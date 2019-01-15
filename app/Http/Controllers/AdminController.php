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
use Mail;


use App\Http\Requests\LocalRequest;
use App\Http\Requests\Local_UserRequest;
use App\Http\Requests\PlanillaRequest;
use App\Http\Requests\AgregarTurnoRequest;
use App\Http\Requests\CrearPlanillaRequest;
use App\Http\Requests\TurnoRequest;
use App\Http\Requests\PostulacionRequest;
use App\Http\Requests\CuposCantRequest;
use App\Http\Requests\AgregarPagoRequest;
use App\Http\Requests\BuscarTurnosUsuarioRequest;


use App\User;
use App\Region;
use App\Comuna;
use App\Universidad;
use App\Carrera;
use App\Cadena;
use App\Organizacion;
use App\Local;
use App\Local_User;
use App\Planilla;
use App\Turno;
use App\Planilla_Turno_User;
use App\Postulacion_User;
use App\Postulacion;
use App\Pago;


class AdminController extends Controller
{
    public function __construct()
    {
        //Validación de usuario logeado - debe haber un usuario logeado para entrar
        $this->middleware('auth');
        //Validar que el usuario logeado es un tipo->administrador
        //tuvé que crear el middleware "Admin.php" y agregarlo en el kernel
        $this->middleware('admin');
    }   


//***************** INICIO LOCAL **************************************  


    public function mostrarLocales(Request $request)
    {
        /*
        $local = Local::paginate(10);
        foreach ($local as $loc){
            $loc->cantEmpaques = Local_User::where('local_id', $loc->id)->where('estado', '!=', 'Desvinculado')->count();
        }
        return view('admin.local.listado')
            ->with('local', $local);
        */
        if($request->ajax()){



            if(!$request->nombre){

                //debo obtener un panel que me diga la cantidad de los locales premium, free, usuarios premium, usuarios free, empaques total
                //locales bloqueados, etc.
                $cantLocalPremium = 0;
                $cantLocalFree = 0;
                $cantLocalActivos = 0;
                $cantLocalBloqueados = 0;
                $cantUserPremium = 0;
                $cantUserFree = 0;
                $cantUserTotal = 0;

                $locales = Local_User::select('locales.id', 'cadenas.nombre as nombreCadena', 'locales.nombre', 'locales.cuenta', 'locales.estado', 'locales.visible', 'locales.responsablePago', 'locales.precioMensual')
                    ->where('local_user.estado', '!=', 'Desvinculado')
                    ->join('locales', 'locales.id', '=', 'local_user.local_id')
                    ->join('cadenas', 'cadenas.id', '=', 'locales.cadena_id')
                    ->selectRaw('count(*) as cantEmpaques')
                    ->groupby('local_user.local_id')
                    ->get();
                //->paginate(10);
                foreach ($locales as $local){

                    $local->precioMensual = "$".number_format($local->precioMensual,0, '', '.');
                    //$cantUserTotal = $cantUserTotal + $local->cantEmpaques;

                    if($local->estado == 'Bloqueado'){
                        $cantLocalBloqueados++;
                    }elseif($local->cuenta == 'Premium'){
                        $cantLocalPremium++;
                        $cantLocalActivos++;
                        $cantUserPremium = $cantUserPremium + $local->cantEmpaques;
                        $cantUserTotal = $cantUserTotal + $local->cantEmpaques;
                    }elseif($local->cuenta == 'Free'){
                        $cantLocalFree++;
                        $cantLocalActivos++;
                        $cantUserFree = $cantUserFree + $local->cantEmpaques;
                        $cantUserTotal = $cantUserTotal + $local->cantEmpaques;
                    }
                }
                $cantLocalRegistrados = $locales->count();


                return response()->json([
                    'locales' => $locales->take(10),
                    'cantLocalRegistrados' => $cantLocalRegistrados,
                    'cantLocalActivos' => $cantLocalActivos,
                    'cantLocalBloqueados' => $cantLocalBloqueados,
                    'cantLocalPremium' => $cantLocalPremium,
                    'cantLocalFree' => $cantLocalFree,
                    'cantUserTotal' => $cantUserTotal,
                    'cantUserPremium' => $cantUserPremium,
                    'cantUserFree' => $cantUserFree,
                ], 200);

            }else{

                $locales = Local_User::select('locales.id', 'cadenas.nombre as nombreCadena', 'locales.nombre', 'locales.cuenta', 'locales.estado', 'locales.visible', 'locales.responsablePago', 'locales.precioMensual')
                    ->where('local_user.estado', '!=', 'Desvinculado')
                    ->where(function ($query) use($request) {
                        $query->where('locales.nombre', 'LIKE', "%$request->nombre%")
                            ->orWhere('locales.cuenta', 'LIKE', "%$request->nombre%")
                            ->orWhere('locales.estado', 'LIKE', "%$request->nombre%")
                            ->orWhere('cadenas.nombre', 'LIKE', "%$request->nombre%")
                            ->orWhere('organizaciones.nombre', 'LIKE', "%$request->nombre%");
                    })
                    //->where('locales.nombre', 'LIKE', "%$request->nombre%")
                    //->orWhere('locales.cuenta', 'LIKE', "%$request->nombre%")
                    //->orWhere('locales.estado', 'LIKE', "%$request->nombre%")
                    //->orWhere('cadenas.nombre', 'LIKE', "%$request->nombre%")
                    //->orWhere('organizaciones.nombre', 'LIKE', "%$request->nombre%")
                    ->join('locales', 'locales.id', '=', 'local_user.local_id')
                    ->join('cadenas', 'cadenas.id', '=', 'locales.cadena_id')
                    ->join('organizaciones', 'organizaciones.id', '=', 'locales.organizacion_id')
                    ->selectRaw('count(*) as cantEmpaques')
                    ->groupby('local_user.local_id')
                    ->orderBy('locales.estado', 'asc')
                    ->get();

                foreach ($locales as $local){
                    $local->precioMensual = "$".number_format($local->precioMensual,0, '', '.');
                }

                return response()->json([
                    'locales' => $locales
                ], 200);
            }


        }
        return view('admin.local.listado');

    }

    public function agregarLocal()
    {
        $cadenas = Cadena::orderby('nombre','ASC')->pluck('nombre','id');
        $organizaciones = Organizacion::orderby('nombre','ASC')->pluck('nombre','id');

        return view('admin.local.agregar')
            ->with('cadenas', $cadenas)            
            ->with('organizaciones', $organizaciones);        
    }

    public function postAgregarLocal(LocalRequest $request)
    {
        $local = new Local($request->all());

        $local->save();
       
        session()->flash('success', 'Guardado exitosamente');
        return redirect()->action('AdminController@mostrarLocales');
    }   

    //Opciones Local
    public function opciones($id){
        $local = Local::find($id);
        return view ('admin.local.opciones')
            ->with('local', $local);
    }

    public function cuposTomaPorDefecto(CuposCantRequest $request){//id local

        //$empaques = Local_User::where('local_id', $request->id_local)->
        DB::table('local_user')->where('local_id', $request->id_local)->update(['cuposToma' => $request->cant]);

        session()->flash('success', 'Se modificó la cant. de cupos que pueden tomar todos los empaques en la toma de turnos.');
        return redirect()->action('AdminController@empaques', ['id' => $request->id_local]);
    }

    public function cuposPreTomaPorDefecto(CuposCantRequest $request){//id local

        DB::table('local_user')->where('local_id', $request->id_local)->update(['cuposPreToma' => $request->cant]);

        session()->flash('success', 'Se modificó la cant. de cupos que pueden tomar todos los empaques en la pre-toma.');
        return redirect()->action('AdminController@empaques', ['id' => $request->id_local]);
    }

    public function cuposRepechajePorDefecto(CuposCantRequest $request){//id local

        DB::table('local_user')->where('local_id', $request->id_local)->update(['cuposRepechaje' => $request->cant]);

        session()->flash('success', 'Se modificó la cant. de cupos que pueden tomar todos los empaques en el Repechaje.');
        return redirect()->action('AdminController@empaques', ['id' => $request->id_local]);
    }

    public function buscarUsuario(Request $request)
    {

        $v = Validator::make($request->all(), [
            'nombre'   => 'alpha|min:3|max:45|required',
            'id_local' => 'integer|required',
        ]);

        if ($v->fails())
        {
            return view ('errors/userNotFound');
        }


        $local = Local::find($request->id_local);
        if($local == ''){
            return view ('errors/userNotFound');
        }

        $nombre = $request->nombre;
        $empaques = DB::table('local_user')
            ->select('local_user.*', 'users.id as id_user', 'users.nombre', 'users.apellido')
            ->where('local_user.local_id', $request->id_local)
            ->where('local_user.estado', '!=', 'Desvinculado')
            ->join('users', 'local_user.user_id', '=', 'users.id')
            ->where(function($q) use($nombre)
            {
                $q->where('nombre', 'LIKE', "%$nombre%")
                    ->orWhere('apellido', 'LIKE', "%$nombre%");
            })
            //->where('nombre', 'LIKE', "%$request->nombre%")
            //->orWhere('apellido', 'LIKE', "%$request->nombre%")
            ->get();


        return view ('admin.local.busqueda')//,compact('cantUsuarios')
        ->with('local', $local)
            ->with('empaques', $empaques);

    }

    //Listado de las Postulaciones del Local
    public function postulaciones($id){//id local
        $local = Local::find($id);
        if($local == ''){
            return redirect()->action('HomeController@index');
        }
        $postulaciones = Postulacion::where('local_id', $id)
                            ->orderBy('id','desc')
                            ->paginate(2);
        return view ('admin.local.postulaciones')
            ->with('postulaciones', $postulaciones)
            ->with('local', $id);
    }

    //Agregar Postulación
    public function agregarPostulacion($id)
    {

        $local = Local::find($id);
        if($local == ''){
            return redirect()->action('HomeController@index');
        }

        return view ('admin.local.agregarPostulacion')
                ->with('local', $id);
    }

    //POST Agregar Postulación
    public function postAgregarPostulacion(PostulacionRequest $request)
    {

        $postulacion = new Postulacion($request->all());

        $local = Local::find($postulacion->local_id);
        if($local == ''){
            return redirect()->action('HomeController@index');
        }

        $postulacion->save();

        session()->flash('success', 'Agregado exitosamente');

        return redirect()->action('AdminController@postulaciones', ['id' => $postulacion->local_id]);
    }


    //Editar Postulación del Local
    public function editarPostulacion($id){//id postulacion
        $postulacion = Postulacion::find($id);
        if($postulacion == ''){
            return redirect()->action('HomeController@index');
        }

        return view ('admin.local.editarPostulacion')
            ->with('postulacion', $postulacion);

    }

    //PUT Editar Postulación
    public function putEditarPostulacion(PostulacionRequest $request, $id){

        $postulacion = Postulacion::find($id);

        if($postulacion=='')
        {
            return redirect()->action('HomeController@index');
        }

        $postulacion->fill($request->all());
        //si la postulacion que se esta intentando guardar era provada y tenia postulantes se procederá a eliminar.
        //DB::table('users')->whereIn('id', $ids_to_delete)->delete();
        DB::table('postulacion_user')->where('postulacion_id', $id)->delete();
        //$allUserPostulaciones = Postulacion_User::where('postulacion_id',$id)->get();
        //$allUserPostulaciones->delete();

        //guardo los nuevos cambios de la postulacion
        $postulacion->save();

        session()->flash('success', 'Modificado exitosamente');

        return redirect()->action('AdminController@editarPostulacion', ['id' => $id]);

    }

    //Eliminar Postulación del Local
    public function eliminarPostulacion($id){//id postulacion
        $postulacion = Postulacion::find($id);
        if($postulacion == ''){
            return redirect()->action('HomeController@index');
        }

        return view ('admin.local.eliminarPostulacion')
            ->with('postulacion', $postulacion);

    }

    //Delete Eliminar Postulación
    public function deleteEliminarPostulacion($id)
    {
        $postulacion = Postulacion::find($id);
        if($postulacion == ''){
            return redirect()->action('HomeController@index');
        }
        $postulacion->delete();
        session()->flash('danger', '¡Se ha borrado la postulación de forma exitosa!');
        return redirect()->action('AdminController@postulaciones', ['id' => $postulacion->local_id]);
    }

