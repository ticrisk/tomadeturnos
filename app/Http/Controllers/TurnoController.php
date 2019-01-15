<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;

use Auth;   //Para ocupar y obtener el ID, username, etc una vez logeado el usuario.

use App\User;
use App\Cadena;
use App\Organizacion;
use App\Local;
use App\Local_User;
use App\Turno;
use App\Planilla;
use App\Planilla_Turno_User;
use App\Noticia;
use App\Informativo;

use Illuminate\Support\Facades\DB;

class TurnoController extends Controller
{

    public function __construct()
    {
        //Validación de usuario logeado - debe haber un usuario logeado para entrar
        $this->middleware('auth');
        //Validar que el usuario logeado es un tipo->administrador
        //tuvé que crear el middleware "Admin.php" y agregarlo en el kernel
        //$this->middleware('admin');
    }   



    public function index()
    {
        //Muestra los super donde puedo tomar turnos o repechajes
        $misLocales = Local_User::where('user_id',Auth::user()->id)->where('estado', '!=' ,'Desvinculado')->get();
        //Validación en el caso de no encontrar registro
        if($misLocales == '' || empty($misLocales))
        {
            session()->flash('danger', 'Usted no  pertenece a ningún local.');
            return redirect()->action('HomeController@index');
        }
        //dd($misLocales);
        return view('turno.index')
            ->with('misLocales', $misLocales);
    }


    public function toma($id)//Deberia ser el id del local - id de la planilla que toca según fecha
    {
        //obtengo los datos del usuario que pertenece al local
        $user = Local_User::where('user_id', Auth::user()->id)->where('local_id', $id)->where('estado', '!=', 'Desvinculado')->firstOrFail();

        //Obtengo la fecha y hora actual del servidor
        $hora = date('Y-m-d H:i:s');

        if($user->estado == 'Deudor' || $user->estado == 'Suspendido' || $user->Local->estado == 'Bloqueado'){
            session()->flash('danger', 'Usted no puede tomar turnos porque mantiene una deuda pendiente, está suspendido o el local se encuentra bloqueado');
            return redirect()->action('TurnoController@index');
        }elseif($user->inicioCastigo <= $hora && $user->terminoCastigo >= $hora) {
            session()->flash('danger', "Usted se encuentra castigado desde el ".$user->inicioCastigo." al ".$user->terminoCastigo);
            return redirect()->action('TurnoController@index'); 
        }

        //obtengo todos los datos de la planilla
        $planilla = Planilla::where('local_id', $id)->where('estado', 'Activa')->get()->last();

        //si no devuelve nada debería mostrar un mensaje de que no existe una planilla
        if($planilla == '') {
            session()->flash('danger', 'El encargado no ha creado ninguna planilla.');
            return redirect()->action('TurnoController@index');
        }


        //si la variable $hora no está entre el inicio y termino de la planilla pasa al "else" y muestra el mensaje de que aún no es la toma de turnos!.
        if($hora >= $planilla->inicioToma && $hora <= $planilla->finToma) {
        //------------------------------
        $noEsHora = 1;

        //tomo todos los turnos de la planilla
        $turnos = Turno::where('planilla_id', $planilla->id)->orderBy('fecha', 'asc')->orderBy('inicio', 'asc')->get();

        $idPlanilla=$planilla->id;

        $tomados = DB::table('planilla_turno_user')
                            ->where('planilla_turno_user.planilla_id', $planilla->id)
                            ->where('planilla_turno_user.estado', 'Activo')
                            ->join('turnos', function ($join) use($idPlanilla) {
                                        $join->on('planilla_turno_user.turno_id', '=', 'turnos.id')
                                            ->where('turnos.planilla_id', '=', $idPlanilla);//877
                                            //->orderBy('turnos.fecha', 'asc');
                                            //->orderBy('inicio', 'asc');
                                    })
                            ->orderBy('turnos.fecha', 'asc')
                            ->orderBy('turnos.inicio', 'asc')
                            ->get();

            //Recorro cada turno
            foreach ($turnos as $turno) 
            {
                //Selecciono todos los cupos tomados del turno que estoy recorriendo con el foreach
                $allTomados = 0;//cant. de turnos tomados por todos
                //$userAsignado = 0;//cant. de turnos asignado al user
                $userTomados = "";//Incluye el tipo del cupo tomado del user logeado

                foreach ($tomados as $tomado) {

                    if($turno->id == $tomado->turno_id)
                    {
                        //cuento cuantos cupos por turno han sido tomados, sirve para el "no cupos"
                        $allTomados++;

                        //Si el cupo tomado de acuerdo al id del turno pertenece al usuario logeado y es de tipo asignado, se muestra en la pre-toma un boton rojo deshabilitado con el valor "Asignado"
                        if($tomado->local_user_id == $user->id && $tomado->tipo == "Asignado"){
                            $userTomados = "Asignado";
                        //en el caso de que no sea del tipo"Asignado" y pertenece al user logeado solo se muestra el boton soltar.
                        }elseif($tomado->local_user_id == $user->id && $tomado->tipo == "Pre Toma"){
                            $userTomados = "Pre-Toma";
                        }elseif($tomado->local_user_id == $user->id && $tomado->tipo == "Repechaje"){
                            $userTomados = "Pre-Toma";
                        //en el caso de que no sea del tipo"Asignado" y pertenece al user logeado solo se muestra el boton soltar. (aunque nunca debería entrar en este if porque la pre-toma es primero que la toma, por lo tanto, no deberia existir otro tipo de turno tomado como "toma","repechaje",etc)
                        }elseif($tomado->local_user_id == $user->id){
                            $userTomados = "Soltar";
                        }
                    }
                    
                }

                //acá debe compararce los contadores xq si lo hago dentro del foreach "tomados" al final en los if de acá me lo va a sobrescribir!.
                
                if($userTomados == "Asignado"){ $turno->addEstado = "Asignado"; }
                elseif($userTomados == "Pre-Toma"){ $turno->addEstado = "Pre-Toma"; }
                elseif($userTomados == "Soltar"){ $turno->addEstado = "Soltar"; }
                //elseif(){ $turno->addEstado = "Tope"; }
                elseif($allTomados >= $turno->cupos){ $turno->addEstado = "No Cupos"; }
                else{ $turno->addEstado = "Disponible"; }
                

                //modifico la hora del inicio para NO mostrar los segundos
                $turno->inicio = date('H:i', strtotime($turno->inicio));
                $turno->termino = date('H:i', strtotime($turno->termino));
                
                //ingreso datos en un espacio del array(objeto) turno creado automaticamente al hacer la consulta $turnos
                $turno->allTomados = $allTomados;
                

            }
            //dd($turnos);
            return view('turno.toma')
                ->with('planilla', $planilla)
                ->with('noEsHora', $noEsHora)
                ->with('turnos', $turnos);

        }else{
            //hora debe estar entre la hora de inicio y la hora de termino
            //hora >= hora inicio y hora <= hora de termino

            //selecciono la última noticia actualizada
            //Público es la noticia del encargado
            //Oculto es la noticia del Administrador
            $noticia = Noticia::where('local_id', $id)
                                ->where('estado', 'Público')
                                ->orderBy('updated_at', 'desc')
                                ->first();
            if(empty($noticia))
            {
                $noticia = new Noticia();
                $noticia->titulo = "Sin Registro";
                $noticia->descripcion = "Sin Registro";
                $noticia->updated_at = date("Y-m-d H:i:s");
            }

            $noticiaAdmin = Noticia::where('local_id', $id)
                                ->where('estado', 'Oculto')
                                ->orderBy('updated_at', 'desc')
                                ->first();

            if(empty($noticiaAdmin))
            {
                $noticiaAdmin = new Noticia();
                $noticiaAdmin->titulo = "Sin Registro";
                $noticiaAdmin->descripcion = "Sin Registro";
                $noticiaAdmin->updated_at = date("Y-m-d H:i:s");
            }     

            $informativo = Informativo::where('tipo', 'Locales')->where('estado', 'Público')->orderBy('updated_at', 'desc')->first();
            /*Si no existe un informativo */
            if(empty($informativo))
            {
                $existe = 'No';
            }else{
                $existe = 'Si';
            }                                           
            $planilla->inicioToma = date('H:i:s d-m-Y', strtotime($planilla->inicioToma));
            $planilla->finToma = date('H:i:s d-m-Y', strtotime($planilla->finToma));

            $noEsHora = 0;
            return view('turno.toma')
            ->with('noEsHora', $noEsHora)
            ->with('planilla', $planilla)
            ->with('noticia', $noticia)
            ->with('noticiaAdmin', $noticiaAdmin)
            ->with('informativo', $informativo)
            ->with('existe', $existe)
            ->with('user', $user);
        }  
        
    }

    public function toma2x4($id)//ID del local
    {
        //obtengo los datos del usuario que pertenece al local
        $user = Local_User::where('user_id', Auth::user()->id)->where('local_id', $id)->where('estado', '!=', 'Desvinculado')->firstOrFail();

        //Obtengo la fecha y hora actual del servidor
        $hora = date('Y-m-d H:i:s');

        if($user->estado == 'Deudor' || $user->estado == 'Suspendido' || $user->Local->estado == 'Bloqueado'){
            session()->flash('danger', 'Usted no puede tomar turnos porque mantiene una deuda pendiente, está suspendido o el local se encuentra bloqueado');
            return redirect()->action('TurnoController@index');
        }elseif($user->inicioCastigo <= $hora && $user->terminoCastigo >= $hora) {
            session()->flash('danger', "Usted se encuentra castigado desde el ".$user->inicioCastigo." al ".$user->terminoCastigo);
            return redirect()->action('TurnoController@index');
        }

        //obtengo todos los datos de la planilla
        $planilla = Planilla::where('local_id', $id)->where('estado', 'Activa')->get()->last();

        //si no devuelve nada debería mostrar un mensaje de que no existe una planilla
        if($planilla == '') {
            session()->flash('danger', 'El encargado no ha creado ninguna planilla.');
            return redirect()->action('TurnoController@index');
        }


        //si la variable $hora no está entre el inicio y termino de la planilla pasa al "else" y muestra el mensaje de que aún no es la toma de turnos!.
        if($hora >= $planilla->inicioToma && $hora <= $planilla->finToma) {
            //------------------------------
            $noEsHora = 1;

            //tomo todos los turnos de la planilla
            $turnos = Turno::where('planilla_id', $planilla->id)->orderBy('fecha', 'asc')->orderBy('inicio', 'asc')->get();

            $idPlanilla=$planilla->id;

            $tomados = DB::table('planilla_turno_user')
                ->where('planilla_turno_user.planilla_id', $planilla->id)
                ->where('planilla_turno_user.estado', 'Activo')
                ->join('turnos', function ($join) use($idPlanilla) {
                    $join->on('planilla_turno_user.turno_id', '=', 'turnos.id')
                        ->where('turnos.planilla_id', '=', $idPlanilla);//877
                    //->orderBy('turnos.fecha', 'asc');
                    //->orderBy('inicio', 'asc');
                })
                ->orderBy('turnos.fecha', 'asc')
                ->orderBy('turnos.inicio', 'asc')
                ->get();

            //Recorro cada turno
            foreach ($turnos as $turno)
            {
                //Selecciono todos los cupos tomados del turno que estoy recorriendo con el foreach
                $allTomados = 0;//cant. de turnos tomados por todos
                //$userAsignado = 0;//cant. de turnos asignado al user
                $userTomados = "";//Incluye el tipo del cupo tomado del user logeado

                foreach ($tomados as $tomado) {

                    if($turno->id == $tomado->turno_id)
                    {
                        //cuento cuantos cupos por turno han sido tomados, sirve para el "no cupos"
                        $allTomados++;

                        //Si el cupo tomado de acuerdo al id del turno pertenece al usuario logeado y es de tipo asignado, se muestra en la pre-toma un boton rojo deshabilitado con el valor "Asignado"
                        if($tomado->local_user_id == $user->id && $tomado->tipo == "Asignado"){
                            $userTomados = "Asignado";
                            //en el caso de que no sea del tipo"Asignado" y pertenece al user logeado solo se muestra el boton soltar.
                        }elseif($tomado->local_user_id == $user->id && $tomado->tipo == "Pre Toma"){
                            $userTomados = "Pre-Toma";
                        }elseif($tomado->local_user_id == $user->id && $tomado->tipo == "Repechaje"){
                            $userTomados = "Pre-Toma";
                            //en el caso de que no sea del tipo"Asignado" y pertenece al user logeado solo se muestra el boton soltar. (aunque nunca debería entrar en este if porque la pre-toma es primero que la toma, por lo tanto, no deberia existir otro tipo de turno tomado como "toma","repechaje",etc)
                        }elseif($tomado->local_user_id == $user->id){
                            $userTomados = "Soltar";
                        }
                    }

                }

                //acá debe compararce los contadores xq si lo hago dentro del foreach "tomados" al final en los if de acá me lo va a sobrescribir!.

                if($userTomados == "Asignado"){ $turno->addEstado = "Asignado"; }
                elseif($userTomados == "Pre-Toma"){ $turno->addEstado = "Pre-Toma"; }
                elseif($userTomados == "Soltar"){ $turno->addEstado = "Soltar"; }
                //elseif(){ $turno->addEstado = "Tope"; }
                elseif($allTomados >= $turno->cupos){ $turno->addEstado = "No Cupos"; }
                else{ $turno->addEstado = "Disponible"; }


                //modifico la hora del inicio para NO mostrar los segundos
                $turno->inicio = date('H:i', strtotime($turno->inicio));
                $turno->termino = date('H:i', strtotime($turno->termino));

                //ingreso datos en un espacio del array(objeto) turno creado automaticamente al hacer la consulta $turnos
                $turno->allTomados = $allTomados;


            }
            //dd($turnos);
            return view('turno.toma-2x4')
                ->with('planilla', $planilla)
                ->with('noEsHora', $noEsHora)
                ->with('turnos', $turnos);

        }else{
            //hora debe estar entre la hora de inicio y la hora de termino
            //hora >= hora inicio y hora <= hora de termino

            //selecciono la última noticia actualizada
            //Público es la noticia del encargado
            //Oculto es la noticia del Administrador
            $noticia = Noticia::where('local_id', $id)
                ->where('estado', 'Público')
                ->orderBy('updated_at', 'desc')
                ->first();
            if(empty($noticia))
            {
                $noticia = new Noticia();
                $noticia->titulo = "Sin Registro";
                $noticia->descripcion = "Sin Registro";
                $noticia->updated_at = date("Y-m-d H:i:s");
            }

            $noticiaAdmin = Noticia::where('local_id', $id)
                ->where('estado', 'Oculto')
                ->orderBy('updated_at', 'desc')
                ->first();

            if(empty($noticiaAdmin))
            {
                $noticiaAdmin = new Noticia();
                $noticiaAdmin->titulo = "Sin Registro";
                $noticiaAdmin->descripcion = "Sin Registro";
                $noticiaAdmin->updated_at = date("Y-m-d H:i:s");
            }

            $informativo = Informativo::where('tipo', 'Locales')->where('estado', 'Público')->orderBy('updated_at', 'desc')->first();
            /*Si no existe un informativo */
            if(empty($informativo))
            {
                $existe = 'No';
            }else{
                $existe = 'Si';
            }
            $planilla->inicioToma = date('H:i:s d-m-Y', strtotime($planilla->inicioToma));
            $planilla->finToma = date('H:i:s d-m-Y', strtotime($planilla->finToma));

            $noEsHora = 0;
            return view('turno.toma-2x4')
                ->with('noEsHora', $noEsHora)
                ->with('planilla', $planilla)
                ->with('noticia', $noticia)
                ->with('noticiaAdmin', $noticiaAdmin)
                ->with('informativo', $informativo)
                ->with('existe', $existe)
                ->with('user', $user);
        }

    }

