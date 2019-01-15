<?php

/*

Route::get('/', function () {
    return view('welcome');
});
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');



/*
**********************************************************************
**********************************************************************
***********************----> Home <----******************************
**********************************************************************
**********************************************************************
*/
Route::get('home', function () {
    return redirect('/');
});

//Route::get('prueba', 'HomeController@prueba');
Route::get('tarifas', 'HomeController@tarifas');
Route::get('contacto', 'HomeController@contacto');
Route::get('solicitar-demo', 'HomeController@solicitarDemo');
$this->post('home.solicitar-demo', 'HomeController@postSolicitarDemo');
Route::get('tutoriales', 'HomeController@tutoriales');
Route::get('alianzas', 'HomeController@alianzas');
Route::get('sobre-nosotros', 'HomeController@nosotros');
Route::get('tomar-turnos-online', 'HomeController@toma');
Route::get('propineros-supermercados', 'HomeController@propineros');
Route::get('supermercados-chile', 'HomeController@supermercados');
Route::get('error', 'HomeController@error');
//falta store
$this->post('home.store', 'HomeController@store');
/*
Route::post('{id}/store',[
    'as'        =>      'home.store',
    'uses'      =>      'HomeController@store'
]);
*/



// Authentication routes... Login(get,post),Register,reset,email...
Auth::routes();
//$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
//$this->post('login', 'Auth\LoginController@login');
$this->get('logout', 'Auth\LoginController@logout')->name('logout');

/*---------------------------------------------------------*/

//Registro Personalizado
/*
Route::get('registro', [
    'uses'	=>	'UserController@getRegistro',
    'as'	=>	'user.registro'
]);
*/
$this->get('registro', 'UserController@getRegistro')->name('registro');
Route::post("postRegistro","UserController@postRegistro");




/*---------------------------------------------------------*/
Route::group(['prefix' => 'user'], function () {


    /* Editar Usuario DropDownList*/
    Route::get('{user}/regiones/{id}','UserController@getRegiones');
    Route::get('{user}/comunas/{id}','UserController@getComunas');

    /* Buscar Tatuadores DropDownList*/
    Route::get('regiones/{id}','UserController@getRegiones2');
    Route::get('comunas/{id}','UserController@getComunas2');

});

/*
**********************************************************************
**********************************************************************
***********************----> ADMIN <----******************************
**********************************************************************
**********************************************************************
*/

