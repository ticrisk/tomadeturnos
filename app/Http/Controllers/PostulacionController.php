<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use App\Http\Requests\UserRequest;
use Auth;   //Para ocupar y obtener el ID, username, etc una vez logeado el usuario.
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
//use Illuminate\Validation\Validator;//para validar dentro del controlador
use Validator;

use App\Http\Requests\AspiranteRequest;



use App\User;
use App\Cadena;
use App\Organizacion;
use App\Local;
use App\Local_User;
use App\Postulacion_User;
use App\Postulacion;


class PostulacionController extends Controller
{
    public function __construct()
    {
        //Validación de usuario logeado - debe haber un usuario logeado para entrar
        $this->middleware('auth', ['except' => ['index']]);
        //Validar que el usuario logeado es un tipo->administrador
    }

    public function index()
    {
        $hoy = date('Y-m-d H:i:s');
        //$postulaciones = Postulacion::orderBy('inicio', 'DESC')->paginate(4);
        $postulaciones = DB::table('postulaciones')
            ->select('postulaciones.descripcion','postulaciones.cupos','postulaciones.inicio','postulaciones.termino','postulaciones.activarLista','postulaciones.id', 'locales.nombre','locales.visible','cadenas.nombre as cadenaNombre')
            ->join('locales', 'postulaciones.local_id', '=', 'locales.id')
            ->where('locales.visible', '=', 'Si')
            ->join('cadenas', 'locales.cadena_id', '=', 'cadenas.id')
            ->orderBy('postulaciones.inicio', 'desc')
            ->paginate(4);

        //dd($postulaciones);
        foreach ($postulaciones as $postulacion){

            if($postulacion->activarLista == 'Azar'){
                $postulacion->activa = 'Azar';
            }elseif($postulacion->inicio <= $hoy && $postulacion->termino >= $hoy ){
                $postulacion->activa = 'Activa';
            }elseif($postulacion->termino <= $hoy){
                $postulacion->activa = 'Finalizada';
            }else{
                $postulacion->activa = 'En Curso';
            }

        }

        return view('postulaciones.index')
            ->with('postulaciones', $postulaciones);

    }

    public  function postulacion($id){

        $postulacion = Postulacion::find($id);
        $hoy = date('Y-m-d H:i:s');
        $cantUserLista = 0;
        $userEstado = 0;
        $cantTomados = 0;
        //dd($postulacion->Local->visible);
        if($postulacion == ''){
            return view ('errors/userNotFound');
        }elseif ($postulacion->Local->visible == 'No') {
            session()->flash('danger', 'El local no permite esta operación');
            return redirect()->action('PostulacionController@index');
        }elseif($postulacion->activarLista == 'Azar'){
            session()->flash('danger', 'Las postulaciones de tipo "Azar" son sorteos automáticos.');
            return redirect()->action('PostulacionController@index');
        }elseif($postulacion->inicio > $hoy || $postulacion->termino < $hoy){
            session()->flash('danger', 'Aún no es hora de la postulación '. $postulacion->id .' del '. $postulacion->Local->Cadena->nombre . ' - ' . $postulacion->Local->nombre );
            return redirect()->action('PostulacionController@index');
        }elseif($postulacion->activarLista == 'Si'){//Es 'Si' si es que pertenece a una postulación privada
            //Selecciono todos los cupos tomados en la postulación
            $allPostulaciones = Postulacion_User::where('postulacion_id', $id)->get();
            foreach ($allPostulaciones as $pos){
                //compruebo si aparece el id del usuario en la lista privada
                if($pos->user_id == Auth::user()->id){
                    $cantUserLista++;
                    if($pos->estado == 'Tomado'){
                        $userEstado++;
                        $cantTomados++;
                    }
                }elseif($pos->estado == 'Tomado'){
                    $cantTomados++;
                }
            }
            //si es nulo significa q no esta en la lista
            if($cantUserLista == 0){
                session()->flash('danger', 'La postulación '. $postulacion->id .' del '. $postulacion->Local->Cadena->nombre . ' - ' . $postulacion->Local->nombre . ' es privada y usted no está en la lista de candidatos.');
                return redirect()->action('PostulacionController@index');
            }else{
                $postulacion->cuposTomados = $cantTomados;
                //estado del boton a mostrar
                if($userEstado > 0){
                    $postulacion->addEstado = 'mio';
                }elseif($postulacion->cuposTomados >= $postulacion->cupos){
                    $postulacion->addEstado = 'no-cupos';
                }else{
                    $postulacion->addEstado = 'ok';
                }

            }
        }else{
            //Selecciono todos los cupos tomados en la postulación
            $allPostulaciones = Postulacion_User::where('postulacion_id', $id)->where('estado', 'Tomado')->get();

            foreach ($allPostulaciones as $pos){
                $cantTomados++;
                if($pos->user_id == Auth::user()->id){
                    $userEstado++;
                }
            }


                //Entra cuando todos los datos estan correctos!
                $postulacion->cuposTomados = $cantTomados;
                //estado del boton a mostrar
                if($userEstado > 0){
                    $postulacion->addEstado = 'mio';
                }elseif($postulacion->cuposTomados >= $postulacion->cupos){
                    $postulacion->addEstado = 'no-cupos';
                }else{
                    $postulacion->addEstado = 'ok';
                }




        }
        return view('postulaciones.postulacion')
            ->with('postulacion', $postulacion);
    }