    public function tomaPorDia($id)//ID del local
    {
        //obtengo los datos del usuario que pertenece al local
        $user = Local_User::where('user_id', Auth::user()->id)->where('local_id', $id)->where('estado', '!=', 'Desvinculado')->firstOrFail();

        //Obtengo la fecha y hora actual del servidor
        $hora = date('Y-m-d H:i:s');

        if($user->estado == 'Deudor' || $user->estado == 'Suspendido' || $user->Local->estado == 'Bloqueado'){
            session()->flash('danger', 'Usted no puede tomar turnos porque mantiene una deuda pendiente, está suspendido o el local se encuentra bloqueado');
            return redirect()->action('TurnoController@index');
        }elseif($user->inicioCastigo <= $hora && $user->terminoCastigo >= $hora) {
            session()->flash('danger', "Usted se encuentra castigado desde el ".$user->inicioCastigo." al ".$user->terminoCastigo);
            return redirect()->action('TurnoController@index');
        }

        //obtengo todos los datos de la planilla
        $planilla = Planilla::where('local_id', $id)->where('estado', 'Activa')->get()->last();

        //si no devuelve nada debería mostrar un mensaje de que no existe una planilla
        if($planilla == '') {
            session()->flash('danger', 'El encargado no ha creado ninguna planilla.');
            return redirect()->action('TurnoController@index');
        }


        //si la variable $hora no está entre el inicio y termino de la planilla pasa al "else" y muestra el mensaje de que aún no es la toma de turnos!.
        if($hora >= $planilla->inicioToma && $hora <= $planilla->finToma) {
            //------------------------------
            $noEsHora = 1;

            //tomo todos los turnos de la planilla
            $turnos = Turno::where('planilla_id', $planilla->id)->orderBy('fecha', 'asc')->orderBy('inicio', 'asc')->get();

            $idPlanilla=$planilla->id;

            $tomados = DB::table('planilla_turno_user')
                ->where('planilla_turno_user.planilla_id', $planilla->id)
                ->where('planilla_turno_user.estado', 'Activo')
                ->join('turnos', function ($join) use($idPlanilla) {
                    $join->on('planilla_turno_user.turno_id', '=', 'turnos.id')
                        ->where('turnos.planilla_id', '=', $idPlanilla);//877
                    //->orderBy('turnos.fecha', 'asc');
                    //->orderBy('inicio', 'asc');
                })
                ->orderBy('turnos.fecha', 'asc')
                ->orderBy('turnos.inicio', 'asc')
                ->get();

            //Recorro cada turno
            foreach ($turnos as $turno)
            {
                //Selecciono todos los cupos tomados del turno que estoy recorriendo con el foreach
                $allTomados = 0;//cant. de turnos tomados por todos
                //$userAsignado = 0;//cant. de turnos asignado al user
                $userTomados = "";//Incluye el tipo del cupo tomado del user logeado

                foreach ($tomados as $tomado) {

                    if($turno->id == $tomado->turno_id)
                    {
                        //cuento cuantos cupos por turno han sido tomados, sirve para el "no cupos"
                        $allTomados++;

                        //Si el cupo tomado de acuerdo al id del turno pertenece al usuario logeado y es de tipo asignado, se muestra en la pre-toma un boton rojo deshabilitado con el valor "Asignado"
                        if($tomado->local_user_id == $user->id && $tomado->tipo == "Asignado"){
                            $userTomados = "Asignado";
                            //en el caso de que no sea del tipo"Asignado" y pertenece al user logeado solo se muestra el boton soltar.
                        }elseif($tomado->local_user_id == $user->id && $tomado->tipo == "Pre Toma"){
                            $userTomados = "Pre-Toma";
                        }elseif($tomado->local_user_id == $user->id && $tomado->tipo == "Repechaje"){
                            $userTomados = "Pre-Toma";
                            //en el caso de que no sea del tipo"Asignado" y pertenece al user logeado solo se muestra el boton soltar. (aunque nunca debería entrar en este if porque la pre-toma es primero que la toma, por lo tanto, no deberia existir otro tipo de turno tomado como "toma","repechaje",etc)
                        }elseif($tomado->local_user_id == $user->id){
                            $userTomados = "Soltar";
                        }
                    }

                }

                //acá debe compararce los contadores xq si lo hago dentro del foreach "tomados" al final en los if de acá me lo va a sobrescribir!.

                if($userTomados == "Asignado"){ $turno->addEstado = "Asignado"; }
                elseif($userTomados == "Pre-Toma"){ $turno->addEstado = "Pre-Toma"; }
                elseif($userTomados == "Soltar"){ $turno->addEstado = "Soltar"; }
                //elseif(){ $turno->addEstado = "Tope"; }
                elseif($allTomados >= $turno->cupos){ $turno->addEstado = "No Cupos"; }
                else{ $turno->addEstado = "Disponible"; }


                //modifico la hora del inicio para NO mostrar los segundos
                $turno->inicio = date('H:i', strtotime($turno->inicio));
                $turno->termino = date('H:i', strtotime($turno->termino));

                //ingreso datos en un espacio del array(objeto) turno creado automaticamente al hacer la consulta $turnos
                $turno->allTomados = $allTomados;


            }
            //dd($turnos);
            return view('turno.toma-por-dia')
                ->with('planilla', $planilla)
                ->with('noEsHora', $noEsHora)
                ->with('turnos', $turnos);

        }else{
            //hora debe estar entre la hora de inicio y la hora de termino
            //hora >= hora inicio y hora <= hora de termino

            //selecciono la última noticia actualizada
            //Público es la noticia del encargado
            //Oculto es la noticia del Administrador
            $noticia = Noticia::where('local_id', $id)
                ->where('estado', 'Público')
                ->orderBy('updated_at', 'desc')
                ->first();
            if(empty($noticia))
            {
                $noticia = new Noticia();
                $noticia->titulo = "Sin Registro";
                $noticia->descripcion = "Sin Registro";
                $noticia->updated_at = date("Y-m-d H:i:s");
            }

            $noticiaAdmin = Noticia::where('local_id', $id)
                ->where('estado', 'Oculto')
                ->orderBy('updated_at', 'desc')
                ->first();

            if(empty($noticiaAdmin))
            {
                $noticiaAdmin = new Noticia();
                $noticiaAdmin->titulo = "Sin Registro";
                $noticiaAdmin->descripcion = "Sin Registro";
                $noticiaAdmin->updated_at = date("Y-m-d H:i:s");
            }

            $informativo = Informativo::where('tipo', 'Locales')->where('estado', 'Público')->orderBy('updated_at', 'desc')->first();
            /*Si no existe un informativo */
            if(empty($informativo))
            {
                $existe = 'No';
            }else{
                $existe = 'Si';
            }
            $planilla->inicioToma = date('H:i:s d-m-Y', strtotime($planilla->inicioToma));
            $planilla->finToma = date('H:i:s d-m-Y', strtotime($planilla->finToma));

            $noEsHora = 0;
            return view('turno.toma-por-dia')
                ->with('noEsHora', $noEsHora)
                ->with('planilla', $planilla)
                ->with('noticia', $noticia)
                ->with('noticiaAdmin', $noticiaAdmin)
                ->with('informativo', $informativo)
                ->with('existe', $existe)
                ->with('user', $user);
        }

    }

    public function postToma($id, $pla, Request $request)//id del turno
    {
        $message = "";
       
        //Obtengo todos los turnos disponibles en la toma
        $turnos = Turno::where('planilla_id', $pla)->orderBy('fecha', 'asc')->orderBy('inicio', 'asc')->get();

        //selecciono los datos del turno que quiero tomar desde la collection de todos los turnos disponibles seleccionados en la planilla
        $turno = $turnos->find($id);


        //validación si existe el turno que se pretende tomar
        if(empty($turno) || $turno->Planilla->estado == 'Eliminada') { abort(500); }

        //Obtengo datos del usuario según local al que pertenece.
        $user = Local_User::where('user_id', Auth::user()->id)->where('local_id', $turno->planilla->local_id)->first(); 

        /* Obtengo todos los turnos tomados y la información de cada turno como fecha, inicio, termino, etc */
        $userTurnos = Planilla_Turno_User::where('planilla_turno_user.planilla_id', $pla)
             ->where('planilla_turno_user.estado', 'Activo')
             ->join('turnos', 'planilla_turno_user.turno_id', '=', 'turnos.id')
             ->get();
        
        //total de cupos tomados por todos los empaques
        $cantTurnosTomados = 0;
        //cantidad de turnos tomados por un empaque en una en la planilla solo por "Toma" de turnos
        $cantTurnosTomadosUser=0;
        //si un usuario tomó dos veces el mismo turno
        $duplicidad=0;
        //Si es distinto a cero sigifica que tiene tope con otro turno
        $tope =0;

        foreach ($userTurnos as $userTurno) {
            //Cantidad de turnos tomados (cupos) por todos los empaques de un turno especifico de la planilla en la toma activa.
            if($userTurno->turno_id == $turno->id){
                $cantTurnosTomados++;
            }
          
            
            //verificar duplicidad (si ya tengo tomado un turno que quiero tomar)
            if($userTurno->local_user_id == $user->id && $userTurno->turno_id == $turno->id){
                $duplicidad++;
                break;
            //Si la fecha del turno del array es igual al turno que se quiere tomar entra al if y se hacen las validaciones de hora de inicio y hora de termino
            }elseif (($userTurno->local_user_id == $user->id && $userTurno->fecha == $turno->fecha && $userTurno->inicio <= $turno->inicio && $userTurno->termino >= $turno->inicio)  || ($userTurno->local_user_id == $user->id && $userTurno->fecha == $turno->fecha && $userTurno->inicio <= $turno->termino && $userTurno->termino >= $turno->termino)) {
                                
                $tope++;
                break;
        
            }                
            

            if($userTurno->local_user_id == $user->id && $userTurno->tipo == "Toma"){
                //cantidad de turnos tomados por un empaque en una en la planilla solo por "Toma" de turnos
                $cantTurnosTomadosUser++;                    
            }

            
        }



        //if si esq no queda cupo disponible del turno
        if($cantTurnosTomados >= $turno->cupos){
            $message = "No Cupos";
        }elseif($duplicidad != 0){
            //Verificar si ya tengo tomado un turno que quiero tomar
            $message = "Ya es mío";

        }elseif($user->cuposToma <= $cantTurnosTomadosUser) {
            //cantidad de turnos tomados por un empaque en una en la planilla solo por "Toma" de turnos
            $message = "Max. Turno";
            //abort(500);
        }elseif($tope != 0){
            //Validación de tope de horario
            $message = "Tope";
        }else{

            $hora = date('Y-m-d H:i:s');
            //si la variable $hora no está entre el inicio y termino de la planilla pasa al "else" y muestra el mensaje de que aún no es la toma de turnos o ya no esta en el rango de hora permitido!.
            if($hora >= $turno->Planilla->inicioToma && $hora <= $turno->Planilla->finToma)
            {
        
                        $pla_tur_user = new Planilla_Turno_User();
                        //$pla_tur_user->deseo = null;
                        //$pla_tur_user->fijo = "No";
                        //$pla_tur_user->coordinador = "No";
                        $pla_tur_user->tipo = "Toma";
                        //$pla_tur_user->estado = "Activo";
                        //$pla_tur_user->exTipo = null;
                        $pla_tur_user->planilla_id = $pla;//puede ser $id del post
                        $pla_tur_user->turno_id = $turno->id;
                        $pla_tur_user->local_user_id = $user->id;
                        
                        $pla_tur_user->save();
                        $userTurnos->push($pla_tur_user);

                        $message = "ok-Tomado";//Turno Guardado Exitosamente
            }else{
                //Flash::error("Usted ya no se encuentra en el rango de hora permitido para tomar o soltar un turno.");
                //return redirect()->action('TurnoController@index');
                $message = "Fuera de Hora";
                //abort(500);
            }
        }
        
        $arrayCupos = array();


        //varibale $cantCupos disponibles para mostrar en la vista (cupos que se han tomado)

        foreach ($turnos as $turno) {
          
                $allTomados = 0;//cant. de turnos tomados por todos
                //$userAsignado = 0;//cant. de turnos asignado al user
                $userTomados = "";//Incluye el tipo del cupo tomado del user logeado
                //$estado = "";

                foreach ($userTurnos as $tomado) {//userTurnos

                    if($turno->id == $tomado->turno_id)
                    {
                            //cuento cuantos cupos por turno han sido tomados, sirve para el "no cupos"
                            $allTomados++;

                            
                            //Si el cupo tomado de acuerdo al id del turno pertenece al usuario logeado y es de tipo asignado, se muestra en la pre-toma un boton rojo deshabilitado con el valor "Asignado"
                            if($tomado->local_user_id == $user->id && $tomado->tipo == "Asignado"){
                                $userTomados = "Asignado";
                            }elseif($tomado->local_user_id == $user->id && $tomado->tipo == "Pre Toma"){
                                $userTomados = "Pre-Toma";
                            }elseif($tomado->local_user_id == $user->id && $tomado->tipo == "Repechaje"){
                                $userTomados = "Pre-Toma";
                            //en el caso de que no sea del tipo"Asignado" y pertenece al user logeado solo se muestra el boton soltar. (aunque nunca debería entrar en este if porque la pre-toma es primero que la toma, por lo tanto, no deberia existir otro tipo de turno tomado como "toma","repechaje",etc)
                            }elseif($tomado->local_user_id == $user->id){
                                $userTomados = "Soltar";
                            }
                    }
                    
                }

                //acá debe compararce los contadores xq si lo hago dentro del foreach "tomados" al final en los if de acá me lo va a sobrescribir!.
                if($userTomados == "Asignado"){ $estado = "Asignado"; }
                elseif($userTomados == "Pre-Toma"){ $estado = "Pre-Toma"; }
                elseif($userTomados == "Soltar"){ $estado = "ok-Tomado"; }
                elseif($allTomados >= $turno->cupos){ $estado = "No Cupos"; }
                else{ $estado = "Disponible"; }
                //$estado = "ok-Tomado";
   
                //Agrego la cantidad a un array segun id del turno
                $arrayCupos[] =  array(
                                            'id' => $turno->id,//idTurno
                                            'cupos' => $allTomados,//Cupos disponibles
                                            'estado'=> $estado,
                                        );
                    
        }
        
        if($request->ajax()){
            return response()->json([

                    'message'   =>  $message,
                    'arrayCupos'    =>  $arrayCupos,//$arrayCupos
         
                    
                ]);
        }

        
    }