Route::group(['prefix' => 'admin'], function () {

    /*
    **********************************************************************
    ************** ----> ADMIN - USUARIO <---- ***************************
    **********************************************************************
    */

    //Listado de usuarios registrados - Dir => /admin/usuario
    Route::get('usuario',[
        'as'	=>	'admin.usuario.listado',
        'uses'	=>	'AdminController@mostrarUsuarios'
    ]);

    //Listado de usuarios registrados - Dir => /admin/usuario/listado
    Route::get('usuario/listado',[
        'as'	=>	'admin.usuario.listado',
        'uses'	=>	'AdminController@mostrarUsuarios'
    ]);

    //Muestra información del usuario  -- NO FUNCIONA
    Route::get('usuario/{id}/perfil',[
        'as'	=>	'admin.usuario.perfil',
        'uses'	=>	'AdminController@mostrarUsuario'
    ]);

    //Agregar usuario a un local
    Route::get('usuario/{id}/asignar',[
        'as'	=>	'admin.usuario.asignar',
        'uses'	=>	'AdminController@asignarUsuario'
    ]);

    //Post de agregar usuario a un local
    $this->post('postAsignarUsuario', 'AdminController@postAsignarUsuario');

    /* DropDownList en Cascada en la vista admin/usuario/asignar */
    Route::get('usuario/{user}/locales/{id}','AdminController@getLocales');

    Route::get('usuario/{id}/locales',[
        'as'	=>	'admin.usuario.locales',
        'uses'	=>	'AdminController@locales'
    ]);

    //Editar usuario de un local
    Route::get('usuario/{id}/editar',[
        'as'	=>	'admin.usuario.editar',
        'uses'	=>	'AdminController@editarUserLocal'
    ]);

    //Put de Editar usuario de un local
    Route::put('{id}/putEditarUserLocal',[
        'as'	=>	'admin.usuario.putEditarUserLocal',
        'uses'	=>	'AdminController@putEditarUserLocal'
    ]);


    //Listado de turnos tomados
    Route::get('usuario/{id}/ver-turnos',[
        'as'	=>	'admin.usuario.ver-turnos',
        'uses'	=>	'AdminController@verTurnos'
    ]);

    /*
    **********************************************************************
    ************** ----> ADMIN - PLANILLA <---- **************************
    **********************************************************************
    */
    //Opciones de la planillas de un local
    Route::get('planilla/{id}/tomados',[
        'as'	=>	'admin.planilla.tomados',
        'uses'	=>	'AdminController@tomados'
    ]);

    //Listado de planillas de un local
    Route::get('planilla/local/{id}',[
        'as'	=>	'admin.planilla.local',
        'uses'	=>	'AdminController@planillasLocal'
    ]);

    //Opciones de la planillas de un local
    Route::get('planilla/{id}/opciones',[
        'as'	=>	'admin.planilla.opciones',
        'uses'	=>	'AdminController@opcionesPlanilla'
    ]);

    //Imprimir planilla del local
    Route::get('planilla/{id}/pdf',[
        'as'	=>	'admin.planilla.pdf',
        'uses'	=>	'PdfController@imprimir'
    ]);

    //Imprimir cantidad de turnos tomados por empaque
    Route::get('planilla/{id}/cant-turnos-tomados',[
        'as'	=>	'admin.planilla.cant-turnos-tomados',
        'uses'	=>	'PdfController@pdfCantTurnosTomadosAdmin'
    ]);


    //GET - Editar planilla del local
    Route::get('planilla/{id}/editar', 'AdminController@getEditarPlanilla')->name('admin.planilla.editar');
    //PUT - Editar planilla del local
    Route::put('planilla/{id}/editar', 'AdminController@putEditarPlanilla');


    //Eliminar planillas del local
    Route::get('planilla/{id}/eliminar',[
        'as'	=>	'admin.planilla.eliminar',
        'uses'	=>	'AdminController@eliminarPlanilla'
    ]);

    //Delete de Eliminar planilla de un local
    Route::delete('{id}/deletePlanilla',[
        'as'	=>	'admin.planilla.deletePlanilla',
        'uses'	=>	'AdminController@deletePlanilla'
    ]);

    //Copiar planilla en un local - solo si existe una, sino te deriva a otra ruta
    Route::post('{id}/postCopiarPlanilla',[
        'as'	=>	'admin.planilla.postCopiarPlanilla',
        'uses'	=>	'AdminController@postCopiarPlanilla'
    ]);

    //Crear PRIMERA planilla del local
    Route::get('planilla/{id}/crear',[
        'as'	=>	'admin.planilla.crear',
        'uses'	=>	'AdminController@crearPlanilla'
    ]);

    //POST crear Planilla
    $this->post('postCrearPlanilla', 'AdminController@postCrearPlanilla');

    //Mostrar Turnos Tomados
    Route::get('planilla/{id}/turnos',[
        'as'	=>	'admin.planilla.turnos',
        'uses'	=>	'AdminController@mostrarTurnosTomados'
    ]);

    //Mostrar Estadística de la Planilla
    Route::get('planilla/{id}/disponible',[
        'as'	=>	'admin.planilla.disponible',
        'uses'	=>	'AdminController@disponible'
    ]);

    Route::get('planilla/{id}/editarTurnos',[
        'as'	=>	'admin.planilla.editarTurnos',
        'uses'	=>	'AdminController@editarTurnos'
    ]);

    Route::get('planilla/{id}/listTurn',[
        'as'	=>	'admin.planilla.incluir.listTurn',
        'uses'	=>	'AdminController@listTurn'
    ]);

    Route::get('planilla/{id}/infoTurno',[
        'as'	=>	'admin.planilla.infoTurno',
        'uses'	=>	'AdminController@infoTurno'
    ]);

    //PUT - Editar turno de una planilla
    Route::put('planilla/{id}/updateTurno', 'UsuarioController@updateTurno');

    //POST - Agregar  turno
    Route::post('usuario/planilla/agregarTurno', 'AdminController@postAgregarTurno');

    //Delete de Eliminar turno de una planilla
    Route::delete('planilla/{id}/deleteTurno',[
        'as'	=>	'admin.planilla.deleteTurno',
        'uses'	=>	'AdminController@deleteTurno'
    ]);


    //Asignar Empaque a un turno de una planilla
    Route::get('planilla/{id}/asignar',[
        'as'	=>	'admin.planilla.asignar',
        'uses'	=>	'AdminController@asignar'
    ]);
    //POST asignar Turno
    $this->post('postAsignar', 'AdminController@postAsignar');

    //Delete de Eliminar Usuario que tiene un turno de una planilla
    Route::delete('{id}/deleteUsuarioTurno',[
        'as'	=>	'admin.planilla.deleteUsuarioTurno',
        'uses'	=>	'AdminController@deleteUsuarioTurno'
    ]);

    //Mostrar Informacion de un turno de Planilla_Turno_User
    Route::get('planilla/turnoUser/{id}',[
        'as'	=>	'admin.planilla.turnoUser',
        'uses'	=>	'AdminController@turnoUser'
    ]);

    //Editar Informacion de un turno de Planilla_Turno_User
    Route::put('{id}/putTurnoUser',[
        'as'	=>	'admin.planilla.putTurnoUser',
        'uses'	=>	'AdminController@putTurnoUser'
    ]);

    //Elimina todos los turnos de una planilla
    Route::delete('{id}/deleteToma',[
        'as'	=>	'admin.planilla.deleteToma',
        'uses'	=>	'AdminController@deleteToma'
    ]);

    //Elimina todos los turnos tomados en la toma de turnos de una planilla
    Route::delete('{id}/deleteTomaDeTurnos',[
        'as'	=>	'admin.planilla.deleteTomaDeTurnos',
        'uses'	=>	'AdminController@deleteTomaDeTurnos'
    ]);

    //Elimina todos los turnos tomados en la pre toma de una planilla
    Route::delete('{id}/deletePreToma',[
        'as'	=>	'admin.planilla.deletePreToma',
        'uses'	=>	'AdminController@deletePreToma'
    ]);

    //Elimina todos los turnos tomados en el repechaje de una planilla
    Route::delete('{id}/deleteRepechaje',[
        'as'	=>	'admin.planilla.deleteRepechaje',
        'uses'	=>	'AdminController@deleteRepechaje'
    ]);
    /*
    **********************************************************************
    ************** ----> ADMIN - LOCAL   <---- ***************************
    **********************************************************************
    */

    //Dir => admin/locales/index
    Route::get('local',[
        'as'	=>	'admin.local.listado',
        'uses'	=>	'AdminController@mostrarLocales'
    ]);

    Route::get('local/listado',[
        'as'	=>	'admin.local.listado',
        'uses'	=>	'AdminController@mostrarLocales'
    ]);

    Route::get('local/agregar',[
        'as'	=>	'admin.local.agregar',
        'uses'	=>	'AdminController@agregarLocal'
    ]);

    $this->post('postAgregarLocal', 'AdminController@postAgregarLocal');

    Route::get('local/{id}/opciones',[
        'as'	=>	'admin.local.opciones',
        'uses'	=>	'AdminController@opciones'
    ]);

    Route::get('local/{id}/editar',[
        'as'	=>	'admin.local.editar',
        'uses'	=>	'AdminController@editarLocal'
    ]);

    Route::put('local/putActualizarLocal/{id}',[
        'as'	=>	'admin.local.putActualizarLocal',
        'uses'	=>	'AdminController@putActualizarLocal'
    ]);

    Route::get('local/{id}/postulaciones',[
        'as'	=>	'admin.local.postulaciones',
        'uses'	=>	'AdminController@postulaciones'
    ]);

    Route::get('local/{id}/agregarPostulacion',[
        'as'	=>	'admin.local.agregarPostulacion',
        'uses'	=>	'AdminController@agregarPostulacion'
    ]);

    $this->post('postAgregarPostulacion', 'AdminController@postAgregarPostulacion');


    Route::get('local/editarPostulacion/{id}',[
        'as'	=>	'admin.local.editarPostulacion',
        'uses'	=>	'AdminController@editarPostulacion'
    ]);

    Route::put('local/putEditarPostulacion/{id}',[
        'as'	=>	'admin.local.putEditarPostulacion',
        'uses'	=>	'AdminController@putEditarPostulacion'
    ]);

    Route::get('local/eliminarPostulacion/{id}',[
        'as'	=>	'admin.local.eliminarPostulacion',
        'uses'	=>	'AdminController@eliminarPostulacion'
    ]);

    Route::delete('local/deleteEliminarPostulacion/{id}',[
        'as'	=>	'admin.local.deleteEliminarPostulacion',
        'uses'	=>	'AdminController@deleteEliminarPostulacion'
    ]);

    Route::get('local/resultados/{id}',[
        'as'	=>	'admin.local.resultados',
        'uses'	=>	'AdminController@resultados'
    ]);

    Route::get('local/{id}/eliminar',[
        'as'	=>	'admin.local.eliminar',
        'uses'	=>	'AdminController@eliminarLocal'
    ]);

    Route::delete('local/deleteEliminarLocal/{id}',[
        'as'	=>	'admin.local.deleteEliminarLocal',
        'uses'	=>	'AdminController@deleteEliminarLocal'
    ]);

    Route::get('local/{id}/empaques/{estado?}',[
        'as'	=>	'admin.local.empaques',
        'uses'	=>	'AdminController@empaques'
    ]);

    //Muestra el perfil del usuario perteneciente al local
    Route::get('local/{idLocal}/perfil/{id}',[
        'as'	=>	'admin.local.perfil',
        'uses'	=>	'AdminController@perfil'
    ]);

    //Editar Usuario del Local  | admin/local/usuario
    Route::get('local/usuario/{id}',[
        'as'	=>	'admin.local.usuario',
        'uses'	=>	'AdminController@editarUsuarioLocal'
    ]);

    //Actualizar (PUT) usuario local | admin/local/usuario
    Route::put('local/putUsuarioLocal/{id}',[
        'as'	=>	'admin.local.putUsuarioLocal',
        'uses'	=>	'AdminController@putUsuarioLocal'
    ]);


    Route::put('local/putDesvincularUsuarioLocal/{id}',[
        'as'	=>	'admin.local.putDesvincularUsuarioLocal',
        'uses'	=>	'AdminController@putDesvincularUsuarioLocal'
    ]);



    $this->post('postAgregar', 'AdminController@postAgregar');

    $this->post('admin.local.cuposTomaPorDefecto', 'AdminController@cuposTomaPorDefecto');

    $this->post('admin.local.cuposPreTomaPorDefecto', 'AdminController@cuposPreTomaPorDefecto');

    $this->post('admin.local.cuposRepechajePorDefecto', 'AdminController@cuposRepechajePorDefecto');

    Route::get('busqueda',[
        'as'	=>	'admin.local.busqueda',
        'uses'	=>	'AdminController@buscarUsuario'
    ]);

    Route::get('local/listado-pagos/{id}',[
        'as'	=>	'admin.local.listado-pagos',
        'uses'	=>	'AdminController@listadoPagos'
    ]);

    Route::get('local/agregar-pago/{id}',[
        'as'	=>	'admin.local.agregar-pago',
        'uses'	=>	'AdminController@agregarPago'
    ]);

    $this->post('admin.local.postAgregarPago', 'AdminController@postAgregarPago');

    Route::get('local/editar-pago/{id}',[
        'as'	=>	'admin.local.editar-pago',
        'uses'	=>	'AdminController@editarPago'
    ]);

    $this->put('admin.local.putEditarPago', 'AdminController@putEditarPago');

    Route::get('local/detalle-pago/{id}',[
        'as'	=>	'admin.local.detalle-pago',
        'uses'	=>	'AdminController@detallePago'
    ]);

    Route::delete('local/deletePago/{id}',[
        'as'	=>	'admin.local.deletePago',
        'uses'	=>	'AdminController@deletePago'
    ]);

    //Rendimiento del local
    Route::get('local/{id}/rendimiento',[
        'as'	=>	'admin.local.rendimiento',
        'uses'	=>	'AdminController@rendimiento'
    ]);

    //buscador de la cantidad de turnos tomados por todos los usuarios del local
    Route::get('local/{id}/cantidad-turnos-asignados',[
        'as'	=>	'admin.local.cantidad-turnos-asignados',
        'uses'	=>	'AdminController@cantidadTurnosAsignados'
    ]);

    //New Update
    Route::get('local/{id}/pago-encargado',[
        'as'	=>	'admin.local.pago-encargado',
        'uses'	=>	'AdminController@pagoEncargado'
    ]);

    //Listado de usuarios registrados - Dir => /admin/usuario
    Route::get('local/detalle-cobro-mensual',[
        'as'	=>	'admin.local.detalle-cobro-mensual',
        'uses'	=>	'AdminController@detalleCobroMensual'
    ]);

    //Muestra los turnos tomados por el empaque para que se prosiga a cobrar (Incluye regalados, cambios y tomas)
    Route::get('local/detalle-turnos-tomados',[
        'as'	=>	'admin.local.detalle-turnos-tomados',
        'uses'	=>	'AdminController@detalleTurnosTomados'
    ]);
    //End New Update

});

