<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;   //Para ocupar y obtener el ID, username, etc una vez logeado el usuario.
use Illuminate\Support\Facades\Input;
use App\Http\Requests\InformativoRequest;
use App\Informativo;
use App\User;

class InformativoController extends Controller
{
    public function __construct()
    {
        //Validación de usuario logeado - debe haber un usuario logeado para entrar
        $this->middleware('auth');
        
        $this->middleware('admin');
    }    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*
        FUNCIONES PARA ENCARGADO
    */

    public function index()
    {
        $informativos = Informativo::orderBy('updated_at', 'desc')->paginate(10);

        return view('informativo.index')
            ->with('informativos', $informativos);
    }

    public function create()
    {
        return view('informativo.create');
    }

    public function store(InformativoRequest $request)
    {
        $informativo = new Informativo($request->all());

        $informativo->user_id = Auth::user()->id;

        $informativo->save();

        session()->flash('success', 'Informativo Agregado');
        return redirect()->action('InformativoController@index');
     
    }


    public function edit($id)
    {
        $informativo = Informativo::find($id);
        if($informativo == '')
        {
            return view('errors.userNotFound');
        }

        return view('informativo.edit')
            ->with('informativo', $informativo);
    }

    public function update(InformativoRequest $request, $id)
    {

        $informativo = Informativo::find($id);
        if(empty($informativo))
        {
            return view('errors.userNotFound');
        }

        $informativo->fill($request->all());
        $informativo->user_id = Auth::user()->id;
        $informativo->update();

        session()->flash('success', 'Modificado Exitosamente.');
        return redirect()->route('informativo.edit', ['id' => $id]);           
    }

    public function destroy($id)
    {
        $informativo = Informativo::find($id);
        if(empty($informativo))
        {
            return view('errors.userNotFound');
        }

        $informativo->delete();

        session()->flash('danger', 'Informativo Eliminado');
        return redirect()->action('InformativoController@index');        
    }

}