    public function deleteTurnoTomado($id, Request $request)//id del turno
    {
        $turno = Turno::find($id);

        //validación si existe el turno que se pretende tomar
        if(empty($turno) || $turno->Planilla->estado == 'Eliminada') { abort(500); }

        $local = $turno->Planilla->local_id;//corresponde al local según la planilla
        $user = Local_User::where('user_id', Auth::user()->id)->where('local_id', $local)->first();

        $hora = date('Y-m-d H:i:s');
        //si la variable $hora no está entre el inicio y termino de la planilla pasa al "else" y muestra el mensaje de que aún no es la toma de turnos o ya no esta en el rango de hora permitido!.
        if($hora >= $turno->Planilla->inicioToma && $hora <= $turno->Planilla->finToma)
        {
            //falta poner el first para q elimine solo un turno y no recorra todos los datos
            $soltar = Planilla_Turno_User::where('planilla_id', $turno->planilla_id)->where('turno_id', $id)->where('local_user_id', $user->id)->delete();

            $message = "Soltar";
        
        }else{
            $message = "Fuera de Hora";
        }

        
        $arrayCupos = array();
        
        //Obtengo todos los turnos disponibles en la toma
        $turnos = Turno::where('planilla_id', $turno->planilla_id)->orderBy('fecha', 'asc')->orderBy('inicio', 'asc')->get();
        

        $idPlanilla = $turno->planilla_id;
        //dd($planilla->id);
        /**/
        $tomados = DB::table('planilla_turno_user')
                            ->where('planilla_turno_user.planilla_id', $turno->planilla_id)
                            ->where('planilla_turno_user.estado', 'Activo')
                            ->join('turnos', function ($join) use($idPlanilla) {
                                        $join->on('planilla_turno_user.turno_id', '=', 'turnos.id')
                                            ->where('turnos.planilla_id', '=', $idPlanilla);//877
                                            //->orderBy('turnos.fecha', 'asc');
                                            //->orderBy('inicio', 'asc');
                                    })
                            ->orderBy('turnos.fecha', 'asc')
                            ->orderBy('turnos.inicio', 'asc')
                            ->get();

        //varibale $cantCupos disponibles para mostrar en la vista (cupos que se han tomado)

        foreach ($turnos as $turno) {
          
              
                //Selecciono todos los cupos tomados del turno que estoy recorriendo con el foreach
                //$tomados = Planilla_Turno_User::where('planilla_id', $turno->planilla_id)->where('turno_id', $turno->id)->where('estado', 'Activo')->get();//->where('local_user_id', $user->id)

                $allTomados = 0;//cant. de turnos tomados por todos
                //$userAsignado = 0;//cant. de turnos asignado al user
                $userTomados = "";//Incluye el tipo del cupo tomado del user logeado
                //$estado = "";

                foreach ($tomados as $tomado) {

                    if($turno->id == $tomado->turno_id)
                    {
                            //cuento cuantos cupos por turno han sido tomados, sirve para el "no cupos"
                            $allTomados++;

                            
                            //Si el cupo tomado de acuerdo al id del turno pertenece al usuario logeado y es de tipo asignado, se muestra en la pre-toma un boton rojo deshabilitado con el valor "Asignado"
                            if($tomado->local_user_id == $user->id && $tomado->tipo == "Asignado"){
                                $userTomados = "Asignado";
                            }elseif($tomado->local_user_id == $user->id && $tomado->tipo == "Pre Toma"){
                                $userTomados = "Pre-Toma";
                            }elseif($tomado->local_user_id == $user->id && $tomado->tipo == "Repechaje"){
                                $userTomados = "Pre-Toma";
                            //en el caso de que no sea del tipo"Asignado" y pertenece al user logeado solo se muestra el boton soltar. (aunque nunca debería entrar en este if porque la pre-toma es primero que la toma, por lo tanto, no deberia existir otro tipo de turno tomado como "toma","repechaje",etc)
                            }elseif($tomado->local_user_id == $user->id){
                                $userTomados = "Soltar";
                            }
                    }
                    
                }

                //acá debe compararce los contadores xq si lo hago dentro del foreach "tomados" al final en los if de acá me lo va a sobrescribir!.
                if($userTomados == "Asignado"){ $estado = "Asignado"; }
                elseif($userTomados == "Pre-Toma"){ $estado = "Pre-Toma"; }
                elseif($userTomados == "Soltar"){ $estado = "ok-Tomado"; }
                elseif($allTomados >= $turno->cupos){ $estado = "No Cupos"; }
                else{ $estado = "Disponible"; }
                //$estado = "ok-Tomado";
   
                //Agrego la cantidad a un array segun id del turno
                $arrayCupos[] =  array(
                                            'id' => $turno->id,//idTurno
                                            'cupos' => $allTomados,//Cupos disponibles
                                            'estado'=> $estado,
                                        );
                    
        }

            //$message = "eliminado";//Turno Guardado Exitosamente
            if($request->ajax()){
                return response()->json([

                        'message'   =>  $message,
                        'arrayCupos'    =>  $arrayCupos,//$arrayCupos
                    ]);
            }


    }

    public function preToma($id)
    {
        //obtengo los datos del usuario que pertenece al local
        $user = Local_User::where('user_id', Auth::user()->id)->where('local_id', $id)->where('estado', '!=', 'Desvinculado')->firstOrFail();

        //Obtengo la fecha y hora actual del servidor
        $hora = date('Y-m-d H:i:s');

        if($user->Local->preToma == 'No'){
            session()->flash('danger', 'El local no tiene habilitada la pre-toma');
            return redirect()->action('TurnoController@index');
        }elseif($user->estado == 'Deudor' || $user->estado == 'Suspendido' || $user->Local->estado == 'Bloqueado'){
            session()->flash('danger', 'Usted no puede tomar turnos porque mantiene una deuda pendiente, está suspendido o el local se encuentra bloqueado');
            return redirect()->action('TurnoController@index');
        }elseif($user->inicioCastigo <= $hora && $user->terminoCastigo >= $hora) {
            session()->flash('danger', "Usted se encuentra castigado desde el ".$user->inicioCastigo." al ".$user->terminoCastigo);
            return redirect()->action('TurnoController@index');
        }

        //obtengo todos los datos de la planilla
        $planilla = Planilla::where('local_id', $id)->where('estado', 'Activa')->get()->last();

        //si no devuelve nada debería mostrar un mensaje de que no existe una planilla
        if($planilla == '')
        {
            session()->flash('danger', 'El encargado no ha creado ninguna planilla.');
            return redirect()->action('TurnoController@index');
        }

        if($planilla->inicioPreToma == '' || $planilla->finPreToma == '')
        {
            session()->flash('danger', 'El encargado no ha ingresado una fecha y hora para la Pre-Toma.');
            return redirect()->action('TurnoController@index');
        }


        //si la variable $hora no está entre el inicio y termino de la planilla pasa al "else" y muestra el mensaje de que aún no es la toma de turnos!.
        if($hora >= $planilla->inicioPreToma && $hora <= $planilla->finPreToma)
        {

            //------------------------------
            $noEsHora = 1;
            //falta validar si la planilla existe, si corresponde a la toma, si pertenece al super, ect
            //Selecciono todos los turnos de una planilla
            $turnos = Turno::where('planilla_id', $planilla->id)->orderBy('fecha', 'asc')->orderBy('inicio', 'asc')->get();


            $idPlanilla = $planilla->id;
            //dd($planilla->id);
            /**/
            $tomados = DB::table('planilla_turno_user')
                ->where('planilla_turno_user.planilla_id', $idPlanilla)
                ->where('planilla_turno_user.estado', 'Activo')
                ->join('turnos', function ($join) use($idPlanilla) {
                    $join->on('planilla_turno_user.turno_id', '=', 'turnos.id')
                        ->where('turnos.planilla_id', '=', $idPlanilla);//877
                    //->orderBy('turnos.fecha', 'asc');
                    //->orderBy('inicio', 'asc');
                })
                ->orderBy('turnos.fecha', 'asc')
                ->orderBy('turnos.inicio', 'asc')
                ->get();

            //Recorro cada turno
            foreach ($turnos as $turno)
            {

                //Selecciono todos los cupos tomados del turno que estoy recorriendo con el foreach
                //$tomados = Planilla_Turno_User::where('planilla_id', $planilla->id)->where('turno_id', $turno->id)->where('estado', 'Activo')->get();

                $allTomados = 0;//cant. de turnos tomados por todos
                //$userAsignado = 0;//cant. de turnos asignado al user
                $userTomados = "";//Incluye el tipo del cupo tomado del user logeado

                foreach ($tomados as $tomado) {

                    if($turno->id == $tomado->turno_id)
                    {
                        //cuento cuantos cupos por turno han sido tomados, sirve para el "no cupos"
                        $allTomados++;


                        //Si el cupo tomado de acuerdo al id del turno pertenece al usuario logeado y es de tipo asignado, se muestra en la pre-toma un boton rojo deshabilitado con el valor "Asignado"
                        if($tomado->local_user_id == $user->id && $tomado->tipo == "Asignado"){
                            $userTomados = "Asignado";
                        }elseif($tomado->local_user_id == $user->id && $tomado->tipo == "Toma"){
                            $userTomados = "Toma";
                        }elseif($tomado->local_user_id == $user->id && $tomado->tipo == "Repechaje"){
                            $userTomados = "Toma";
                            //en el caso de que no sea del tipo"Asignado" y pertenece al user logeado solo se muestra el boton soltar. (aunque nunca debería entrar en este if porque la pre-toma es primero que la toma, por lo tanto, no deberia existir otro tipo de turno tomado como "toma","repechaje",etc)
                        }elseif($tomado->local_user_id == $user->id){
                            $userTomados = "Soltar";
                        }
                    }

                }

                //acá debe compararce los contadores xq si lo hago dentro del foreach "tomados" al final en los if de acá me lo va a sobrescribir!.
                if($userTomados == "Asignado"){ $turno->addEstado = "Asignado"; }
                elseif($userTomados == "Toma"){ $turno->addEstado = "Toma"; }
                elseif($userTomados == "Soltar"){ $turno->addEstado = "Soltar"; }
                //elseif(){ $turno->addEstado = "Tope"; }
                elseif($allTomados >= $turno->cupos){ $turno->addEstado = "No Cupos"; }
                else{ $turno->addEstado = "Disponible"; }

                //Muestro la hora y minutos SIN segundos
                $turno->inicio = date('H:i', strtotime($turno->inicio));
                $turno->termino = date('H:i', strtotime($turno->termino));
                //ingreso datos en un espacio del array(objeto) turno creado automaticamente al hacer la consulta $turnos
                $turno->allTomados = $allTomados;
                //$turno->addEstado = $userTomados;

            }
            //dd($turnos);
            return view('turno.pre-toma')
                ->with('planilla', $planilla)
                ->with('noEsHora', $noEsHora)
                ->with('turnos', $turnos);

        }else{
            //hora debe estar entre la hora de inicio y la hora de termino
            //hora >= hora inicio y hora <= hora de termino

            //selecciono la última noticia actualizada
            //Público es la noticia del encargado
            //Oculto es la noticia del Administrador
            $noticia = Noticia::where('local_id', $id)
                ->where('estado', 'Público')
                ->orderBy('updated_at', 'desc')
                ->first();
            if(empty($noticia))
            {
                $noticia = new Noticia();
                $noticia->titulo = "Sin Registro";
                $noticia->descripcion = "Sin Registro";
                $noticia->updated_at = date("Y-m-d H:i:s");
            }

            $noticiaAdmin = Noticia::where('local_id', $id)
                ->where('estado', 'Oculto')
                ->orderBy('updated_at', 'desc')
                ->first();

            if(empty($noticiaAdmin))
            {
                $noticiaAdmin = new Noticia();
                $noticiaAdmin->titulo = "Sin Registro";
                $noticiaAdmin->descripcion = "Sin Registro";
                $noticiaAdmin->updated_at = date("Y-m-d H:i:s");
            }

            $informativo = Informativo::where('tipo', 'Locales')->where('estado', 'Público')->orderBy('updated_at', 'desc')->first();
            /*Si no existe un informativo */
            if($informativo == '')
            {
                $existe = 'No';
            }else{
                $existe = 'Si';
            }
            $planilla->inicioPreToma = date('H:i:s d-m-Y', strtotime($planilla->inicioPreToma));
            $planilla->finPreToma = date('H:i:s d-m-Y', strtotime($planilla->finPreToma));

            $noEsHora = 0;
            return view('turno.pre-toma')
                ->with('noEsHora', $noEsHora)
                ->with('planilla', $planilla)
                ->with('noticia', $noticia)
                ->with('noticiaAdmin', $noticiaAdmin)
                ->with('informativo', $informativo)
                ->with('existe', $existe)
                ->with('user', $user);
        }
    }

