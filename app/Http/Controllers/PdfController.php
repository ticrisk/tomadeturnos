<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;   //Para ocupar y obtener el ID, username, etc una vez logeado el usuario.

use App\User;
use App\Planilla;
use App\Turno;
use App\Planilla_Turno_User;
use App\Local_User;
use App\Local;

class PdfController extends Controller
{
    public function __construct()
    {
        //Validación de usuario logeado - debe haber un usuario logeado para entrar
        $this->middleware('auth');
        //Validar que el usuario logeado es un tipo->administrador
        //tuvé que crear el middleware "Admin.php" y agregarlo en el kernel
        $this->middleware('admin', ['except' => ['invoice', 'invoice2','pdfCantTurnosTomados']]);
    }   

    //Imprimir Planilla del Local - Encargado
    public function invoice($id) 
    {
        $planilla = Planilla::where('id', $id)->where('estado', 'Activa')->first();

        if (empty($planilla)) {
            session()->flash('danger', 'La planilla no existe');
            return redirect()->action('HomeController@index');
        }

        //el usuario debe ser encargado, pertenecer al local, no estar desvinculado, si no redirecciona al index
        $locales = Local_User::where('user_id', Auth::user()->id)
                    ->where('estado', '!=', 'Desvinculado')
                    ->where('local_id', $planilla->local_id)
                    ->where('rol', 'Encargado')
                    ->first();

        if (empty($locales)) {
            session()->flash('danger', 'Usted no tiene privilegios suficientes.');
            return redirect()->action('HomeController@index');
        }elseif($locales->Local->cuenta == 'Free') {
            session()->flash('danger', 'Opción disponible para locales Premium');
            return redirect()->action('UsuarioController@opcionesPlanilla', ['id' => $id]);
        }elseif($planilla->Local->estado == 'Bloqueado'){
            session()->flash('danger', 'El local se encuentra temporalmente bloqueado.');
            return redirect()->route('usuario.mis-locales');
        }
        //FIN VALIDACIÓN

        /*
        //Obtengo la fecha exacta de cada día de la semana (excepto el lunes y el domingo porque estan registrados el inicio y fin de la planilla).
        $fec_mar = date('Y-m-d', strtotime ('+1 day' , strtotime($planilla->inicioPlanilla)));
        $fec_mie = date('Y-m-d', strtotime ('+2 day' , strtotime($planilla->inicioPlanilla)));
        $fec_jue = date('Y-m-d', strtotime ('+3 day' , strtotime($planilla->inicioPlanilla)));
        $fec_vie = date('Y-m-d', strtotime ('+4 day' , strtotime($planilla->inicioPlanilla)));
        $fec_sab = date('Y-m-d', strtotime ('+5 day' , strtotime($planilla->inicioPlanilla)));

        //Obtengo todos los turnos disponibles por día (ej: (1) 08:30 a 12:30 , etc...)
        $lun = Turno::where('planilla_id', $id)->where('fecha', $planilla->inicioPlanilla)->orderby('inicio', 'asc')->get();
        $mar = Turno::where('planilla_id', $id)->where('fecha', $fec_mar)->orderby('inicio', 'asc')->get();
        $mie = Turno::where('planilla_id', $id)->where('fecha', $fec_mie)->orderby('inicio', 'asc')->get();
        $jue = Turno::where('planilla_id', $id)->where('fecha', $fec_jue)->orderby('inicio', 'asc')->get();
        $vie = Turno::where('planilla_id', $id)->where('fecha', $fec_vie)->orderby('inicio', 'asc')->get();
        $sab = Turno::where('planilla_id', $id)->where('fecha', $fec_sab)->orderby('inicio', 'asc')->get();
        $dom = Turno::where('planilla_id', $id)->where('fecha', $planilla->finPlanilla)->orderby('inicio', 'asc')->get();

        //Obtengo todos los cupos tomados según la planilla.
        $turnosTomados = Planilla_Turno_User::where('planilla_id', $id)
                                        ->where('estado', 'Activo')
                                        ->get();
        */

        //colecciones por día
        $lunes = collect([]);
        $martes = collect([]);
        $miercoles = collect([]);
        $jueves = collect([]);
        $viernes = collect([]);
        $sabado = collect([]);
        $domingo = collect([]);

        //Obtengo todos los cupos tomados según la planilla. HACER UN SELECT!
        $turnosTomados = Planilla_Turno_User::select('planilla_turno_user.*', 'turnos.fecha', 'users.nombre', 'users.apellido')
            ->where([['planilla_turno_user.planilla_id', $id], ['planilla_turno_user.estado', 'Activo']])
            ->join('turnos', 'turnos.id', '=', 'planilla_turno_user.turno_id')
            ->join('local_user', 'local_user.id', '=', 'planilla_turno_user.local_user_id')
            ->join('users', 'users.id', '=', 'local_user.user_id')
            ->orderby('planilla_turno_user.id', 'asc')
            ->get();

        $turnos = Turno::select('turnos.*')
            ->where('planilla_id', $id)
            ->orderby('fecha', 'asc')
            ->orderby('inicio', 'asc')
            ->orderby('termino', 'asc')
            ->groupBy('id')
            ->get();

        //recorro el collect y agrego un atributo al collect con los empaques de ese turno
        $turnos->map(function($turno) use ($turnosTomados){

            $users = collect([]);
            foreach ($turnosTomados as $xxx){

                if ($xxx->turno_id == $turno->id ){

                    if($xxx->coordinador == 'Si'){
                        $users->push(['nombre'=> $xxx->nombre. ' ' . $xxx->apellido, 'rol' =>  'Coordinador']);
                    }else{
                        $users->push(['nombre'=> $xxx->nombre. ' ' . $xxx->apellido, 'rol' =>  'Empaque']);
                    }
                }
            }

            $turno->empaques = $users;
            $turno->inicio = date('H:i', strtotime($turno->inicio));
            $turno->termino = date('H:i', strtotime($turno->termino));
        });

        //Separo los turnos por días
        foreach ($turnos as $turno){
            if ($turno->fecha == $planilla->inicioPlanilla){
                $lunes[] = $turno;
            }elseif ($turno->fecha == date('Y-m-d', strtotime ('+1 day' , strtotime($planilla->inicioPlanilla)))){
                $martes[] = $turno;
            }elseif ($turno->fecha == date('Y-m-d', strtotime ('+2 day' , strtotime($planilla->inicioPlanilla)))){
                $miercoles[] = $turno;
            }elseif ($turno->fecha == date('Y-m-d', strtotime ('+3 day' , strtotime($planilla->inicioPlanilla)))){
                $jueves[] = $turno;
            }elseif ($turno->fecha == date('Y-m-d', strtotime ('+4 day' , strtotime($planilla->inicioPlanilla)))){
                $viernes[] = $turno;
            }elseif ($turno->fecha == date('Y-m-d', strtotime ('+5 day' , strtotime($planilla->inicioPlanilla)))){
                $sabado[] = $turno;
            }elseif ($turno->fecha == date('Y-m-d', strtotime ('+6 day' , strtotime($planilla->inicioPlanilla)))){
                $domingo[] = $turno;
            }
        }


        $meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $dia_inicio = date('d', strtotime($planilla->inicioPlanilla));
        $dia_termino = date('d', strtotime($planilla->finPlanilla));
        $x_mes = date('n', strtotime($planilla->finPlanilla));
        $mes = $meses[$x_mes];
        $anio = date('Y', strtotime($planilla->finPlanilla));                               

        $view =  \View::make('pdf.invoice', compact('lunes','martes','miercoles','jueves','viernes','sabado','domingo', 'planilla'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download($dia_inicio.' al '.$dia_termino.' de '.$mes.' - '.$anio.' - '.$planilla->Local->nombre.' - '.$planilla->Local->Cadena->nombre.'.pdf');
    }
 

    public function invoice2($id) 
    {
        //falta validar que es el encargado que imprima esto.
        $planilla = Planilla::findOrFail($id);

        //el usuario debe  pertenecer al local, no estar desvinculado, si no redirecciona al index
        $locales = Local_User::where('user_id', Auth::user()->id)
                    ->where('estado', '!=', 'Desvinculado')
                    ->where('local_id', $planilla->local_id)
                    //->where('rol', '!=','Empaque')
                    ->first();

        if (empty($locales)) {
            session()->flash('danger', 'Usted no puede ver las planillas de este local');
            return redirect()->action('UsuarioController@misLocales');
        }elseif($locales->Local->estado == 'Bloqueado'){
            session()->flash('danger', 'El local se encuentra temporalmente bloqueado.');
            return redirect()->action('UsuarioController@misLocales');
        }elseif($locales->Local->cuenta == 'Free'){
            session()->flash('danger', 'Opción disponible para locales premium');
            return redirect()->action('UsuarioController@misLocales');
        }elseif($locales->Local->planillaEmpaque == 'No' && $locales->rol == 'Empaque'){
            session()->flash('danger', 'Opción no disponible para los empaques');
            return redirect()->action('UsuarioController@misLocales');
        }elseif($locales->Local->planillaCoordinador == 'No' && $locales->rol == 'Coordinador'){
            session()->flash('danger', 'Opción no disponible para los coordinadores');
            return redirect()->action('UsuarioController@misLocales');
        }

        //Solo puede ver la planilla una vez terminada la toma y si la planilla está activa
        if($planilla->estado != 'Activa') {
            session()->flash('danger', 'La planilla no existe');
            return redirect()->action('HomeController@index');
        }elseif($planilla->finToma > date('Y-m-d H:i:s')) {
            session()->flash('danger', 'Puede ver la planilla una vez terminada la Toma de Turnos.');
            return redirect()->route('usuario.local.listado-planillas', ['id' => $planilla->local_id]);
        }
        /*
        //Obtengo la fecha exacta de cada día de la semana (excepto el lunes y el domingo porque estan registrados el inicio y fin de la planilla).
        $fec_mar = date('Y-m-d', strtotime ('+1 day' , strtotime($planilla->inicioPlanilla)));
        $fec_mie = date('Y-m-d', strtotime ('+2 day' , strtotime($planilla->inicioPlanilla)));
        $fec_jue = date('Y-m-d', strtotime ('+3 day' , strtotime($planilla->inicioPlanilla)));
        $fec_vie = date('Y-m-d', strtotime ('+4 day' , strtotime($planilla->inicioPlanilla)));
        $fec_sab = date('Y-m-d', strtotime ('+5 day' , strtotime($planilla->inicioPlanilla)));

        //Obtengo todos los turnos disponibles por día (ej: (1) 08:30 a 12:30 , etc...)
        $lun = Turno::where('planilla_id', $id)->where('fecha', $planilla->inicioPlanilla)->orderby('inicio', 'asc')->get();
        $mar = Turno::where('planilla_id', $id)->where('fecha', $fec_mar)->orderby('inicio', 'asc')->get();
        $mie = Turno::where('planilla_id', $id)->where('fecha', $fec_mie)->orderby('inicio', 'asc')->get();
        $jue = Turno::where('planilla_id', $id)->where('fecha', $fec_jue)->orderby('inicio', 'asc')->get();
        $vie = Turno::where('planilla_id', $id)->where('fecha', $fec_vie)->orderby('inicio', 'asc')->get();
        $sab = Turno::where('planilla_id', $id)->where('fecha', $fec_sab)->orderby('inicio', 'asc')->get();
        $dom = Turno::where('planilla_id', $id)->where('fecha', $planilla->finPlanilla)->orderby('inicio', 'asc')->get();

        //Obtengo todos los cupos tomados según la planilla.
        $turnosTomados = Planilla_Turno_User::where('planilla_id', $id)
                                        ->where('estado', 'Activo')
                                        ->get();
        */

        //colecciones por día
        $lunes = collect([]);
        $martes = collect([]);
        $miercoles = collect([]);
        $jueves = collect([]);
        $viernes = collect([]);
        $sabado = collect([]);
        $domingo = collect([]);

        //Obtengo todos los cupos tomados según la planilla. HACER UN SELECT!
        $turnosTomados = Planilla_Turno_User::select('planilla_turno_user.*', 'turnos.fecha', 'users.nombre', 'users.apellido')
            ->where([['planilla_turno_user.planilla_id', $id], ['planilla_turno_user.estado', 'Activo']])
            ->join('turnos', 'turnos.id', '=', 'planilla_turno_user.turno_id')
            ->join('local_user', 'local_user.id', '=', 'planilla_turno_user.local_user_id')
            ->join('users', 'users.id', '=', 'local_user.user_id')
            ->orderby('planilla_turno_user.id', 'asc')
            ->get();

        $turnos = Turno::select('turnos.*')
            ->where('planilla_id', $id)
            ->orderby('fecha', 'asc')
            ->orderby('inicio', 'asc')
            ->orderby('termino', 'asc')
            ->groupBy('id')
            ->get();

        //recorro el collect y agrego un atributo al collect con los empaques de ese turno
        $turnos->map(function($turno) use ($turnosTomados){

            $users = collect([]);
            foreach ($turnosTomados as $xxx){

                if ($xxx->turno_id == $turno->id ){

                    if($xxx->coordinador == 'Si'){
                        $users->push(['nombre'=> $xxx->nombre. ' ' . $xxx->apellido, 'rol' =>  'Coordinador']);
                    }else{
                        $users->push(['nombre'=> $xxx->nombre. ' ' . $xxx->apellido, 'rol' =>  'Empaque']);
                    }
                }
            }

            $turno->empaques = $users;
            $turno->inicio = date('H:i', strtotime($turno->inicio));
            $turno->termino = date('H:i', strtotime($turno->termino));
        });

        //Separo los turnos por días
        foreach ($turnos as $turno){
            if ($turno->fecha == $planilla->inicioPlanilla){
                $lunes[] = $turno;
            }elseif ($turno->fecha == date('Y-m-d', strtotime ('+1 day' , strtotime($planilla->inicioPlanilla)))){
                $martes[] = $turno;
            }elseif ($turno->fecha == date('Y-m-d', strtotime ('+2 day' , strtotime($planilla->inicioPlanilla)))){
                $miercoles[] = $turno;
            }elseif ($turno->fecha == date('Y-m-d', strtotime ('+3 day' , strtotime($planilla->inicioPlanilla)))){
                $jueves[] = $turno;
            }elseif ($turno->fecha == date('Y-m-d', strtotime ('+4 day' , strtotime($planilla->inicioPlanilla)))){
                $viernes[] = $turno;
            }elseif ($turno->fecha == date('Y-m-d', strtotime ('+5 day' , strtotime($planilla->inicioPlanilla)))){
                $sabado[] = $turno;
            }elseif ($turno->fecha == date('Y-m-d', strtotime ('+6 day' , strtotime($planilla->inicioPlanilla)))){
                $domingo[] = $turno;
            }
        }

        $meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $dia_inicio = date('d', strtotime($planilla->inicioPlanilla));
        $dia_termino = date('d', strtotime($planilla->finPlanilla));
        $x_mes = date('n', strtotime($planilla->finPlanilla));
        $mes = $meses[$x_mes];
        $anio = date('Y', strtotime($planilla->finPlanilla));                               

        $view =  \View::make('pdf.invoice', compact('lunes','martes','miercoles','jueves','viernes','sabado','domingo', 'planilla'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download($dia_inicio.' al '.$dia_termino.' de '.$mes.' - '.$anio.' - '.$planilla->Local->nombre.' - '.$planilla->Local->Cadena->nombre.'.pdf');
    }

     public function imprimir($id) 
    {
        //falta validar que es el encargado que imprima esto.
        $planilla = Planilla::find($id);

        if(empty($planilla))
        { 
            return view('errors.userNotFound');
        }

        //el usuario debe ser encargado, pertenecer al local, no estar desvinculado, si no redirecciona al index
        $locales = User::where('id', Auth::user()->id)
                    //->where('estado', '!=', 'Desvinculado')
                    //->where('local_id', $planilla->local_id)
                    ->where('rol', 'Admin')
                    ->first();

        if (empty($locales)) {
            session()->flash('danger', 'Usted no tiene privilegios suficientes.');
            return redirect()->action('HomeController@index');
        }
        //FIN VALIDACIÓN

        /*
        //Obtengo la fecha exacta de cada día de la semana (excepto el lunes y el domingo porque estan registrados el inicio y fin de la planilla).
        $fec_mar = date('Y-m-d', strtotime ('+1 day' , strtotime($planilla->inicioPlanilla)));
        $fec_mie = date('Y-m-d', strtotime ('+2 day' , strtotime($planilla->inicioPlanilla)));
        $fec_jue = date('Y-m-d', strtotime ('+3 day' , strtotime($planilla->inicioPlanilla)));
        $fec_vie = date('Y-m-d', strtotime ('+4 day' , strtotime($planilla->inicioPlanilla)));
        $fec_sab = date('Y-m-d', strtotime ('+5 day' , strtotime($planilla->inicioPlanilla)));

        //Obtengo todos los turnos disponibles por día (ej: (1) 08:30 a 12:30 , etc...)
        $lun = Turno::where('planilla_id', $id)->where('fecha', $planilla->inicioPlanilla)->orderby('inicio', 'asc')->get();
        $mar = Turno::where('planilla_id', $id)->where('fecha', $fec_mar)->orderby('inicio', 'asc')->get();
        $mie = Turno::where('planilla_id', $id)->where('fecha', $fec_mie)->orderby('inicio', 'asc')->get();
        $jue = Turno::where('planilla_id', $id)->where('fecha', $fec_jue)->orderby('inicio', 'asc')->get();
        $vie = Turno::where('planilla_id', $id)->where('fecha', $fec_vie)->orderby('inicio', 'asc')->get();
        $sab = Turno::where('planilla_id', $id)->where('fecha', $fec_sab)->orderby('inicio', 'asc')->get();
        $dom = Turno::where('planilla_id', $id)->where('fecha', $planilla->finPlanilla)->orderby('inicio', 'asc')->get();

        //Obtengo todos los cupos tomados según la planilla.
        $turnosTomados = Planilla_Turno_User::where('planilla_id', $id)
                                        ->where('estado', 'Activo')
                                        ->get();
        */

        //colecciones por día
        $lunes = collect([]);
        $martes = collect([]);
        $miercoles = collect([]);
        $jueves = collect([]);
        $viernes = collect([]);
        $sabado = collect([]);
        $domingo = collect([]);

        //Obtengo todos los cupos tomados según la planilla. HACER UN SELECT!
        $turnosTomados = Planilla_Turno_User::select('planilla_turno_user.*', 'turnos.fecha', 'users.nombre', 'users.apellido')
            ->where([['planilla_turno_user.planilla_id', $id], ['planilla_turno_user.estado', 'Activo']])
            ->join('turnos', 'turnos.id', '=', 'planilla_turno_user.turno_id')
            ->join('local_user', 'local_user.id', '=', 'planilla_turno_user.local_user_id')
            ->join('users', 'users.id', '=', 'local_user.user_id')
            ->orderby('planilla_turno_user.id', 'asc')
            ->get();

        $turnos = Turno::select('turnos.*')
            ->where('planilla_id', $id)
            ->orderby('fecha', 'asc')
            ->orderby('inicio', 'asc')
            ->orderby('termino', 'asc')
            ->groupBy('id')
            ->get();

        //recorro el collect y agrego un atributo al collect con los empaques de ese turno
        $turnos->map(function($turno) use ($turnosTomados){

            $users = collect([]);
            foreach ($turnosTomados as $xxx){

                if ($xxx->turno_id == $turno->id ){

                    if($xxx->coordinador == 'Si'){
                        $users->push(['nombre'=> $xxx->nombre. ' ' . $xxx->apellido, 'rol' =>  'Coordinador']);
                    }else{
                        $users->push(['nombre'=> $xxx->nombre. ' ' . $xxx->apellido, 'rol' =>  'Empaque']);
                    }
                }
            }

            $turno->empaques = $users;
            $turno->inicio = date('H:i', strtotime($turno->inicio));
            $turno->termino = date('H:i', strtotime($turno->termino));
        });

        //Separo los turnos por días
        foreach ($turnos as $turno){
            if ($turno->fecha == $planilla->inicioPlanilla){
                $lunes[] = $turno;
            }elseif ($turno->fecha == date('Y-m-d', strtotime ('+1 day' , strtotime($planilla->inicioPlanilla)))){
                $martes[] = $turno;
            }elseif ($turno->fecha == date('Y-m-d', strtotime ('+2 day' , strtotime($planilla->inicioPlanilla)))){
                $miercoles[] = $turno;
            }elseif ($turno->fecha == date('Y-m-d', strtotime ('+3 day' , strtotime($planilla->inicioPlanilla)))){
                $jueves[] = $turno;
            }elseif ($turno->fecha == date('Y-m-d', strtotime ('+4 day' , strtotime($planilla->inicioPlanilla)))){
                $viernes[] = $turno;
            }elseif ($turno->fecha == date('Y-m-d', strtotime ('+5 day' , strtotime($planilla->inicioPlanilla)))){
                $sabado[] = $turno;
            }elseif ($turno->fecha == date('Y-m-d', strtotime ('+6 day' , strtotime($planilla->inicioPlanilla)))){
                $domingo[] = $turno;
            }
        }

        $meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $dia_inicio = date('d', strtotime($planilla->inicioPlanilla));
        $dia_termino = date('d', strtotime($planilla->finPlanilla));
        $x_mes = date('n', strtotime($planilla->finPlanilla));
        $mes = $meses[$x_mes];
        $anio = date('Y', strtotime($planilla->finPlanilla));                               

        $view =  \View::make('pdf.invoice', compact('lunes','martes','miercoles','jueves','viernes','sabado','domingo', 'planilla'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download($dia_inicio.' al '.$dia_termino.' de '.$mes.' - '.$anio.' - '.$planilla->Local->nombre.' - '.$planilla->Local->Cadena->nombre.'.pdf');
    }


    public function pdfCantTurnosTomados($id) 
    {
        $planilla = Planilla::where('id', $id)->where('estado', 'Activa')->first();

        if (empty($planilla)) {
            session()->flash('danger', 'La planilla no existe');
            return redirect()->action('HomeController@index');
        }

        //el usuario debe ser encargado, pertenecer al local, no estar desvinculado, si no redirecciona al index
        $locales = Local_User::where('user_id', Auth::user()->id)
                    ->where('estado', '!=', 'Desvinculado')
                    ->where('local_id', $planilla->local_id)
                    ->where('rol', 'Encargado')
                    ->first();
        //dd($locales);
        if (empty($locales)) {
            session()->flash('danger', 'Usted no tiene privilegios suficientes.');
            return redirect()->action('HomeController@index');
        }

        //Esta opción es solo para locales premmiums
        if($locales->Local->cuenta == 'Free'){
            session()->flash('danger', 'Opción disponibles solo para locales Premium.');
            return redirect()->route('usuario.planilla.opciones', ['id' => $id]);
        }

        //Esta opción es para locales Activos, no para bloqueados
        if($locales->Local->estado == 'Bloqueado'){
            session()->flash('danger', 'El local se encuentra temporalmente bloqueado.');
            return redirect()->route('usuario.mis-locales');
        }
        //Fin Validación

        /*
        $usuarios = Local_User::where('local_id', $planilla->local_id)
                        ->where('estado', '!=', 'Desvinculado')
                        ->orderBy('rol', 'desc')
                        ->get();

        foreach ($usuarios as $usuario) 
        {
            $turnos = Planilla_Turno_User::where('planilla_id', $id)->where('local_user_id', $usuario->id)->where('estado', 'Activo')->count();
            $usuario->cantTurnos = $turnos;
        }
        */

        $usuarios = Planilla_Turno_User::select('planilla_turno_user.local_user_id', 'users.nombre', 'users.apellido')
            ->where([['planilla_id', $id], ['planilla_turno_user.estado', 'Activo']])
            ->join('local_user', 'local_user.id', '=', 'planilla_turno_user.local_user_id')
            ->join('users', 'users.id', '=', 'local_user.user_id')
            ->selectRaw('count(*) as cantTurnos')
            ->groupBy('planilla_turno_user.local_user_id')
            ->get();

        $meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $dia_inicio = date('d', strtotime($planilla->inicioPlanilla));
        $dia_termino = date('d', strtotime($planilla->finPlanilla));
        $x_mes = date('n', strtotime($planilla->finPlanilla));
        $mes = $meses[$x_mes];
        $anio = date('Y', strtotime($planilla->finPlanilla));    
        //dd($usuarios);
        //$date = date('Y-m-d');
        //$invoice = "2222";
        $view =  \View::make('pdf.cant-turnos-tomados', compact('usuarios', 'planilla'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //return $pdf->stream($dia_inicio.' al '.$dia_termino.' de '.$mes.' - '.$anio);//nombre del archivo
        //return $pdf->download('invoice');
        return $pdf->download('cant turnos tomados '.$dia_inicio.' al '.$dia_termino.' de '.$mes.' - '.$anio.' - '.$planilla->Local->nombre.' - '.$planilla->Local->Cadena->nombre.'.pdf');
    }

    public function pdfCantTurnosTomadosAdmin($id) 
    {
        //imprimir-cant-turnos-tomados
        //falta validar que es el encargado que imprima esto.
        $planilla = Planilla::find($id);

        if(empty($planilla))
        { 
            return view('errors.userNotFound');
        }

        //el usuario debe ser encargado, pertenecer al local, no estar desvinculado, si no redirecciona al index
        $locales = User::where('id', Auth::user()->id)
                    //->where('estado', '!=', 'Desvinculado')
                    //->where('local_id', $planilla->local_id)
                    ->where('rol', 'Admin')
                    ->first();

        if (empty($locales)) {
            session()->flash('danger', 'Usted no tiene privilegios suficientes.');
            return redirect()->action('HomeController@index');
        }
        //FIN VALIDACIÓN   
        
        /*
        $usuarios = Local_User::where('local_id', $planilla->local_id)
            ->where('estado', '!=', 'Desvinculado')
            ->orderBy('rol', 'desc')
            ->get();

        foreach ($usuarios as $usuario) 
        {
            
            $turnos = Planilla_Turno_User::where('planilla_id', $id)->where('local_user_id', $usuario->id)->where('estado', 'Activo')->count();
            $usuario->cantTurnos = $turnos;
        }
        */

        $usuarios = Planilla_Turno_User::select('planilla_turno_user.local_user_id', 'users.nombre', 'users.apellido')
            ->where([['planilla_id', $id], ['planilla_turno_user.estado', 'Activo']])
            ->join('local_user', 'local_user.id', '=', 'planilla_turno_user.local_user_id')
            ->join('users', 'users.id', '=', 'local_user.user_id')
            ->selectRaw('count(*) as cantTurnos')
            ->groupBy('planilla_turno_user.local_user_id')
            ->get();

        $meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $dia_inicio = date('d', strtotime($planilla->inicioPlanilla));
        $dia_termino = date('d', strtotime($planilla->finPlanilla));
        $x_mes = date('n', strtotime($planilla->finPlanilla));
        $mes = $meses[$x_mes];
        $anio = date('Y', strtotime($planilla->finPlanilla));    
        //dd($usuarios);
        //$date = date('Y-m-d');
        //$invoice = "2222";
        $view =  \View::make('pdf.cant-turnos-tomados', compact('usuarios', 'planilla'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //return $pdf->stream($dia_inicio.' al '.$dia_termino.' de '.$mes.' - '.$anio);//nombre del archivo
        //return $pdf->download('invoice');
        return $pdf->download('cant turnos tomados '.$dia_inicio.' al '.$dia_termino.' de '.$mes.' - '.$anio.' - '.$planilla->Local->nombre.' - '.$planilla->Local->Cadena->nombre.'.pdf');
    }

    //Usuario
    public function pdfCantTurnosTomadosFecha(Requests\CantTurnosTomadosFechaRequest $request)
    {

        //el usuario debe ser encargado, pertenecer al local, no estar desvinculado, si no redirecciona al index
        $local = Local_User::where('user_id', Auth::user()->id)
            ->where('estado', '!=', 'Desvinculado')
            ->where('local_id', $request->id)
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

        $usuarios = Local_User::select('local_user.id as id', 'local_user.rol', 'users.nombre', 'users.apellido')
            ->where('local_user.local_id', $request->id)
            ->where('local_user.estado', '!=', 'Desvinculado')
            ->join('users', 'users.id', '=', 'local_user.user_id')
            ->get();

        //Meto los id de los usuarios para proceder hacer la consulta en la query $turnos (WhereIn)
        $ids = array();
        foreach ($usuarios as $usuario){
            $ids[] = array(
                'id' => $usuario->id
            );
        }

        $firstDay='';
        $lastDay='';
        if($request->desde == null || $request->hasta == null){

            //Obtengo el primer día del mes
            $firstDay = date('Y-m-d', mktime(0,0,0, date('m'), 1, date('Y')));
            //Obtengo el ultimo día del mes/año CORRECTO ingresado por el usuario
            $lastDay = date("Y-m-d", mktime(0,0,0, date('m') +1, 0, date('Y')));
            //dd('ok');
        }else {
            $firstDay = $request->desde;
            $lastDay = $request->hasta;
        }
        $turnos = Planilla_Turno_User::
        whereIn('planilla_turno_user.local_user_id', $ids)
            ->join('turnos', 'turnos.id', '=', 'planilla_turno_user.turno_id')
            ->where('turnos.fecha', '>=', $firstDay)
            ->where('turnos.fecha', '<=', $lastDay)
            ->get();


        foreach ($usuarios as $usuario) {
            $asignar = 0;
            $toma = 0;
            $repechaje = 0;
            $pretoma = 0;
            $regalo = 0;
            $cambio = 0;
            $cedido = 0;

            foreach ($turnos as $turno) {
                if($usuario->id == $turno->local_user_id)
                {
                    if (($turno->tipo == "Toma")  || ($turno->tipo == "Regalando" && $turno->exTipo == "Toma") || ($turno->tipo == "Cediendo" && $turno->exTipo == "Toma") || ($turno->tipo == "Cambiando" && $turno->exTipo == "Toma")) {
                        $toma++;
                    }elseif (($turno->tipo == "Asignado") || ($turno->tipo == "Regalando" && $turno->exTipo == "Asignado") || ($turno->tipo == "Cediendo" && $turno->exTipo == "Asignado") || ($turno->tipo == "Cambiando" && $turno->exTipo == "Asignado")) {
                        $asignar++;
                    }elseif (($turno->tipo == "Repechaje") || ($turno->tipo == "Regalando" && $turno->exTipo == "Repechaje") || ($turno->tipo == "Cediendo" && $turno->exTipo == "Repechaje") || ($turno->tipo == "Cambiando" && $turno->exTipo == "Repechaje")) {
                        $repechaje++;
                    }elseif (($turno->tipo == "Pre Toma") || ($turno->tipo == "Regalando" && $turno->exTipo == "Pre Toma") || ($turno->tipo == "Cediendo" && $turno->exTipo == "Pre Toma") || ($turno->tipo == "Cambiando" && $turno->exTipo == "Pre Toma")) {
                        $pretoma++;
                    }elseif (($turno->tipo == "Cambio") || ($turno->tipo == "Regalando" && $turno->exTipo == "Cambio") || ($turno->tipo == "Cediendo" && $turno->exTipo == "Cambio") || ($turno->tipo == "Cambiando" && $turno->exTipo == "Cambio")) {
                        $cambio++;
                    }elseif (($turno->tipo == "Regalo") || ($turno->tipo == "Regalando" && $turno->exTipo == "Regalo") || ($turno->tipo == "Cediendo" && $turno->exTipo == "Regalo") || ($turno->tipo == "Cambiando" && $turno->exTipo == "Regalo")) {
                        $regalo++;
                    }elseif (($turno->tipo == "Cedido")  || ($turno->tipo == "Regalando" && $turno->exTipo == "Cedido")  || ($turno->tipo == "Cediendo" && $turno->exTipo == "Cedido") || ($turno->tipo == "Cambiando" && $turno->exTipo == "Cedido")) {
                        $cedido++;
                    }
                }
            }
            $usuario->asignar = $asignar;
            $usuario->toma = $toma;
            $usuario->repechaje = $repechaje;
            $usuario->pretoma = $pretoma;
            $usuario->regalo = $regalo;
            $usuario->cambio = $cambio;
            $usuario->cedido = $cedido;
            $usuario->cantTurnos = $asignar + $toma + $repechaje + $pretoma + $regalo + $cambio + $cedido;
        }

        $local = $local->Local->nombre . '-'. $local->Local->Cadena->nombre;
        //dd($local);
        $view =  \View::make('pdf.cant-turnos-tomados-fecha', compact('usuarios', 'firstDay', 'lastDay', 'local'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper('a4', 'landscape');

        return $pdf->download('cant-turnos-tomados-'.$request->desde.'-al-'.$request->hasta.'-'.$local.'.pdf');
    }

}
