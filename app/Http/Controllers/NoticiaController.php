<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;   //Para ocupar y obtener el ID, username, etc una vez logeado el usuario.
use Illuminate\Support\Facades\Input;

use App\Http\Requests\NoticiaRequest;


use App\Noticia;
use App\User;
use App\Local;
use App\Local_User;


class NoticiaController extends Controller
{

    public function __construct()
    {
        //Validación de usuario logeado - debe haber un usuario logeado para entrar
        $this->middleware('auth');
        
        $this->middleware('admin', ['except' => ['noticiaLocal', 'editarNoticia', 'updateNoticia', 'deleteNoticia', 'agregarNoticia', 'postAgregarNoticia']]);
    }    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*
        FUNCIONES PARA ENCARGADO
    */

    public function noticiaLocal($id)
    {
        //busco si existe el id del local
        $infoLocal = Local::findOrFail($id);

        //Validación Encargado, Versión, Estado
        $local = Local_User::where('user_id', Auth::user()->id)
            ->where('estado', '!=', 'Desvinculado')
            ->where('local_id', $id)
            ->where('rol', 'Encargado')
            ->first();

        if (empty($local)) {
            session()->flash('danger', 'Usted no tiene privilegios suficientes.');
            return redirect()->action('HomeController@index');
        }elseif($local->Local->cuenta == 'Free'){
            session()->flash('danger', 'Opción disponible para locales premium');
            return redirect()->action('UsuarioController@opciones', ['id' => $id]);
        }elseif ($local->Local->estado == 'Bloqueado'){
            session()->flash('danger', 'El local se encuentra temporalmente bloqueado.');
            return redirect()->action('UsuarioController@misLocales');
        }
        //Fin Validación

        $noticias = Noticia::where('local_id', $id)->where('estado', 'Público')->orderBy('updated_at', 'desc')->paginate(10);

        return view('noticia.noticia-local')
            ->with('noticias', $noticias)
            ->with('idLocal', $id);
    }


    public function editarNoticia($id)//id noticia
    {
        $noticia = Noticia::findOrFail($id);

        //Validación Encargado, Versión, Estado
        $local = Local_User::where('user_id', Auth::user()->id)
            ->where('estado', '!=', 'Desvinculado')
            ->where('local_id', $noticia->local_id)
            ->where('rol', 'Encargado')
            ->first();

        if (empty($local)) {
            session()->flash('danger', 'Usted no tiene privilegios suficientes.');
            return redirect()->action('HomeController@index');
        }elseif($local->Local->cuenta == 'Free'){
            session()->flash('danger', 'Opción disponible para locales premium');
            return redirect()->action('UsuarioController@opciones', ['id' => $noticia->local_id]);
        }elseif ($local->Local->estado == 'Bloqueado'){
            session()->flash('danger', 'El local se encuentra temporalmente bloqueado.');
            return redirect()->action('UsuarioController@misLocales');
        }
        //Fin Validación

        return view('noticia.editar-noticia')
            ->with('noticia', $noticia);
    }

    public function updateNoticia(NoticiaRequest $request, $id)//id noticia
    {
        $noticia = Noticia::find($id);
        if(empty($noticia))
        {
            session()->flash('danger', 'Noticia no encontrada');
            return redirect()->action('HomeController@index');
        }

        //Validación Encargado, Versión, Estado
        $local = Local_User::where('user_id', Auth::user()->id)
            ->where('estado', '!=', 'Desvinculado')
            ->where('local_id', $request->local_id)
            ->where('rol', 'Encargado')
            ->first();

        if (empty($local)) {
            session()->flash('danger', 'Usted no tiene privilegios suficientes.');
            return redirect()->action('HomeController@index');
        }elseif($local->Local->cuenta == 'Free'){
            session()->flash('danger', 'Opción disponible para locales premium');
            return redirect()->action('UsuarioController@opciones', ['id' => $request->local_id]);
        }elseif ($local->Local->estado == 'Bloqueado'){
            session()->flash('danger', 'El local se encuentra temporalmente bloqueado.');
            return redirect()->action('UsuarioController@misLocales');
        }
        //Fin Validación

        $noticia->fill($request->all());
        $noticia->estado = "Público";
        $noticia->update();

        session()->flash('success', 'Modificado Exitosamente.');
        return redirect()->route('noticia.editar-noticia', ['id' => $id]);      
    }


    public function deleteNoticia($id)//id noticia
    {
        $noticia = Noticia::find($id);

        if(empty($noticia))
        {
            session()->flash('danger', 'Error al eliminar, noticia no encontrada');
            return redirect()->action('HomeController@index');
        }

        //Validación Encargado, Versión, Estado
        $local = Local_User::where('user_id', Auth::user()->id)
            ->where('estado', '!=', 'Desvinculado')
            ->where('local_id', $noticia->local_id)
            ->where('rol', 'Encargado')
            ->first();

        if (empty($local)) {
            session()->flash('danger', 'Usted no tiene privilegios suficientes.');
            return redirect()->action('HomeController@index');
        }elseif($local->Local->cuenta == 'Free'){
            session()->flash('danger', 'Opción disponible para locales premium');
            return redirect()->action('UsuarioController@opciones', ['id' => $noticia->local_id]);
        }elseif ($local->Local->estado == 'Bloqueado'){
            session()->flash('danger', 'El local se encuentra temporalmente bloqueado.');
            return redirect()->action('UsuarioController@misLocales');
        }
        //Fin Validación

        $noticia->delete();

        session()->flash('danger', 'Noticia Eliminada.');
        return redirect()->route('noticia.noticia-local', ['id' => $noticia->local_id]);  
    }