    public function preToma2x4($id)
    {
        //obtengo los datos del usuario que pertenece al local
        $user = Local_User::where('user_id', Auth::user()->id)->where('local_id', $id)->where('estado', '!=', 'Desvinculado')->firstOrFail();

        //Obtengo la fecha y hora actual del servidor
        $hora = date('Y-m-d H:i:s');

        if($user->Local->preToma == 'No'){
            session()->flash('danger', 'El local no tiene habilitada la pre-toma');
            return redirect()->action('TurnoController@index');
        }elseif($user->estado == 'Deudor' || $user->estado == 'Suspendido' || $user->Local->estado == 'Bloqueado'){
            session()->flash('danger', 'Usted no puede tomar turnos porque mantiene una deuda pendiente, está suspendido o el local se encuentra bloqueado');
            return redirect()->action('TurnoController@index');
        }elseif($user->inicioCastigo <= $hora && $user->terminoCastigo >= $hora) {
            session()->flash('danger', "Usted se encuentra castigado desde el ".$user->inicioCastigo." al ".$user->terminoCastigo);
            return redirect()->action('TurnoController@index');
        }

        //obtengo todos los datos de la planilla
        $planilla = Planilla::where('local_id', $id)->where('estado', 'Activa')->get()->last();

        //si no devuelve nada debería mostrar un mensaje de que no existe una planilla
        if($planilla == '')
        {
            session()->flash('danger', 'El encargado no ha creado ninguna planilla.');
            return redirect()->action('TurnoController@index');
        }

        if($planilla->inicioPreToma == '' || $planilla->finPreToma == '')
        {
            session()->flash('danger', 'El encargado no ha ingresado una fecha y hora para la Pre-Toma.');
            return redirect()->action('TurnoController@index');
        }


        //si la variable $hora no está entre el inicio y termino de la planilla pasa al "else" y muestra el mensaje de que aún no es la toma de turnos!.
        if($hora >= $planilla->inicioPreToma && $hora <= $planilla->finPreToma)
        {

            //------------------------------
            $noEsHora = 1;
            //falta validar si la planilla existe, si corresponde a la toma, si pertenece al super, ect
            //Selecciono todos los turnos de una planilla
            $turnos = Turno::where('planilla_id', $planilla->id)->orderBy('fecha', 'asc')->orderBy('inicio', 'asc')->get();


            $idPlanilla = $planilla->id;
            //dd($planilla->id);
            /**/
            $tomados = DB::table('planilla_turno_user')
                ->where('planilla_turno_user.planilla_id', $idPlanilla)
                ->where('planilla_turno_user.estado', 'Activo')
                ->join('turnos', function ($join) use($idPlanilla) {
                    $join->on('planilla_turno_user.turno_id', '=', 'turnos.id')
                        ->where('turnos.planilla_id', '=', $idPlanilla);//877
                    //->orderBy('turnos.fecha', 'asc');
                    //->orderBy('inicio', 'asc');
                })
                ->orderBy('turnos.fecha', 'asc')
                ->orderBy('turnos.inicio', 'asc')
                ->get();

            //Recorro cada turno
            foreach ($turnos as $turno)
            {

                //Selecciono todos los cupos tomados del turno que estoy recorriendo con el foreach
                //$tomados = Planilla_Turno_User::where('planilla_id', $planilla->id)->where('turno_id', $turno->id)->where('estado', 'Activo')->get();

                $allTomados = 0;//cant. de turnos tomados por todos
                //$userAsignado = 0;//cant. de turnos asignado al user
                $userTomados = "";//Incluye el tipo del cupo tomado del user logeado

                foreach ($tomados as $tomado) {

                    if($turno->id == $tomado->turno_id)
                    {
                        //cuento cuantos cupos por turno han sido tomados, sirve para el "no cupos"
                        $allTomados++;


                        //Si el cupo tomado de acuerdo al id del turno pertenece al usuario logeado y es de tipo asignado, se muestra en la pre-toma un boton rojo deshabilitado con el valor "Asignado"
                        if($tomado->local_user_id == $user->id && $tomado->tipo == "Asignado"){
                            $userTomados = "Asignado";
                        }elseif($tomado->local_user_id == $user->id && $tomado->tipo == "Toma"){
                            $userTomados = "Toma";
                        }elseif($tomado->local_user_id == $user->id && $tomado->tipo == "Repechaje"){
                            $userTomados = "Toma";
                            //en el caso de que no sea del tipo"Asignado" y pertenece al user logeado solo se muestra el boton soltar. (aunque nunca debería entrar en este if porque la pre-toma es primero que la toma, por lo tanto, no deberia existir otro tipo de turno tomado como "toma","repechaje",etc)
                        }elseif($tomado->local_user_id == $user->id){
                            $userTomados = "Soltar";
                        }
                    }

                }

                //acá debe compararce los contadores xq si lo hago dentro del foreach "tomados" al final en los if de acá me lo va a sobrescribir!.
                if($userTomados == "Asignado"){ $turno->addEstado = "Asignado"; }
                elseif($userTomados == "Toma"){ $turno->addEstado = "Toma"; }
                elseif($userTomados == "Soltar"){ $turno->addEstado = "Soltar"; }
                //elseif(){ $turno->addEstado = "Tope"; }
                elseif($allTomados >= $turno->cupos){ $turno->addEstado = "No Cupos"; }
                else{ $turno->addEstado = "Disponible"; }

                //Muestro la hora y minutos SIN segundos
                $turno->inicio = date('H:i', strtotime($turno->inicio));
                $turno->termino = date('H:i', strtotime($turno->termino));
                //ingreso datos en un espacio del array(objeto) turno creado automaticamente al hacer la consulta $turnos
                $turno->allTomados = $allTomados;
                //$turno->addEstado = $userTomados;

            }
            //dd($turnos);
            return view('turno.pre-toma-2x4')
                ->with('planilla', $planilla)
                ->with('noEsHora', $noEsHora)
                ->with('turnos', $turnos);

        }else{
            //hora debe estar entre la hora de inicio y la hora de termino
            //hora >= hora inicio y hora <= hora de termino

            //selecciono la última noticia actualizada
            //Público es la noticia del encargado
            //Oculto es la noticia del Administrador
            $noticia = Noticia::where('local_id', $id)
                ->where('estado', 'Público')
                ->orderBy('updated_at', 'desc')
                ->first();
            if(empty($noticia))
            {
                $noticia = new Noticia();
                $noticia->titulo = "Sin Registro";
                $noticia->descripcion = "Sin Registro";
                $noticia->updated_at = date("Y-m-d H:i:s");
            }

            $noticiaAdmin = Noticia::where('local_id', $id)
                ->where('estado', 'Oculto')
                ->orderBy('updated_at', 'desc')
                ->first();

            if(empty($noticiaAdmin))
            {
                $noticiaAdmin = new Noticia();
                $noticiaAdmin->titulo = "Sin Registro";
                $noticiaAdmin->descripcion = "Sin Registro";
                $noticiaAdmin->updated_at = date("Y-m-d H:i:s");
            }

            $informativo = Informativo::where('tipo', 'Locales')->where('estado', 'Público')->orderBy('updated_at', 'desc')->first();
            /*Si no existe un informativo */
            if($informativo == '')
            {
                $existe = 'No';
            }else{
                $existe = 'Si';
            }
            $planilla->inicioPreToma = date('H:i:s d-m-Y', strtotime($planilla->inicioPreToma));
            $planilla->finPreToma = date('H:i:s d-m-Y', strtotime($planilla->finPreToma));

            $noEsHora = 0;
            return view('turno.pre-toma-2x4')
                ->with('noEsHora', $noEsHora)
                ->with('planilla', $planilla)
                ->with('noticia', $noticia)
                ->with('noticiaAdmin', $noticiaAdmin)
                ->with('informativo', $informativo)
                ->with('existe', $existe)
                ->with('user', $user);
        }
    }

    public function preTomaPorDia($id)
    {
        //obtengo los datos del usuario que pertenece al local
        $user = Local_User::where('user_id', Auth::user()->id)->where('local_id', $id)->where('estado', '!=', 'Desvinculado')->firstOrFail();

        //Obtengo la fecha y hora actual del servidor
        $hora = date('Y-m-d H:i:s');

        if($user->Local->preToma == 'No'){
            session()->flash('danger', 'El local no tiene habilitada la pre-toma');
            return redirect()->action('TurnoController@index');
        }elseif($user->estado == 'Deudor' || $user->estado == 'Suspendido' || $user->Local->estado == 'Bloqueado'){
            session()->flash('danger', 'Usted no puede tomar turnos porque mantiene una deuda pendiente, está suspendido o el local se encuentra bloqueado');
            return redirect()->action('TurnoController@index');
        }elseif($user->inicioCastigo <= $hora && $user->terminoCastigo >= $hora) {
            session()->flash('danger', "Usted se encuentra castigado desde el ".$user->inicioCastigo." al ".$user->terminoCastigo);
            return redirect()->action('TurnoController@index');
        }

        //obtengo todos los datos de la planilla
        $planilla = Planilla::where('local_id', $id)->where('estado', 'Activa')->get()->last();

        //si no devuelve nada debería mostrar un mensaje de que no existe una planilla
        if($planilla == '')
        {
            session()->flash('danger', 'El encargado no ha creado ninguna planilla.');
            return redirect()->action('TurnoController@index');
        }

        if($planilla->inicioPreToma == '' || $planilla->finPreToma == '')
        {
            session()->flash('danger', 'El encargado no ha ingresado una fecha y hora para la Pre-Toma.');
            return redirect()->action('TurnoController@index');
        }


        //si la variable $hora no está entre el inicio y termino de la planilla pasa al "else" y muestra el mensaje de que aún no es la toma de turnos!.
        if($hora >= $planilla->inicioPreToma && $hora <= $planilla->finPreToma)
        {

            //------------------------------
            $noEsHora = 1;
            //falta validar si la planilla existe, si corresponde a la toma, si pertenece al super, ect
            //Selecciono todos los turnos de una planilla
            $turnos = Turno::where('planilla_id', $planilla->id)->orderBy('fecha', 'asc')->orderBy('inicio', 'asc')->get();


            $idPlanilla = $planilla->id;
            //dd($planilla->id);
            /**/
            $tomados = DB::table('planilla_turno_user')
                ->where('planilla_turno_user.planilla_id', $idPlanilla)
                ->where('planilla_turno_user.estado', 'Activo')
                ->join('turnos', function ($join) use($idPlanilla) {
                    $join->on('planilla_turno_user.turno_id', '=', 'turnos.id')
                        ->where('turnos.planilla_id', '=', $idPlanilla);//877
                    //->orderBy('turnos.fecha', 'asc');
                    //->orderBy('inicio', 'asc');
                })
                ->orderBy('turnos.fecha', 'asc')
                ->orderBy('turnos.inicio', 'asc')
                ->get();

            //Recorro cada turno
            foreach ($turnos as $turno)
            {

                //Selecciono todos los cupos tomados del turno que estoy recorriendo con el foreach
                //$tomados = Planilla_Turno_User::where('planilla_id', $planilla->id)->where('turno_id', $turno->id)->where('estado', 'Activo')->get();

                $allTomados = 0;//cant. de turnos tomados por todos
                //$userAsignado = 0;//cant. de turnos asignado al user
                $userTomados = "";//Incluye el tipo del cupo tomado del user logeado

                foreach ($tomados as $tomado) {

                    if($turno->id == $tomado->turno_id)
                    {
                        //cuento cuantos cupos por turno han sido tomados, sirve para el "no cupos"
                        $allTomados++;


                        //Si el cupo tomado de acuerdo al id del turno pertenece al usuario logeado y es de tipo asignado, se muestra en la pre-toma un boton rojo deshabilitado con el valor "Asignado"
                        if($tomado->local_user_id == $user->id && $tomado->tipo == "Asignado"){
                            $userTomados = "Asignado";
                        }elseif($tomado->local_user_id == $user->id && $tomado->tipo == "Toma"){
                            $userTomados = "Toma";
                        }elseif($tomado->local_user_id == $user->id && $tomado->tipo == "Repechaje"){
                            $userTomados = "Toma";
                            //en el caso de que no sea del tipo"Asignado" y pertenece al user logeado solo se muestra el boton soltar. (aunque nunca debería entrar en este if porque la pre-toma es primero que la toma, por lo tanto, no deberia existir otro tipo de turno tomado como "toma","repechaje",etc)
                        }elseif($tomado->local_user_id == $user->id){
                            $userTomados = "Soltar";
                        }
                    }

                }

                //acá debe compararce los contadores xq si lo hago dentro del foreach "tomados" al final en los if de acá me lo va a sobrescribir!.
                if($userTomados == "Asignado"){ $turno->addEstado = "Asignado"; }
                elseif($userTomados == "Toma"){ $turno->addEstado = "Toma"; }
                elseif($userTomados == "Soltar"){ $turno->addEstado = "Soltar"; }
                //elseif(){ $turno->addEstado = "Tope"; }
                elseif($allTomados >= $turno->cupos){ $turno->addEstado = "No Cupos"; }
                else{ $turno->addEstado = "Disponible"; }

                //Muestro la hora y minutos SIN segundos
                $turno->inicio = date('H:i', strtotime($turno->inicio));
                $turno->termino = date('H:i', strtotime($turno->termino));
                //ingreso datos en un espacio del array(objeto) turno creado automaticamente al hacer la consulta $turnos
                $turno->allTomados = $allTomados;
                //$turno->addEstado = $userTomados;

            }
            //dd($turnos);
            return view('turno.pre-toma-por-dia')
                ->with('planilla', $planilla)
                ->with('noEsHora', $noEsHora)
                ->with('turnos', $turnos);

        }else{
            //hora debe estar entre la hora de inicio y la hora de termino
            //hora >= hora inicio y hora <= hora de termino

            //selecciono la última noticia actualizada
            //Público es la noticia del encargado
            //Oculto es la noticia del Administrador
            $noticia = Noticia::where('local_id', $id)
                ->where('estado', 'Público')
                ->orderBy('updated_at', 'desc')
                ->first();
            if(empty($noticia))
            {
                $noticia = new Noticia();
                $noticia->titulo = "Sin Registro";
                $noticia->descripcion = "Sin Registro";
                $noticia->updated_at = date("Y-m-d H:i:s");
            }

            $noticiaAdmin = Noticia::where('local_id', $id)
                ->where('estado', 'Oculto')
                ->orderBy('updated_at', 'desc')
                ->first();

            if(empty($noticiaAdmin))
            {
                $noticiaAdmin = new Noticia();
                $noticiaAdmin->titulo = "Sin Registro";
                $noticiaAdmin->descripcion = "Sin Registro";
                $noticiaAdmin->updated_at = date("Y-m-d H:i:s");
            }

            $informativo = Informativo::where('tipo', 'Locales')->where('estado', 'Público')->orderBy('updated_at', 'desc')->first();
            /*Si no existe un informativo */
            if($informativo == '')
            {
                $existe = 'No';
            }else{
                $existe = 'Si';
            }
            $planilla->inicioPreToma = date('H:i:s d-m-Y', strtotime($planilla->inicioPreToma));
            $planilla->finPreToma = date('H:i:s d-m-Y', strtotime($planilla->finPreToma));

            $noEsHora = 0;
            return view('turno.pre-toma-por-dia')
                ->with('noEsHora', $noEsHora)
                ->with('planilla', $planilla)
                ->with('noticia', $noticia)
                ->with('noticiaAdmin', $noticiaAdmin)
                ->with('informativo', $informativo)
                ->with('existe', $existe)
                ->with('user', $user);
        }
    }