/*
**********************************************************************
**********************************************************************
***********************----> Usuario <----******************************
**********************************************************************
**********************************************************************
*/
Route::group(['prefix' => 'usuario'], function () {

    //Opciones de la planillas de un local
    Route::get('planilla/{id}/tomados',[
        'as'	=>	'usuario.planilla.tomados',
        'uses'	=>	'UsuarioController@tomados'
    ]);

    //ver todos los locales que tengo indiferente el rol (encargado, empaque, coordinador)
    Route::get('mis-locales',[
        'as'	=>	'usuario.mis-locales',
        'uses'	=>	'UsuarioController@misLocales'
    ]);


    //ver todos los locales que tengo indiferente el rol (encargado, empaque, coordinador)
    Route::get('{id}/faltas',[
        'as'	=>	'usuario.faltas',
        'uses'	=>	'UsuarioController@faltas'
    ]);

    //Listado de turnos tomados
    Route::get('{id}/ver-turnos',[
        'as'	=>	'usuario.ver-turnos',
        'uses'	=>	'UsuarioController@verTurnos'
    ]);

    /*
    **********************************************************************
    ************** ----> USUARIO - Local <---- ***************************
    **********************************************************************
    */

    //Listado de pagos usuario - vista desde la cuenta del encargado
    Route::get('{id}/ver-pagos',[
        'as'	=>	'usuario.ver-pagos',
        'uses'	=>	'UsuarioController@verPagosUsuario'
    ]);

    //Listado de pagos usuario - vista desde la cuenta del empaque
    Route::get('{id}/listado-pagos',[
        'as'	=>	'usuario.listado-pagos',
        'uses'	=>	'UsuarioController@listadoPagos'
    ]);

    Route::get('local/detalle-pago/{id}',[
        'as'	=>	'usuario.local.detalle-pago',
        'uses'	=>	'UsuarioController@detallePago'
    ]);

    //
    Route::get('local/{id}/pago-encargado',[
        'as'	=>	'usuario.local.pago-encargado',
        'uses'	=>	'UsuarioController@pagoEncargado'
    ]);

    //Listado de usuarios registrados - Dir => /admin/usuario
    Route::get('local/detalle-cobro-mensual',[
        'as'	=>	'usuario.local.detalle-cobro-mensual',
        'uses'	=>	'UsuarioController@detalleCobroMensual'
    ]);

    //Muestra los turnos tomados por el empaque para que se prosiga a cobrar (Incluye regalados, cambios y tomas)
    Route::get('local/detalle-turnos-tomados',[
        'as'	=>	'usuario.local.detalle-turnos-tomados',
        'uses'	=>	'UsuarioController@detalleTurnosTomados'
    ]);

    //Listado de planillas de un local
    Route::get('local/{id}/listado-planillas',[
        'as'	=>	'usuario.local.listado-planillas',
        'uses'	=>	'UsuarioController@listadoPlanillas'
    ]);

    //Listado de planillas de un local
    Route::get('local/{id}/ver-planillas',[
        'as'	=>	'usuario.local.ver-planillas',
        'uses'	=>	'UsuarioController@verplanillas'
    ]);

    $this->post('postAgregar', 'UsuarioController@postAgregar');

    $this->post('usuario.local.cuposTomaPorDefecto', 'UsuarioController@cuposTomaPorDefecto');

    $this->post('usuario.local.cuposPreTomaPorDefecto', 'UsuarioController@cuposPreTomaPorDefecto');

    $this->post('usuario.local.cuposRepechajePorDefecto', 'UsuarioController@cuposRepechajePorDefecto');

    Route::get('busqueda',[
        'as'	=>	'usuario.local.busqueda',
        'uses'	=>	'UsuarioController@buscarUsuario'
    ]);

    //opciones del local
    Route::get('local/{id}/opciones',[
        'as'	=>	'usuario.local.opciones',
        'uses'	=>	'UsuarioController@opciones'
    ]);

    //Listado postulaciones del local
    Route::get('local/{id}/postulaciones',[
        'as'	=>	'usuario.local.postulaciones',
        'uses'	=>	'UsuarioController@postulaciones'
    ]);

    Route::get('local/{id}/agregarPostulacion',[
        'as'	=>	'usuario.local.agregarPostulacion',
        'uses'	=>	'UsuarioController@agregarPostulacion'
    ]);

    $this->post('local.postAgregarPostulacion', 'UsuarioController@postAgregarPostulacion');

    Route::get('local/editarPostulacion/{id}',[
        'as'	=>	'usuario.local.editarPostulacion',
        'uses'	=>	'UsuarioController@editarPostulacion'
    ]);

    Route::put('local/putEditarPostulacion/{id}',[
        'as'	=>	'usuario.local.putEditarPostulacion',
        'uses'	=>	'UsuarioController@putEditarPostulacion'
    ]);

    Route::get('local/eliminarPostulacion/{id}',[
        'as'	=>	'usuario.local.eliminarPostulacion',
        'uses'	=>	'UsuarioController@eliminarPostulacion'
    ]);

    Route::delete('local/deleteEliminarPostulacion/{id}',[
        'as'	=>	'usuario.local.deleteEliminarPostulacion',
        'uses'	=>	'UsuarioController@deleteEliminarPostulacion'
    ]);

    Route::get('local/resultados/{id}',[
        'as'	=>	'usuario.local.resultados',
        'uses'	=>	'UsuarioController@resultados'
    ]);

    //Editar opciones del local
    Route::get('local/{id}/editar',[
        'as'	=>	'usuario.local.editar',
        'uses'	=>	'UsuarioController@editar'
    ]);

    Route::put('local/putActualizarLocal/{id}',[
        'as'	=>	'usuario.local.putActualizarLocal',
        'uses'	=>	'UsuarioController@putActualizarLocal'
    ]);

    //Mostrar listado de empaques asociados al local
    Route::get('local/{id}/empaques/{estado?}',[
        'as'	=>	'usuario.local.empaques',
        'uses'	=>	'UsuarioController@empaques'
    ]);

    //Horarios de las tomas de todos los locales
    Route::get('local/{id}/rendimiento',[
        'as'	=>	'usuario.local.rendimiento',
        'uses'	=>	'UsuarioController@rendimiento'
    ]);

    //buscador de la cantidad de turnos tomados por todos los usuarios del local
    Route::get('local/{id}/cantidad-turnos-asignados',[
        'as'	=>	'usuario.local.cantidad-turnos-asignados',
        'uses'	=>	'UsuarioController@cantidadTurnosAsignados'
    ]);

    //Vista para modificar caracteristicas de un usuario de un local
    /*
    Route::get('local/empaques/{id}',[
        'as'	=>	'usuario.local.empaques',
        'uses'	=>	'UsuarioController@empaques'
    ]);
    */

    //Actualizar (PUT) usuario local | usuario/local/usuario
    Route::put('local/putUsuarioLocal/{id}',[
        'as'	=>	'usuario.local.putUsuarioLocal',
        'uses'	=>	'UsuarioController@putUsuarioLocal'
    ]);


    //Muestra el perfil del usuario perteneciente al local
    Route::get('local/{idLocal}/perfil/{id}',[
        'as'	=>	'usuario.local.perfil',
        'uses'	=>	'UsuarioController@perfil'
    ]);



    //Editar Usuario del Local  | usuario/local/usuario
    Route::get('local/usuario/{id}',[
        'as'	=>	'usuario.local.usuario',
        'uses'	=>	'UsuarioController@editarUsuarioLocal'
    ]);


    //DESVINCULAR Usuario del Local  | usuario/local/usuario
    Route::get('local/desvincular/{id}',[
        'as'	=>	'usuario.local.desvincular',
        'uses'	=>	'UsuarioController@desvincularUsuarioLocal'
    ]);

    Route::put('local/putDesvincularUsuarioLocal/{id}',[
        'as'	=>	'usuario.local.putDesvincularUsuarioLocal',
        'uses'	=>	'UsuarioController@putDesvincularUsuarioLocal'
    ]);

    //Faltas del empaque  | usuario/local/faltas/id
    Route::get('local/faltas/{id}',[
        'as'	=>	'usuario.local.faltas',
        'uses'	=>	'UsuarioController@faltasUser'
    ]);

    //Editar Falta de un empaque  | usuario/local/editar-falta/id
    Route::get('local/editar-falta/{id}',[
        'as'	=>	'usuario.local.editar-falta',
        'uses'	=>	'UsuarioController@editarFalta'
    ]);

    Route::put('local/putActualizarFalta/{id}',[
        'as'	=>	'usuario.local.putActualizarFalta',
        'uses'	=>	'UsuarioController@putActualizarFalta'
    ]);

    //Delete falta de un empaque
    Route::delete('{id}/deleteFalta',[
        'as'	=>	'usuario.local.deleteFalta',
        'uses'	=>	'UsuarioController@deleteFalta'
    ]);

    //Agregar Falta
    Route::get('local/agregar-falta/{id}',[
        'as'	=>	'usuario.local.agregar-falta',
        'uses'	=>	'UsuarioController@agregarFalta'
    ]);

    $this->post('usuario.local.postAgregarFalta', 'UsuarioController@postAgregarFalta');

    //Imprimir cantidad de turnos tomados por empaque
    Route::get('local/cant-turnos-tomados-fecha',[
        'as'	=>	'usuario.local.cant-turnos-tomados-fecha',
        'uses'	=>	'PdfController@pdfCantTurnosTomadosFecha'
    ]);

    /*
    **********************************************************************
    ************** ----> USUARIO - PLanilla <---- ***************************
    **********************************************************************
    */


    //Opciones de la planillas de un local
    Route::get('planilla/{id}/opciones',[
        'as'	=>	'usuario.planilla.opciones',
        'uses'	=>	'UsuarioController@opcionesPlanilla'
    ]);


    //Imprimir planilla del local
    Route::get('planilla/{id}/pdf',[
        'as'	=>	'usuario.planilla.pdf',
        'uses'	=>	'PdfController@invoice'
    ]);

    //Imprimir planilla vista empaque, coordinador y encargado
    Route::get('planilla/{id}/pdf-turnos',[
        'as'	=>	'usuario.planilla.pdf-turnos',
        'uses'	=>	'PdfController@invoice2'
    ]);

    //Imprimir cantidad de turnos tomados por empaque
    Route::get('planilla/{id}/cant-turnos-tomados',[
        'as'	=>	'usuario.planilla.cant-turnos-tomados',
        'uses'	=>	'PdfController@pdfCantTurnosTomados'
    ]);


    //GET - Editar planilla del local
    Route::get('planilla/{id}/editar', 'UsuarioController@getEditarPlanilla')->name('usuario.planilla.editar');
    //PUT - Editar planilla del local
    Route::put('planilla/{id}/editar', 'UsuarioController@putEditarPlanilla');


    //Eliminar planillas del local
    Route::get('planilla/{id}/eliminar',[
        'as'	=>	'usuario.planilla.eliminar',
        'uses'	=>	'UsuarioController@eliminarPlanilla'
    ]);

    //Delete de Eliminar planilla de un local
    Route::delete('{id}/deletePlanilla',[
        'as'	=>	'usuario.planilla.deletePlanilla',
        'uses'	=>	'UsuarioController@deletePlanilla'
    ]);

    //Mostrar Turnos Tomados
    Route::get('planilla/{id}/turnos',[
        'as'	=>	'usuario.planilla.turnos',
        'uses'	=>	'UsuarioController@mostrarTurnosTomados'
    ]);

    //Mostrar Turnos Tomados (vista coordinadores y encargados)
    Route::get('planilla/{id}/turnos-tomados',[
        'as'	=>	'usuario.planilla.turnos-tomados',
        'uses'	=>	'UsuarioController@turnosTomadosPlanilla'
    ]);


    Route::get('planilla/{id}/editarTurnos',[
        'as'	=>	'usuario.planilla.editarTurnos',
        'uses'	=>	'UsuarioController@editarTurnos'
    ]);

    Route::get('planilla/{id}/listTurn',[
        'as'	=>	'usuario.planilla.incluir.listTurn',
        'uses'	=>	'UsuarioController@listTurn'
    ]);

    Route::get('planilla/{id}/infoTurno',[
        'as'	=>	'usuario.planilla.infoTurno',
        'uses'	=>	'UsuarioController@infoTurno'
    ]);

    //PUT - Editar turno de una planilla
    Route::put('planilla/{id}/updateTurno', 'UsuarioController@updateTurno');

    //POST - Agregar  turno
    Route::post('usuario/planilla/agregarTurno', 'UsuarioController@postAgregarTurno');

    //Delete de Eliminar turno de una planilla
    Route::delete('planilla/{id}/deleteTurno',[
        'as'	=>	'usuario.planilla.deleteTurno',
        'uses'	=>	'UsuarioController@deleteTurno'
    ]);


    //Mostrar Turnos Disponibles - que no han sido tomados
    Route::get('planilla/{id}/disponible',[
        'as'	=>	'usuario.planilla.disponible',
        'uses'	=>	'UsuarioController@disponible'
    ]);

    //Asignar Empaque a un turno de una planilla
    Route::get('planilla/{id}/asignar',[
        'as'	=>	'usuario.planilla.asignar',
        'uses'	=>	'UsuarioController@asignar'
    ]);

    $this->post('usuario.planilla.postAsignar', 'UsuarioController@postAsignar');

    //Mostrar Informacion de un turno de Planilla_Turno_User en el asignar
    Route::get('planilla/turnoUser/{id}',[
        'as'	=>	'usuario.planilla.turnoUser',
        'uses'	=>	'UsuarioController@turnoUser'
    ]);

    //Editar Informacion de un turno de Planilla_Turno_User en el asignar
    Route::put('{id}/putTurnoUser',[
        'as'	=>	'usuario.planilla.putTurnoUser',
        'uses'	=>	'UsuarioController@putTurnoUser'
    ]);

    //Delete de Eliminar Usuario que tiene un turno de una planilla
    Route::delete('{id}/deleteUsuarioTurno',[
        'as'	=>	'usuario.planilla.deleteUsuarioTurno',
        'uses'	=>	'UsuarioController@deleteUsuarioTurno'
    ]);


    //Copiar planilla en un local - solo si existe una, sino te deriva a otra ruta
    Route::post('{id}/postCopiarPlanilla',[
        'as'	=>	'usuario.planilla.postCopiarPlanilla',
        'uses'	=>	'UsuarioController@postCopiarPlanilla'
    ]);

    //Crear PRIMERA planilla del local
    Route::get('planilla/{id}/crear',[
        'as'	=>	'usuario.planilla.crear',
        'uses'	=>	'UsuarioController@crearPlanilla'
    ]);

    //POST crear Planilla
    $this->post('usuario.planilla.postCrearPlanilla', 'UsuarioController@postCrearPlanilla');

    //Elimina todos los turnos de una planilla
    Route::delete('{id}/deleteToma',[
        'as'	=>	'usuario.planilla.deleteToma',
        'uses'	=>	'UsuarioController@deleteToma'
    ]);

    //Elimina todos los turnos tomados en la toma de turnos de una planilla
    Route::delete('{id}/deleteTomaDeTurnos',[
        'as'	=>	'usuario.planilla.deleteTomaDeTurnos',
        'uses'	=>	'UsuarioController@deleteTomaDeTurnos'
    ]);

    //Elimina todos los turnos tomados en la pre toma de una planilla
    Route::delete('{id}/deletePreToma',[
        'as'	=>	'usuario.planilla.deletePreToma',
        'uses'	=>	'UsuarioController@deletePreToma'
    ]);

    //Elimina todos los turnos tomados en el repechaje de una planilla
    Route::delete('{id}/deleteRepechaje',[
        'as'	=>	'usuario.planilla.deleteRepechaje',
        'uses'	=>	'UsuarioController@deleteRepechaje'
    ]);

    /*
    **********************************************************************
    ************** ----> FIN ADMIN <---- ***************************
    **********************************************************************
    */


});