    //ver resultados de la postulación
    public function resultados($id){//id postulacion

        $postulacion = Postulacion::find($id);
        if($postulacion == ''){
            return redirect()->action('HomeController@index');
        }elseif($postulacion->activarLista == 'Azar'){
            $hoy = date('Y-m-d H:i:s');
            $cantTomados = Postulacion_User::where('postulacion_id', $id)->where('estado', 'Tomado')->count();

            if($hoy < $postulacion->inicio){
                //Aún no es la hora para el sorteo "azar"
                session()->flash('danger', 'Los resultados de la postulación al azar se mostrará una vez que la hora actual sea luego de la hora de inicio de la postulación.');
                return redirect()->action('AdminController@postulaciones', ['id' => $postulacion->local_id]);
            }elseif($cantTomados > 0){
                //si existe una postulacion_user  como "tomado" significa que el sorteo ya se hizo y muesta los resultados
                $resultados = Postulacion_User::where('postulacion_id', $id)
                    ->orderBy('estado', 'desc')
                    ->orderBy('postulacion', 'asc')
                    ->paginate(25);//->get();

                foreach ($resultados as $res){
                    $res->postulacion = date('H:i:s', strtotime($res->postulacion) );
                }

                return view ('admin.local.resultados')
                    ->with('resultados', $resultados)
                    ->with('local', $postulacion->local_id);
            }else{
                //si es hora del sorteo y aún no hay un postulante como "tomado", se realiza la función del azar y se muestra los resultados
                $resultados = Postulacion_User::where('postulacion_id', $id)->get();
                //dd($resultados);
                if( $resultados =="" ) {
                    //No existe ningún aspirante en la lista privada
                    session()->flash('danger', 'No se ha registrado ningun aspirante a la postulación.');
                    return redirect()->action('AdminController@postulaciones', ['id' => $postulacion->local_id]);
                }else{
                    $azar1 = $resultados->random($postulacion->cupos);

                    foreach($azar1 as $azar) {
                        $azar->postulacion = $hoy;
                        $azar->estado = 'Tomado';
                        $azar->update();
                    }

                    $resultados = Postulacion_User::where('postulacion_id', $id)
                        ->orderBy('estado', 'desc')
                        ->orderBy('postulacion', 'asc')
                        ->paginate(25);//->get();

                    foreach ($resultados as $res) {
                        $res->postulacion = date('H:i:s', strtotime($res->postulacion));
                    }
                    return view ('admin.local.resultados')
                        ->with('resultados', $resultados)
                        ->with('local', $postulacion->local_id);
                }


            }

        }else{
            //Muestra resultados en las postulaciones Privadas y Públicas
            $resultados = Postulacion_User::where('postulacion_id', $id)
                ->orderBy('estado', 'desc')
                ->orderBy('postulacion', 'asc')
                ->paginate(25);//->get();

            foreach ($resultados as $res){
                $res->postulacion = date('H:i:s', strtotime($res->postulacion) );
            }

            return view ('admin.local.resultados')
                ->with('resultados', $resultados)
                ->with('local', $postulacion->local_id);
        }

    }


    //Vista Empaques Asignados al Local
    public function empaques($id, $estado = null){


        $local = Local::findOrFail($id);


        if($estado == null){
            $empaques = Local_User::where('local_id', $id)
                ->where('estado', '!=', 'Desvinculado')
                ->paginate(20);
        }elseif ($estado == 'activos'){
            //selección de todos los empaques asociados al local
            $empaques = Local_User::where('local_id', $id)
                ->where('estado', 'Activo')
                ->paginate(20);
        }elseif ($estado == 'desvinculados'){
            $empaques = Local_User::where('local_id', $id)
                ->where('estado', 'Desvinculado')
                ->paginate(20);
        }elseif ($estado == 'deudores'){
            $empaques = Local_User::where('local_id', $id)
                ->where('estado', 'Deudor')
                ->paginate(20);
        }elseif ($estado == 'suspendidos'){
            $empaques = Local_User::where('local_id', $id)
                ->where('estado', 'Suspendido')
                ->paginate(20);
        }elseif ($estado == 'encargados'){
            $empaques = Local_User::where('local_id', $id)
                ->where('estado', '!=', 'Desvinculado')
                ->where('rol', 'Encargado')
                ->paginate(20);
        }elseif ($estado == 'coordinadores'){
            $empaques = Local_User::where('local_id', $id)
                ->where('estado', '!=', 'Desvinculado')
                ->where('rol', 'Coordinador')
                ->paginate(20);
        }elseif ($estado == 'empaques'){
            $empaques = Local_User::where('local_id', $id)
                ->where('estado', '!=', 'Desvinculado')
                ->where('rol', 'Empaque')
                ->paginate(20);
        }else{
            session()->flash('danger', 'Datos incorrectos al filtrar');
            return redirect()->action('AdminController@empaques', ['id' => $id]);
        }

        //Contar total de usuarios asociados al local
        $cantUsuarios = Local_User::where('local_id', $id)
                        ->where('estado', '!=', 'Desvinculado')
                        ->count();
        //Contar total de encargados asociados al local
        $cantEncargados = Local_User::where('local_id', $id)
                        ->where('estado', '!=', 'Desvinculado')
                        ->where('rol','Encargado')
                        ->count();
        //Contar total de coordinadores asociados al local
        $cantCoordinadores = Local_User::where('local_id', $id)
                        ->where('estado', '!=', 'Desvinculado')
                        ->where('rol','Coordinador')
                        ->count();                        
        //Contar total de empaques asociados al local
        $cantEmpaques = Local_User::where('local_id', $id)
                        ->where('estado', '!=', 'Desvinculado')
                        ->where('rol','Empaque')
                        ->count();      

        //Contar total de empaques ACTIVOS asociados al local
        $cantActivos = Local_User::where('local_id', $id)->where('estado', 'Activo')->count();
        //Contar total de empaques DEUDORES asociados al local
        $cantDeudores = Local_User::where('local_id', $id)->where('estado', 'Deudor')->count();
        //Contar total de empaques SUSPENDIDOS asociados al local
        $cantSuspendidos = Local_User::where('local_id', $id)->where('estado', 'Suspendido')->count();
        //Contar total de empaques DESVINCULADOS asociados al local
        $cantDesvinculados = Local_User::where('local_id', $id)->where('estado', 'Desvinculado')->count();
        
        return view ('admin.local.empaques')//,compact('cantUsuarios')
            ->with('local', $local)
            ->with('empaques', $empaques)
            ->with('cantUsuarios',$cantUsuarios)
            ->with('cantEncargados',$cantEncargados)
            ->with('cantCoordinadores',$cantCoordinadores)
            ->with('cantEmpaques',$cantEmpaques)
            ->with('cantActivos',$cantActivos)
            ->with('cantDeudores',$cantDeudores)
            ->with('cantSuspendidos',$cantSuspendidos)
            ->with('cantDesvinculados',$cantDesvinculados);
    }


    //Editar Local
    public function editarLocal($id)
    {
        $local = Local::findOrFail($id);
        $local->precioMensual = $local->pagoTotal = number_format($local->precioMensual,0, '.', '');

        $cadenas = Cadena::orderby('nombre','ASC')->pluck('nombre','id');
        $organizaciones = Organizacion::orderby('nombre','ASC')->pluck('nombre','id');

        return view('admin.local.editar')
            ->with('local', $local)
            ->with('cadenas', $cadenas)            
            ->with('organizaciones', $organizaciones); 
    }   


    public function putActualizarLocal(LocalRequest $request, $id)
    {
        $local = Local::findOrFail($id);

        if($request->responsablePago <> $local->responsablePago || $request->precioMensual <> $local->precioMensual || $request->cuenta <> $local->cuenta){
            //Esta validación se hace debido a que como se cobra a fin de mes, se debe generar la boleta por la cual ocuparón la pag.
            if(date('Y-m-d H:i:s') < date('Y-m-08 08:10:00')){
                session()->flash('danger', 'Solo se puede modificar el "Responsable de pago", "Tipo de cuenta" y el "Precio Mensual" después de los días 08 a las 08:10:00 de cada mes.');
                return redirect()->action('AdminController@editarLocal', ['id' => $id])->with('local', $local);
            }

            //Si se encuentra un empaque deudor, se cancela la operación
            $deudores = Local_User::where('local_id', $id)->where('estado', 'Deudor')->count();

            if($deudores > 0){
                session()->flash('danger', 'No debe haber ningún empaque Deudor.');
                return redirect()->action('AdminController@editarLocal', ['id' => $id])->with('local', $local);
            }
        }

        $local->fill($request->all());
        $local->save();

        session()->flash('success', 'Modificado exitosamente');
      
        return redirect()->action('AdminController@editarLocal', ['id' => $id])
            ->with('local', $local);
    }  


    public function eliminarLocal($id)
    {
        $local = Local::find($id);

        if($local=='')
        {
            return redirect()->action('HomeController@index');
        }        

        return view('admin.local.eliminar')
            ->with('local', $local);
    }   


    public function deleteEliminarLocal($id)
    {
        $local = Local::find($id);

        // Valida si el ID del articulo existe, en el caso de que no exista lo redirecciona al Inicio (nulo)
        
        if($local=='')
        {
            return redirect()->action('HomeController@index');
        }


        $local->delete();//Articulo::destroy($id); //otra opción para eliminar un registro

        session()->flash('danger', '¡Se ha borrado el local  de forma exitosa!');
        return redirect()->action('AdminController@mostrarLocales');
    }