    public function postPreToma($id, Request $request)//id es el id del turno
    {
        $message = "";

        $turno = Turno::find($id);

        //validación si existe el turno que se pretende tomar
        if(empty($turno) || $turno->Planilla->estado == 'Eliminada') { abort(500); }

        //corresponde al local según la planilla
        $local = $turno->Planilla->local_id;
        //Obtengo datos del usuario según local al que pertenece.
        $user = Local_User::where('user_id', Auth::user()->id)->where('local_id', $local)->first();
        

        //***** Validaciones  ******

        /* Obtengo todos los turnos tomados y la información de cada turno como fecha, inicio, termino, etc */
        $userTurnos = Planilla_Turno_User::where('planilla_turno_user.planilla_id', $turno->planilla_id)
            ->where('planilla_turno_user.estado', 'Activo')
            ->join('turnos', 'planilla_turno_user.turno_id', '=', 'turnos.id')
            ->get();


        /* Obtengo todos los turnos tomados y la información de cada turno como fecha, inicio, termino, etc
        $userTurnos = Planilla_Turno_User::where('planilla_id', $turno->planilla_id)
             ->where('estado', 'Activo')
             ->where('tipo', 'Pre Toma')
             ->get();
        */
                 
        //total de cupos tomados por todos los empaques
        $cantTurnosTomados = 0;
        //cantidad de turnos tomados por un empaque en una en la planilla solo por "Toma" de turnos
        $cantTurnosTomadosUser=0;
        //si un usuario tomó dos veces el mismo turno
        $duplicidad=0;
        //Si es distinto a cero sigifica que tiene tope con otro turno
        $tope = 0;

        //ciclo para recorrer todos los turnos tomados por los empaque en una planilla X.
        foreach ($userTurnos as $userTurno) {

            if($userTurno->turno_id == $turno->id){
                $cantTurnosTomados++;
            }

            //verificar duplicidad (si ya tengo tomado un turno que quiero tomar)
            if($userTurno->local_user_id == $user->id && $userTurno->turno_id == $turno->id){
                $duplicidad++;
                break;
                //Si la fecha del turno del array es igual al turno que se quiere tomar entra al if y se hacen las validaciones de hora de inicio y hora de termino
            }elseif (($userTurno->local_user_id == $user->id && $userTurno->fecha == $turno->fecha && $userTurno->inicio <= $turno->inicio && $userTurno->termino >= $turno->inicio)  || ($userTurno->local_user_id == $user->id && $userTurno->fecha == $turno->fecha && $userTurno->inicio <= $turno->termino && $userTurno->termino >= $turno->termino)) {
                $tope++;
                break;
            }

            if($userTurno->local_user_id == $user->id && $userTurno->tipo == "Pre Toma"){
                //cantidad de turnos tomados por un empaque en una en la planilla solo por "Toma" de turnos
                $cantTurnosTomadosUser++;
            }
        }



       
        //if si esq no queda cupo disponible del turno
        if($cantTurnosTomados >= $turno->cupos){
            $message = "No Cupos";
        }elseif($duplicidad != 0){
            //Verificar si ya tengo tomado un turno que quiero tomar
            $message = "Ya es mío";

        }elseif($user->cuposPreToma <= $cantTurnosTomadosUser) {
            //cantidad de turnos tomados por un empaque en una en la planilla solo por "Pre-Toma" de turnos
            $message = "Max. Turno";
            //abort(500);
        }elseif($tope != 0){
            //Validación de tope de horario
            $message = "Tope";
        }else{

            $hora = date('Y-m-d H:i:s');
            //si la variable $hora no está entre el inicio y termino de la planilla pasa al "else" y muestra el mensaje de que aún no es la toma de turnos o ya no esta en el rango de hora permitido!.
            if($hora >= $turno->Planilla->inicioPreToma && $hora <= $turno->Planilla->finPreToma)
            {
        
                        $pla_tur_user = new Planilla_Turno_User();
                        $pla_tur_user->deseo = null;
                        $pla_tur_user->fijo = "No";
                        $pla_tur_user->coordinador = "No";
                        $pla_tur_user->tipo = "Pre Toma";
                        $pla_tur_user->estado = "Activo";
                        $pla_tur_user->exTipo = null;
                        $pla_tur_user->planilla_id = $turno->planilla_id;//puede ser $id del post
                        $pla_tur_user->turno_id = $turno->id;
                        $pla_tur_user->local_user_id = $user->id;
                        
                        $pla_tur_user->save();


                        $message = "ok-Tomado";//Turno Guardado Exitosamente
            }else{
                //Flash::error("Usted ya no se encuentra en el rango de hora permitido para tomar o soltar un turno.");
                //return redirect()->action('TurnoController@index');
                $message = "Fuera de Hora";
                //abort(500);
            }
        }
        
        $arrayCupos = array();
        
        //Obtengo todos los turnos disponibles en la toma
        $turnos = Turno::where('planilla_id', $turno->planilla_id)->orderBy('fecha', 'asc')->orderBy('inicio', 'asc')->get();
        
        //varibale $cantCupos disponibles para mostrar en la vista (cupos que se han tomado)

        $idPlanilla = $turno->planilla_id;
        //dd($planilla->id);
        /**/
        $tomados = DB::table('planilla_turno_user')
                            ->where('planilla_turno_user.planilla_id', $idPlanilla)
                            ->where('planilla_turno_user.estado', 'Activo')
                            ->join('turnos', function ($join) use($idPlanilla) {
                                        $join->on('planilla_turno_user.turno_id', '=', 'turnos.id')
                                            ->where('turnos.planilla_id', '=', $idPlanilla);//877
                                            //->orderBy('turnos.fecha', 'asc');
                                            //->orderBy('inicio', 'asc');
                                    })
                            ->orderBy('turnos.fecha', 'asc')
                            ->orderBy('turnos.inicio', 'asc')
                            ->get();

        foreach ($turnos as $turno) {
          
              
                //Selecciono todos los cupos tomados del turno que estoy recorriendo con el foreach
                //$tomados = Planilla_Turno_User::where('planilla_id', $turno->planilla_id)->where('turno_id', $turno->id)->where('estado', 'Activo')->get();

                $allTomados = 0;//cant. de turnos tomados por todos
                //$userAsignado = 0;//cant. de turnos asignado al user
                $userTomados = "";//Incluye el tipo del cupo tomado del user logeado
                //$estado = "";

                foreach ($tomados as $tomado) {

                    if($turno->id == $tomado->turno_id)
                    {                    
                            //cuento cuantos cupos por turno han sido tomados, sirve para el "no cupos"
                            $allTomados++;

                            
                            //Si el cupo tomado de acuerdo al id del turno pertenece al usuario logeado y es de tipo asignado, se muestra en la pre-toma un boton rojo deshabilitado con el valor "Asignado"
                            if($tomado->local_user_id == $user->id && $tomado->tipo == "Asignado"){
                                $userTomados = "Asignado";
                            }elseif($tomado->local_user_id == $user->id && $tomado->tipo == "Toma"){
                                $userTomados = "Toma";
                            }elseif($tomado->local_user_id == $user->id && $tomado->tipo == "Repechaje"){
                                $userTomados = "Toma";
                            //en el caso de que no sea del tipo"Asignado" y pertenece al user logeado solo se muestra el boton soltar. (aunque nunca debería entrar en este if porque la pre-toma es primero que la toma, por lo tanto, no deberia existir otro tipo de turno tomado como "toma","repechaje",etc)
                            }elseif($tomado->local_user_id == $user->id){
                                $userTomados = "Soltar";
                            }

                    }
                }

                //acá debe compararce los contadores xq si lo hago dentro del foreach "tomados" al final en los if de acá me lo va a sobrescribir!.
                if($userTomados == "Asignado"){ $estado = "Asignado"; }
                elseif($userTomados == "Soltar"){ $estado = "ok-Tomado"; }
                elseif($userTomados == "Toma"){ $estado = "Toma"; }
                elseif($allTomados >= $turno->cupos){ $estado = "No Cupos"; }
                else{ $estado = "Disponible"; }
                //$estado = "ok-Tomado";
   
                //Agrego la cantidad a un array segun id del turno
                $arrayCupos[] =  array(
                                            'id' => $turno->id,//idTurno
                                            'cupos' => $allTomados,//Cupos disponibles
                                            'estado'=> $estado,
                                        );
                    
        }
        
            if($request->ajax()){
                return response()->json([

                        'message'   =>  $message,
                        'arrayCupos'    =>  $arrayCupos,//$arrayCupos
             
                        
                    ]);
            }

        
    }    

    public function deletePreTurnoTomado($id, Request $request)
    {
        $turno = Turno::find($id);

        //validación si existe el turno que se pretende tomar
        if(empty($turno) || $turno->Planilla->estado == 'Eliminada') { abort(500); }

        $local = $turno->Planilla->local_id;//corresponde al local según la planilla
        $user = Local_User::where('user_id', Auth::user()->id)->where('local_id', $local)->first();

        $hora = date('Y-m-d H:i:s');
        //si la variable $hora no está entre el inicio y termino de la planilla pasa al "else" y muestra el mensaje de que aún no es la toma de turnos o ya no esta en el rango de hora permitido!.
        if($hora >= $turno->Planilla->inicioPreToma && $hora <= $turno->Planilla->finPreToma)
        {
            //falta poner el first para q elimine solo un turno y no recorra todos los datos
            $soltar = Planilla_Turno_User::where('planilla_id', $turno->planilla_id)->where('turno_id', $id)->where('local_user_id', $user->id);

            $soltar->delete();
            $message = "Soltar";
        
        }else{
            $message = "Fuera de Hora";
        }

        
        $arrayCupos = array();
        
        //Obtengo todos los turnos disponibles en la toma
        $turnos = Turno::where('planilla_id', $turno->planilla_id)->orderBy('fecha', 'asc')->orderBy('inicio', 'asc')->get();
        
        //varibale $cantCupos disponibles para mostrar en la vista (cupos que se han tomado)

        $idPlanilla = $turno->planilla_id;
        //dd($planilla->id);
        /**/
        $tomados = DB::table('planilla_turno_user')
                            ->where('planilla_turno_user.planilla_id', $idPlanilla)
                            ->where('planilla_turno_user.estado', 'Activo')
                            ->join('turnos', function ($join) use($idPlanilla) {
                                        $join->on('planilla_turno_user.turno_id', '=', 'turnos.id')
                                            ->where('turnos.planilla_id', '=', $idPlanilla);//877
                                            //->orderBy('turnos.fecha', 'asc');
                                            //->orderBy('inicio', 'asc');
                                    })
                            ->orderBy('turnos.fecha', 'asc')
                            ->orderBy('turnos.inicio', 'asc')
                            ->get();

        foreach ($turnos as $turno) {
          
              
                //Selecciono todos los cupos tomados del turno que estoy recorriendo con el foreach
                //$tomados = Planilla_Turno_User::where('planilla_id', $turno->planilla_id)->where('turno_id', $turno->id)->where('estado', 'Activo')->get();//->where('local_user_id', $user->id)

                $allTomados = 0;//cant. de turnos tomados por todos
                //$userAsignado = 0;//cant. de turnos asignado al user
                $userTomados = "";//Incluye el tipo del cupo tomado del user logeado
                //$estado = "";

                foreach ($tomados as $tomado) {
                            
                    if($turno->id == $tomado->turno_id)
                    {
                            //cuento cuantos cupos por turno han sido tomados, sirve para el "no cupos"
                            $allTomados++;

                            
                            //Si el cupo tomado de acuerdo al id del turno pertenece al usuario logeado y es de tipo asignado, se muestra en la pre-toma un boton rojo deshabilitado con el valor "Asignado"
                            if($tomado->local_user_id == $user->id && $tomado->tipo == "Asignado"){
                                $userTomados = "Asignado";
                            }elseif($tomado->local_user_id == $user->id && $tomado->tipo == "Toma"){
                                $userTomados = "Toma";
                            }elseif($tomado->local_user_id == $user->id && $tomado->tipo == "Repechaje"){
                                $userTomados = "Toma";
                            //en el caso de que no sea del tipo"Asignado" y pertenece al user logeado solo se muestra el boton soltar. (aunque nunca debería entrar en este if porque la pre-toma es primero que la toma, por lo tanto, no deberia existir otro tipo de turno tomado como "toma","repechaje",etc)
                            }elseif($tomado->local_user_id == $user->id){
                                $userTomados = "Soltar";
                            }
                    }
                    
                }

                //acá debe compararce los contadores xq si lo hago dentro del foreach "tomados" al final en los if de acá me lo va a sobrescribir!.
                if($userTomados == "Asignado"){ $estado = "Asignado"; }
                elseif($userTomados == "Soltar"){ $estado = "ok-Tomado"; }
                elseif($userTomados == "Toma"){ $estado = "Toma"; }
                elseif($allTomados >= $turno->cupos){ $estado = "No Cupos"; }
                else{ $estado = "Disponible"; }
                //$estado = "ok-Tomado";
   
                //Agrego la cantidad a un array segun id del turno
                $arrayCupos[] =  array(
                                            'id' => $turno->id,//idTurno
                                            'cupos' => $allTomados,//Cupos disponibles
                                            'estado'=> $estado,
                                        );
                    
        }
            //$message = "eliminado";//Turno Guardado Exitosamente
            if($request->ajax()){
                return response()->json([

                        'message'   =>  $message,
                        'arrayCupos'    =>  $arrayCupos,//$arrayCupos
                    ]);
            }


    }

    public function repechaje($id){
        //obtengo los datos del usuario que pertenece al local
        $user = Local_User::where('user_id', Auth::user()->id)->where('local_id', $id)->where('estado', '!=', 'Desvinculado')->firstOrFail();

        //Obtengo la fecha y hora actual del servidor
        $hora = date('Y-m-d H:i:s');

        if($user->Local->repechajeLocal == 'No'){
            session()->flash('danger', 'El local no tiene habilitado el repechaje');
            return redirect()->action('TurnoController@index');           
        }elseif($user->estado == 'Deudor' || $user->estado == 'Suspendido' || $user->Local->estado == 'Bloqueado'){
            session()->flash('danger', 'Usted no puede tomar turnos porque mantiene una deuda pendiente, está suspendido o el local se encuentra bloqueado');
            return redirect()->action('TurnoController@index');
        }elseif($user->inicioCastigo <= $hora && $user->terminoCastigo >= $hora) {
            session()->flash('danger', "Usted se encuentra castigado desde el ".$user->inicioCastigo." al ".$user->terminoCastigo);
            return redirect()->action('TurnoController@index'); 
        }

        //obtengo todos los datos de la planilla
        $planilla = Planilla::where('local_id', $id)->where('estado', 'Activa')->get()->last();

        //si no devuelve nada debería mostrar un mensaje de que no existe una planilla
        if($planilla == '')
        {
            session()->flash('danger', 'El encargado no ha creado ninguna planilla.');
            return redirect()->action('TurnoController@index');
        }

        if($planilla->inicioRepechaje == '' || $planilla->finRepechaje == '')
        {
            session()->flash('danger', 'El encargado no ha ingresado una fecha y hora para el repechaje.');
            return redirect()->action('TurnoController@index');
        }          


        //si la variable $hora no está entre el inicio y termino de la planilla pasa al "else" y muestra el mensaje de que aún no es la toma de turnos!.
        if($hora >= $planilla->inicioRepechaje && $hora <= $planilla->finRepechaje)
        {
      
        //------------------------------
        $noEsHora = 1;
       
        $turnos = array();
        //$array = array();
        
        //$turnos = collect();
        //falta validar si la planilla existe, si corresponde a la toma, si pertenece al super, ect
        $allTurnos = Turno::where('planilla_id', $planilla->id)->orderBy('fecha', 'asc')->orderBy('inicio', 'asc')->get();

        $idPlanilla = $planilla->id;
        //dd($planilla->id);
        /**/
        $tomados = DB::table('planilla_turno_user')
                            ->where('planilla_turno_user.planilla_id', $idPlanilla)
                            ->where('planilla_turno_user.estado', 'Activo')
                            ->join('turnos', function ($join) use($idPlanilla) {
                                        $join->on('planilla_turno_user.turno_id', '=', 'turnos.id')
                                            ->where('turnos.planilla_id', '=', $idPlanilla);//877
                                            //->orderBy('turnos.fecha', 'asc');
                                            //->orderBy('inicio', 'asc');
                                    })
                            ->orderBy('turnos.fecha', 'asc')
                            ->orderBy('turnos.inicio', 'asc')
                            ->get();

            //Recorro cada turno
            foreach ($allTurnos as $allTurno) 
            {
                $allTomados = 0;//cant. de turnos tomados por todos
                $mio="No";//Mio=Si significa que tengo este turno y no deberia mostrar en el repechaje
                $userTomados = "";//Incluye el tipo del cupo tomado del user logeado
                
                //Selecciono todos los cupos tomados del turno que estoy recorriendo con el foreach
                //$tomados = Planilla_Turno_User::where('planilla_id', $planilla->id)->where('turno_id', $allTurno->id)->where('estado', 'Activo')->get();


                foreach ($tomados as $tomado) {
                    if($allTurno->id == $tomado->turno_id)
                    {
                        $allTomados++;

                        if($tomado->local_user_id == $user->id){
                            $mio = "Si";
                        }
                    }
                }
                
                             

                //entra si quedan cupos disponibles en el turno
                if($allTomados < $allTurno->cupos && $mio == "No"){
                    //cantidad de cupos tomados por turno
                    //$allTomados= $allTurno->cupos - $tomados;
                    //agrego al array turnos
                /*
                $turno->inicio = date('h:i', strtotime($turno->inicio));
                $turno->termino = date('h:i', strtotime($turno->termino));
                */
                    //$addEstado="Disponible";

                                $turnos[] =  array(
                                                    'id' => $allTurno->id,//idTurno
                                                    'fecha' =>  date('d-m-Y', strtotime($allTurno->fecha)),
                                                    'inicio'=>  date('H:i', strtotime($allTurno->inicio)),
                                                    'termino'=> date('H:i', strtotime($allTurno->termino)),
                                                    'cupos' =>  $allTurno->cupos,
                                                    'planilla_id'=>$allTurno->planilla_id,
                                                    'cuposTomados' => $allTomados,//Cupos disponibles
                                                    //'addEstado' => $estado,
                                                );
                                        
                }



            }

            
            //dd($turnos);
            return view('turno.repechaje')
                ->with('noEsHora', $noEsHora)
                ->with('turnos', $turnos);
            //->with('orders', $orders);

        }else{
            //hora debe estar entre la hora de inicio y la hora de termino
            //hora >= hora inicio y hora <= hora de termino

            //selecciono la última noticia actualizada
            //Público es la noticia del encargado
            //Oculto es la noticia del Administrador
            $noticia = Noticia::where('local_id', $id)
                                ->where('estado', 'Público')
                                ->orderBy('updated_at', 'desc')
                                ->first();
            if(empty($noticia))
            {
                $noticia = new Noticia();
                $noticia->titulo = "Sin Registro";
                $noticia->descripcion = "Sin Registro";
                $noticia->updated_at = date("Y-m-d H:i:s");
            }

            $noticiaAdmin = Noticia::where('local_id', $id)
                                ->where('estado', 'Oculto')
                                ->orderBy('updated_at', 'desc')
                                ->first();

            if(empty($noticiaAdmin))
            {
                $noticiaAdmin = new Noticia();
                $noticiaAdmin->titulo = "Sin Registro";
                $noticiaAdmin->descripcion = "Sin Registro";
                $noticiaAdmin->updated_at = date("Y-m-d H:i:s");
            }           

            $informativo = Informativo::where('tipo', 'Locales')->where('estado', 'Público')->orderBy('updated_at', 'desc')->first();
            /*Si no existe un informativo */
            if($informativo == '')
            {
                $existe = 'No';
            }else{
                $existe = 'Si';
            }
            $planilla->inicioRepechaje = date('H:i:s d-m-Y', strtotime($planilla->inicioRepechaje));
            $planilla->finRepechaje = date('H:i:s d-m-Y', strtotime($planilla->finRepechaje));

            $noEsHora = 0;
            return view('turno.repechaje')
            ->with('noEsHora', $noEsHora)
            ->with('planilla', $planilla)
            ->with('noticia', $noticia)
            ->with('noticiaAdmin', $noticiaAdmin)
            ->with('informativo', $informativo)
            ->with('existe', $existe)
            ->with('user', $user);
        }  
    }



