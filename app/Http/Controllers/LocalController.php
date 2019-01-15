<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LocalRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;   //Para ocupar y obtener el ID, username, etc una vez logeado el usuario.
use Illuminate\Support\Facades\Input;

use App\Http\Requests\AsociarmeRequest;

use App\Local;
use App\Local_User;
use App\Cadena;
use App\Organizacion;



class LocalController extends Controller
{

    public function __construct()
    {
        //Validación de usuario logeado - debe haber un usuario logeado para entrar
        $this->middleware('auth', ['except' => ['index']]);
        //Validar que el usuario logeado es un tipo->administrador
        //tuvé que crear el middleware "Admin.php" y agregarlo en el kernel
        $this->middleware('admin', ['except' => ['index','getVincular','postVincular']]);
    }    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locales = Local::where('estado', 'Activo')->where('visible', 'Si')->get();

        return view('local.index')
            ->with('locales', $locales);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $local = Local::find($id);

      

        if($local=='')
        {
            return redirect()->action('HomeController@index');
        }        

        return view('local.show')
            ->with('local', $local);
    }

    /**
     * Show the form for editing the s
     pecified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $local = Local::findOrFail($id);

        $cadenas = Cadena::orderby('nombre','ASC')->lists('nombre','id');
        $organizaciones = Organizacion::orderby('nombre','ASC')->lists('nombre','id');          


        return view('local.edit')
            ->with('local', $local)
            ->with('cadenas', $cadenas)            
            ->with('organizaciones', $organizaciones); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocalRequest $request, $id)
    {
        $local = Local::findOrFail($id);

        $local->fill($request->all());

        $local->save();

        session()->flash('success', 'Modificado exitosamente');
      
        return redirect()->action('LocalController@edit', ['id' => $id])
            ->with('local', $local);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $local = Local::find($id);

        // Valida si el ID del articulo existe, en el caso de que no exista lo redirecciona al Inicio (nulo)
        if($local=='')
        {
            return redirect()->action('HomeController@index');
        }

        $local->delete();//Articulo::destroy($id); //otra opción para eliminar un registro

        session()->flash('danger', '¡Se ha borrado la cadena  de forma exitosa!');
        return redirect()->action('LocalController@index');
    }

    //Vista Opciones Local
    public function opciones($id){
        $local = Local::find($id);
        return view ('local.opciones')
            ->with('local', $local);
    }

    //Vista Empaques Asignados al Local
    public function empaques($id){
        
        $empaques = Local_User::where('local_id',$id)
                    ->where('estado','=','Activo')
                    ->orWhere('estado','=','Suspendido')
                    ->orWhere('estado','=','Deudor')
                    ->orderby('rol','desc')
                    ->get();
       
        return view ('local.empaques')
            ->with('empaques', $empaques);
    }    

    public function getVincular()
    {
        //El vincular es solo para locales premium
        $locales = Local::where('estado', 'Activo')->where('cuenta', 'Premium')->where('visible', 'Si')->pluck('nombre','id');
        return view('local.vincular')
            ->with('locales', $locales);
    }

    public function postVincular(AsociarmeRequest $request)
    {
        $local = Local::where('id', $request->local_id)->where('codigo', $request->codigo)->first();
        //dd($local);
        if($local == '') {
            session()->flash('danger', 'Código Incorrecto');
            return redirect()->action('LocalController@getVincular');
        }elseif($local->estado == 'Bloqueado'){
            session()->flash('danger', 'El local se encuentra bloqueado.');
            return redirect()->action('LocalController@getVincular');
        }elseif($local->visible == 'No'){
            session()->flash('danger', 'El local no tiene habilitado esta opción');
            return redirect()->action('LocalController@getVincular');
        }elseif($local->cuenta == 'Free'){
            session()->flash('danger', 'Opción disponible para locales Premium');
            return redirect()->action('LocalController@getVincular');
        }else{

            $pertenece = Local_User::where('local_id', $request->local_id)->where('user_id', Auth::user()->id)->count();

            if($pertenece > 0)
            {
                //Si el usuario fue desvinculado debe agregarse mediante el rut, desde la vista del Enc.
                session()->flash('danger', '¡Usted ya pertenece al local!.');
                return redirect()->action('UsuarioController@misLocales');
            }

            $local_user = new Local_User();
            $local_user->cuposToma = 4;
            $local_user->cuposPreToma = 0;
            $local_user->cuposRepechaje = 10;
            $local_user->estado = "Activo";
            $local_user->rol = "Empaque";
            $local_user->inicioCastigo = null;
            $local_user->terminoCastigo = null;
            $local_user->local_id = $request->local_id;
            $local_user->user_id = Auth::user()->id;

            $local_user->save();

            session()->flash('success', '¡Ahora pertecenes al local!.');
            return redirect()->action('UsuarioController@misLocales');
        }
        
    }
}