    public function rendimiento($id){

        $monday = array();
        $tuesday = array();
        $wednesday = array();
        $thursday = array();
        $friday = array();
        $saturday = array();
        $sunday = array();

        $locales = Local::where('estado', 'Activo')->get();

        foreach ($locales as $local) {
            $lastPlanilla = Planilla::where('local_id', $local->id)->get()->last();
            $cantEmpaques = Local_User::where('local_id', $local->id)->where('estado', 'Activo')->count();

            //toma de turnos
            if(date("D", strtotime($lastPlanilla['inicioToma'])) == 'Mon'){
                $monday[] = array(
                    'local' => $local->nombre,
                    'cadena' => $local->Cadena->nombre,
                    'inicio' => date('H:i:s', strtotime($lastPlanilla['inicioToma'])),
                    'tipo' => 'Toma',
                    'cantEmpaques' => $cantEmpaques,
                );
            }elseif(date("D", strtotime($lastPlanilla['inicioToma'])) == 'Tue'){
                $tuesday[] = array(
                    'local' => $local->nombre,
                    'cadena' => $local->Cadena->nombre,
                    'inicio' => date('H:i:s', strtotime($lastPlanilla['inicioToma'])),
                    'tipo' => 'Toma',
                    'cantEmpaques' => $cantEmpaques,
                );
            }elseif(date("D", strtotime($lastPlanilla['inicioToma'])) == 'Wed'){
                $wednesday[] = array(
                    'local' => $local->nombre,
                    'cadena' => $local->Cadena->nombre,
                    'inicio' => date('H:i:s', strtotime($lastPlanilla['inicioToma'])),
                    'tipo' => 'Toma',
                    'cantEmpaques' => $cantEmpaques,
                );
            }elseif(date("D", strtotime($lastPlanilla['inicioToma'])) == 'Thu'){
                $thursday[] = array(
                    'local' => $local->nombre,
                    'cadena' => $local->Cadena->nombre,
                    'inicio' => date('H:i:s', strtotime($lastPlanilla['inicioToma'])),
                    'tipo' => 'Toma',
                    'cantEmpaques' => $cantEmpaques,
                );
            }elseif(date("D", strtotime($lastPlanilla['inicioToma'])) == 'Fri'){
                $friday[] = array(
                    'local' => $local->nombre,
                    'cadena' => $local->Cadena->nombre,
                    'inicio' => date('H:i:s', strtotime($lastPlanilla['inicioToma'])),
                    'tipo' => 'Toma',
                    'cantEmpaques' => $cantEmpaques,
                );
            }elseif(date("D", strtotime($lastPlanilla['inicioToma'])) == 'Sat'){
                $saturday[] = array(
                    'local' => $local->nombre,
                    'cadena' => $local->Cadena->nombre,
                    'inicio' => date('H:i:s', strtotime($lastPlanilla['inicioToma'])),
                    'tipo' => 'Toma',
                    'cantEmpaques' => $cantEmpaques,
                );
            }elseif(date("D", strtotime($lastPlanilla['inicioToma'])) == 'Sun'){
                $sunday[] = array(
                    'local' => $local->nombre,
                    'cadena' => $local->Cadena->nombre,
                    'inicio' => date('H:i:s', strtotime($lastPlanilla['inicioToma'])),
                    'tipo' => 'Toma',
                    'cantEmpaques' => $cantEmpaques,
                );
            }


            //pre-toma
            if($local->preToma == 'Si') {
                if (date("D", strtotime($lastPlanilla['inicioPreToma'])) == 'Mon') {
                    $monday[] = array(
                        'local' => $local->nombre,
                        'cadena' => $local->Cadena->nombre,
                        'inicio' => date('H:i:s', strtotime($lastPlanilla['inicioPreToma'])),
                        'tipo' => 'PreToma',
                        'cantEmpaques' => $cantEmpaques,
                    );
                } elseif (date("D", strtotime($lastPlanilla['inicioPreToma'])) == 'Tue') {
                    $tuesday[] = array(
                        'local' => $local->nombre,
                        'cadena' => $local->Cadena->nombre,
                        'inicio' => date('H:i:s', strtotime($lastPlanilla['inicioPreToma'])),
                        'tipo' => 'PreToma',
                        'cantEmpaques' => $cantEmpaques,
                    );
                } elseif (date("D", strtotime($lastPlanilla['inicioPreToma'])) == 'Wed') {
                    $wednesday[] = array(
                        'local' => $local->nombre,
                        'cadena' => $local->Cadena->nombre,
                        'inicio' => date('H:i:s', strtotime($lastPlanilla['inicioPreToma'])),
                        'tipo' => 'PreToma',
                        'cantEmpaques' => $cantEmpaques,
                    );
                } elseif (date("D", strtotime($lastPlanilla['inicioPreToma'])) == 'Thu') {
                    $thursday[] = array(
                        'local' => $local->nombre,
                        'cadena' => $local->Cadena->nombre,
                        'inicio' => date('H:i:s', strtotime($lastPlanilla['inicioPreToma'])),
                        'tipo' => 'PreToma',
                        'cantEmpaques' => $cantEmpaques,
                    );
                } elseif (date("D", strtotime($lastPlanilla['inicioPreToma'])) == 'Fri') {
                    $friday[] = array(
                        'local' => $local->nombre,
                        'cadena' => $local->Cadena->nombre,
                        'inicio' => date('H:i:s', strtotime($lastPlanilla['inicioPreToma'])),
                        'tipo' => 'PreToma',
                        'cantEmpaques' => $cantEmpaques,
                    );
                } elseif (date("D", strtotime($lastPlanilla['inicioPreToma'])) == 'Sat') {
                    $saturday[] = array(
                        'local' => $local->nombre,
                        'cadena' => $local->Cadena->nombre,
                        'inicio' => date('H:i:s', strtotime($lastPlanilla['inicioPreToma'])),
                        'tipo' => 'PreToma',
                        'cantEmpaques' => $cantEmpaques,
                    );
                } elseif (date("D", strtotime($lastPlanilla['inicioPreToma'])) == 'Sun') {
                    $sunday[] = array(
                        'local' => $local->nombre,
                        'cadena' => $local->Cadena->nombre,
                        'inicio' => date('H:i:s', strtotime($lastPlanilla['inicioPreToma'])),
                        'tipo' => 'PreToma',
                        'cantEmpaques' => $cantEmpaques,
                    );
                }
            }


            //Repechaje
            if($local->repechajeLocal == 'Si') {
                if (date("D", strtotime($lastPlanilla['inicioRepechaje'])) == 'Mon') {
                    $monday[] = array(
                        'local' => $local->nombre,
                        'cadena' => $local->Cadena->nombre,
                        'inicio' => date('H:i:s', strtotime($lastPlanilla['inicioRepechaje'])),
                        'tipo' => 'Repechaje',
                        'cantEmpaques' => $cantEmpaques,
                    );
                } elseif (date("D", strtotime($lastPlanilla['inicioRepechaje'])) == 'Tue') {
                    $tuesday[] = array(
                        'local' => $local->nombre,
                        'cadena' => $local->Cadena->nombre,
                        'inicio' => date('H:i:s', strtotime($lastPlanilla['inicioRepechaje'])),
                        'tipo' => 'Repechaje',
                        'cantEmpaques' => $cantEmpaques,
                    );
                } elseif (date("D", strtotime($lastPlanilla['inicioRepechaje'])) == 'Wed') {
                    $wednesday[] = array(
                        'local' => $local->nombre,
                        'cadena' => $local->Cadena->nombre,
                        'inicio' => date('H:i:s', strtotime($lastPlanilla['inicioRepechaje'])),
                        'tipo' => 'Repechaje',
                        'cantEmpaques' => $cantEmpaques,
                    );
                } elseif (date("D", strtotime($lastPlanilla['inicioRepechaje'])) == 'Thu') {
                    $thursday[] = array(
                        'local' => $local->nombre,
                        'cadena' => $local->Cadena->nombre,
                        'inicio' => date('H:i:s', strtotime($lastPlanilla['inicioRepechaje'])),
                        'tipo' => 'Repechaje',
                        'cantEmpaques' => $cantEmpaques,
                    );
                } elseif (date("D", strtotime($lastPlanilla['inicioRepechaje'])) == 'Fri') {
                    $friday[] = array(
                        'local' => $local->nombre,
                        'cadena' => $local->Cadena->nombre,
                        'inicio' => date('H:i:s', strtotime($lastPlanilla['inicioRepechaje'])),
                        'tipo' => 'Repechaje',
                        'cantEmpaques' => $cantEmpaques,
                    );
                } elseif (date("D", strtotime($lastPlanilla['inicioRepechaje'])) == 'Sat') {
                    $saturday[] = array(
                        'local' => $local->nombre,
                        'cadena' => $local->Cadena->nombre,
                        'inicio' => date('H:i:s', strtotime($lastPlanilla['inicioRepechaje'])),
                        'tipo' => 'Repechaje',
                        'cantEmpaques' => $cantEmpaques,
                    );
                } elseif (date("D", strtotime($lastPlanilla['inicioRepechaje'])) == 'Sun') {
                    $sunday[] = array(
                        'local' => $local->nombre,
                        'cadena' => $local->Cadena->nombre,
                        'inicio' => date('H:i:s', strtotime($lastPlanilla['inicioRepechaje'])),
                        'tipo' => 'Repechaje',
                        'cantEmpaques' => $cantEmpaques,
                    );
                }
            }
        }

        $monday = array_values(array_sort($monday, function ($value) {
            return $value['inicio'];
        }));

        $tuesday = array_values(array_sort($tuesday, function ($value) {
            return $value['inicio'];
        }));

        $wednesday = array_values(array_sort($wednesday, function ($value) {
            return $value['inicio'];
        }));

        $thursday = array_values(array_sort($thursday, function ($value) {
            return $value['inicio'];
        }));

        $friday = array_values(array_sort($friday, function ($value) {
            return $value['inicio'];
        }));

        $saturday = array_values(array_sort($saturday, function ($value) {
            return $value['inicio'];
        }));

        $sunday = array_values(array_sort($sunday, function ($value) {
            return $value['inicio'];
        }));

        return view('admin.local.rendimiento')
            ->with('monday', $monday)
            ->with('tuesday', $tuesday)
            ->with('wednesday', $wednesday)
            ->with('thursday', $thursday)
            ->with('friday', $friday)
            ->with('saturday', $saturday)
            ->with('sunday', $sunday)
            ->with('id', $id);
    }

    public function cantidadTurnosAsignados(BuscarTurnosUsuarioRequest $request, $id){


        $usuarios = Local_User::select('local_user.id as id', 'local_user.rol', 'users.nombre', 'users.apellido')
                ->where('local_user.local_id', $id)
                ->where('local_user.estado', '!=', 'Desvinculado')
                ->join('users', 'users.id', '=', 'local_user.user_id')
                ->paginate(20);

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
            $lastDay = date("d", mktime(0,0,0, date('m') +1, 0, date('Y')));
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

            return view('admin.local.cantidad-turnos-asignados')
                ->with('id', $id)
                ->with('usuarios', $usuarios);

    }

    public function perfil($idLocal, $id)
    {
        //dd($idLocal);
        $usuario = User::find($id);

        if($usuario->comuna_id != null){
            $usuario->comuna_id = $usuario->comuna->nombre;
            //paso la variable region con el valor=nombreRegion xq no esta en el modelo 
            $region = $usuario->comuna->region->nombre;
        }else{
            $region = '';
        }

        if($usuario->carrera_id != null){
            $usuario->carrera_id = $usuario->carrera->nombre;
        }

        if($usuario->universidad_id != null){
            $usuario->universidad_id = $usuario->universidad->nombre;
        }    

        if($usuario->avatar==null){
            $usuario->avatar = "avatar.jpg";
        }

        

        return view('admin.local.perfil',compact('region'))
            ->with('usuario', $usuario)
            ->with('idLocal', $idLocal);
    }   


    //Funcion para editar usuario perteneciente al local
    public function editarUsuarioLocal($id)
    {
        $local_user = Local_User::find($id);

        if($local_user=='')
        {
            return redirect()->action('HomeController@index');
        }
        
        return view('admin.local.usuario')
            ->with('local_user', $local_user);
    }


    public function putUsuarioLocal(Local_UserRequest $request, $id)
    {
        $local_user = Local_User::findOrFail($id);
        $user = $local_user->user_id;
        $local = $local_user->local_id;

        $cantEnc = Local_User::where('rol', 'Encargado')->where('estado', '!=','Desvinculado')->where('local_id', $local)->count();

        //Debe haber al menos 1 encargado
        if($cantEnc==1 && $local_user->rol == 'Encargado' && ($local_user->rol <> $request->rol || $request->estado == 'Desvinculado' )){
            session()->flash('danger', 'Debe haber al menos un encargado en el local');
            return redirect()->route('admin.local.usuario', ['id' => $local_user->id]);
        }

        $local_user->fill($request->all());

        $local_user->user_id  = $user;
        $local_user->local_id = $local;




        if($local_user->estado == 'Desvinculado'){
            //Vuelvo a los valores por defecto
            $local_user->rol = 'Empaque';
            $local_user->cuposToma = 4;
            $local_user->cuposPreToma = 0;
            $local_user->cuposRepechaje = 10;
            $local_user->inicioCastigo = null;
            $local_user->terminoCastigo = null;
        }

        $local_user->save();
        
        session()->flash('success', 'Modificado Exitosamente');
        return redirect()->route('admin.local.usuario', ['id' => $local_user->id]);
    }

    //Funcion para editar usuario perteneciente al local
    /*
    public function desvincularUsuarioLocal($id)
    {
        $local_user = Local_User::find($id);

        if($local_user=='')
        {
            return redirect()->action('HomeController@index');
        }
        
        return view('admin.local.desvincular')
            ->with('local_user', $local_user);
    }   
    */
    public function putDesvincularUsuarioLocal(Local_UserRequest $request, $id)
    {
        $local_user = Local_User::find($id);
        $user = $local_user->user_id;
        $local = $local_user->local_id;
        
        if($local_user == '')
        {
            return redirect()->action('HomeController@index');
        }
        

        $local_user->fill($request->all());

        $local_user->user_id  = $user;
        $local_user->local_id = $local;


        if($local_user->inicioCastigo == '' && $local_user->terminoCastigo == '')
        {
            $local_user->inicioCastigo = null;
            $local_user->terminoCastigo = null;

        }

        $local_user->estado = "Desvinculado";
        $local_user->rol = 'Empaque';
        $local_user->cuposToma = 4;
        $local_user->cuposPreToma = 0;
        $local_user->cuposRepechaje = 10;

        $local_user->save();
        
        session()->flash('success', 'Desvinculado Exitosamente');
        return redirect()->route('admin.local.desvincular', ['id' => $local_user->id]);
    }

    public function listadoPagos($id){
        $local = Local_User::findorfail($id);
        $pagos = Pago::where('local_user_id', $id)->orderBy('pagoHasta', 'desc')->paginate(10);

        if($pagos->count() == 0) {
            session()->flash('warning', 'Agregarás el primer pago del empaque');
            //return redirect()->route('admin.local.empaques', ['id' => $local->local_id]);
            return redirect()->route('admin.local.agregar-pago', ['id' => $id]);
        }else{

            //$fechaActual = date('Y-m-d H:i:s');
            //Obtengo el primer día del mes
            $firstDay = date('Y-m-d', mktime(0,0,0, date('m'), 1, date('Y')));
            //Obtengo el ultimo día del mes/año
            $lastDay = date("Y-m-d", mktime(0,0,0, date('m') +1, 0, date('Y')));
            $deudaDelMes = 0;

            $lastPago = $pagos->where('estado', 'Aceptado')
                ->where('pagoDesde', '>=', $firstDay)
                ->where('pagoHasta', '<=', $lastDay)
                ->first();


            if(!empty($lastPago)){
                $deudaDelMes = 0;
            }else{
                //verifico si tomó algun turno en el mes correspondiente a la boleta.
                $turnTaken = Planilla_Turno_User::where('local_user_id', $id)
                    ->where('created_at', '>=', $firstDay)
                    ->where('created_at', '<=', $lastDay)
                    ->first();

                if (!empty($turnTaken)){
                    $deudaDelMes = $local->Local->precioMensual;
                }
            }


            //Obtengo la suma a pagar  de las boletas pendientes
            $deudaBoletas = Pago::where('estado', 'Pendiente')
                                ->where('local_user_id', $id)
                                ->sum('pagoTotal');


            $deudaTotal = $deudaDelMes + $deudaBoletas;

            $meses = array('Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic');
            $months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

            foreach ($pagos as $pago){
                $pago->fechaPago= date('d-m-Y', strtotime($pago->fechaPago));
                $pago->pagoDesde= str_replace($months, $meses, date('d-M-Y', strtotime($pago->pagoDesde)));
                $pago->pagoHasta= str_replace($months, $meses, date('d-M-Y', strtotime($pago->pagoHasta)));
                $pago->pagoTotal = '$' . number_format($pago->pagoTotal,0, '', '.');
            }
            return view ('admin.local.listado-pagos')
                ->with('pagos', $pagos)
                ->with('local', $local)
                ->with('deudaDelMes',  number_format($deudaDelMes,0, '', '.'))
                ->with('deudaBoletas',  number_format($deudaBoletas,0, '', '.'))
                ->with('deudaTotal', number_format($deudaTotal,0, '', '.'));
        /**/
        }

    }

    public function agregarPago($id){
        $usuario = Local_User::findorfail($id);

        if($usuario->Local->responsablePago == 'Empaques'){
            $responsable = 'Empaque';
        }else{
            $responsable = 'Encargado';
        }

        return view('admin.local.agregar-pago')
            ->with('usuario', $usuario)
            ->with('responsable', $responsable);
    }