    public function postRepechaje($id, Request $request)//id es el id del turno
    {
        $message = "";

        $turno = Turno::find($id);

        //validación si existe el turno que se pretende tomar
        if(empty($turno) || $turno->Planilla->estado == 'Eliminada') { abort(500); }

        //corresponde al local según la planilla
        $local = $turno->Planilla->local_id;
        //Obtengo datos del usuario según local al que pertenece.
        $user = Local_User::where('user_id', Auth::user()->id)->where('local_id', $local)->first();
        

        //***** Validaciones  ******


   

        /* Obtengo todos los turnos tomados y la información de cada turno como fecha, inicio, termino, etc */
        $userTurnos = Planilla_Turno_User::where('planilla_id', $turno->planilla_id)
             ->where('estado', 'Activo')
             //->where('tipo', 'Pre Toma')
             ->get();


        //total de cupos tomados por todos los empaques
        $cantTurnosTomados = 0;
        //cantidad de turnos tomados por un empaque en una en la planilla solo por "Toma" de turnos
        $cantTurnosTomadosUser=0;
        //si un usuario tomó dos veces el mismo turno
        $duplicidad=0;
        //Si es distinto a cero sigifica que tiene tope con otro turno
        $tope =0;

        //ciclo para recorrer todos los turnos tomados por los empaque en una planilla X.
        foreach ($userTurnos as $userTurno) {
            //Cantidad de turnos tomados (cupos) por todos los empaques de un turno especifico de la planilla en la toma activa.
            if($userTurno->turno_id == $turno->id){
                $cantTurnosTomados = $cantTurnosTomados + 1;
            }
          
            //si el turno que estamos recorriendo pertenece al usuario que esta tomando el turno entra en este if
            if($userTurno->local_user_id == $user->id){
                //verificar duplicidad (si ya tengo tomado un turno que quiero tomar)
                if($userTurno->turno_id == $turno->id){
                    $duplicidad = 1;
                //Si la fecha del turno del array es igual al turno que se quiere tomar entra al if y se hacen las validaciones de hora de inicio y hora de termino
                }elseif ($userTurno->Turno->fecha == $turno->fecha) {
                    //elseIf -> Tope de Horario hora inicio
                    if($userTurno->Turno->inicio <= $turno->inicio && $userTurno->Turno->termino >= $turno->inicio){
                        $tope = $tope + 1;
                    //elseIf -> Tope de Horario hora termino
                    }elseif($userTurno->Turno->inicio <= $turno->termino && $userTurno->Turno->termino >= $turno->termino){
                        $tope = $tope + 1;
                    }
                }

                //cantidad de turnos tomados por un empaque en una en la planilla solo por "Repechaje"
                if($userTurno->tipo == 'Repechaje'){
                    $cantTurnosTomadosUser = $cantTurnosTomadosUser + 1;
                }


            }
        }



        //FALTA VALIDAD LA HORA EN QUE SE TOMA EL TURNO Y NO EXCEDA LO PERMITIDO DEL FIN DE TOMA DE TURNO!.

        //if si esq no queda cupo disponible del turno
        if($cantTurnosTomados >= $turno->cupos){
            $message = "No Cupos";
        }elseif($duplicidad != 0){
            //Verificar si ya tengo tomado un turno que quiero tomar
            $message = "Ya es mío";

        }elseif($tope != 0){
            //Validación de tope de horario
            $message = "Tope";
        }elseif($user->cuposRepechaje <= $cantTurnosTomadosUser) {
            //cantidad de turnos tomados por un empaque en una en la planilla solo por "Repechaje" de turnos
            $message = "Max. Turno";
            //abort(500);
        }else{

            $hora = date('Y-m-d H:i:s');
            //si la variable $hora no está entre el inicio y termino de la planilla pasa al "else" y muestra el mensaje de que aún no es la toma de turnos o ya no esta en el rango de hora permitido!.
            if($hora >= $turno->Planilla->inicioRepechaje && $hora <= $turno->Planilla->finRepechaje)
            {
        
                        $pla_tur_user = new Planilla_Turno_User();
                        $pla_tur_user->deseo = null;
                        $pla_tur_user->fijo = "No";
                        $pla_tur_user->coordinador = "No";
                        $pla_tur_user->tipo = "Repechaje";
                        $pla_tur_user->estado = "Activo";
                        $pla_tur_user->exTipo = null;
                        $pla_tur_user->planilla_id = $turno->planilla_id;//puede ser $id del post
                        $pla_tur_user->turno_id = $turno->id;
                        $pla_tur_user->local_user_id = $user->id;
                        
                        $pla_tur_user->save();


                        $message = "ok-Tomado";//Turno Guardado Exitosamente
            }else{
                //Flash::error("Usted ya no se encuentra en el rango de hora permitido para tomar o soltar un turno.");
                //return redirect()->action('TurnoController@index');
                $message = "Fuera de Hora";
                //abort(500);
            }
        }
        
        $arrayCupos = array();
        
        //Obtengo todos los turnos disponibles en la toma
        $turnos = Turno::where('planilla_id', $turno->planilla_id)->orderBy('fecha', 'asc')->orderBy('inicio', 'asc')->get();
        
        //varibale $cantCupos disponibles para mostrar en la vista (cupos que se han tomado)
        $idPlanilla = $turno->planilla_id;
        //dd($planilla->id);
        /**/
        $tomados = DB::table('planilla_turno_user')
                            ->where('planilla_turno_user.planilla_id', $idPlanilla)
                            ->where('planilla_turno_user.estado', 'Activo')
                            ->join('turnos', function ($join) use($idPlanilla) {
                                        $join->on('planilla_turno_user.turno_id', '=', 'turnos.id')
                                            ->where('turnos.planilla_id', '=', $idPlanilla);//877
                                            //->orderBy('turnos.fecha', 'asc');
                                            //->orderBy('inicio', 'asc');
                                    })
                            ->orderBy('turnos.fecha', 'asc')
                            ->orderBy('turnos.inicio', 'asc')
                            ->get();


        foreach ($turnos as $turno) {
          
              
                //Selecciono todos los cupos tomados del turno que estoy recorriendo con el foreach
                //$tomados = Planilla_Turno_User::where('planilla_id', $turno->planilla_id)->where('turno_id', $turno->id)->where('estado', 'Activo')->get();//->where('local_user_id', $user->id)

                $allTomados = 0;//cant. de turnos tomados por todos
                //$userAsignado = 0;//cant. de turnos asignado al user
                $userTomados = "";//Incluye el tipo del cupo tomado del user logeado
                //$estado = "";

                foreach ($tomados as $tomado) 
                {

                    if($turno->id == $tomado->turno_id)
                    {

                                //cuento cuantos cupos por turno han sido tomados, sirve para el "no cupos"
                                $allTomados++;

                                /*
                                //Si el cupo tomado de acuerdo al id del turno pertenece al usuario logeado y es de tipo asignado, se muestra en la pre-toma un boton rojo deshabilitado con el valor "Asignado"
                                if($tomado->local_user_id == $user->id && $tomado->tipo == "Asignado"){
                                    $userTomados = "Asignado";
                                }elseif($tomado->local_user_id == $user->id && $tomado->tipo == "Toma"){
                                    $userTomados = "Toma";
                                //en el caso de que no sea del tipo"Asignado" y pertenece al user logeado solo se muestra el boton soltar. (aunque nunca debería entrar en este if porque la pre-toma es primero que la toma, por lo tanto, no deberia existir otro tipo de turno tomado como "toma","repechaje",etc)
                                }elseif($tomado->local_user_id == $user->id){
                                    $userTomados = "Soltar";
                                }
                                */
                                if($tomado->local_user_id == $user->id && $tomado->tipo == "Repechaje"){
                                    $userTomados = "Soltar";
                                }
                    }
                }

                //acá debe compararce los contadores xq si lo hago dentro del foreach "tomados" al final en los if de acá me lo va a sobrescribir!.

                if($userTomados == "Soltar"){ $estado = "ok-Tomado"; }
                elseif($allTomados >= $turno->cupos){ $estado = "No Cupos"; }
                else{ $estado = "Disponible"; }
                //$estado = "ok-Tomado";
   
                //Agrego la cantidad a un array segun id del turno
                $arrayCupos[] =  array(
                                            'id' => $turno->id,//idTurno
                                            'cupos' => $allTomados,//Cupos disponibles
                                            'estado'=> $estado,
                                        );
                    
        }
        
            if($request->ajax()){
                return response()->json([

                        'message'   =>  $message,
                        'arrayCupos'    =>  $arrayCupos,//$arrayCupos
             
                        
                    ]);
            }

        
    }    


    public function deleteRepechajeTomado($id, Request $request)
    {
        $turno = Turno::find($id);

        //validación si existe el turno que se pretende tomar
        if(empty($turno) || $turno->Planilla->estado == 'Eliminada') { abort(500); }



        $local = $turno->Planilla->local_id;//corresponde al local según la planilla
        $user = Local_User::where('user_id', Auth::user()->id)->where('local_id', $local)->first();

        $hora = date('Y-m-d H:i:s');
        //si la variable $hora no está entre el inicio y termino de la planilla pasa al "else" y muestra el mensaje de que aún no es la toma de turnos o ya no esta en el rango de hora permitido!.
        if($hora >= $turno->Planilla->inicioRepechaje && $hora <= $turno->Planilla->finRepechaje)
        {
            //falta poner el first para q elimine solo un turno y no recorra todo los datos
            $soltar = Planilla_Turno_User::where('planilla_id', $turno->planilla_id)->where('turno_id', $id)->where('local_user_id', $user->id);

            $soltar->delete();
            $message = "Soltar";
        
        }else{
            $message = "Fuera de Hora";
        }

        
        $arrayCupos = array();
        
        //Obtengo todos los turnos disponibles en la toma
        $turnos = Turno::where('planilla_id', $turno->planilla_id)->orderBy('fecha', 'asc')->orderBy('inicio', 'asc')->get();
        
        //varibale $cantCupos disponibles para mostrar en la vista (cupos que se han tomado)


        $idPlanilla = $turno->planilla_id;
        //dd($planilla->id);
        /**/
        $tomados = DB::table('planilla_turno_user')
                            ->where('planilla_turno_user.planilla_id', $idPlanilla)
                            ->where('planilla_turno_user.estado', 'Activo')
                            ->join('turnos', function ($join) use($idPlanilla) {
                                        $join->on('planilla_turno_user.turno_id', '=', 'turnos.id')
                                            ->where('turnos.planilla_id', '=', $idPlanilla);//877
                                            //->orderBy('turnos.fecha', 'asc');
                                            //->orderBy('inicio', 'asc');
                                    })
                            ->orderBy('turnos.fecha', 'asc')
                            ->orderBy('turnos.inicio', 'asc')
                            ->get();


        foreach ($turnos as $turno) 
        {
          
              
                //Selecciono todos los cupos tomados del turno que estoy recorriendo con el foreach
                //$tomados = Planilla_Turno_User::where('planilla_id', $turno->planilla_id)->where('turno_id', $turno->id)->where('estado', 'Activo')->get();//->where('local_user_id', $user->id)

                $allTomados = 0;//cant. de turnos tomados por todos
                //$userAsignado = 0;//cant. de turnos asignado al user
                $userTomados = "";//Incluye el tipo del cupo tomado del user logeado
                //$estado = "";

                foreach ($tomados as $tomado) 
                {
                    if($turno->id == $tomado->turno_id)
                    {
                        //cuento cuantos cupos por turno han sido tomados, sirve para el "no cupos"
                        $allTomados++;

                        
                        if($tomado->local_user_id == $user->id && $tomado->tipo == "Repechaje"){
                            $userTomados = "Soltar";
                        }
                    }

                    
                }

                //acá debe compararce los contadores xq si lo hago dentro del foreach "tomados" al final en los if de acá me lo va a sobrescribir!.
                
                if($userTomados == "Soltar"){ $estado = "ok-Tomado"; }
                elseif($allTomados >= $turno->cupos){ $estado = "No Cupos"; }
                else{ $estado = "Disponible"; }
                //$estado = "ok-Tomado";
   
                //Agrego la cantidad a un array segun id del turno
                $arrayCupos[] =  array(
                                            'id' => $turno->id,//idTurno
                                            'cupos' => $allTomados,//Cupos disponibles
                                            'estado'=> $estado,
                                        );
                    
        }

            //$message = "eliminado";//Turno Guardado Exitosamente
            if($request->ajax()){
                return response()->json([

                        'message'   =>  $message,
                        'arrayCupos'    =>  $arrayCupos,//$arrayCupos
                    ]);
            }


    }