//----------------------------------------------------------
//----------------------------------------------------------
/*---------------------------------------------------------*/
Route::group(['prefix' => 'local'], function () {

    Route::get('{id}/opciones',[
        'as'	=>	'admin.opciones',
        'uses'	=>	'LocalController@opciones'
    ]);


    Route::get('{id}/empaques',[
        'as'	=>	'admin.empaques',
        'uses'	=>	'LocalController@empaques'
    ]);

    Route::get('vincular',[
        'as'	=>	'local.vincular',
        'uses'	=>	'LocalController@getVincular'
    ]);


    $this->post('postVincular', 'LocalController@postVincular');

});

/*---------------------------------------------------------*/


/*
**********************************************************************
**********************************************************************
***********************----> Turnos <----*****************************
**********************************************************************
**********************************************************************
*/

//------------------------------------------------------

//get toma PC
Route::get('turno/toma/{id}',[
    'as'	=>	'turno.toma',
    'uses'	=>	'TurnoController@toma'
]);

//get toma Movil -> muestra instantaneamente lunes y martes, miércoles y jueves, etc.
Route::get('turno/toma-2x4/{id}',[
    'as'	=>	'turno.toma-2x4',
    'uses'	=>	'TurnoController@toma2x4'
]);

//get toma Movil -> muestra en un boton lunes y martes, miércoles y jueves, etc.
Route::get('turno/toma-por-dia/{id}',[
    'as'	=>	'turno.toma-por-dia',
    'uses'	=>	'TurnoController@tomaPorDia'
]);

