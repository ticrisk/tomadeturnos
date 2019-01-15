<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;   //Para ocupar y obtener el ID, username, etc una vez logeado el usuario.
use Illuminate\Support\Facades\Input;

use App\Http\Requests\OrganizacionRequest;

use App\Organizacion;



class OrganizacionController extends Controller
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
        $organizacion = Organizacion::all();

        return view('organizacion.index')
            ->with('organizacion', $organizacion);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('organizacion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganizacionRequest $request)
    {
        $organizacion = new Organizacion($request->all());

        $organizacion->save();

        session()->flash('success', 'Guardado exitosamente');
        return redirect()->action('OrganizacionController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $organizacion = Organizacion::find($id);

        if($organizacion=='')
        {
            return redirect()->action('HomeController@index');
        }        

        return view('organizacion.show')
            ->with('organizacion', $organizacion);
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
        $organizacion = Organizacion::find($id);

        if($organizacion=='')
        {
            return redirect()->action('HomeController@index');
        }        

        return view('organizacion.edit')
            ->with('organizacion', $organizacion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrganizacionRequest $request, $id)
    {
        $organizacion = Organizacion::find($id);

        if($organizacion=='')
        {
            return redirect()->action('HomeController@index');
        }

        $organizacion->fill($request->all());

        $organizacion->save();

        session()->flash('success', 'Modificado exitosamente');
      
        return redirect()->action('OrganizacionController@edit', ['id' => $id])
            ->with('organizacion', $organizacion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organizacion = Organizacion::find($id);

        /*
            Valida si el ID de la org. existe, en el caso de que no exista lo redirecciona al Inicio (nulo)
        */
        if($organizacion=='')
        {
            return redirect()->action('HomeController@index');
        }


        $organizacion->delete();//Articulo::destroy($id); //otra opción para eliminar un registro


        session()->flash('danger', '¡Se ha borrado la organización  de forma exitosa!');
        return redirect()->action('OrganizacionController@index');
    }
}