    public function misTurnos(){
        //Obtengo los id de Local_User que pertenece un usuario
        $misLocales = Local_User::select('id')->where('user_id', Auth::user()->id)->get();

        if($misLocales == '' || empty($misLocales))
        {
            session()->flash('danger', 'Usted no pertenece a ningún local.');
            return redirect()->action('HomeController@index');
        }        


        $hoy = date("Y-m-d");  
        $hora = date('H:i:s');
        $proxTurnos = Planilla_Turno_User::
                        select('planilla_turno_user.*', 'turnos.fecha', 'turnos.inicio', 'turnos.termino')
                        ->whereIn('planilla_turno_user.local_user_id', $misLocales)
                        ->where('planilla_turno_user.estado', 'Activo')
                        ->join('turnos', 'turnos.id', '=', 'planilla_turno_user.turno_id')

                        ->where('turnos.fecha', '>=', $hoy)
            /*
                        ->orWhere(function ($query) use($hoy, $hora) {
                            $query->where('turnos.fecha', '=', $hoy)
                                ->where('turnos.inicio' ,'>=', $hora);

                        })
            */
                        //->where('turnos.inicio' ,'>=', $hora)
                        ->orderBy('turnos.fecha', 'asc')
                        ->orderBy('turnos.inicio', 'asc')

                        ->paginate(6);       
        //dd($proxTurnos);
        //con whereIn hace una busqueda por los valores dentro de un array (misLocales)
        /**/
        $turnos = Planilla_Turno_User::
                        select('planilla_turno_user.*', 'turnos.fecha', 'turnos.inicio', 'turnos.termino')
                        ->whereIn('planilla_turno_user.local_user_id', $misLocales)
                        ->where('planilla_turno_user.estado', 'Activo')
                        ->join('turnos', 'turnos.id', '=', 'planilla_turno_user.turno_id')
            /*
                        ->where(function ($query) use($hoy, $hora) {
                            $query->where('turnos.fecha', '<=', $hoy)
                                ->where(function ($query2) use($hora) {
                                    $query2->where('turnos.inicio' ,'<=', $hora);
                                });

                        })
            */
                        //->groupBy('turno_id')
                        ->where('fecha' ,'<=', $hoy)
                        ->orderBy('turnos.fecha', 'desc')
                        ->orderBy('turnos.inicio', 'asc')
                        //->get();
                        ->paginate(6);

        

        return view('turno.mis-turnos', ['proxTurnos' => $proxTurnos], ['turnos' => $turnos]);
        //return view('turno.mis-turnos')
            //->with('proxTurnos', $proxTurnos)
            //->with('turnos', $turnos);
    }

    public function regalos($id){
        //obtengo los datos del usuario que pertenece al local
        $user = Local_User::where('user_id', Auth::user()->id)->where('local_id', $id)->first();

        //si la consulta anterior no devuelve nada significa que el local no existe o el empaque no pertenece al local
        if($user == '')
        {
            return view ('errors/userNotFound');
        }

        //Obtengo la fecha y hora actual del servidor
        //date_default_timezone_set("America/Santiago");
        $hora = date('Y-m-d H:i:s');

        if($user->Local->regalarLocal == 'No' || $user->Local->cuenta == 'Free'){
            session()->flash('danger', "El local ".$user->Local->Cadena->nombre." - " .$user->Local->nombre."  no tiene habilitado los regalos y es sólo para locales premium");
            return redirect()->action('TurnoController@index');
        }elseif($user->estado == 'Deudor'){
            session()->flash('danger', 'Usted no puede tomar regalos porque mantiene una deuda pendiente');
            return redirect()->action('TurnoController@index');
        }elseif($user->estado == 'Suspendido'){
            session()->flash('danger', 'Usted no puede tomar turnos porque está suspendido');
            return redirect()->action('TurnoController@index');
        }elseif($user->estado == 'Desvinculado'){
            session()->flash('danger', 'Usted no puede tomar turnos porque ya no pertenece a este local');
            return redirect()->action('TurnoController@index');
        }elseif ($user->Local->estado == 'Bloqueado') {
            session()->flash('danger', "El local ".$user->Local->Cadena->nombre." - " .$user->Local->nombre."  se encuentra bloqueado");
            return redirect()->action('TurnoController@index');
        }elseif($user->inicioCastigo <= $hora && $user->terminoCastigo >= $hora) {
            session()->flash('danger', "Usted se encuentra castigado desde el ".$user->inicioCastigo." al ".$user->terminoCastigo);
            return redirect()->action('TurnoController@index');
        }

        $fechaActual = date('Y-m-d');

        $allTurnos = DB::table('planilla_turno_user')->select('planilla_turno_user.*', 'users.nombre', 'users.apellido', 'turnos.fecha',  'turnos.inicio',  'turnos.termino')
                        ->where('planilla_turno_user.tipo', 'Regalando')
                        ->where('planilla_turno_user.estado', 'Activo')
                        ->join('turnos', 'turnos.id', '=', 'planilla_turno_user.turno_id')
                        ->join('local_user', 'local_user.id', '=', 'planilla_turno_user.local_user_id')
                        ->where('local_user.local_id', '=', $id)
                        ->join('users', 'users.id', '=', 'local_user.user_id')
                        ->where('turnos.fecha' ,'>=', $fechaActual)
                        ->orderBy('turnos.fecha', 'asc')
                        ->orderBy('turnos.inicio', 'asc')
                        ->get();


        //lo convierto a una colección xq no acepta array que se produce al ejecutar "joins"
        $allTurnos = Collection::make($allTurnos);

        //dd(date('H:i'));
        $turnos = $allTurnos->filter(function($turn)
            {

                $fechaActual = date('Y-m-d');
                $horaActual = date('H:i:s');

                if ($turn->fecha == $fechaActual && $turn->inicio < $horaActual) {
                    return false;
                }elseif ($turn->fecha >= $fechaActual){
                    $semana = array("","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo");
                    $turn->diaSemana = $semana[date('N', strtotime($turn->fecha))];
                    $turn->fecha = date('d-m-Y', strtotime($turn->fecha));
                    $turn->inicio = date('H:i', strtotime($turn->inicio));
                    $turn->termino = date('H:i', strtotime($turn->termino));
                    return true;
                }

            });

        return view('turno.regalos')
                ->with('turnos', $turnos);
    }

    public function postRegalos(Request $request){
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');
        $turnoRegalo = Planilla_Turno_User::find($request->id);

        //si el turno que se quiere tomar no existe o no se esta regalando se redirige a la pag error
        if($turnoRegalo == '' || $turnoRegalo->tipo != 'Regalando' || $turnoRegalo->estado == 'Cancelado')
        {
            session()->flash('danger', 'El turno que quieres tomar no existe o ya no se está regalando.');
            return redirect()->route('turno.regalos', ['id' => $turnoRegalo->Local_User->local_id]);
        }

        if($turnoRegalo->Turno->fecha == $fecha){
            if($turnoRegalo->Turno->inicio <= $hora){// && $turno->Turno->termino >= $hora
                session()->flash('danger', 'No lo puedes tomar porque ya comenzó o terminó el turno');
                return redirect()->route('turno.regalos', ['id' => $turnoRegalo->Local_User->local_id]);
            }
        }

        //si no pertenezco al local me redirige al error
        $miLocal = Local_User::where('user_id', Auth::user()->id)->where('local_id', $turnoRegalo->Planilla->local_id)->first();
        if($miLocal == '')
        {
            session()->flash('danger', "Usted no pertenece al local ".$turnoRegalo->Planilla->Local->Cadena->nombre. " - ".$turnoRegalo->Planilla->Local->nombre);
            return redirect()->route('turno.regalos', ['id' => $miLocal->local_id]);
        }elseif ($miLocal->Local->regalarLocal == 'No'  || $miLocal->Local->cuenta == 'Free'){
            session()->flash('danger', "El local ".$miLocal->Local->Cadena->nombre." - " .$miLocal->Local->nombre."  no tiene habilitado los regalos y es sólo para locales premium");
            return redirect()->action('TurnoController@index');
        }

        $turnoFecha = $turnoRegalo->Turno->fecha;
        $turnoInicio = $turnoRegalo->Turno->inicio;
        $turnoTermino = $turnoRegalo->Turno->termino;

        //validar si tengo un turno con tope del regalo
        $tope = DB::table('planilla_turno_user')
                        ->select('planilla_turno_user.*', 'turnos.inicio', 'turnos.termino')
                        ->where('planilla_turno_user.local_user_id', $miLocal->id)
                        ->where('planilla_turno_user.estado', 'Activo')
                        ->join('turnos', 'turnos.id', '=', 'planilla_turno_user.turno_id')
                        ->where('turnos.fecha', '=', $turnoFecha)
                        ->where(function ($query) use($turnoInicio, $turnoTermino) {
                            $query->whereBetween('turnos.inicio', [$turnoInicio,$turnoTermino])
                                ->orWhere(function ($query2) use($turnoInicio, $turnoTermino) {
                                    $query2->whereBetween('turnos.termino', [$turnoInicio,$turnoTermino]);
                                });

                        })
                        ->count();


        if($tope > 0){
            session()->flash('danger', 'No es posible tomar este turno, tienes tope de hora');
            return redirect()->route('turno.regalos', ['id' => $miLocal->local_id]);
        }

        $turnoNuevo = new Planilla_Turno_User();

        //$turnoNuevo->deseo = null;
        $turnoNuevo->fijo = 'No';
        $turnoNuevo->coordinador = $turnoRegalo->coordinador;
        $turnoNuevo->tipo = "Regalo";
        $turnoNuevo->estado = "Activo";
        $turnoNuevo->exTipo = null;
        $turnoNuevo->planilla_id = $turnoRegalo->planilla_id;
        $turnoNuevo->turno_id = $turnoRegalo->turno_id;
        $turnoNuevo->local_user_id = $miLocal->id;
        $turnoNuevo->save();

        $turnoRegalo->estado = "Cancelado";
        $turnoRegalo->update();

        session()->flash('success', '¡Tomaste el Turno!, Revisa tus Turnos.');
        return redirect()->route('turno.regalos', ['id' => $miLocal->local_id]);

    }

    public function regalarTurno(Request $request){
        $fechaActual = date('Y-m-d H:i:s');
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');

        $turno = Planilla_Turno_User::find($request->id);


        if($turno == '' || $turno->tipo == "Regalando" || $turno->estado == "Cancelado")
        {
            session()->flash('danger', '¡El turno que intentas regalar no existe, lo estas regalando o ya lo regalaste!');
            return redirect()->route('turno.mis-turnos');
        }elseif($turno->tipo == "Cediendo" || $turno->tipo == "Cambiando"){
            session()->flash('danger', '¡El turno que intentas regalar lo estas cediendo o cambiando, para regalar el turno debes dejar de ceder o cambiar el turno !');
            return redirect()->route('turno.mis-turnos');
        }

        if($turno->Turno->fecha == $fecha){
            if($turno->Turno->inicio <= $hora){// && $turno->Turno->termino >= $hora
                session()->flash('danger', 'No lo puedes regalar porque ya comenzó o terminó el turno');
                return redirect()->route('turno.mis-turnos');
            }
        }

        if(($turno->planilla->inicioToma <= $fechaActual && $turno->planilla->finToma >= $fechaActual) || ($turno->planilla->inicioPreToma <= $fechaActual && $turno->planilla->finPreToma >= $fechaActual)){
            session()->flash('danger', 'No puedes regalar los turnos mientras la pre-toma o la toma de turnos esta activa');
            return redirect()->route('turno.mis-turnos');
        }

        if($turno->planilla->finToma >= $fechaActual){
            session()->flash('danger', 'Sólo se puede regalar turnos una vez que la toma de turno haya terminado');
            return redirect()->route('turno.mis-turnos');
        }

        if ($turno->Local_User->Local->regalarLocal == 'No'  || $turno->Local_User->Local->cuenta == 'Free'){
            session()->flash('danger', "El local ".$turno->Local_User->Local->Cadena->nombre." - " .$turno->Local_User->Local->nombre."  no tiene habilitado los regalos y es sólo para locales premium");
            return redirect()->route('turno.mis-turnos');
        }

        $turno->exTipo = $turno->tipo;
        $turno->tipo = "Regalando";

        $turno->update();

        session()->flash('warning', '¡Estas regalando el turno!');
        return redirect()->route('turno.mis-turnos');

    }

    public function cancelarRegalo(Request $request){
        $fechaActual = date('Y-m-d H:i:s');


        $turno = Planilla_Turno_User::find($request->id);

        if($turno == '' || $turno->tipo != "Regalando" || $turno->estado == "Cancelado")
        {
            session()->flash('danger', '¡El turno que intentas regalar no existe, lo estas regalando o ya lo regalaste!');
            return redirect()->route('turno.mis-turnos');
        }



        if(($turno->planilla->inicioToma <= $fechaActual && $turno->planilla->finToma >= $fechaActual) || ($turno->planilla->inicioPreToma <= $fechaActual && $turno->planilla->finPreToma >= $fechaActual)){
            session()->flash('danger', 'No puedes cancelar los turnos que estas regalando mientras la pre-toma o la toma de turnos esta activa');
            return redirect()->route('turno.mis-turnos');
        }

        if($turno->planilla->finToma >= $fechaActual){
            session()->flash('danger', 'Sólo se puede regalar turnos una vez que la toma de turno haya terminado');
            return redirect()->route('turno.mis-turnos');
        }

        if ($turno->Local_User->Local->regalarLocal == 'No'  || $turno->Local_User->Local->cuenta == 'Free'){
            session()->flash('danger', "El local ".$turno->Local_User->Local->Cadena->nombre." - " .$turno->Local_User->Local->nombre."  no tiene habilitado los regalos y es sólo para locales premium");
            return redirect()->route('turno.mis-turnos');
        }

        $turno->tipo = $turno->exTipo;
        $turno->exTipo = null;
        $turno->update();

        session()->flash('success', '¡Volviste a tomar el turno!');
        return redirect()->route('turno.mis-turnos');
    }