//get pre-toma PC
Route::get('turno/pre-toma/{id}',[
    'as'	=>	'turno.pre-toma',
    'uses'	=>	'TurnoController@preToma'
]);

//get toma Movil -> muestra instantaneamente lunes y martes, miércoles y jueves, etc.
Route::get('turno/pre-toma-2x4/{id}',[
    'as'	=>	'turno.pre-toma-2x4',
    'uses'	=>	'TurnoController@preToma2x4'
]);

//get toma Movil -> muestra en un boton lunes y martes, miércoles y jueves, etc.
Route::get('turno/pre-toma-por-dia/{id}',[
    'as'	=>	'turno.pre-toma-por-dia',
    'uses'	=>	'TurnoController@preTomaPorDia'
]);

//Post tomar turno
Route::post('{id}/{pla}/postToma',[
    'as'	=>	'turno.postToma',
    'uses'	=>	'TurnoController@postToma'
]);

//Delete turno tomado en la toma de turnos
Route::post('{id}/deleteTurnoTomado',[
    'as'	=>	'turno.deleteTurnoTomado',
    'uses'	=>	'TurnoController@deleteTurnoTomado'
]);

//Post tomar turno
Route::post('{id}/postPreToma',[
    'as'	=>	'turno.postPreToma',
    'uses'	=>	'TurnoController@postPreToma'
]);

