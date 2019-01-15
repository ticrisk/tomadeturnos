<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;   //Para ocupar y obtener el ID, username, etc una vez logeado el usuario.
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CadenaRequest;
use App\Cadena;



class CadenaController extends Controller
{

    public function __construct()
    {
        //Validación de usuario logeado - debe haber un usuario logeado para entrar
        $this->middleware('auth');
        //Validar que el usuario logeado es un tipo->administrador
        //tuvé que crear el middleware "Admin.php" y agregarlo en el kernel
        $this->middleware('admin');
    }    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cadena = Cadena::all();

        return view('cadena.index')
            ->with('cadena', $cadena);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cadena.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CadenaRequest $request)
    {
        $cadena = new Cadena($request->all());

        $cadena->save();
       
        session()->flash('success', 'Guardado exitosamente');
        return redirect()->action('CadenaController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cadena = Cadena::find($id);

        if($cadena=='')
        {
            return redirect()->action('HomeController@index');
        }        

        return view('cadena.show')
            ->with('cadena', $cadena);
    }

    /**
     * Show the form for editing the s
     pecified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cadena = Cadena::find($id);

        if($cadena=='')
        {
            return redirect()->action('HomeController@index');
        }        

        return view('cadena.edit')
            ->with('cadena', $cadena);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CadenaRequest $request, $id)
    {
        $cadena = Cadena::find($id);

        if($cadena=='')
        {
            return redirect()->action('HomeController@index');
        }

        $cadena->fill($request->all());

        $cadena->save();

        session()->flash('success', 'Modificado exitosamente');
      
        return redirect()->action('CadenaController@edit', ['id' => $id])
            ->with('cadena', $cadena);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cadena = Cadena::find($id);

        /*
            Valida si el ID del articulo existe, en el caso de que no exista lo redirecciona al Inicio (nulo)
        */
        if($cadena=='')
        {
            return redirect()->action('HomeController@index');
        }


        $cadena->delete();//Articulo::destroy($id); //otra opción para eliminar un registro


        session()->flash('danger', '¡Se ha borrado la cadena  de forma exitosa!');
        return redirect()->action('CadenaController@index');
    }
}