    public function postAgregarPago(AgregarPagoRequest $request){

        $email = Local_User::select('users.email')
            ->where('local_user.id', $request->local_user_id)
            ->join('users', 'users.id', '=', 'local_user.user_id')
            ->firstOrFail();

        $pago = new Pago($request->all());

        //Código para validar el "pagoDesde" y "pagoHasta" sean correcto.
        $diaDesde = date('d', strtotime($pago->pagoDesde));
        $diaHasta = date('d', strtotime($pago->pagoHasta));
        $mesHasta = date('m', strtotime($pago->pagoHasta));
        $anoHasta = date('Y', strtotime($pago->pagoHasta));

        //Obtengo el ultimo día del mes/año CORRECTO ingresado por el usuario
        $day = date("d", mktime(0,0,0, $mesHasta +1, 0, $anoHasta));

        if($diaDesde != '01' || $day != $diaHasta){
            session()->flash('danger', 'El "pago desde" debe comenzar desde el primer día del mes (01) y el "pago hasta" debe ser el último día del mes ingresado, ej:(31)');
            return redirect()->back()->withInput();
        }

        if($pago->informacionExtra != null){
            $pago->informacionExtra = strip_tags($pago->informacionExtra);
        }

        if($pago->comprobante != null) {
            //Guardo la foto subida al hacer el update
            $fileComprobante = $request->file('comprobante');
            $rename_fileComprobante = $pago->local_user_id . '-' . date('c') . '.' . $fileComprobante->getClientOriginalExtension();
            $path = public_path() . '/img/pagos/';
            $fileComprobante->move($path, $rename_fileComprobante);
            $img = \Image::make($path . $rename_fileComprobante)->resize(800, 800);//Tamaño 120 de la imagen para que se vea bien en el articulo
            $img->save($path . $rename_fileComprobante);
            $pago->comprobante = $rename_fileComprobante;
        }

        $pago->save();

        $arrayEmails=$email->toArray();

        $arrayEmails = $arrayEmails['email'];

        if($pago->estado == 'Aceptado'){
            Mail::send('vendor.notifications.email-pago-procesado', [], function($msj) use($arrayEmails){
                $msj->to($arrayEmails)->subject('Su pago ha sido procesado exitosamente - Proyecto Nero');
            });
        }


        session()->flash('success', 'Pago Agregado Con Éxito');
        return redirect()->route('admin.local.agregar-pago', ['id' => $request->local_user_id]);

    }

    public function editarPago($id){

        $pago = Pago::findorfail($id);
        $pago->pagoTotal = number_format($pago->pagoTotal,0, '.', '');

        if($pago->paga == 'Encargado'){
            $encargados = Local_User::
            select(DB::raw("CONCAT(users.nombre,' ',users.apellido) AS fullname"),'local_user.id AS id')
                ->where('local_user.local_id', $pago->Local_User->local_id)
                ->where('local_user.rol', 'Encargado')
                ->where('local_user.estado', '!=', 'Desvinculado')
                ->join('users', 'local_user.user_id' ,'=' , 'users.id' )
                ->pluck('fullname', 'id')->toArray();
        }else{
            //List vacia
            $collection = collect();
            $encargados = $collection->pluck('fullname', 'id')->toArray();
        }


        return view('admin.local.editar-pago')
            ->with('pago', $pago)
            ->with('encargados', $encargados);
    }

    public function putEditarPago(AgregarPagoRequest $request){

        $pago = Pago::findorfail($request->id);
        $oldFile = $pago->comprobante;
        $pago->fill($request->all());

        //Código para validar el "pagoDesde" y "pagoHasta" sean correcto.
        $diaDesde = date('d', strtotime($pago->pagoDesde));
        $diaHasta = date('d', strtotime($pago->pagoHasta));
        $mesHasta = date('m', strtotime($pago->pagoHasta));
        $anoHasta = date('Y', strtotime($pago->pagoHasta));

        //Obtengo el ultimo día del mes/año CORRECTO ingresado por el usuario
        $day = date("d", mktime(0,0,0, $mesHasta +1, 0, $anoHasta));

        if($diaDesde != '01' || $day != $diaHasta){
            session()->flash('danger', 'El "pago desde" debe comenzar desde el primer día del mes (01) y el "pago hasta" debe ser el último día del mes ingresado, ej:(31)');
            return redirect()->back()->withInput();
        }


        if($pago->comprobante != $oldFile){
            \File::delete(public_path().'/img/pagos/'.$oldFile);//elimino foto guardada anteriormente

            $fileComprobante = $request->file('comprobante');
            $rename_fileComprobante = $pago->local_user_id . '-' . date('c') . '.' . $fileComprobante->getClientOriginalExtension();
            $path = public_path() . '/img/pagos/';
            $fileComprobante->move($path, $rename_fileComprobante);
            $img = \Image::make($path . $rename_fileComprobante)->resize(800, 800);//Tamaño 120 de la imagen para que se vea bien en el articulo
            $img->save($path . $rename_fileComprobante);
            $pago->comprobante = $rename_fileComprobante;
        }

        $pago->save();

        session()->flash('success', 'Pago actualizado con éxito');
        return redirect()->route('admin.local.editar-pago', ['id' => $pago->id]);
    }

    public function detallePago($id){
        $pago = Pago::findorfail($id);

        $meses = array('Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic');
        $months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');


        $pago->fechaPago= date('d-m-Y', strtotime($pago->fechaPago));
        $pago->pagoDesde= str_replace($months, $meses, date('d-M-Y', strtotime($pago->pagoDesde)));;
        $pago->pagoHasta= str_replace($months, $meses, date('d-M-Y', strtotime($pago->pagoHasta)));;
        $pago->pagoTotal = number_format($pago->pagoTotal,0, '.', '');

        return view('admin.local.detalle-pago')
            ->with('pago', $pago);
    }

    public function deletePago($id)//
    {
        $pago = Pago::findorfail($id);

        $borrarPago = Pago::where('id',$id)->delete();


        if($pago->comprobante != null)
        {
            \File::delete(public_path().'/img/pagos/'.$pago->comprobante);//elimino foto guardada anteriormente
        }


        session()->flash('success', 'Pago Eliminado Exitosamente');
        return redirect()->route('admin.local.listado-pagos', ['id' => $pago->local_user_id]);
    }


//***************** FIN LOCAL **************************************    


/*
**********************************************************************
*********************                  *******************************
********************* ADMIN - USUARIO  *******************************
*********************                  *******************************
**********************************************************************
*/

    //Listado de los Usuarios Registrados
    public function mostrarUsuarios(Request $request)
    {
        
        //$usuario = User::orderBy('id','desc')->paginate(10);
        $usuario = User::BuscarUsuario($request->nombre)->orderBy('id','desc')->paginate(10);
       

        return view('admin.usuario.listado')
            ->with('usuario', $usuario);
    }

    //Muestra Información de un usuario
    public function mostrarUsuario($id)
    {
        $usuario = User::find($id);

        if($usuario->comuna_id != null){
            $usuario->comuna_id = $usuario->comuna->nombre;
            //paso la variable region con el valor=nombreRegion xq no esta en el modelo 
            $region = $usuario->comuna->region->nombre;
        }else{
            $region = '';
        }

        if($usuario->carrera_id != null){
            $usuario->carrera_id = $usuario->carrera->nombre;
        }

        if($usuario->universidad_id != null){
            $usuario->universidad_id = $usuario->universidad->nombre;
        }    

        if($usuario->avatar==null){
            $usuario->avatar = "avatar.jpg";
        }      

        return view('admin.usuario.perfil',compact('region'))
            ->with('usuario', $usuario);
    } 


    //
    public function asignarUsuario($id)//
    {

        $usuario = User::find($id);

        if($usuario == '')
        {
            //return redirect()->action('HomeController@index');
            return view('errors.userNotFound');
        }

        
        $cadena = Cadena::orderby('nombre','ASC')->pluck('nombre','id');
        $local  = Local::where('id',$usuario->local_id)->pluck('nombre','id');

        return view('admin.usuario.asignar')
            ->with('usuario', $usuario)
            ->with('cadena', $cadena)
            ->with('local', $local);
    }    


    public function postAsignarUsuario(Request $request)//
    {

        $usuario = new Local_User($request->all());

        if($usuario == '' || $usuario->user_id == '')
        {
            return view('errors.userNotFound');
        }

        $val = new Local_User();
        //Validación si el usuario ya esta asignado al local
        $val = Local_User::where('user_id', $usuario->user_id)->where('local_id', $usuario->local_id)->first();
        //dd($val->estado);
        //si devuelve algun dato significa que ya esta asignado, si es no lo agrega.
        if(!empty($val)){
            //Este if sirve si el empaque fue desvinculado anteriormente, lo vuelve asignar si es necesario
            if($val->estado == 'Desvinculado'){
                $val->estado = 'Activo';
                $val->rol = $usuario->rol;
                $val->save();
                session()->flash('success', 'Empaque Reincorparado, ya que el usuario había sido desvinculado anteriormente');
                return redirect()->route('admin.usuario.locales', ['id' => $usuario->user_id]);

            }else{
                session()->flash('danger', 'El Usuario ya esta Asignado al Local');
                //return redirect()->route('admin.usuario.asignar', ['id' => $usuario->user_id]);
                return redirect()->route('admin.usuario.locales', ['id' => $usuario->user_id]);
            }
        }else{       

            $usuario->save();
            session()->flash('success', 'Usuario Asignado Con Éxito');
            return redirect()->route('admin.usuario.locales', ['id' => $usuario->user_id]);
        }
        
    }  


    // Locales que tiene asignado un usuario
    public function locales($id)//
    {

        $usuario = User::find($id);

        if($usuario == '')
        {
            //return redirect()->action('HomeController@index');
            return view('errors.userNotFound');
        }

        $local_user = Local_User::where('user_id', $id)->get();
        
        //Si la consulta no devuelve algun registro entra en este if que retorna un mensaje
        if(empty($local_user)){
            session()->flash('danger', 'Usuario sin Local asignado');
        }
        
        
        return view('admin.usuario.locales')
            ->with('usuario', $usuario)
            ->with('local_user', $local_user);
    } 

    //Funcion para editar usuario perteneciente al local
    public function editarUserLocal($id)
    {
        $local_user = Local_User::find($id);

        if($local_user=='')
        {
            return redirect()->action('HomeController@index');
        }
        
        return view('admin.usuario.editar')
            ->with('local_user', $local_user);
    }


    public function putEditarUserLocal(Local_UserRequest $request, $id)
    {
        $local_user = Local_User::findOrFail($id);
        $user = $local_user->user_id;
        $local = $local_user->local_id;

        $local_user->fill($request->all());

        $local_user->user_id  = $user;
        $local_user->local_id = $local;


        if($local_user->estado == 'Desvinculado'){
            $local_user->rol = 'Empaque';
            $local_user->cuposToma = 4;
            $local_user->cuposPreToma = 0;
            $local_user->cuposRepechaje = 10;
            $local_user->inicioCastigo = null;
            $local_user->terminoCastigo = null;
        }

        $local_user->save();
        
        session()->flash('success', 'Modificado Exitosamente');
        return redirect()->route('admin.usuario.editar', ['id' => $local_user->id]);
    }


    public function destroy($id)
    {
        $local_user = Local_User::find($id);

        /*
            Valida si el ID del articulo existe, en el caso de que no exista lo redirecciona al Inicio (nulo)
            Valida si el articulo pertenece al usuario, en el caso de que no pertenezca lo redirecciona al Inicio
        */
        if($local_user=='')
        {
            return redirect()->action('HomeController@index');
        }

        $local_user->estado = 'Desvinculado';
        $local_user->rol = 'Empaque';
        $local_user->cuposToma = 4;
        $local_user->cuposPreToma = 0;
        $local_user->cuposRepechaje = 10;
        $local_user->inicioCastigo = null;
        $local_user->terminoCastigo = null;

        $local_user->save();
        session()->flash('danger', 'Desvinculado con Éxito');

        //return redirect()->route('admin.locales', ['id' => $local_user->user_id]);
        //return redirect()->route('AdminController@mostrarLocales');
        return redirect()->route('admin.local.empaques', ['id' => $local_user->local_id]);
    }


/*
*********************** FIN USUARIO *********************************    
*/

/*
**********************************************************************
*********************                  *******************************
********************* ADMIN - PLANILLA *******************************
*********************                  *******************************
**********************************************************************
*/    
    //cantidad de turnos tomados por  empaque en una planilla
    public function tomados($id)//id planilla
    {
        $planilla = Planilla::find($id);
        if($planilla == '')
        {
            return view ('errors/userNotFound');
        }

        $usuarios = Planilla_Turno_User::select('planilla_turno_user.local_user_id', 'users.nombre', 'users.apellido', 'local_user.rol' )
            ->where([['planilla_id', $planilla->id], ['planilla_turno_user.estado', 'Activo']])
            ->join('local_user', 'local_user.id', '=', 'planilla_turno_user.local_user_id')
            ->join('users', 'users.id', '=', 'local_user.user_id')
            ->selectRaw('count(*) as cantTurnos')
            ->selectRaw('count(case when (tipo = "Toma") or (tipo = "Regalando" and exTipo = "Toma") or (tipo = "Cediendo" and exTipo = "Toma") or (tipo = "Cambiando" and exTipo = "Toma") then 9 end) as toma')
            ->selectRaw('count(case when (tipo ="Repechaje") or (tipo = "Regalando" and exTipo = "Repechaje") or (tipo = "Cediendo" and exTipo = "Repechaje") or (tipo = "Cambiando" and exTipo = "Repechaje") then 1 end) as repechaje')
            ->selectRaw('count(case when (tipo ="Asignado") or (tipo = "Regalando" and exTipo = "Asignado") or (tipo = "Cediendo" and exTipo = "Asignado") or (tipo = "Cambiando" and exTipo = "Asignado") then 1 end) as asignar')
            ->selectRaw('count(case when (tipo ="Pre Toma") or (tipo = "Regalando" and exTipo = "Pre Toma") or (tipo = "Cediendo" and exTipo = "Pre Toma") or (tipo = "Cambiando" and exTipo = "Pre Toma") then 1 end) as pretoma')
            ->selectRaw('count(case when (tipo ="Cedido") or (tipo = "Regalando" and exTipo = "Cedido") or (tipo = "Cediendo" and exTipo = "Cedido") or (tipo = "Cambiando" and exTipo = "Cedido") then 1 end) as cedido')
            ->selectRaw('count(case when (tipo ="Cambio") or (tipo = "Regalando" and exTipo = "Cambio") or (tipo = "Cediendo" and exTipo = "Cambio") or (tipo = "Cambiando" and exTipo = "Cambio") then 1 end) as cambio')
            ->selectRaw('count(case when (tipo ="Regalo") or (tipo = "Regalando" and exTipo = "Regalo") or (tipo = "Cediendo" and exTipo = "Regalo") or (tipo = "Cambiando" and exTipo = "Regalo") then 1 end) as regalo')
            ->groupBy('planilla_turno_user.local_user_id')
            ->paginate(20);

        /*
        $usuarios = Local_User::where('local_id', $planilla->local_id)
                    ->where('estado', '!=', 'Desvinculado')
                    ->paginate(20);

        
        $turnos = DB::table('planilla_turno_user')
                        ->where('planilla_id', $id)
                        ->where('estado', 'Activo')
                        ->select('id','tipo','exTipo','local_user_id')
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
        */

        //dd($usuarios);
        return view('admin.planilla.tomados')
            ->with('planilla', $planilla)
            ->with('usuarios', $usuarios);
    }