    public function agregarNoticia($id)//id local
    {

        $infoLocal = Local::findOrFail($id);

        //Validación Encargado, Versión, Estado
        $local = Local_User::where('user_id', Auth::user()->id)
            ->where('estado', '!=', 'Desvinculado')
            ->where('local_id', $id)
            ->where('rol', 'Encargado')
            ->first();

        if (empty($local)) {
            session()->flash('danger', 'Usted no tiene privilegios suficientes.');
            return redirect()->action('HomeController@index');
        }elseif($local->Local->cuenta == 'Free'){
            session()->flash('danger', 'Opción disponible para locales premium');
            return redirect()->action('UsuarioController@opciones', ['id' => $id]);
        }elseif ($local->Local->estado == 'Bloqueado'){
            session()->flash('danger', 'El local se encuentra temporalmente bloqueado.');
            return redirect()->action('UsuarioController@misLocales');
        }
        //Fin Validación

        return view('noticia.agregar-noticia')
            ->with('idLocal', $id)
            ->with('idLocalUser', $local->id);
    }


    public function postAgregarNoticia(NoticiaRequest $request)
    {
        //Validación Encargado, Versión, Estado
        $local = Local_User::where('user_id', Auth::user()->id)
            ->where('estado', '!=', 'Desvinculado')
            ->where('local_id', $request->local_id)
            ->where('rol', 'Encargado')
            ->first();

        if (empty($local)) {
            session()->flash('danger', 'Usted no tiene privilegios suficientes.');
            return redirect()->action('HomeController@index');
        }elseif($local->Local->cuenta == 'Free'){
            session()->flash('danger', 'Opción disponible para locales premium');
            return redirect()->action('UsuarioController@opciones', ['id' => $request->id]);
        }elseif ($local->Local->estado == 'Bloqueado'){
            session()->flash('danger', 'El local se encuentra temporalmente bloqueado.');
            return redirect()->action('UsuarioController@misLocales');
        }
        //Fin Validación

        $noticia = new Noticia($request->all());

        $noticia->estado = "Público";
        //$noticia->local_user_id = 2;
        $noticia->save();
       
        session()->flash('success', 'Guardado exitosamente');
        return redirect()->route('noticia.noticia-local', ['id' => $noticia->local_id]);
    }



                /*
                    ----------------------------

                    ----------------------------
                    FUNCIONES PARA ADMINISTRADOR
                    ----------------------------

                    ----------------------------
                */    






    public function noticiaListadoLocal($id)//id_super
    {
        //busco si existe el id del local
        $local = Local::find($id);
        
        if(empty($local))
        { 
            return view('errors.userNotFound');
        }

        $noticias = Noticia::where('local_id', $id)->where('estado', 'Oculto')->orderBy('updated_at', 'desc')->paginate(10);

        return view('noticia.listado-local')
            ->with('noticias', $noticias)
            ->with('idLocal', $id);
    }


    public function modificarNoticia($id)//id noticia
    {
        $noticia = Noticia::find($id);

        if(empty($noticia))
        {
            return view('errors.userNotFound');
        }
     

        return view('noticia.modificar-noticia')
            ->with('noticia', $noticia);
    }




    public function putNoticia(NoticiaRequest $request, $id)//id noticia
    {
        $noticia = Noticia::find($id);
        if(empty($noticia))
        {
            return view('errors.userNotFound');
        }

        $noticia->fill($request->all());
        $noticia->estado = "Oculto";
        $noticia->update();

        session()->flash('success', 'Modificado Exitosamente.');
        return redirect()->route('noticia.modificar-noticia', ['id' => $id]);      
    }


    public function eliminarNoticia($id)//id noticia
    {
        $noticia = Noticia::find($id);

        if(empty($noticia))
        {
            return view('errors.userNotFound');
        }

        $noticia->delete();

        session()->flash('danger', 'Noticia Eliminada.');
        return redirect()->route('noticia.listado-local', ['id' => $noticia->local_id]);  
    }

    public function insertarNoticia($id)//id local
    {

        $local = Local::find($id);

        if(empty($local))
        {
            return view('errors.userNotFound');
        }

        //El admin debe pertenecer a un local por lo menos
        $idLocalUser = Local_User::select('id')->where('user_id', Auth::user()->id)->first();
        //dd($idLocalUser->id);
        if(!isset($idLocalUser->id))
        {
            session()->flash('danger', 'El Admin debe pertenecer a un local como mínimo');
            return redirect()->route('noticia.listado-local', ['id' => $id]);
        }
        //dd($idLocalUser);
        //$idLocalUser = 52;

        return view('noticia.insertar-noticia')
            ->with('idLocal', $id)
            ->with('idLocalUser', $idLocalUser->id);
    }


    public function postInsertarNoticia(NoticiaRequest $request)
    {
        
        $noticia = new Noticia($request->all());

        $noticia->estado = "Oculto";
        $noticia->save();
       
        session()->flash('success', 'Guardado exitosamente');
        return redirect()->route('noticia.listado-local', ['id' => $noticia->local_id]);
        
    }    

}
