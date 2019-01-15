<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ArticuloRequest;
use App\Http\Requests\UpdateArticuloRequest;

//use App\Http\Requests\ArticuloRequest;  //Para poder usar la validación del App/Http/Rquest/ArticuloRequest
//use App\Http\Requests\Update_ArticuloRequest; 
use App\Articulo;   //Llamo a la clase Articulo
use App\User;
use Auth;   //Para ocupar y obtener el ID, username, etc una vez logeado el usuario.

class ArticuloController extends Controller
{
    public function __construct()
    {
        //Validación de usuario logeado - debe haber un usuario logeado para entrar
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('admin', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Publico
    public function index()
    {
        $articulos = Articulo::where('estado', 'Activo')->orderBy('updated_at', 'desc')->paginate(10);

        return view('articulo.index')
            ->with('articulos', $articulos);
    }


    public function misArticulos()
    {
        $articulos = Articulo::orderBy('id', 'desc')->paginate(10);

        

        return view('articulo.mis-articulos')
            ->with('articulos', $articulos);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articulo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticuloRequest $request)
    {
        $art = new Articulo($request->all());

                //Paso 2. -> Obtengo el ID del usuario logeado
        $art->user_id = Auth::user()->id;    

        //Paso 4.1. -> Obtengo la imagen del blog del formulario.
        $fileBlog = $request->file('portada');
        //Paso 4.2. -> Concateno ID + '-blog-' + fecha/hora + extension.
        $rename_fileBlog = $art->user_id . '-blog-' . time() . '.' . $fileBlog->getClientOriginalExtension();
        //Paso 4.3. -> Dirección donde se alberga el proyecto + dirección donde se alberga la imagenes.
        $path = public_path() . '/img/articulos/';
        //Paso 4.4. -> Muevo y guardo la imagen a la dirección del path
        $fileBlog->move($path, $rename_fileBlog);
        //Paso 4.5. -> Función del "Intervention Image", busco la imagen con el make(dirección+nombre archivo) y le cambio el tamaño con el resize.
        $img = \Image::make($path.$rename_fileBlog)->resize(850, 450);//Tamaño de la imagen para que se vea bien en el articulo
        //Paso 4.6. -> Sustituyo la imagen redimensionada del paso 4.5 por la antigua guardada en el paso 4.4
        $img->save($path .$rename_fileBlog);
        //Paso 4.7. -> El nombre de la imagen guardada la albergo en el objeto $art->imagen para ser guardada el nombre en la base de datos.
        $art->portada = $rename_fileBlog;

        //Se repite los pasos del 4.x pero con la imagen del Facebook
        $fileFacebook = $request->file('imgDescripcion');
        $rename_fileFacebook = $art->user_id . '-fb-' . time() . '.' . $fileFacebook->getClientOriginalExtension();
        $path = public_path() . '/img/articulos/';
        $fileFacebook->move($path, $rename_fileFacebook);
        $img = \Image::make($path.$rename_fileFacebook)->resize(484, 252);//Tamaño recomendado Face (compartir) = 484 x 252  - Planilla defecto : 700 x 460
        $img->save($path .$rename_fileFacebook);
        $art->imgDescripcion = $rename_fileFacebook;
        

        //COnvierto a minúscula todo el texto y desques quito la palabras del array 'xss'
        //titulo y descripción -> eliminar etiquetas
        /*
        $xss = array("script", "applet", "object", "embed");
        
        $art->titulo        = str_replace($xss,'',strtolower(strip_tags($art->titulo)));
        $art->descripcion   = str_replace($xss,'',strtolower(strip_tags($art->descripcion)));
        $art->texto_uno     = str_replace($xss,'',strtolower($art->texto_uno));
        $art->texto_dos     = str_replace($xss,'',strtolower($art->texto_dos));
        $art->texto_tres    = str_replace($xss,'',strtolower($art->texto_tres));
        */
        //Paso 5. -> Guardo en la base de datos
        $art->save();
       
        //Paso 6. -> Envío un mensaje de "Guardado" al controlador ArticleController@listado que ejecuta la vista del article/list.blade.php
        session()->flash('success', 'Guardado exitosamente');
        return redirect()->action('ArticuloController@misArticulos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $art = Articulo::where('link', $id)->where('estado', 'Activo')->first();

        $ultimos = Articulo::where('estado', 'Activo')->orderBy('updated_at','desc')->take(5)->get();

        if($art=='')
        {
            //return redirect()->action('HomeController@index');
            return view('errors.userNotFound');
        }
        //Paso 3.
        return view('articulo.show')
            ->with('art', $art)
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
        $art = Articulo::find($id);
        /*
        Paso 2.
            -Valida si el ID del articulo existe, en el caso de que no exista lo redirecciona al Inicio (nulo)
            -Valida si el articulo pertenece al usuario, en el caso de que no pertenezca lo redirecciona al Inicio
        */
        if($art=='')
        {
            return redirect()->action('HomeController@index');
        }
        //Paso 3.
        return view('articulo.edit')
            ->with('art', $art);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticuloRequest $request, $id)
    {
        $art = Articulo::find($id);

        if($art->user_id != Auth::user()->id)
        {
            return redirect()->action('HomeController@index');
        }
        
        $imgBlog = $art->portada;
        $imgFacebook = $art->imgDescripcion;
        $art->fill($request->all());



        if($art->portada != $imgBlog)
        {
            //Eliminno la antigua foto y guardo la nueva imagen 
            \File::delete(public_path().'/img/articulos/'.$imgBlog);//elimino foto guardada anteriormente
            //Guardo la foto subida al hacer el update
            $fileBlog = $request->file('portada');
            $rename_fileBlog = $art->user_id . '-blog-' . time() . '.' . $fileBlog->getClientOriginalExtension();
            $path = public_path() . '/img/articulos/';
            $fileBlog->move($path, $rename_fileBlog);
            $img = \Image::make($path.$rename_fileBlog)->resize(850, 450);//Tamaño de la imagen para que se vea bien en el articulo
            $img->save($path .$rename_fileBlog);
            $art->portada = $rename_fileBlog;
        }

        if($art->imgDescripcion != $imgFacebook)
        {
            //Eliminno la antigua foto y guardo la nueva imagen 
            \File::delete(public_path().'/img/articulos/'.$imgFacebook);//elimino foto guardada anteriormente
            //Guardo la foto subida al hacer el update
            $fileFacebook = $request->file('imgDescripcion');
            $rename_fileFacebook = $art->user_id . '-fb-' . time() . '.' . $fileFacebook->getClientOriginalExtension();
            $path = public_path() . '/img/articulos/';
            $fileFacebook->move($path, $rename_fileFacebook);
            $img = \Image::make($path.$rename_fileFacebook)->resize(484, 252);
            $img->save($path .$rename_fileFacebook);
            $art->imgDescripcion = $rename_fileFacebook;
        }
       
        //COnvierto a minúscula todo el texto y desques quito la palabras del array 'xss'
        /*
        $xss = array("script", "applet", "object", "embed");
        
        $art->titulo        = str_replace($xss,'',strtolower($art->titulo));
        $art->descripcion   = str_replace($xss,'',strtolower($art->descripcion));
        $art->texto_uno     = str_replace($xss,'',strtolower($art->texto_uno));
        $art->texto_dos     = str_replace($xss,'',strtolower($art->texto_dos));
        $art->texto_tres    = str_replace($xss,'',strtolower($art->texto_tres));
        */
        //$art->estado = 'Editando';//Editando
        $art->update();
        
        session()->flash('success', "Artículo <u><b><em> $art->titulo </em></b></u> modificado exitosamente");
        return redirect()->action('ArticuloController@misArticulos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $art = Articulo::find($id);

        /*
            Valida si el ID del articulo existe, en el caso de que no exista lo redirecciona al Inicio (nulo)
            Valida si el articulo pertenece al usuario, en el caso de que no pertenezca lo redirecciona al Inicio
        */
        if($art == '')
        {
            return redirect()->action('HomeController@index');
        }

        $art->delete();//Articulo::destroy($id); //otra opción para eliminar un registro

        \File::delete(public_path().'/img/articulos/'.$art->portada);
        \File::delete(public_path().'/img/articulos/'.$art->imgDescripcion);
        
        session()->flash('danger', '¡Se ha borrado el artículo <u><b><em>' . $art->titulo . '</em></b></u>  de forma exitosa!');
        return redirect()->action('ArticuloController@misArticulos');
    }
}