//Delete turno tomado en la toma de turnos
Route::post('{id}/deletePreTurnoTomado',[
    'as'	=>	'turno.deletePreTurnoTomado',
    'uses'	=>	'TurnoController@deletePreTurnoTomado'
]);

//get toma
Route::get('turno/repechaje/{id}',[
    'as'	=>	'turno.repechaje',
    'uses'	=>	'TurnoController@repechaje'
]);

//Post tomar turno
Route::post('{id}/postRepechaje',[
    'as'	=>	'turno.postRepechaje',
    'uses'	=>	'TurnoController@postRepechaje'
]);

//Delete turno tomado en la toma de turnos
Route::post('{id}/deleteRepechajeTomado',[
    'as'	=>	'turno.deleteRepechajeTomado',
    'uses'	=>	'TurnoController@deleteRepechajeTomado'
]);

//get regalos
Route::get('turno/regalos/{id}',[
    'as'	=>	'turno.regalos',
    'uses'	=>	'TurnoController@regalos'
]);

//Post tomar regalo
Route::post('postRegalos','TurnoController@postRegalos');

//regalar turno

Route::post('turno.regalarTurno', 'TurnoController@regalarTurno');


Route::post('turno.cancelarRegalo', 'TurnoController@cancelarRegalo');

//New Update 2
//Ceder Mostrar
Route::get('turno/ceder/{id}',[
    'as'	=>	'turno.ceder',
    'uses'	=>	'TurnoController@ceder'
]);