    //Muestra un listado de todas las planillas de un local
    public function planillasLocal($id)
    {     

        $planillas = Planilla::where('local_id',$id)->orderBy('id','desc')->paginate(4);
        
        if(count($planillas)<1)
        {
            session()->flash('danger', 'No existen planillas asociadas al local');
        }

        foreach ($planillas as $planilla){
            $planilla->inicioPlanilla = date('d-m-Y', strtotime($planilla->inicioPlanilla));
            $planilla->finPlanilla = date('d-m-Y', strtotime($planilla->finPlanilla));
            $planilla->inicioToma = date('d-m-Y H:i:s', strtotime($planilla->inicioToma));
            $planilla->finToma = date('d-m-Y H:i:s', strtotime($planilla->finToma));
        }

        
        return view('admin.planilla.local')
            ->with('planillas', $planillas)
            ->with('local', $id);
    }

    //Opciones de la planilla de un local
    public function opcionesPlanilla($id)
    {
        $planilla = Planilla::find($id);

        return view('admin.planilla.opciones')
            ->with('planilla', $planilla);
    }

    //GET - Editar planilla del local
    public function getEditarPlanilla($id)
    {
        //$planilla = Planilla::findOrFail($id);
        $planilla = Planilla::where('id', $id)->where('estado', 'Activa')->first();

        if (empty($planilla)) {
            session()->flash('danger', 'La planilla no existe');
            return redirect()->action('HomeController@index');
        }


        //Validación para locales bloqueados
        if($planilla->Local->estado == 'Bloqueado'){
            session()->flash('danger', 'El local se encuentra temporalmente bloqueado.');
            return redirect()->route('admin.local.listado');
        }

        return view('admin.planilla.editar')
            ->with('planilla', $planilla);
    }  

    //PUT - Editar planilla del local
    public function putEditarPlanilla(PlanillaRequest $request, $id)      
    {
        $planilla = Planilla::where('id', $request->id)->where('estado', 'Activa')->first();

        if (empty($planilla)) {
            session()->flash('danger', 'La planilla no existe');
            return redirect()->action('HomeController@index');
        }


        //Validación para locales bloqueados
        if($planilla->Local->estado == 'Bloqueado'){
            session()->flash('danger', 'El local se encuentra temporalmente bloqueado.');
            return redirect()->route('admin.local.listado');
        }


        $local_id = $planilla->local_id;

        $planilla->fill($request->all());

        if($planilla->inicioPreToma == '' && $planilla->finPreToma == '')
        { 
            $planilla->inicioPreToma = null; 
            $planilla->finPreToma = null; 
        }

        if($planilla->inicioRepechaje == '' && $planilla->finRepechaje == '')
        { 
            $planilla->inicioRepechaje = null; 
            $planilla->finRepechaje = null; 
        }   


        $planilla->local_id = $local_id;

        $planilla->save();
        
        session()->flash('success', 'Planilla Modificada Exitosamente');
        return redirect()->route('admin.planilla.editar', ['id' => $planilla->id]);
    }

    //Eliminar Planilla del local
    public function eliminarPlanilla($id)
    {
        $planilla = Planilla::findOrFail($id);

        return view('admin.planilla.eliminar')
            ->with('planilla', $planilla);
    }  

    //Eliminar - DELETE Planilla del local
    public function deletePlanilla($id)
    {
        $planilla = Planilla::findOrFail($id);

        $idLocal = $planilla->local_id;


        $planilla->update(['estado' => 'Eliminada']);//$planilla->delete();

        //tengo que buscar los turnos tomados y pasarlos a "Cancelado
        $turnos = Planilla_Turno_User::where('planilla_id',$id)->update(['estado' => 'Cancelado']);


        session()->flash('danger', '¡Se ha borrado la planilla de forma exitosa!');
        return redirect()->route('admin.planilla.local', ['id' => $idLocal]);
    }   

    public function postCopiarPlanilla($id)          
    {
        $local = Local::findOrFail($id);
        //obtengo la ultima planilla del local especificado
        $ultimaPlanilla = Planilla::where('local_id',$id)->where('estado','Activa')->get()->last();

        
        //Si no existe alguna planilla creada, crea una. Si existe una planilla creada , crea una copia de la anterior
        if(empty($ultimaPlanilla))
        {
            //como no existe una planilla , redirecciono a la vista para crear la primera planilla.
            return redirect()->route('admin.planilla.crear', ['id' => $id]);

        }else{
            $usuariosDeudores = array();
            //obtengo la planilla, le sumo 1 semana a cada atributo de fecha y creo la nueva planilla
            //obtengo los turnos de la planilla que quiero copiar y le sumo 1 seman a la fecha del turno y voy copiando de a uno
            $planilla = new Planilla();

            $planilla->inicioPlanilla = date('Y-m-d', strtotime ('+1 week' , strtotime($ultimaPlanilla->inicioPlanilla)) );
            $planilla->finPlanilla = date('Y-m-d', strtotime ('+1 week' , strtotime($ultimaPlanilla->finPlanilla)) );
            $planilla->inicioToma = date('Y-m-d H:i:s', strtotime ('+1 week' , strtotime($ultimaPlanilla->inicioToma)) );
            $planilla->finToma = date('Y-m-d H:i:s', strtotime ('+1 week' , strtotime($ultimaPlanilla->finToma)) );

            if($ultimaPlanilla->inicioRepechaje == '' && $ultimaPlanilla->finRepechaje == ''){ 
                $planilla->inicioRepechaje = null; 
                $planilla->finRepechaje = null; 
            }else{
                $planilla->inicioRepechaje = date('Y-m-d H:i:s',strtotime('+1 week',strtotime($ultimaPlanilla->inicioRepechaje)));
                $planilla->finRepechaje = date('Y-m-d H:i:s', strtotime('+1 week' ,strtotime($ultimaPlanilla->finRepechaje))); 
            }  

            if($ultimaPlanilla->inicioPreToma == '' && $ultimaPlanilla->finPreToma == ''){ 
                $planilla->inicioPreToma = null; 
                $planilla->finPreToma = null; 
            }else{
                $planilla->inicioPreToma = date('Y-m-d H:i:s',strtotime('+1 week',strtotime($ultimaPlanilla->inicioPreToma)));
                $planilla->finPreToma = date('Y-m-d H:i:s', strtotime('+1 week' ,strtotime($ultimaPlanilla->finPreToma))); 
            }   

            $planilla->local_id = $ultimaPlanilla->local_id;                     
            
            $planilla->save();
            
            //Obtengo los turnos de la planilla pasada y los meto en el array $turnosPasados
            $turnosPasados = Turno::where('planilla_id', $ultimaPlanilla->id)->get();
            //Recorro el array uno por uno para crear los nuevos turnos realizando una copia al anterior y modificando la fecha para la próxima semana.
            foreach ($turnosPasados as $turnoPasado) {

                $turno = new Turno();

                $turno->fecha = date('Y-m-d', strtotime ('+1 week' , strtotime($turnoPasado->fecha)) );
                $turno->inicio = $turnoPasado->inicio;
                $turno->termino = $turnoPasado->termino;
                $turno->cupos = $turnoPasado->cupos;
                $turno->planilla_id = $planilla->id;

                $turno->save();

                if($local->cuenta == 'Premium'){
                    //meto en este array los turnos de coordinadores y los turnos fijos para que sean copiados en la nueva planilla.
                    //si un coordinador regala su coordinación el tipo de la otra persona pasa a "Regalo".
                    //Para copiar el turno del coordinador debe ser de tipo "Asignado".

                    $turnosTomados = Planilla_Turno_User::select('planilla_turno_user.*', 'local_user.estado as userEstado', 'users.nombre', 'users.apellido')
                        ->where('planilla_turno_user.planilla_id', $ultimaPlanilla->id)
                        ->where('planilla_turno_user.turno_id', $turnoPasado->id)
                        ->where('planilla_turno_user.fijo', 'Si')
                        ->join('local_user', 'planilla_turno_user.local_user_id', '=', 'local_user.id')
                        ->join('users', 'users.id', '=', 'local_user.user_id')
                        ->where('local_user.estado', '!=', 'Desvinculado')
                        ->get();

                    //si existe algún turno de coordinador o fijo entra en el if para crear la copia de turnos tomados.
                    if(!empty($turnosTomados)){
                        //recorro el array porque un turno puede tener un coordinador y varios turnos fijos
                        foreach ($turnosTomados as $turnoTomado) {

                            if($turnoTomado->userEstado == "Deudor") {
                                //Acá disminuyo 1 cupo el turno y meto en un array el nombre completo del empaque que no se copió el turno
                                //$cupoActualizado = $turno->cupos - 1;
                                //Turno::where('id', $turno->id)->update(['cupos' =>  $turno->cupos - 1]);
                                $usuariosDeudores[] = $turnoTomado->nombre . ' ' . $turnoTomado->apellido;
                            }else{
                                //posteriormente solo creo el objeto para que se guarde con los datos nuevos del turno y planilla
                                $planillaTurnoUser = new Planilla_Turno_User();

                                $planillaTurnoUser->fijo = $turnoTomado->fijo;
                                $planillaTurnoUser->coordinador = $turnoTomado->coordinador;
                                $planillaTurnoUser->tipo = 'Asignado';
                                $planillaTurnoUser->estado = 'Activo';
                                $planillaTurnoUser->exTipo = null;
                                $planillaTurnoUser->planilla_id = $planilla->id;
                                $planillaTurnoUser->turno_id = $turno->id;
                                $planillaTurnoUser->local_user_id = $turnoTomado->local_user_id;

                                $planillaTurnoUser->save();
                            }
                        }
                    }
                }

            }


            if(empty($usuariosDeudores)) {
                session()->flash('success', 'Planilla Creada del Local '.$local->nombre);
            }else{
                $a_result = array_unique($usuariosDeudores);
                $strDeudores  = implode(", ",$a_result);
                session()->flash('danger', 'Planilla Creada pero los siguientes usuarios son deudores y no se copiaron : '.$strDeudores. '. Revisa la planilla.');
            }
        }

        //return redirect()->route('admin.local.listado');
        return redirect()->route('admin.local.opciones', ['id' => $local->id]);
    }

    public function crearPlanilla($id)
    {

        //Validación si existe el local
        $local = Local::findOrFail($id);

        //validación si existe una planilla creada en ese local
        $planillas = Planilla::where('local_id',$id)->where('Estado','Activa')->orderBy('id','desc')->get();

        if(count($planillas)<1)
        {
            return view('admin.planilla.crear')
                ->with('local', $local);
        }else{
            session()->flash('danger', 'Ya existe una planilla en este Local ');
            return redirect()->route('admin.local.opciones', ['id' => $local->id]);
        }
    }


