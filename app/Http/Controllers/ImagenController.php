<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ImagenRequest;
use App\Http\Requests\UpdateImagenRequest;


use App\Imagen;   
use App\User;
use Auth;   


class ImagenController extends Controller
{
    public function __construct()
    {
        //Validación de usuario logeado - debe haber un usuario logeado para entrar
        $this->middleware('auth', ['except' => ['index', 'show', 'getMemes', 'getFrases']]);
        $this->middleware('admin', ['except' => ['index', 'show', 'getMemes', 'getFrases']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Publico
    public function index()
    {
        
        //return view('imagen.memes');
        return redirect()->action('ImagenController@getMemes');
    }

    public function getMemes()
    {
        $memes = Imagen::where('tipo', 'Meme')->where('estado', 'Activo')->orderBy('updated_at', 'desc')->paginate(10);

        return view('imagen.memes')
            ->with('memes', $memes);
    }

    public function getFrases()
    {
        $frases = Imagen::where('tipo', 'Frase')->where('estado', 'Activo')->orderBy('updated_at', 'desc')->paginate(10);

        return view('imagen.frases')
            ->with('frases', $frases);
    }        


    public function misImagenes()
    {
        $imagenes = Imagen::orderBy('id', 'desc')->paginate(10);

        

        return view('imagen.mis-imagenes')
            ->with('imagenes', $imagenes);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        return view('imagen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImagenRequest $request)
    {
        $art = new Imagen($request->all());

                //Paso 2. -> Obtengo el ID del usuario logeado
        $art->user_id = Auth::user()->id;    

        //Paso 4.1. -> Obtengo la imagen del blog del formulario.
        $fileBlog = $request->file('imagen');
        //Paso 4.2. -> Concateno ID + '-blog-' + fecha/hora + extension.
        $rename_fileBlog = $art->user_id . '-img-' . time() . '.' . $fileBlog->getClientOriginalExtension();
        //Paso 4.3. -> Dirección donde se alberga el proyecto + dirección donde se alberga la imagenes.
        $path = public_path() . '/img/album/';
        //Paso 4.4. -> Muevo y guardo la imagen a la dirección del path
        $fileBlog->move($path, $rename_fileBlog);
        //Paso 4.5. -> Función del "Intervention Image", busco la imagen con el make(dirección+nombre archivo) y le cambio el tamaño con el resize.
        $img = \Image::make($path.$rename_fileBlog)->resize(850, 450);//Tamaño de la imagen para que se vea bien en el articulo
        //Paso 4.6. -> Sustituyo la imagen redimensionada del paso 4.5 por la antigua guardada en el paso 4.4
        $img->save($path .$rename_fileBlog);
        //Paso 4.7. -> El nombre de la imagen guardada la albergo en el objeto $art->imagen para ser guardada el nombre en la base de datos.
        $art->imagen = $rename_fileBlog;


        //Paso 5. -> Guardo en la base de datos
        $art->save();
       
        //Paso 6. -> Envío un mensaje de "Guardado" al controlador ArticleController@listado que ejecuta la vista del article/list.blade.php
        session()->flash('success', 'Guardado exitosamente');
        return redirect()->action('ImagenController@misImagenes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $imagen = Imagen::where('link', $id)->where('estado', 'Activo')->first();

        $ultimos = Imagen::where('estado', 'Activo')->orderBy('updated_at','desc')->take(3)->get();

        if($imagen=='')
        {
            //return redirect()->action('HomeController@index');
            return view('errors.userNotFound');
        }
        //Paso 3.
        return view('imagen.show')
            ->with('imagen', $imagen)
            ->with('ultimos', $ultimos);        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Paso 1.
        $imagen = Imagen::find($id);
        /*
        Paso 2.
            -Valida si el ID del articulo existe, en el caso de que no exista lo redirecciona al Inicio (nulo)
            -Valida si el articulo pertenece al usuario, en el caso de que no pertenezca lo redirecciona al Inicio
        */
        if($imagen=='')
        {
            return redirect()->action('HomeController@index');
        }
        //Paso 3.
        return view('imagen.edit')
            ->with('imagen', $imagen);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImagenRequest $request, $id)
    {
        $imagen = Imagen::find($id);

        if($imagen->user_id != Auth::user()->id)
        {
            return redirect()->action('HomeController@index');
        }
        
     
        
        $imgBlog = $imagen->imagen;
        //$imgFacebook = $art->imgDescripcion;
        $imagen->fill($request->all());



        if($imagen->imagen != $imgBlog)
        {
            //Eliminno la antigua foto y guardo la nueva imagen 
            \File::delete(public_path().'/img/album/'.$imgBlog);//elimino foto guardada anteriormente
            //Guardo la foto subida al hacer el update
            $fileBlog = $request->file('imagen');
            $rename_fileBlog = $imagen->user_id . '-img-' . time() . '.' . $fileBlog->getClientOriginalExtension();
            $path = public_path() . '/img/album/';
            $fileBlog->move($path, $rename_fileBlog);
            $img = \Image::make($path.$rename_fileBlog)->resize(850, 450);//Tamaño de la imagen para que se vea bien en el articulo
            $img->save($path .$rename_fileBlog);
            $imagen->imagen = $rename_fileBlog;
        }


        $imagen->update();
        
        session()->flash('success', "Artículo <u><b><em> $imagen->titulo </em></b></u> modificado exitosamente");
        return redirect()->action('ImagenController@misImagenes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imagen = Imagen::find($id);

        /*
            Valida si el ID del articulo existe, en el caso de que no exista lo redirecciona al Inicio (nulo)
            Valida si el articulo pertenece al usuario, en el caso de que no pertenezca lo redirecciona al Inicio
        */
        if($imagen == '')
        {
            return redirect()->action('HomeController@index');
        }



        $imagen->delete();//Articulo::destroy($id); //otra opción para eliminar un registro


        \File::delete(public_path().'/img/album/'.$imagen->imagen);
        
        

        session()->flash('danger', '¡Se ha borrado el artículo <u><b><em>' . $imagen->titulo . '</em></b></u>  de forma exitosa!');
        return redirect()->action('ImagenController@misImagenes');
    }
}
