<?php

namespace App\Http\Controllers;

use App\Pago;
use App\Planilla;
use Illuminate\Http\Request;
use Mail;

use Redirect;
use App\Http\Requests;
use App\Http\Requests\ContactoRequest;
use App\Http\Requests\SolicitarDemoRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\Local;
use App\Local_User;
use App\Turno;
use App\Planilla_Turno_User;
use App\Articulo;
use App\Imagen;
use App\Informativo;
use App\Cadena;


use Illuminate\Support\Facades\DB;
//use App\Http\Controllers\DB;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
    */

    /*
    public function index(){
        return view('home-externo');
    }
    */

    public function prueba(){

        //Quiero Saber cuantos locales tiene cada cadena

        //Solución 2
        /*
        $locales = Local::select('cadena_id')
            ->selectRaw('count(*) as totalLocales')
            ->groupBy('cadena_id')
            ->get();
           */

        //Solución 3
        /*
        $locales = Local::select('locales.cadena_id', 'cadenas.nombre')
            ->join('cadenas', 'cadenas.id', '=', 'locales.cadena_id')
            ->selectRaw('count(*) as totalLocales')
            ->groupBy('locales.cadena_id')
            ->get();
        */

        /*
        $turnos = Planilla_Turno_User::
            select('planilla_turno_user.id','planilla_turno_user.tipo','planilla_turno_user.exTipo','planilla_turno_user.local_user_id')
            ->where('planilla_turno_user.planilla_id', '2617')
            ->where('planilla_turno_user.estado', 'Activo')
            ->join('local_user', 'local_user.id', '=', 'planilla_turno_user.local_user_id')
            ->selectRaw('count(*) as totalTurnos')
            ->groupBy('planilla_turno_user.local_user_id')
            ->get();
        */
        /*

        $turnos = Planilla_Turno_User::
        select('local_user_id')
            ->where([['planilla_id', '2617'], ['estado', 'Activo']])
            ->selectRaw('count(*) as totalTurnos')
            ->selectRaw('count(*) as totalToma WHERE tipo="Toma"')
            ->groupBy('local_user_id')
            ->get();
        */

        /*
        $turnos = Planilla_Turno_User::select('planilla_turno_user.local_user_id as idLocalUser', 'users.nombre', 'users.apellido')
            ->where([['planilla_id', '2617'], ['planilla_turno_user.estado', 'Activo']])
            ->join('local_user', 'local_user.id', '=', 'planilla_turno_user.local_user_id')
            ->join('users', 'users.id', '=', 'local_user.user_id')
            ->selectRaw('count(*) as totalTurnos')
            ->selectRaw('count(case when (tipo = "Toma") or (tipo = "Regalando" and exTipo = "Toma") or (tipo = "Cediendo" and exTipo = "Toma") or (tipo = "Cambiando" and exTipo = "Toma") then 9 end) as totalToma')
            ->selectRaw('count(case when (tipo ="Repechaje") or (tipo = "Regalando" and exTipo = "Repechaje") or (tipo = "Cediendo" and exTipo = "Repechaje") or (tipo = "Cambiando" and exTipo = "Repechaje") then 1 end) as totalRepechaje')
            ->selectRaw('count(case when (tipo ="Asignado") or (tipo = "Regalando" and exTipo = "Asignado") or (tipo = "Cediendo" and exTipo = "Asignado") or (tipo = "Cambiando" and exTipo = "Asignado") then 1 end) as totalAsignado')
            ->selectRaw('count(case when (tipo ="Pre Toma") or (tipo = "Regalando" and exTipo = "Pre Toma") or (tipo = "Cediendo" and exTipo = "Pre Toma") or (tipo = "Cambiando" and exTipo = "Pre Toma") then 1 end) as totalPreToma')
            ->selectRaw('count(case when (tipo ="Cedido") or (tipo = "Regalando" and exTipo = "Cedido") or (tipo = "Cediendo" and exTipo = "Cedido") or (tipo = "Cambiando" and exTipo = "Cedido") then 1 end) as totalCedido')
            ->selectRaw('count(case when (tipo ="Cambio") or (tipo = "Regalando" and exTipo = "Cambio") or (tipo = "Cediendo" and exTipo = "Cambio") or (tipo = "Cambiando" and exTipo = "Cambio") then 1 end) as totalCambio')
            ->selectRaw('count(case when (tipo ="Regalo") or (tipo = "Regalando" and exTipo = "Regalo") or (tipo = "Cediendo" and exTipo = "Regalo") or (tipo = "Cambiando" and exTipo = "Regalo") then 1 end) as totalRegalo')
            ->groupBy('planilla_turno_user.local_user_id')
            ->get();
        */



        return view('home.prueba');
    }



    public function index()
    {


        $cantLocales = Local::where('estado', 'Activo')->count();


        $cantEmpaques = DB::table('local_user')
            ->where('local_user.estado', '!=','Desvinculado')
            ->join('locales', function ($join) {
                $join->on('local_user.local_id', '=', 'locales.id')
                    ->where('locales.estado', '=', 'Activo');
            })
            ->count();

        $cantRegistrados = User::where('estado', 'Confirmado')->count();
        $cantArticulos = Articulo::where('estado', 'Activo')->count();
        $cantImagenes = Imagen::where('estado', 'Activo')->count();

        $articulo = Articulo::where('estado', 'Activo')->orderBy('updated_at', 'desc')->first();
        //obtengo el último meme agregado
        $memeLast = Imagen::where('tipo', 'Meme')->where('estado', 'Activo')->orderBy('updated_at', 'desc')->first();
        //obtengo el Penultimo meme agregado
        $meme = Imagen::where('tipo', 'Meme')->where('estado', 'Activo')->orderBy('updated_at', 'desc')->skip(2)->take(2)->get();
        //dd($meme->last());
        $frase = Imagen::where('tipo', 'Frase')->where('estado', 'Activo')->orderBy('updated_at', 'desc')->first();
        $informativo = Informativo::where('tipo', 'Index')->where('estado', 'Público')->orderBy('updated_at', 'desc')->first();

        //En el caso de que no exista ningún artículo
        if($articulo == '')
        {
            $articulo = new Articulo();
            $articulo->link = "";
            $articulo->titulo = "Proximamente";
            $articulo->descripcion = "Proximamente";
            $articulo->portada = "proximamente2.jpg";
            $articulo->updated_at = date('Y-m-d H:i:s');
        }

        if($meme == '')
        {
            $meme = new Imagen();
            $meme->link = "";
            $meme->titulo = "Proximamente";
            $meme->descripcion = "Proximamente";
            $meme->imagen = "proximamente2.jpg";
            $meme->updated_at = date('Y-m-d H:i:s');
        }

        if($frase == '')
        {
            $frase = new Imagen();
            $frase->link = "";
            $frase->titulo = "Proximamente";
            $frase->descripcion = "Proximamente";
            $frase->imagen = "proximamente2.jpg";
            $frase->updated_at = date('Y-m-d H:i:s');
        }
        //Si no existe un informativo
        if($informativo == '')
        {
            $existe = 'No';
        }else{
            $existe = 'Si';
        }


        return view('home-nero')
            ->with('cantLocales', $cantLocales)
            ->with('cantEmpaques', $cantEmpaques)
            ->with('cantRegistrados', $cantRegistrados)
            ->with('cantArticulos', $cantArticulos)
            ->with('cantImagenes', $cantImagenes)
            ->with('articulo', $articulo)
            ->with('meme', $meme->last())
            ->with('frase', $frase)
            ->with('memeLast', $memeLast)
            ->with('informativo', $informativo)
            ->with('existe', $existe);
    }


    public function tarifas()
    {
        return view('home.tarifas');
    }

    public function contacto()
    {
        return view('home.contacto');
    }


    public function store(ContactoRequest $request)
    {
        //Falta validar Datos
        /**/
        Mail::send('home.contact',$request->all(), function($msj){
            $msj->subject('Correo de Contacto');
            $msj->to('contacto@proyectonero.cl');
        });

        session()->flash('success', 'Mensaje enviado correctamente');
        return Redirect::to('contacto');
    }

    public function solicitarDemo()
    {
        $cadenas = Cadena::orderby('nombre','ASC')->pluck('nombre','id');
        return view('home.solicitar-demo')
            ->with('cadenas', $cadenas);
    }

    public function postSolicitarDemo(SolicitarDemoRequest $request)
    {
        //VALIDAR RUT
        $rut = $request->rut;
        $rut = $this->getRut($rut);

        //si es 0 = rut inconrrecto, si devuelve el rut está correcto.
        /**/
        if($rut == 0)
        {
            session()->flash('danger', 'Rut Incorrecto.');
            return back()->withInput();
        }
        //*******     FIN VALIDACIÓN DEL RUT    *******

        //quitar caracteres al rut y agregar un guión antes del digito verificador
        $fil2   = strip_tags($request->rut);//Retira las etiquetas HTML y PHP de un string
        $result = preg_replace('([^A-Za-z0-9])', '', $fil2); //solo permite letras y numeros, elimina el resto
        $lon = strlen($result);//obtiene la longitud de la cadena
        //agrego el guion al rut
        $x = substr($result, 0, $lon-1)."-".substr($result, $lon-1 ,$lon);
        $request->rut = $x;


        $registrado = '';

        $user = User::where('rut', $request->rut)->orWhere('email', $request->email)->count();
        if($user == 0){


            $registrado = 'No pero lo hemos registrado automáticamente';
            //Auto registrar y enviar un email

            $createUser = new User();
            $createUser->rut = $request->rut;
            $createUser->nombre = $request->nombre;
            $createUser->apellido = $request->apellido;
            $createUser->email = $request->email;
            $createUser->rol = 'Usuario';
            $createUser->estado = 'Confirmado';
            $createUser->avatar = 'avatar.jpg';
            $createUser->ultimaConexion = date("Y-m-d H:i:s");
            //$password = '123456';
            $createUser->password = bcrypt('123456');
            $createUser->save();

            $emailUsuario = $request->email;
            //enviar un email del registro con el nombre de usuario y clave
            $infoUsuario = array(
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'email' => $request->email,
            );
            Mail::send('vendor.notifications.email-creacion-cuenta-automatica', $infoUsuario, function($msj) use($emailUsuario){
                $msj->to($emailUsuario)->subject('Te hemos creado una cuenta de usuario');
            });

        }else{
            $registrado = 'Si, revisa si el rut y el email pertenecen a la misma cuenta de usuario';
        }

        $cadena = Cadena::findOrFail($request->cadena_id);
        //dd($request->Cadena->nombre);
        //información extra
        $datos = array(
            'rut' => $request->rut,//rut - registrado - No Registrado
            'registrado' => $registrado,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'nombreLocal' => $request->nombreLocal,
            'cadena' => $cadena->nombre,
            'cantidad' => $request->cantidad,
            'cobro' => $request->cobro,
            'version' => $request->version,
            'encontraste' => $request->encontraste,
            'mensaje' => $request->mensaje,
        );

        Mail::send('vendor.notifications.email-solicitar-demo', $datos, function($msj) {
            $msj->to('contacto@proyectonero.cl')->subject('Solicitar Demo');
        });

        session()->flash('success', 'Solicitud Enviada Correctamente');
        return Redirect::to('solicitar-demo');
    }

    public function tutoriales()
    {
        return view('home.tutoriales');
    }

    public function alianzas()
    {
        return view('home.alianzas');
    }

    public function nosotros()
    {
        return view('home.sobre-nosotros');
    }

    public function toma()
    {
        return view('home.tomar-turnos-online');
    }

    public function propineros()
    {
        return view('home.propineros-supermercados');
    }

    public function supermercados()
    {
        return view('home.supermercados-chile');
    }

    public function error()
    {
        return view('errors.userNotFound');
    }


    public function getRut($rut)
    {

        //**********        Validar RUT            ****************

        $fil2   = strip_tags($rut);//Retira las etiquetas HTML y PHP de un string
        $result = preg_replace('([^A-Za-z0-9])', '', $fil2); //solo permite letras y numeros, elimina el resto
        $lon = strlen($result);//obtiene la longitud de la cadena

        $resultFinal=0;

        if ($lon == 9) {
            # code...
            //echo "El rut tiene 9 digitos";

            $dv  = substr($result, -1);
            $run = substr($result, 0, 8); // 146839010 comienza de la posicion cero a la posicion 8

            $pos2  = substr($result, 7,1)*2;
            $pos3  = substr($result, 6,1)*3;
            $pos4  = substr($result, 5,1)*4;
            $pos5  = substr($result, 4,1)*5;
            $pos6  = substr($result, 3,1)*6;
            $pos7  = substr($result, 2,1)*7;
            $pos8  = substr($result, 1,1)*2;
            $pos9  = substr($result, 0,1)*3;

            $sumaTotal= $pos2 + $pos3 + $pos4 + $pos5  + $pos6 + $pos7 + $pos8 + $pos9;
            //$res  =   number_format(($sumaTotal / 11), 0);//saco los decimales, el 0 indica que no quiero ningún decimal
            $res = (intval($sumaTotal / 11));
            $res2   =   $sumaTotal - 11 * $res;
            $res3   =   11 - $res2;

            if($res3 == 11)
            {
                $dv2 = 0;
                //echo "dv es 0";
            }elseif ($res3 == 10) {
                $dv2 = 'k';
                //echo "dv es k";
            }else{
                $dv2 = $res3;
                //echo "Cualquier numero";
            }

            /**/
            if ($dv == $dv2) {
                //echo "Rut Correcto!";
                $resultFinal=$result;
            }else{
                //echo "Rut Incorrecto!!";
                $resultFinal=0;
            }

        }elseif ($lon == 8) {
            # code...
            //echo "El rut tiene 8 digitos";
            $dv  = substr($result, -1);
            $run = substr($result, 0, 7); // 9.669.738 comienza de la posicion cero a la posicion 7
            $pos2  = substr($result, 6,1)*2; //16
            $pos3  = substr($result, 5,1)*3; //9
            $pos4  = substr($result, 4,1)*4; //28
            $pos5  = substr($result, 3,1)*5; //45
            $pos6  = substr($result, 2,1)*6; //36
            $pos7  = substr($result, 1,1)*7; //42
            $pos8  = substr($result, 0,1)*2; //18

            $sumaTotal= $pos2 + $pos3 + $pos4 + $pos5  + $pos6 + $pos7 + $pos8 ;
            $res = (intval($sumaTotal / 11));


            $res2   =   $sumaTotal - 11 * $res;
            $res3   =   11 - $res2;

            if ($res3 == 11) {
                $dv2 = 0;
                //echo "dv es 0";
            }elseif ($res3 == 10) {
                $dv2 = 'k';
                //echo "dv es k";
            }else{
                $dv2 = $res3;
                //echo "Cualquier numero";
            }

            /**/
            if ($dv == $dv2) {
                //echo "Rut Correcto!";
                $resultFinal=$result;
            }else{
                //echo "Rut Incorrecto!!";
                $resultFinal=0;
            }
        }else{
            $resultFinal=0;
        }



        if($resultFinal != 0)
        {
            //quitar caracteres al rut y agregar un guión antes del digito verificador
            $fil2   = strip_tags($rut);//Retira las etiquetas HTML y PHP de un string
            $result = preg_replace('([^A-Za-z0-9])', '', $fil2); //solo permite letras y numeros, elimina el resto
            //agrego el guion al rut
            $resultFinal = substr($result, 0, $lon-1)."-".substr($result, $lon-1 ,$lon);
        }


        $rut = $resultFinal;

        return $rut;
    }
}