    public function postCrearPlanilla(CrearPlanillaRequest $request)
    {      
        $planilla = new Planilla($request->all());
        $val_planilla = Planilla::where('local_id',$planilla->local_id)->orderBy('id','desc')->get();
        $local = Local::findOrFail($planilla->local_id);
        
        //Si no existe alguna planilla creada, crea una. Si existe una planilla creada , crea una copia de la anterior
        if(count($val_planilla)<1)
        {
            //date('l') -> obtengo el dia de la semana en ingles de una fecha dada y strtotime de string a fecha.
            $lunes = date('l', strtotime($planilla->inicioPlanilla));
            $domingo = date('l', strtotime($planilla->finPlanilla));
            
            //a la fecha de inicio le sumo 6 dias y deberia coencidir con la fecha "fin de uso" ingresada por el usuario
            $nuevafecha = strtotime ('+6 day' , strtotime($planilla->inicioPlanilla)) ;
            $nuevafecha = date ('Y-m-d', $nuevafecha);//convierto el string al formato fecha Y-m-d
            
            //si la nuevafecha es igual a finPlanilla(finUso) significa que estan bien ingresadas y no entraria en este if.
            if($lunes != 'Monday' || $domingo != 'Sunday' || $nuevafecha != $planilla->finPlanilla )
            {
                session()->flash('warning', 'El "Inicio Uso" debe comenzar desde un día lunes y el "Fin Uso" debe terminar el día domingo de esa misma semana.');
                return redirect()->back()->withInput();
            }

            //si no se pasa los datos a null se guardará por defecto de esta manera 0000-00-00 00:00:00
            if($planilla->inicioPreToma == '' && $planilla->finPreToma == '')
            { 
                $planilla->inicioPreToma = null; 
                $planilla->finPreToma = null; 
            }

            if($planilla->inicioRepechaje == '' && $planilla->finRepechaje == '')
            { 
                $planilla->inicioRepechaje = null; 
                $planilla->finRepechaje = null; 
            }   

            $planilla->save();

            //Acá debo insertar/agregar los turnos por defecto de la planilla.
            //obtengo el inicioPlanilla y lo guardo en una variable para despues sumarle 1 dia por cada ciclo for durante los 7 dias de la semana.
            $diaSiguiente = $planilla->inicioPlanilla;

            for ($i=0; $i < 7; $i++) { 

                //es obligación crear el objeto cada vez que se reemplacen los datos y ser guardados
                $turno = new Turno();
                $turno->fecha = $diaSiguiente;
                $turno->inicio = '08:31:00';
                $turno->termino = '12:30:00';
                $turno->cupos = 4;
                $turno->planilla_id = $planilla->id;
                $turno->save();

                $turno = new Turno();
                $turno->fecha = $diaSiguiente;
                $turno->inicio = '12:31:00';
                $turno->termino = '16:00:00';
                $turno->cupos = 4;
                $turno->planilla_id = $planilla->id;
                $turno->save();

                $turno = new Turno();
                $turno->fecha = $diaSiguiente;
                $turno->inicio = '16:01:00';
                $turno->termino = '19:00:00';
                $turno->cupos = 4;
                $turno->planilla_id = $planilla->id;
                $turno->save();

                $turno = new Turno();
                $turno->fecha = $diaSiguiente;
                $turno->inicio = '19:01:00';
                $turno->termino = '22:15:00';
                $turno->cupos = 4;
                $turno->planilla_id = $planilla->id;
                $turno->save();                                

                //sumo un día a la variable que contiene la fecha inicial del inicioPlanilla.
                $diaSiguiente = strtotime ('+1 day' , strtotime($diaSiguiente)) ;
                $diaSiguiente = date ('Y-m-d', $diaSiguiente);
            }



            session()->flash('warning', 'Se acaba de crear la primera planilla por defecto del local '.$local->nombre);
            //return redirect()->route('admin.local.listado');
            return redirect()->route('admin.planilla.local', ['id' => $local->id]);

        }else{
            return view ('errors/userNotFound');
        }
    }