//Ceder un turno a una persona
Route::post('turno.postCeder', 'TurnoController@postCeder');

//Cancelar un turno cediendo
Route::post('turno.postCancelarCediendo', 'TurnoController@postCancelarCediendo');

//Aceptar el turno que me estan cediendo
Route::post('turno.postAceptarCediendo', 'TurnoController@postAceptarCediendo');
//End New Update 2


//get toma
Route::get('turno/mis-turnos',[
    'as'	=>	'turno.mis-turnos',
    'uses'	=>	'TurnoController@misTurnos'
]);


/*
**********************************************************************
**********************************************************************
***********************----> Noticias <----***************************
**********************************************************************
**********************************************************************
*/
Route::group(['prefix' => 'noticia'], function () {

    /*
        ********** RUTAS ENCARGADO *******
    */

    //Listado de Noticias
    Route::get('noticia-local/{id}',[
        'as'	=>	'noticia.noticia-local',
        'uses'	=>	'NoticiaController@noticiaLocal'
    ]);

    //Listado de Noticias
    Route::get('editar-noticia/{id}',[
        'as'	=>	'noticia.editar-noticia',
        'uses'	=>	'NoticiaController@editarNoticia'
    ]);

    //PUT de actualizar una noticia de un local
    Route::put('{id}/updateNoticia',[
        'as'	=>	'noticia.updateNoticia',
        'uses'	=>	'NoticiaController@updateNoticia'
    ]);

    //Delete de Eliminar noticia del local
    Route::delete('{id}/deleteNoticia',[
        'as'	=>	'noticia.deleteNoticia',
        'uses'	=>	'NoticiaController@deleteNoticia'
    ]);

    //vista para agregar noticia
    Route::get('agregar-noticia/{id}',[
        'as'	=>	'noticia.agregar-noticia',
        'uses'	=>	'NoticiaController@agregarNoticia'
    ]);

    //post agregar noticia
    $this->post('noticia.postAgregarNoticia', 'NoticiaController@postAgregarNoticia');

    /*
        ********** RUTAS ADMIN *******
    */


    //Listado de Noticias
    Route::get('listado-local/{id}',[
        'as'	=>	'noticia.listado-local',
        'uses'	=>	'NoticiaController@noticiaListadoLocal'
    ]);
    /**/
    //Vista Editar de Noticias
    Route::get('modificar-noticia/{id}',[
        'as'	=>	'noticia.modificar-noticia',
        'uses'	=>	'NoticiaController@modificarNoticia'
    ]);

    //PUT de actualizar una noticia de un local
    Route::put('{id}/putNoticia',[
        'as'	=>	'noticia.putNoticia',
        'uses'	=>	'NoticiaController@putNoticia'
    ]);

    //Delete de Eliminar noticia del local
    Route::delete('{id}/eliminarNoticia',[
        'as'	=>	'noticia.eliminarNoticia',
        'uses'	=>	'NoticiaController@eliminarNoticia'
    ]);

    //vista para agregar noticia
    Route::get('insertar-noticia/{id}',[
        'as'	=>	'noticia.insertar-noticia',
        'uses'	=>	'NoticiaController@insertarNoticia'
    ]);

    //post agregar noticia
    $this->post('postInsertarNoticia', 'NoticiaController@postInsertarNoticia');


});