    public function ceder($id){//id local

        $hoy = date("Y-m-d");
        $hora = date('H:i:s');
        $fechaCompleta = date('Y-m-d H:i:s');
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


        $miLocal = Local_User::where('user_id', Auth::user()->id)
            ->where('local_id', $id)
            ->where('estado', '!=', 'Desvinculado')
            ->first();


        if(empty($miLocal)) {
            session()->flash('danger', "Usted no pertenece al local");
            return redirect()->action('HomeController@index');
        }elseif ($miLocal->Local->ceder == 'No'  || $miLocal->Local->cuenta == 'Free' || $miLocal->Local->estado == 'Bloqueado'){
            session()->flash('danger', "Tu local deber tener habilitado la opción ceder turnos, estar activo y ser premium");
            return redirect()->action('TurnoController@index');
        }elseif($miLocal->estado != 'Activo'){
            session()->flash('danger', "Usted se encuentra suspedido o mantiene una deuda pendiente");
            return redirect()->action('TurnoController@index');
        }elseif($miLocal->inicioCastigo <= $fechaCompleta && $miLocal->terminoCastigo >= $fechaCompleta) {
            session()->flash('danger', "Usted se encuentra castigado desde el ".$miLocal->inicioCastigo." al ".$miLocal->terminoCastigo);
            return redirect()->action('TurnoController@index');
        }

        //Código para ceder
            $list_turnos = Planilla_Turno_User::
            select('planilla_turno_user.id', 'turnos.fecha', 'turnos.inicio', 'turnos.termino')
            ->where('planilla_turno_user.local_user_id', $miLocal->id)
            ->where('planilla_turno_user.estado', 'Activo')
            ->join('turnos', 'turnos.id', '=', 'planilla_turno_user.turno_id')
            ->where('turnos.fecha', '>=', $hoy)
            ->orderBy('turnos.fecha', 'asc')
            ->orderBy('turnos.inicio', 'asc')
            ->get();

        foreach ($list_turnos as $turn){
            //funcion date('w') devuelve 0 (para domingo) hasta 6 (para sábado)
            $x = date('w',strtotime($turn->fecha));//Día
            $y = date('n',strtotime($turn->fecha));//Mes
            $turn->fecha = $dias[$x] .' '. date('d',strtotime($turn->fecha)) . ' de ' . $meses[$y];

            $turn->inicio = date('H:i',strtotime($turn->inicio));
            $turn->termino = date('H:i',strtotime($turn->termino));
        }

        //obtengo los empaques del local para mostrarlos en el list
        $empaques = DB::table('local_user')
            ->where('local_user.local_id', $id)
            ->where('local_user.estado', '!=', 'Desvinculado')
            ->orderBy('local_user.rol','desc')
            ->join('users', 'local_user.user_id', '=', 'users.id')
            ->select('local_user.id', 'users.nombre', 'users.apellido')
            ->get();

        //Fin Código para ceder

        //Código que estoy cediendo
        $list_cediendo = Planilla_Turno_User::
        select('planilla_turno_user.id', 'planilla_turno_user.tipo', 'planilla_turno_user.exDueno_id', 'users.nombre', 'users.apellido','turnos.fecha', 'turnos.inicio', 'turnos.termino')
            ->where('planilla_turno_user.local_user_id', $miLocal->id)
            ->where('planilla_turno_user.estado', 'Activo')
            ->where('planilla_turno_user.tipo', 'Cediendo')
            ->join('turnos', 'turnos.id', '=', 'planilla_turno_user.turno_id')
            ->where('turnos.fecha', '>=', $hoy)
            ->orderBy('turnos.fecha', 'asc')
            ->orderBy('turnos.inicio', 'asc')
            ->join('local_user', 'local_user.id', '=', 'planilla_turno_user.exDueno_id')
            ->join('users', 'users.id', '=', 'local_user.user_id')
            ->get();

        foreach ($list_cediendo as $turn){
            //funcion date('w') devuelve 0 (para domingo) hasta 6 (para sábado)
            $x = date('w',strtotime($turn->fecha));//Día
            $y = date('n',strtotime($turn->fecha));//Mes
            $turn->fecha = $dias[$x] .' '. date('d',strtotime($turn->fecha)) . ' de ' . $meses[$y];

            $turn->inicio = date('H:i',strtotime($turn->inicio));
            $turn->termino = date('H:i',strtotime($turn->termino));
        }
        //Fin Código que estoy cediendo

        //Turnos que me ofrecen
        $list_ofrecen = Planilla_Turno_User::
        select('planilla_turno_user.id', 'planilla_turno_user.tipo', 'planilla_turno_user.local_user_id', 'users.nombre', 'users.apellido','turnos.fecha', 'turnos.inicio', 'turnos.termino')
            ->where('planilla_turno_user.exDueno_id', $miLocal->id)
            ->where('planilla_turno_user.estado', 'Activo')
            ->where('planilla_turno_user.tipo', 'Cediendo')
            ->join('turnos', 'turnos.id', '=', 'planilla_turno_user.turno_id')
            ->where('turnos.fecha', '>=', $hoy)
            ->orderBy('turnos.fecha', 'asc')
            ->orderBy('turnos.inicio', 'asc')
            ->join('local_user', 'local_user.id', '=', 'planilla_turno_user.local_user_id')
            ->join('users', 'users.id', '=', 'local_user.user_id')
            ->get();

        foreach ($list_ofrecen as $turn){
            //funcion date('w') devuelve 0 (para domingo) hasta 6 (para sábado)
            $x = date('w',strtotime($turn->fecha));//Día
            $y = date('n',strtotime($turn->fecha));//Mes
            $turn->fecha = $dias[$x] .' '. date('d',strtotime($turn->fecha)) . ' de ' . $meses[$y];

            $turn->inicio = date('H:i',strtotime($turn->inicio));
            $turn->termino = date('H:i',strtotime($turn->termino));
        }
        //Fin turnos que me ofrecen


        return view('turno.ceder')
            ->with('list_turnos', $list_turnos)
            ->with('list_cediendo', $list_cediendo)
            ->with('list_ofrecen', $list_ofrecen)
            ->with('empaques', $empaques);
    }

    public function postCeder(Request $request){
        $fechaActual = date('Y-m-d H:i:s');

        $turnUser = Planilla_Turno_User::findOrFail($request->turno_id);

        //si no pertenezco al local me redirige al error
        $miLocal = Local_User::where('user_id', Auth::user()->id)
            ->where('local_id', $turnUser->Planilla->local_id)
            ->where('estado', '!=', 'Desvinculado')
            ->first();

        if(empty($miLocal)) {
            session()->flash('danger', "Usted no pertenece al local");
            return redirect()->action('HomeController@index');
        }elseif ($miLocal->Local->ceder == 'No'  || $miLocal->Local->cuenta == 'Free' || $miLocal->Local->estado == 'Bloqueado'){
            session()->flash('danger', "No es posible tomar este turno, tu local deber tener habilitado la opción ceder turnos, estar activo y ser premium");
            return redirect()->action('TurnoController@index');
        }elseif($turnUser->local_user_id == $request->local_user_id){
            session()->flash('danger', '¡No puedes Cederte un turno a ti mismo!');
            return redirect()->route('turno.ceder', ['id' => $turnUser->Local_User->local_id]);
        }elseif($turnUser->tipo == "Cediendo" || $turnUser->tipo == "Cambiando" || $turnUser->tipo == "Regalando"){
            session()->flash('danger', '¡No puedes ceder este turno porque ya lo estas cediendo, regalando o cambiando con otra persona!');
            return redirect()->route('turno.ceder', ['id' => $turnUser->Local_User->local_id]);
        }

        //No se pueda ceder si aún está la toma activa
        if(($turnUser->planilla->inicioToma <= $fechaActual && $turnUser->planilla->finToma >= $fechaActual) || ($turnUser->planilla->inicioPreToma <= $fechaActual && $turnUser->planilla->finPreToma >= $fechaActual)){
            session()->flash('danger', 'No puedes ceder este turno mientras la pre-toma o la toma de turnos esta activa');
            return redirect()->route('turno.ceder', ['id' => $turnUser->Local_User->local_id]);
        }

        if($turnUser->planilla->finToma >= $fechaActual){
            session()->flash('danger', 'Sólo puedes ceder turnos una vez que la toma de turno haya terminado');
            return redirect()->route('turno.ceder', ['id' => $turnUser->Local_User->local_id]);
        }


        //Validación de tope de horario, no se puede ceder si la otra persona tiene un turno que tope con el que se quiere ceder
        $turnoFecha = $turnUser->Turno->fecha;
        $turnoInicio = $turnUser->Turno->inicio;
        $turnoTermino = $turnUser->Turno->termino;

        //validar si tengo un turno con tope del regalo
        $tope = DB::table('planilla_turno_user')
            ->select('planilla_turno_user.*', 'turnos.inicio', 'turnos.termino')
            ->where('planilla_turno_user.local_user_id', $request->local_user_id)
            ->where('planilla_turno_user.estado', 'Activo')
            ->join('turnos', 'turnos.id', '=', 'planilla_turno_user.turno_id')
            ->where('turnos.fecha', '=', $turnoFecha)
            ->where(function ($query) use($turnoInicio, $turnoTermino) {
                $query->whereBetween('turnos.inicio', [$turnoInicio,$turnoTermino])
                    ->orWhere(function ($query2) use($turnoInicio, $turnoTermino) {
                        $query2->whereBetween('turnos.termino', [$turnoInicio,$turnoTermino]);
                    });

            })
            ->count();


        if($tope > 0){
            session()->flash('danger', 'No es posible ceder este turno, la otra persona tiene tope de hora');
            return redirect()->route('turno.ceder', ['id' => $miLocal->local_id]);
        }

        $turnUser->exTipo = $turnUser->tipo;
        $turnUser->tipo = "Cediendo";
        $turnUser->exDueno_id = $request->local_user_id;
        $turnUser->save();

        session()->flash('success', 'Estás cediendo el turno');
        return redirect()->route('turno.ceder', ['id' => $turnUser->Local_User->local_id]);
    }

    public function postCancelarCediendo(Request $request){
        $turnUser = Planilla_Turno_User::findOrFail($request->id);

        //si no pertenezco al local me redirige al error
        $miLocal = Local_User::where('user_id', Auth::user()->id)
            ->where('local_id', $turnUser->Planilla->local_id)
            ->where('estado', '!=', 'Desvinculado')
            ->first();

        if(empty($miLocal))
        {
            session()->flash('danger', "Usted no pertenece al local");
            return redirect()->action('HomeController@index');
        }

        $turnUser->tipo = $turnUser->exTipo;
        $turnUser->exTipo = null;
        $turnUser->exDueno_id = null;
        $turnUser->save();

        session()->flash('info', 'Rechazaste el turno que te estaban cediendo');
        return redirect()->route('turno.ceder', ['id' => $turnUser->Local_User->local_id]);
    }

    public function postAceptarCediendo(Request $request){
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');
        $fechaCompleta = date('Y-m-d H:i:s');
        $turnUser = Planilla_Turno_User::findOrFail($request->id);

        //si no pertenezco al local me redirige al error
        $miLocal = Local_User::where('user_id', Auth::user()->id)
            ->where('local_id', $turnUser->Planilla->local_id)
            ->where('estado', '!=', 'Desvinculado')
            ->first();

        if(empty($miLocal))
        {
            session()->flash('danger', "Usted no pertenece al local");
            return redirect()->action('HomeController@index');
        }elseif ($miLocal->Local->ceder == 'No'  || $miLocal->Local->cuenta == 'Free' || $miLocal->Local->estado == 'Bloqueado'){
            session()->flash('danger', "No es posible tomar este turno, tu local deber tener habilitado la opción ceder turnos, estar activo y ser premium");
            return redirect()->action('TurnoController@index');
        }elseif($miLocal->estado != 'Activo'){
            session()->flash('danger', "No es posible tomar este turno, usted se encuentra suspedido o mantiene una deuda pendiente");
            return redirect()->action('TurnoController@index');
        }elseif($miLocal->inicioCastigo <= $fechaCompleta && $miLocal->terminoCastigo >= $fechaCompleta) {
            session()->flash('danger', "Usted se encuentra castigado desde el ".$miLocal->inicioCastigo." al ".$miLocal->terminoCastigo);
            return redirect()->action('TurnoController@index');
        }

        //si el turno que se quiere tomar no existe o no se esta regalando se redirige a la pag error
        if($turnUser->tipo != 'Cediendo' || $turnUser->estado == 'Cancelado')
        {
            session()->flash('danger', 'El turno que quieres tomar no existe o ya no se está cediendo.');
            return redirect()->route('turno.ceder', ['id' => $turnUser->Local_User->local_id]);
        }

        if($turnUser->Turno->fecha == $fecha){
            if($turnUser->Turno->inicio <= $hora){
                session()->flash('danger', 'No lo puedes tomar porque ya comenzó o terminó el turno');
                return redirect()->route('turno.ceder', ['id' => $turnUser->Local_User->local_id]);
            }
        }





        //Validación de tope de horario
        $turnoFecha = $turnUser->Turno->fecha;
        $turnoInicio = $turnUser->Turno->inicio;
        $turnoTermino = $turnUser->Turno->termino;

        //validar si tengo un turno con tope del regalo
        $tope = DB::table('planilla_turno_user')
            ->select('planilla_turno_user.*', 'turnos.inicio', 'turnos.termino')
            ->where('planilla_turno_user.local_user_id', $miLocal->id)
            ->where('planilla_turno_user.estado', 'Activo')
            ->join('turnos', 'turnos.id', '=', 'planilla_turno_user.turno_id')
            ->where('turnos.fecha', '=', $turnoFecha)
            ->where(function ($query) use($turnoInicio, $turnoTermino) {
                $query->whereBetween('turnos.inicio', [$turnoInicio,$turnoTermino])
                    ->orWhere(function ($query2) use($turnoInicio, $turnoTermino) {
                        $query2->whereBetween('turnos.termino', [$turnoInicio,$turnoTermino]);
                    });

            })
            ->count();


        if($tope > 0){
            session()->flash('danger', 'No es posible tomar este turno, tienes tope de hora');
            return redirect()->route('turno.ceder', ['id' => $miLocal->local_id]);
        }


        $newTurn = new Planilla_Turno_User();
        $newTurn->fijo = "No";
        $newTurn->coordinador = $turnUser->coordinador;
        $newTurn->tipo = "Cedido";
        $newTurn->exTipo = null;
        $newTurn->estado = "Activo";
        $newTurn->planilla_id = $turnUser->planilla_id;
        $newTurn->turno_id = $turnUser->turno_id;
        $newTurn->local_user_id = $turnUser->exDueno_id;
        $newTurn->exDueno_id = null;
        $newTurn->save();


        $turnUser->estado = "Cancelado";
        $turnUser->save();

        session()->flash('success', 'Aceptaste el turno que te estaban cediendo');
        return redirect()->route('turno.ceder', ['id' => $turnUser->Local_User->local_id]);
    }

//FALTA VALIDAR QUE LA TOMA DE TURNOS NO SEA ANTES QUE LA PRE-TOMA, DEBERÍA IR EN ESTE ORDEN:
//PRE-TOMA, TOMA, REPECHAJE, REPECHAJE ORG.

//Quizas pueda reutilizar codigo en el json o el tipo de respuesta json
}