    public function postPostulacion($id, Request $request){//id postulacion

        $postulacion = Postulacion::find($id);
        $hoy = date('Y-m-d H:i:s');
        $estado = 'ok';

        if($postulacion == ''){
            abort(500);
            //return view ('errors/userNotFound');
        }

        $cantTomados = Postulacion_User::where('postulacion_id', $id)->where('estado', 'Tomado')->count();
        $posUser = Postulacion_User::where('postulacion_id', $id)->where('user_id', Auth::user()->id)->first();

        if($postulacion->termino < $hoy){
            //postulación ya finalizó
            $estado = 'finalizo';
            //Flash::error('La postulación '. $postulacion->id .' del '. $postulacion->Local->Cadena->nombre . ' - ' . $postulacion->Local->nombre . ' ya finalizó');
            //return redirect()->action('PostulacionController@index');
        }elseif($postulacion->activarLista == 'Privada'){

            //si es nulo significa q no esta en la lista
            if($posUser == ""){
                $estado = 'privada';
                //Flash::error('La postulación '. $postulacion->id .' del '. $postulacion->Local->Cadena->nombre . ' - ' . $postulacion->Local->nombre . ' es privada y usted no está en la lista de candidatos.');
                //return redirect()->action('PostulacionController@index');
            }else{
                //si ya tengo el cupo
                if($posUser->estado == 'Tomado'){
                    $estado = 'mio';
                    //Flash::success('Usted ya participó en la postulación '. $postulacion->id .' del '. $postulacion->Local->Cadena->nombre . ' - ' . $postulacion->Local->nombre );
                    //return redirect()->action('PostulacionController@index');
                    //abort(500);
                }elseif($cantTomados >= $postulacion->cupos){
                    //falta el no cupos
                    $estado = 'no-cupos';
                } else {
                    //si está en la lista y cumple con los requisitos se procede actualizar el registro de la persona, se agrega la hora y el estado pasa a "tomado"
                    $posUser->postulacion = $hoy;
                    $posUser->estado = "Tomado";
                    $posUser->update();
                    $estado = 'ok';
                    $cantTomados = $cantTomados + 1;
                }
            }
        }elseif($postulacion->activarLista == 'Azar'){
            $estado = 'azar';
        }else{
            //es una lista publica y se hace un insert en la postulacion_user

            if($posUser == ''){
                if( $cantTomados < $postulacion->cupos) {
                    //si está en la lista y cumple con los requisitos se procede actualizar el registro de la persona, se agrega la hora y el estado pasa a "tomado"
                    $posUser = new Postulacion_User();
                    $posUser->postulacion = $hoy;
                    $posUser->estado = "Tomado";
                    $posUser->postulacion_id = $id;
                    $posUser->user_id = Auth::user()->id;
                    $posUser->save();
                    $estado = 'ok';
                    $cantTomados = $cantTomados + 1;
                }else{
                    $estado = 'no-cupos';
                }
            }elseif($posUser->estado == 'Tomado'){
                //si ya tengo el cupo
                $estado = 'mio';
                //Flash::success('Usted ya participó en la postulación '. $postulacion->id .' del '. $postulacion->Local->Cadena->nombre . ' - ' . $postulacion->Local->nombre );
                //return redirect()->action('PostulacionController@index');
                //abort(500);
            }elseif($cantTomados >= $postulacion->cupos){
                //falta el no cupos
                $estado = 'no-cupos';
            }elseif($posUser->estado == 'Espera'){
                abort(500);
            }
        }


        if($request->ajax()){
            return response()->json([

                'cuposTomados'    =>  $cantTomados,
                'estado'   =>  $estado,


            ]);
        }

    }

    public function getAspirante()
    {
        //Se puede postulara la lista privada antes de que termine la postulacion
        //dd($x->FullName);

        $hoy = date('Y-m-d H:i:s');
        $postulaciones = Postulacion::where('activarLista', 'Privada')->where('termino', '>' ,$hoy)->pluck('id','id');

        return view('postulaciones.aspirante')
            ->with('postulaciones', $postulaciones);
    }

    public function postAspirante(AspiranteRequest $request)
    {
        $hoy = date('Y-m-d H:i:s');
        $postulacion = Postulacion::find($request->id);

        if($postulacion->Local->visible == 'No'){
            session()->flash('danger', 'El local no permite esta opción');
            return redirect()->action('PostulacionController@getAspirante');
        }elseif ($postulacion->termino < $hoy) {
            session()->flash('danger', 'No es posible participar porque la postulación ya finalizó');
            return redirect()->action('PostulacionController@getAspirante');
        }
        elseif($postulacion->Local->codigoPostulacion != $request->codigoPostulacion){
            session()->flash('danger', 'Código de la Postulación Incorrecto');
            return redirect()->action('PostulacionController@getAspirante');
        }elseif($postulacion->activarLista != 'Si'){
            session()->flash('danger', 'Error - ¡La postulación es pública!');
            return redirect()->action('PostulacionController@getAspirante');
        }else{

            $pertenece = Local_User::where('local_id', $postulacion->local_id)->where('user_id', Auth::user()->id)->where('estado', '!=', 'Desvinculado')->count();

            if($pertenece > 0)
            {
                session()->flash('danger', '¡Usted ya pertenece al local!.');
                return redirect()->action('UsuarioController@misLocales');
            }

            $participantes = Postulacion_User::where('postulacion_id', $request->id)->where('user_id', Auth::user()->id)->count();
            if($participantes > 0) {
                session()->flash('success', '¡Usted ya se encuentra registrado en la lista Privada!.');
                return redirect()->action('PostulacionController@getAspirante');
            }

            $postulacion_user = new Postulacion_User();
            $postulacion_user->postulacion = null;
            $postulacion_user->estado = "Espera";
            $postulacion_user->postulacion_id = $request->id;
            $postulacion_user->user_id = Auth::user()->id;

            $postulacion_user->save();


            session()->flash('success', '¡Ahora puedes participar en la postulación privada!.');
            return redirect()->action('PostulacionController@index');
            //mboT4ockL7KZHpyF
        }

    }
}