    public function mostrarTurnosTomados($id)
    {
        $planilla = Planilla::where('id', $id)->where('estado', 'Activa')->first();

        if (empty($planilla)) {
            session()->flash('danger', 'La planilla no existe');
            return redirect()->action('HomeController@index');
        }

        //Esta opción de asignar solo es para locales premmiums
        if($planilla->Local->estado == 'Bloqueado'){
            session()->flash('danger', 'El local se encuentra temporalmente bloqueado.');
            return redirect()->route('admin.local.listado');
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

        //cantidad de cupos exitentes en todos los turnos de una planilla x.
        $cantTurnos = 0;
        $cantTurnosSobra = 0;
        $cantErrores = 0;

        //Obtengo todos los turnos creados por planilla.
        $allTurnos = Turno::where('planilla_id', $id)->get();
        //Recorro cada turno
        foreach ($allTurnos as $allTurno) {
            //Sumo todos los cupos disponible por turno de una planilla.
            $cantTurnos =  $cantTurnos + $allTurno->cupos;
            //Obtengo la cantidad de cupos tomados por turno de una planilla
            $cantCuposTomados = Planilla_Turno_User::where('planilla_id', $id)
                                            ->where('turno_id', $allTurno->id)
                                            ->where('estado', 'Activo')
                                            ->count();
            //Si la cantidad de cupos tomado por turno es mayor a la  cantidad permitida...
            if($cantCuposTomados > $cantTurnos){
                //Resto para obtener si un turno tiene mas turno tomados de lo permitido.
                $res = $cantCuposTomados - $cantTurnos;
                //Y lo voy sumando en la variable "cantErrores" para mostrar al usuario de dicho error.
                $cantErrores = $cantErrores + $res;
            }else{
                //Sino hago una suma del total turnos tomados en una planilla para .....
                $cantTurnosSobra = $cantTurnosSobra + $cantCuposTomados;               
            }
        }
        //Obtener la cantidad de los cupos de los turnos que no han sido tomados.
        $cantTurnosSobra = $cantTurnos - $cantTurnosSobra;
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

        $cantTurnos = $turnos->sum('cupos');
        $cantErrores = 0;

        //recorro el collect y agrego un atributo al collect con los empaques de ese turno
        $turnos->map(function($turno) use ($turnosTomados){

            $users = collect([]);
            $cantTurnosTomados = 0;

            foreach ($turnosTomados as $xxx){

                if ($xxx->turno_id == $turno->id ){

                    if($xxx->coordinador == 'Si'){
                        $users->push(['nombre'=> $xxx->nombre. ' ' . $xxx->apellido, 'rol' =>  'Coordinador']);
                    }else{
                        $users->push(['nombre'=> $xxx->nombre. ' ' . $xxx->apellido, 'rol' =>  'Empaque']);
                    }
                    $cantTurnosTomados = $cantTurnosTomados + 1;
                }
            }

            $turno->turnosTomados = $cantTurnosTomados;
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

            //Calculo los turnos que tengan más de los empaques permitidos
            if($turno->turnosTomados > $turno->cupos){
                $res = $turno->turnosTomados - $turno->cupos;
                $cantErrores = $cantErrores + $res;
            }
        }

        $cantTurnosSobra = $cantTurnos - $turnos->sum('turnosTomados');

        return view('admin.planilla.turnos')
            ->with('planilla', $planilla)
            ->with('lun', $lunes)
            ->with('mar', $martes)
            ->with('mie', $miercoles)
            ->with('jue', $jueves)
            ->with('vie', $viernes)
            ->with('sab', $sabado)
            ->with('dom', $domingo)
            ->with('cantTurnos', $cantTurnos)
            ->with('cantTurnosSobra', $cantTurnosSobra)
            ->with('cantErrores', $cantErrores);

    }

    public function disponible($id)//id planilla
    {
        $planilla = Planilla::find($id);

        if($planilla == '')
        {
            return view ('errors/userNotFound');
        }

        //cantidad de cupos exitentes en todos los turnos de una planilla x.
        $cantTurnos = 0;
        $cantTurnosSobra = 0;
        $cantErrores = 0;
        
        $arrayError = array();
        $arraySobra = array();

        //Obtengo todos los turnos creados por planilla.
        $allTurnos = Turno::where('planilla_id', $id)->orderBy('fecha', 'asc')->orderBy('inicio', 'asc')->get();
        //Recorro cada turno
        foreach ($allTurnos as $allTurno) 
        {
            //Sumo todos los cupos disponible por turno de una planilla.
            $cantTurnos =  $cantTurnos + $allTurno->cupos;
            //Obtengo la cantidad de cupos tomados por turno de una planilla
            $cantCuposTomados = Planilla_Turno_User::where('planilla_id', $id)
                                            ->where('turno_id', $allTurno->id)
                                            ->where('estado', 'Activo')
                                            ->count();
            //Si la cantidad de cupos tomado por turno es mayor a la  cantidad permitida...
            if($cantCuposTomados > $cantTurnos){
                //Resto para obtener si un turno tiene mas turno tomados de lo permitido.
                $res = $cantCuposTomados - $cantTurnos;
                //Y lo voy sumando en la variable "cantErrores" para mostrar al usuario de dicho error.
                $cantErrores = $cantErrores + $res;
                //Meto los datos del turno en un array si es que se cumple la condicción antes mencionada
                $arrayError[] = $allTurno;
                
            }else
            {
                if($allTurno->cupos > $cantCuposTomados)
                {
                    //calculo la cantidad de cupos que sobran por turno
                    $cantTurnosSobra = $allTurno->cupos - $cantCuposTomados;
                    $allTurno->cantTurnosSobra = $cantTurnosSobra;
                    //Meto los datos del turno en un array si es que se cumple la condicción antes mencionada
                    $arraySobra[] = $allTurno; 
                }
            }
        }

        
        //Obtener la cantidad de los cupos de los turnos que no han sido tomados.
        $cantTurnosSobra = $cantTurnos - $cantTurnosSobra;        

        //dd($array);
        return view('admin.planilla.disponible')
            ->with('planilla', $planilla)
            ->with('arraySobra', $arraySobra)
            ->with('arrayError', $arrayError);
    }



    public function editarTurnos($id){//id planilla
        $planilla = Planilla::where('id', $id)->where('estado', 'Activa')->first();

        if (empty($planilla)) {
            session()->flash('danger', 'La planilla no existe');
            return redirect()->action('HomeController@index');
        }

        //Esta opción de asignar solo es para locales premmiums
        if($planilla->Local->estado == 'Bloqueado'){
            session()->flash('danger', 'El local se encuentra temporalmente bloqueado.');
            return redirect()->route('admin.local.listado');
        }

        return view('admin.planilla.editarTurnos')->with('planilla', $planilla);

    }

    public function listTurn($id){

        $turnos = Turno::where('planilla_id', $id)->orderby('fecha', 'asc')->orderby('inicio','asc')->orderby('termino','asc')->get();
        $monday = array();
        $tuesday = array();
        $wednesday = array();
        $thursday = array();
        $friday = array();
        $saturday = array();
        $sunday = array();

        foreach ($turnos as $turno) {
            if (date("D", strtotime($turno->fecha)) == 'Mon'){
                $monday[] = array(
                    'id' => $turno->id,//idTurno
                    'fecha' => date('d-m-Y', strtotime($turno->fecha)),
                    'inicio' => date('H:i', strtotime($turno->inicio)),
                    'termino' => date('H:i', strtotime($turno->termino)),
                    'cupos' => $turno->cupos,
                    'planilla_id' => $turno->planilla_id,
                );
            }elseif (date("D", strtotime($turno->fecha)) == 'Tue'){
                $tuesday[] = array(
                    'id' => $turno->id,//idTurno
                    'fecha' => date('d-m-Y', strtotime($turno->fecha)),
                    'inicio' => date('H:i', strtotime($turno->inicio)),
                    'termino' => date('H:i', strtotime($turno->termino)),
                    'cupos' => $turno->cupos,
                    'planilla_id' => $turno->planilla_id,
                );
            }elseif (date("D", strtotime($turno->fecha)) == 'Wed'){
                $wednesday[] = array(
                    'id' => $turno->id,//idTurno
                    'fecha' => date('d-m-Y', strtotime($turno->fecha)),
                    'inicio' => date('H:i', strtotime($turno->inicio)),
                    'termino' => date('H:i', strtotime($turno->termino)),
                    'cupos' => $turno->cupos,
                    'planilla_id' => $turno->planilla_id,
                );
            }elseif (date("D", strtotime($turno->fecha)) == 'Thu'){
                $thursday[] = array(
                    'id' => $turno->id,//idTurno
                    'fecha' => date('d-m-Y', strtotime($turno->fecha)),
                    'inicio' => date('H:i', strtotime($turno->inicio)),
                    'termino' => date('H:i', strtotime($turno->termino)),
                    'cupos' => $turno->cupos,
                    'planilla_id' => $turno->planilla_id,
                );
            }elseif (date("D", strtotime($turno->fecha)) == 'Fri'){
                $friday[] = array(
                    'id' => $turno->id,//idTurno
                    'fecha' => date('d-m-Y', strtotime($turno->fecha)),
                    'inicio' => date('H:i', strtotime($turno->inicio)),
                    'termino' => date('H:i', strtotime($turno->termino)),
                    'cupos' => $turno->cupos,
                    'planilla_id' => $turno->planilla_id,
                );
            }
            elseif (date("D", strtotime($turno->fecha)) == 'Sat'){
                $saturday[] = array(
                    'id' => $turno->id,//idTurno
                    'fecha' => date('d-m-Y', strtotime($turno->fecha)),
                    'inicio' => date('H:i', strtotime($turno->inicio)),
                    'termino' => date('H:i', strtotime($turno->termino)),
                    'cupos' => $turno->cupos,
                    'planilla_id' => $turno->planilla_id,
                );
            }
            elseif (date("D", strtotime($turno->fecha)) == 'Sun'){
                $sunday[] = array(
                    'id' => $turno->id,//idTurno
                    'fecha' => date('d-m-Y', strtotime($turno->fecha)),
                    'inicio' => date('H:i', strtotime($turno->inicio)),
                    'termino' => date('H:i', strtotime($turno->termino)),
                    'cupos' => $turno->cupos,
                    'planilla_id' => $turno->planilla_id,
                );
            }
        }

        return view('admin/planilla/incluir/listTurn')
            ->with('monday', $monday)
            ->with('tuesday', $tuesday)
            ->with('wednesday', $wednesday)
            ->with('thursday', $thursday)
            ->with('friday', $friday)
            ->with('saturday', $saturday)
            ->with('sunday', $sunday);
    }

    //código que muestra información en la ventana modal para editar el turno
    public function infoTurno($id){//id del turno
        $turno = Turno::find($id);

        $turno->inicio = date('H:i', strtotime($turno->inicio));
        $turno->termino = date('H:i', strtotime($turno->termino));

        return response()->json($turno);
    }

    public function updateTurno(TurnoRequest $request, $id)//TurnoRequest
    {
        if ($request->ajax())
        {
            $turno = Turno::Find($id);
            //if(count($turno)>0) { return response()->json(['success'=>'false']); }

            $turno->fill($request->all());
            $turno->inicio = $turno->inicio.':00';
            $turno->termino = $turno->termino.':00';
            $result = $turno->save();

            if ($result){
                return response()->json(['success'=>'true']);
            }
            else
            {
                return response()->json(['success'=>'false']);
            }
        }
    }

    public function deleteTurno($id, Request $request)//
    {
        //abort(500);

        $turno = Turno::find($id);

        if($turno=='')
        {
            return redirect()->action('HomeController@index');
        }

        $turno->delete();

        $message = "eliminado";
        if($request->ajax()){
            return response()->json([

                    'message'   =>  $message
                ]);
        }

        session()->flash('danger', 'Turno Eliminado Exitosamente');
        return redirect()->route('admin.planilla.editarTurnos', ['id' => $turno->planilla_id]);
    }

    public function postAgregarTurno(AgregarTurnoRequest $request)//Turno
    {
        $planilla = Planilla::where('id', $request->planilla_id)->where('estado', 'Activa')->first();
        if (empty($planilla)) {
            session()->flash('danger', 'La planilla no existe');
            return redirect()->action('HomeController@index');
        }

        foreach ($request->dia as $dia){
            //dd($dia);
            switch ($dia) {
                case 'lunes':
                    $turno = new Turno($request->all());
                    $turno->fecha = $planilla->inicioPlanilla;
                    $turno->inicio = $turno->inicio.':00';
                    $turno->termino = $turno->termino.':00';
                    $turno->save();
                    break;
                case 'martes':
                    $turno = new Turno($request->all());
                    $turno->fecha = date('Y-m-d', strtotime ('+1 day' , strtotime($planilla->inicioPlanilla)));
                    $turno->inicio = $turno->inicio.':00';
                    $turno->termino = $turno->termino.':00';
                    $turno->save();
                    break;
                case 'miercoles':
                    $turno = new Turno($request->all());
                    $turno->fecha = date('Y-m-d', strtotime ('+2 day' , strtotime($planilla->inicioPlanilla)));
                    $turno->inicio = $turno->inicio.':00';
                    $turno->termino = $turno->termino.':00';
                    $turno->save();
                    break;
                case 'jueves':
                    $turno = new Turno($request->all());
                    $turno->fecha = date('Y-m-d', strtotime ('+3 day' , strtotime($planilla->inicioPlanilla)));
                    $turno->inicio = $turno->inicio.':00';
                    $turno->termino = $turno->termino.':00';
                    $turno->save();
                    break;
                case 'viernes':
                    $turno = new Turno($request->all());
                    $turno->fecha = date('Y-m-d', strtotime ('+4 day' , strtotime($planilla->inicioPlanilla)));
                    $turno->inicio = $turno->inicio.':00';
                    $turno->termino = $turno->termino.':00';
                    $turno->save();
                    break;
                case 'sabado':
                    $turno = new Turno($request->all());
                    $turno->fecha = date('Y-m-d', strtotime ('+5 day' , strtotime($planilla->inicioPlanilla)));
                    $turno->inicio = $turno->inicio.':00';
                    $turno->termino = $turno->termino.':00';
                    $turno->save();
                    break;
                case 'domingo':
                    $turno = new Turno($request->all());
                    $turno->fecha = $planilla->finPlanilla;
                    $turno->inicio = $turno->inicio.':00';
                    $turno->termino = $turno->termino.':00';
                    $turno->save();
                    break;
            }
        }

        session()->flash('success', 'Turno Agregado Exitosamente');
        return redirect()->route('admin.planilla.editarTurnos', ['id' => $planilla->id]);
    }

    public function asignar($id){
       $planilla = Planilla::find($id);

        //validación si existe la planilla
        if(empty($planilla))
        { 
            return view('errors.userNotFound');
        }


        //Obtengo todos los turnos tomados.
        $todos = DB::table('planilla_turno_user')
                        ->select('users.nombre','users.apellido','turnos.fecha','turnos.inicio','turnos.termino','turnos.cupos','planilla_turno_user.coordinador','planilla_turno_user.fijo','planilla_turno_user.tipo','planilla_turno_user.id')
                        ->where('planilla_turno_user.planilla_id', $id)
                        ->where('planilla_turno_user.estado', 'Activo')
                        ->join('planillas', 'planilla_turno_user.planilla_id', '=', 'planillas.id')
                        ->join('turnos', 'planilla_turno_user.turno_id', '=', 'turnos.id') 
                        ->orderBy('turnos.fecha', 'asc')
                        ->orderBy('turnos.inicio', 'asc')
                        ->join('local_user', 'planilla_turno_user.local_user_id', '=', 'local_user.id')
                        ->join('users', 'local_user.user_id', '=', 'users.id') 
                        ->get();

        //colecciones por día
        $lunes = collect([]);
        $martes = collect([]);
        $miercoles = collect([]);
        $jueves = collect([]);
        $viernes = collect([]);
        $sabado = collect([]);
        $domingo = collect([]);

        foreach ($todos as $todo) 
        {
            //cambio el formato de  hr:min:seg a hr:min
            $todo->inicio = date('H:i', strtotime($todo->inicio));
            $todo->termino = date('H:i', strtotime($todo->termino));

            //Separo los turnos tomados por dias de la semana.
            if($todo->fecha == $planilla->inicioPlanilla) {
                $lunes->push($todo);
            }elseif ($todo->fecha == date('Y-m-d', strtotime ('+1 day' , strtotime($planilla->inicioPlanilla)))) {
                $martes->push($todo);
            }elseif ($todo->fecha == date('Y-m-d', strtotime ('+2 day' , strtotime($planilla->inicioPlanilla)))) {
                $miercoles->push($todo);
            }elseif ($todo->fecha == date('Y-m-d', strtotime ('+3 day' , strtotime($planilla->inicioPlanilla)))) {
                $jueves->push($todo);
            }elseif ($todo->fecha == date('Y-m-d', strtotime ('+4 day' , strtotime($planilla->inicioPlanilla)))) {
                $viernes->push($todo);
            }elseif ($todo->fecha == date('Y-m-d', strtotime ('+5 day' , strtotime($planilla->inicioPlanilla)))) {
                $sabado->push($todo);
            }elseif ($todo->fecha == $planilla->finPlanilla) {
                $domingo->push($todo);
            }
        }

        //obtengo todos los turnos de la planilla
        $list_turnos = Turno::where('planilla_id', $id)->orderby('fecha','ASC')->orderby('inicio','ASC')->get();
        //array 0=domingo, 1=lunes, etc.
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        foreach ($list_turnos as $list_turno) {
            //funcion date('w') devuelve 0 (para domingo) hasta 6 (para sábado)
            $x = date('w',strtotime($list_turno->fecha));
            //despues el numero lo busco en el array "dias" y lo sobreescribo con el dia de la semana. ej:lunes.
            $list_turno->fecha = $dias[$x];
            //cambio el formato de  hr:min:seg a hr:min
            $list_turno->inicio = date('H:i', strtotime($list_turno->inicio));
            $list_turno->termino = date('H:i', strtotime($list_turno->termino));
        }

        //obtengo los empaques del local para mostrarlos en el list
        $empaques = DB::table('local_user')
                        ->where('local_user.local_id',$planilla->local_id)
                        ->where('local_user.estado', '!=', 'Desvinculado')
                        ->orderBy('local_user.rol','desc')
                        ->join('users', 'local_user.user_id', '=', 'users.id') 
                        ->select('local_user.id', 'users.nombre', 'users.apellido')                   
                        ->get();

        
        return view('admin.planilla.asignar')
            ->with('planilla', $planilla)
            ->with('list_turnos', $list_turnos)
            ->with('empaques', $empaques)
            ->with('lunes', $lunes)
            ->with('martes', $martes)
            ->with('miercoles', $miercoles)
            ->with('jueves', $jueves)
            ->with('viernes', $viernes)
            ->with('sabado', $sabado)
            ->with('domingo', $domingo);

    }

    public function postAsignar(Request $request)
    {
        //Valida si el empaque no es deudor solo si el responsable de pago son los empaques.
        $deudor = Local_User::findOrFail($request->local_user_id);
        if($deudor->Local->responsablePago == 'Empaques' && $deudor->estado == 'Deudor'){
            session()->flash('danger', 'No puedes agregarlo porque es un empaque Deudor');
            return redirect()->route('usuario.planilla.asignar', ['id' => $request->planilla_id]);
        }
        
        $Planilla_Turno_User = new Planilla_Turno_User($request->all());

        
        $turno = Turno::find($Planilla_Turno_User->turno_id);

        $cont_cupos = 0;
        //Validación si el turno que se va a asignar al empaque ya lo tiene
        $turnosTomados = Planilla_Turno_User::where('turno_id', $Planilla_Turno_User->turno_id)->where('estado', 'Activo')->get();
        foreach ($turnosTomados as $turnoTomado) {
            if($turnoTomado->local_user_id == $Planilla_Turno_User->local_user_id){
                session()->flash('danger', 'No se puede asignar porque el usuario ya tiene este mismo turno.');
                return redirect()->route('admin.planilla.asignar', ['id' => $Planilla_Turno_User->planilla_id]);
            }

            $cont_cupos = $cont_cupos + 1;
        }

        if($turno->cupos <= $cont_cupos){
            session()->flash('danger', 'No se puede agregar más empaques porque el cupo del turno está al máximo, puede agregar aún más la cantidad de cupos del turno para poder agregar a más empaques.');
            return redirect()->route('admin.planilla.asignar', ['id' => $Planilla_Turno_User->planilla_id]);
        }

        //Query para validar el tope de horario. La función selecciona todos los turnos del usuario de la planilla que se desea asignar
        $misTurnos = Planilla_Turno_User::where('planilla_id', $Planilla_Turno_User->planilla_id)
                        ->where('local_user_id', $Planilla_Turno_User->local_user_id)
                        ->where('estado', 'Activo')
                        ->get();

        //recorro cada turno para comprobar si existe tope de horario en el inicio y termino, si existe retorna un msj de error.
        foreach ($misTurnos as $miTurno) {
            if($Planilla_Turno_User->Turno->fecha == $miTurno->Turno->fecha)
            {
                
                if(($Planilla_Turno_User->Turno->inicio >= $miTurno->Turno->inicio) && ($Planilla_Turno_User->Turno->inicio <= $miTurno->Turno->termino))
                {
                    session()->flash('danger', 'Existe Tope de Horario en el Turno de Inicio');
                    return redirect()->route('admin.planilla.asignar', ['id' => $Planilla_Turno_User->planilla_id]);
                }

                if(($Planilla_Turno_User->Turno->termino >= $miTurno->Turno->inicio) && ($Planilla_Turno_User->Turno->termino <= $miTurno->Turno->termino))
                {
                    session()->flash('danger', 'Existe Tope de Horario en el Turno de Termino');
                    return redirect()->route('admin.planilla.asignar', ['id' => $Planilla_Turno_User->planilla_id]);
                }
            }
        }


        $Planilla_Turno_User->exTipo = null;
        $Planilla_Turno_User->tipo = "Asignado";
        $Planilla_Turno_User->save();

        session()->flash('success', 'Asignado con Éxito');
        return redirect()->route('admin.planilla.asignar', ['id' => $Planilla_Turno_User->planilla_id]);
    }

    public function deleteUsuarioTurno($id, Request $request){
        //abort(500);
        $turno = Planilla_Turno_User::find($id);

        if($turno=='')
        {
            return redirect()->action('HomeController@index');
        }

        //Si es fijo y "Elimino" el turno lo tengo que mover a "Fijo->No" para que no se copie en la prox. planilla
        if($turno->fijo == 'Si'){
            $turno->fijo = 'No';
        }

        $turno->estado = "Cancelado";
        $turno->update();
        //$turno->delete();
        
        $message = "Turno Eliminado Exitosamente";
        if($request->ajax()){
            return response()->json([

                    'message'   =>  $message
                ]);
        }
        
        session()->flash('danger', 'Turno Eliminado Exitosamente');
        return redirect()->route('admin.planilla.asignar', ['id' => $turno->planilla_id]);
    }

    public function turnoUser($id){
        $turnoUser = Planilla_Turno_User::find($id);

        return response()->json(
            $turnoUser->toArray()
        );
    }

    public function putTurnoUser(Request $request, $id){
        $turnoUser = Planilla_Turno_User::find($id);

        $turnoUser->fill($request->all());

        if($turnoUser->deseo == ''){
            $turnoUser->deseo = null;
        }

        if($turnoUser->exTipo == ''){
            $turnoUser->exTipo = null;
        }     

        $turnoUser->tipo = 'Asignado';
        $turnoUser->save();

        return response()->json([
                "message" => "Listo"
            ]);
    }   

    public function deleteToma($id) {
        $turnos = Planilla_Turno_User::where('planilla_id',$id)->where('fijo', 'No')->update(['estado' => 'Cancelado']);

        session()->flash('success', 'Turnos Eliminados Exitosamente');
        return redirect()->route('admin.planilla.opciones', ['id' => $id]);
    }

    public function deleteTomaDeTurnos($id) {
        $turnos = Planilla_Turno_User::where('planilla_id',$id)
            ->where('tipo', 'Toma')
            ->orWhere(function($q) {
                $q->where([['tipo', 'Regalando'], ['exTipo', 'Toma']]);
            })
            ->orWhere(function($q) {
                $q->where([['tipo', 'Cediendo'], ['exTipo', 'Toma']]);
            })
            ->orWhere(function($q) {
                $q->where([['tipo', 'Cambiando'], ['exTipo', 'Toma']]);
            })
            ->where('fijo', 'No')
            ->update(['estado' => 'Cancelado']);

        session()->flash('success', 'Turnos Eliminados Exitosamente');
        return redirect()->route('admin.planilla.opciones', ['id' => $id]);
    }

    public function deletePreToma($id) {
        $turnos = Planilla_Turno_User::where('planilla_id',$id)
            ->where('tipo', 'Pre Toma')
            ->orWhere(function($q) {
                $q->where([['tipo', 'Regalando'], ['exTipo', 'Pre Toma']]);
            })
            ->orWhere(function($q) {
                $q->where([['tipo', 'Cediendo'], ['exTipo', 'Pre Toma']]);
            })
            ->orWhere(function($q) {
                $q->where([['tipo', 'Cambiando'], ['exTipo', 'Pre Toma']]);
            })
            ->where('fijo', 'No')
            ->update(['estado' => 'Cancelado']);

        session()->flash('success', 'Turnos Eliminados Exitosamente');
        return redirect()->route('admin.planilla.opciones', ['id' => $id]);
    }

    public function deleteRepechaje($id) {
        $turnos = Planilla_Turno_User::where('planilla_id',$id)
            ->where('tipo', 'Repechaje')
            ->orWhere(function($q) {
                $q->where([['tipo', 'Regalando'], ['exTipo', 'Repechaje']]);
            })
            ->orWhere(function($q) {
                $q->where([['tipo', 'Cediendo'], ['exTipo', 'Repechaje']]);
            })
            ->orWhere(function($q) {
                $q->where([['tipo', 'Cambiando'], ['exTipo', 'Repechaje']]);
            })
            ->where('fijo', 'No')
            ->update(['estado' => 'Cancelado']);

        session()->flash('success', 'Turnos Eliminados Exitosamente');
        return redirect()->route('admin.planilla.opciones', ['id' => $id]);
    }






    //ver los turnos tomados del mes actual GET
    public function verTurnos(BuscarTurnosUsuarioRequest $request, $id){

        $usuario = Local_User::findOrFail($id);

        if($request->desde == null || $request->hasta == null){
            //Obtengo el primer día del mes
            $firstDay = date('Y-m-d', mktime(0,0,0, date('m'), 1, date('Y')));
            //Obtengo el ultimo día del mes/año CORRECTO ingresado por el usuario
            $lastDay = date("d", mktime(0,0,0, date('m') +1, 0, date('Y')));

            $turnos = Planilla_Turno_User::
            select('planilla_turno_user.*', 'turnos.fecha', 'turnos.inicio', 'turnos.termino')
                ->where('planilla_turno_user.local_user_id', $id)
                ->join('turnos', 'turnos.id', '=', 'planilla_turno_user.turno_id')
                ->where('fecha' ,'>=', $firstDay)
                ->where('fecha' ,'<=', $lastDay)
                ->orderBy('turnos.fecha', 'asc')
                ->orderBy('turnos.inicio', 'asc')
                ->get();

            return view('admin.usuario.ver-turnos')
                ->with('usuario', $usuario)
                ->with('turnos', $turnos);
        }else{
            $turnos = Planilla_Turno_User::
            select('planilla_turno_user.*', 'turnos.fecha', 'turnos.inicio', 'turnos.termino')
                ->where('planilla_turno_user.local_user_id', $id)
                ->join('turnos', 'turnos.id', '=', 'planilla_turno_user.turno_id')
                ->where('fecha' ,'>=', $request->desde)
                ->where('fecha' ,'<=', $request->hasta)
                ->orderBy('turnos.fecha', 'asc')
                ->orderBy('turnos.inicio', 'asc')
                ->get();

            return view('admin.usuario.ver-turnos')
                ->with('usuario', $usuario)
                ->with('turnos', $turnos);
        }
    }

/*
*********************** FIN PLANILLA *********************************    
*/


    public function postAgregar(Request $request)
    {

        //dd($request->local);
        //dd($request->rut);

        //**********        Validar RUT            ****************

        $fil2   = strip_tags($request->rut);//Retira las etiquetas HTML y PHP de un string
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


        //si es 0 = rut inconrrecto, si devuelve el rut está correcto.
        if($resultFinal == 0)
        {
            session()->flash('danger', 'Rut Incorrecto.');
            return redirect()->route('admin.local.empaques', ['id' => $request->local]);
        }

        //*******     FIN VALIDACIÓN DEL RUT    *******

        //quitar caracteres al rut y agregar un guión antes del digito verificador
        $fil2   = strip_tags($request->rut);//Retira las etiquetas HTML y PHP de un string
        $result = preg_replace('([^A-Za-z0-9])', '', $fil2); //solo permite letras y numeros, elimina el resto
        //agrego el guion al rut
        $x = substr($result, 0, $lon-1)."-".substr($result, $lon-1 ,$lon);

        $request->rut = $x;

        //VALIDAR SI EL LOCAL ES PREMIUM****



        //Busco el ID del user según su rut.
        $user = User::select('id')->where('rut', $request->rut)->first();
        //dd($user->id);

        if(empty($user))
        {
            session()->flash('danger', 'El empaque No está registrado.');
            return redirect()->route('admin.local.empaques', ['id' => $request->local]);
        }

        //Busco si el usuario ya fue agregado al local anteriormente y lo paso de "desvinculado" a "activo", en el caso de que ya este agregado al local informo que ya pertenece al super.
        $registrado = Local_User::where('local_id', $request->local)->where('user_id', $user->id)->first();

        if(!empty($registrado))
        {
            if($registrado->estado != 'Desvinculado'){
                session()->flash('info', 'El empaque ya pertenece al local.');
                return redirect()->route('admin.local.empaques', ['id' => $request->local]);
            }else{
                //Responsable Emp. o Enc.
                $deudas = Pago::where('local_user_id', $registrado->id)
                    ->where('pagos.estado', 'Pendiente')
                    ->get();

                if(!empty($deudas)){
                    //Tiene deudas pendientes
                    $deudaTotal=0;

                    foreach ($deudas as $deuda){
                        $deudaTotal = $deudaTotal + $deuda->pagoTotal;
                    }

                    session()->flash('danger','El empaque debe $'.$deudaTotal. ' pesos, correspondiente a ' .count($deudas). ' mes(es).');//meses deuda
                    return redirect()->route('usuario.local.empaques', ['id' => $request->local]);
                }else{
                    //Lo muevo a activo si no tiene deudas pendientes

                    Local_User::where('id', $registrado->id)->update(['estado' => 'Activo']);

                    session()->flash('success','El empaque fue reincorparado con éxito.');//meses deuda
                    return redirect()->route('usuario.local.empaques', ['id' => $request->local]);
                }
            }
        }


        //Si el usuario es la primera vez que se lo va agregar al local, se lo agrega con este código.
        $local_user = new Local_User();
        $local_user->cuposToma = 4;
        $local_user->cuposPreToma = 0;
        $local_user->cuposRepechaje = 10;
        $local_user->estado = 'Activo';
        $local_user->rol = 'Empaque';
        $local_user->inicioCastigo = null;
        $local_user->terminoCastigo = null;
        $local_user->local_id = $request->local;
        $local_user->user_id = $user->id;

        $local_user->save();


        session()->flash('success', 'Agregado exitosamente');
        return redirect()->route('admin.local.empaques', ['id' => $request->local]);

    }

    public function getLocales(Request $request, $user, $id){
        if($request->ajax()){
            $towns = Local::buscarLocales($id);
            return response()->json($towns);
        }
    }


    public function pagoEncargado($id){

        $infoLocal = Local::findOrFail($id);

        $pagos = Pago::where('pagos.paga', 'Encargado')
            ->join('local_user', 'pagos.local_user_id', '=', 'local_user.id')
            ->where('local_user.local_id', $infoLocal->id)
            ->orderBy('pagos.pagoDesde', 'desc')
            ->paginate(12);

        foreach ($pagos as $pago){
            $pago->pagoDesde = date('d-m-Y', strtotime($pago->pagoDesde));
            $pago->pagoHasta = date('d-m-Y', strtotime($pago->pagoHasta));
            $pago->pagoTotal = number_format($pago->pagoTotal,0, '', '.');
        }

        return view('admin.local.pago-encargado')
            ->with('local', $infoLocal)
            ->with('pagos', $pagos);
    }

    public function detalleCobroMensual(Request $request){

        $validatedData = $request->validate([
            'local' => 'required|integer',
            'fecha' => 'required|date_format:"Y-m"',
        ]);


        $local = Local::find($request->local);


        $mes= date('m', strtotime($request->fecha));
        $ano= date('Y', strtotime($request->fecha));
        //Obtengo el primer día del mes/año CORRECTO ingresado por el usuario
        $firstDay = date('Y-m-d', mktime(0,0,0, date($mes), 1, date($ano)));
        //Obtengo el ultimo día del mes/año CORRECTO ingresado por el usuario
        $lastDay = date('Y-m-d', mktime(0,0,0, date($mes) +1, 0, date($ano)));

        //selecciono los ids de los empaques de un local (incluyendo los desvinculados)
        $idUsers = Local_User::select('id')->where('local_id', $request->local)->get();

        //obtengo la información de los empaques que tomaron 1 o más turnos
        $infoUsers = Planilla_Turno_User::select('local_user.estado', 'local_user.id as idUserLocal', 'users.rut', 'users.nombre', 'users.apellido')
            ->whereIn('planilla_turno_user.local_user_id', $idUsers)
            ->where('planilla_turno_user.created_at', '>=', $firstDay)
            ->where('planilla_turno_user.created_at', '<=', $lastDay )
            ->join('local_user', 'planilla_turno_user.local_user_id', '=', 'local_user.id')
            ->where('local_user.local_id', $request->local)
            ->join('users', 'local_user.user_id', '=', 'users.id')
            ->distinct('local_user.local_id')
            ->get();

        //Cuento la cantidad de empaques que tomaron turnos en el mes
        $cantUserTakeTurn = count($infoUsers);

        return view('admin.local.detalle-cobro-mensual')
            ->with('cantUserTakeTurn', $cantUserTakeTurn)
            ->with('infoUsers', $infoUsers)
            ->with('local', $request->local)
            ->with('fecha', $request->fecha)
            ->with('precio', $local->precioMensual);
    }

    public function detalleTurnosTomados(Request $request){

        $validatedData = $request->validate([
            'local' => 'required|integer',
            'user' => 'required|integer',
            'fecha' => 'required|date_format:"Y-m"',
        ]);

        $empaque = Local_User::findOrFail($request->user);


        $mes= date('m', strtotime($request->fecha));
        $ano= date('Y', strtotime($request->fecha));

        //Obtengo el primer día del mes/año CORRECTO ingresado por el usuario
        $firstDay = date('Y-m-d', mktime(0,0,0, date($mes), 1, date($ano)));
        //Obtengo el ultimo día del mes/año CORRECTO ingresado por el usuario
        $lastDay = date('Y-m-d', mktime(0,0,0, date($mes) +1, 0, date($ano)));

        $turnos = Planilla_Turno_User::where('local_user_id', $request->user)
            ->where('planilla_turno_user.created_at', '>=', $firstDay)
            ->where('planilla_turno_user.created_at', '<=', $lastDay)
            ->get();

        foreach ($turnos as $turno){
            $turno->Turno->fecha = date('d-m-Y', strtotime($turno->Turno->fecha));
            $turno->Turno->inicio = date('H:i', strtotime($turno->Turno->inicio));
            $turno->Turno->termino = date('H:i', strtotime($turno->Turno->termino));
        }

        return view('admin.local.detalle-turnos-tomados')
            ->with('turnos', $turnos)
            ->with('request', $request);
    }

//return redirect()->action('ArticleController@articulos');

//Redirecciono de vuelta con los valores de los input ingresados
//return redirect()->back()->withInput();

}