/*
**********************************************************************
**********************************************************************
*******************----> Postulacion <----****************************
**********************************************************************
**********************************************************************
*/


Route::get('postulaciones', 'PostulacionController@index');

//vista para agregar noticia
Route::get('postulaciones/postulacion/{id}',[
    'as'	=>	'postulaciones.postulacion',
    'uses'	=>	'PostulacionController@postulacion'
]);

//Post tomar cupo en la postulación
Route::post('{id}/postPostulacion',[
    'as'	=>	'postulaciones.postPostulacion',
    'uses'	=>	'PostulacionController@postPostulacion'
]);

//vista para ingresar el código para quedar en la lista privada de una postulación
Route::get('postulaciones/aspirante',[
    'as'	=>	'postulaciones.aspirante',
    'uses'	=>	'PostulacionController@getAspirante'
]);

$this->post('postAspirante', 'PostulacionController@postAspirante');


/*
**********************************************************************
**********************************************************************
*********************----> Articulos <----****************************
**********************************************************************
**********************************************************************
*/

Route::group(['prefix' => 'blog'], function () {

    Route::get('mis-articulos', 'ArticuloController@misArticulos');

});


/*
**********************************************************************
**********************************************************************
*********************----> Imagenes  <----****************************
**********************************************************************
**********************************************************************
*/

Route::group(['prefix' => 'album'], function () {

    Route::get('mis-imagenes', 'ImagenController@misImagenes');
    Route::get('memes', 'ImagenController@getMemes');
    Route::get('frases', 'ImagenController@getFrases');

});
/*---------------------------------------------------------*/

//validaciones de rutas incorrectas
Route::get('usuario/local/usuario', function () {
    return redirect()->action('HomeController@index');
});



Route::resource('user','UserController');
Route::resource('admin','AdminController');
Route::resource('cadena','CadenaController');
Route::resource('organizacion','OrganizacionController');
Route::resource('local','LocalController');
Route::resource('turno','TurnoController');
Route::resource('blog', 'ArticuloController');
Route::resource('album', 'ImagenController');
Route::resource('informativo', 'InformativoController');

