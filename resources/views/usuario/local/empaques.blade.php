@extends('layouts.global-externo')

@section('content')
<section>
        <div class="container">

            <h4 class="text-center">Empaques</h4>
            <p class="m-b-25 text-center">Listado de empaques</p>

            <b class="text-center">@include('incluir/mensajes')</b>

            <div class="card card-info">
                <div class="card-header">
                    <h5 class="card-title">Info Adicional</h5>
                </div>
                <div class="card-block">
                      <div class="row">
                        <div class="col-12 col-sm-6 col-md-3"> <b>ID Local:</b>  {{ $local->id }} </div>
                        <div class="col-12 col-sm-6 col-md-3"> <b>Cadena:</b> {{ $local->Cadena->nombre }}</div>
                        <div class="col-12 col-sm-6 col-md-3"> <b>Local:</b> {{ $local->nombre }}</div>
                        <div class="col-12 col-sm-6 col-md-3"> <b>Cuenta:</b> {{ $local->cuenta }}</div>
                      </div>

                    <hr class="hidden-md-up">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3"> <b>Total Usuarios:</b> <a href="{{ action('UsuarioController@empaques', ['id' => $local->id]) }}">{{ $cantUsuarios }}</a> </div>
                        <div class="col-12 col-sm-6 col-md-3"> <b>Encargados:</b> <a href="{{ action('UsuarioController@empaques', ['id' => $local->id, 'estado' => 'encargados']) }}">{{ $cantEncargados }}</a> </div>
                        <div class="col-12 col-sm-6 col-md-3"> <b>Coordinadores:</b> <a href="{{ action('UsuarioController@empaques', ['id' => $local->id, 'estado' => 'coordinadores']) }}">{{ $cantCoordinadores }}</a> </div>
                        <div class="col-12 col-sm-6 col-md-3"> <b>Empaques:</b> <a href="{{ action('UsuarioController@empaques', ['id' => $local->id, 'estado' => 'empaques']) }}">{{ $cantEmpaques }}</a> </div>
                    </div>

                    <hr class="hidden-md-up">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3"> <b>Usuarios Activos:</b> <a href="{{ action('UsuarioController@empaques', ['id' => $local->id, 'estado' => 'activos']) }}">{{ $cantActivos }}</a> </div>
                        <div class="col-12 col-sm-6 col-md-3"> <b>Usuarios Deudores:</b> <a href="{{ action('UsuarioController@empaques', ['id' => $local->id, 'estado' => 'deudores']) }}">{{ $cantDeudores }}</a> </div>
                        <div class="col-12 col-sm-6 col-md-3"> <b>Usuarios Suspendidos:</b> <a href="{{ action('UsuarioController@empaques', ['id' => $local->id, 'estado' => 'suspendidos']) }}">{{ $cantSuspendidos }}</a> </div>
                        <div class="col-12 col-sm-6 col-md-3"> <b>Usuarios Desvinculados:</b> <a href="{{ action('UsuarioController@empaques', ['id' => $local->id, 'estado' => 'desvinculados']) }}">{{ $cantDesvinculados }}</a> </div>
                    </div>

                </div>
            </div>

            <div class="card card-warning">
                <div class="card-header">
                    <h5 class="card-title">Atajo - ¡Cuidado!</h5>
                </div>
                <div class="card-block">

                            {!! Form::open(['action' => 'UsuarioController@postAgregar', 'method' => 'POST'])!!}
                            {!! Form::hidden('local', $local->id) !!}
                            <div class="row">

                                <label class="col-12 col-sm-6 col-md-4 col-lg-4 ">Agregar Persona (Rut) <br> <small  class="form-text">Configuración por defecto.</small> </label>
                                <div class="col-12 col-sm-3 col-md-4 col-lg-3">
                                    {!! Form::text('rut', null, ['class'=>'form-control input-xs', 'required', 'placeholder'=>'18785418-6']) !!}
                                </div>
                                <div class="hidden-down p-t-55"></div>
                                <div class="col-12 col-sm-3 col-md-4 col-lg-3">
                                    {!! Form::submit('Agregar', ['class'=>'btn btn-xs btn-success']) !!}
                                </div>


                            </div>
                            {!! Form::close() !!}



                            <hr class="hidden-sm-up">

                            {!! Form::open(['route' => 'usuario.local.busqueda', 'method' => 'GET'])!!}
                            <div class="row">
                                <label class="col-12 col-sm-6 col-md-4 col-lg-4">Nombre Persona  <br> <small  class="form-text">Buscar por nombre o apellido.</small> </label>
                                <div class="col-12 col-sm-3 col-md-4 col-lg-3">
                                     {!! Form::text('nombre', null, ['class'=>'form-control', 'required', 'placeholder'=>'Camila']) !!}
                                     {!! Form::hidden('id_local', $local->id) !!}
                                </div>
                                <div class="hidden-down p-t-55"></div>
                                <div class="col-12 col-sm-3 col-md-4 col-lg-3">
                                     {!! Form::submit('Buscar', ['class'=>'btn btn-xs btn-info']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}

                            <hr class="hidden-sm-up">

                            <div class="hidden-md-down p-t-15"></div>
                            {!! Form::open(['action' => 'UsuarioController@cuposTomaPorDefecto', 'method' => 'POST'])!!}
                            <div class="row">
                                  <label class="col-12 col-sm-6 col-md-4 col-lg-4">Cant. Cupos Toma de Turnos por Defecto  <br> <small  class="form-text">Se modificará a todos los empaques.</small> </label>

                                  <div class="col-12 col-sm-3 col-md-4 col-lg-3">
                                      {!! Form::text('cant', null, ['class'=>'form-control', 'required', 'placeholder'=>'4']) !!}
                                      {!! Form::hidden('id_local', $local->id) !!}
                                  </div>
                                  <div class="hidden-down p-t-55"></div>
                                  <div class="col-12 col-sm-3 col-md-4 col-lg-3">
                                      {!! Form::submit('Cambiar', ['class'=>'btn btn-xs btn-primary']) !!}
                                  </div>
                            </div>
                            {!! Form::close() !!}

                            <hr class="hidden-sm-up">

                            <div class="hidden-md-down p-t-15"></div>
                            {!! Form::open(['action' => 'UsuarioController@cuposPreTomaPorDefecto', 'method' => 'POST'])!!}
                            <div class="row">
                                  <label class="col-12 col-sm-6 col-md-4 col-lg-4">Cant. Cupos Pre-Toma por Defecto   <br> <small  class="form-text">Se modificará a todos los empaques.</small> </label>

                                  <div class="col-12 col-sm-3 col-md-4 col-lg-3">
                                      {!! Form::text('cant', null, ['class'=>'form-control', 'required', 'placeholder'=>'0']) !!}
                                      {!! Form::hidden('id_local', $local->id) !!}
                                  </div>
                                  <div class="hidden-down p-t-55"></div>
                                  <div class="col-12 col-sm-3 col-md-4 col-lg-3">
                                      {!! Form::submit('Cambiar', ['class'=>'btn btn-sm btn-warning']) !!}
                                  </div>
                            </div>
                            {!! Form::close() !!}

                            <hr class="hidden-sm-up">

                            <div class="hidden-md-down p-t-15"></div>
                            {!! Form::open(['action' => 'UsuarioController@cuposRepechajePorDefecto', 'method' => 'POST'])!!}
                            <div class="row">
                                <label class="col-12 col-sm-6 col-md-4 col-lg-4">Cant. Cupos Repechaje por Defecto   <br> <small  class="form-text">Se modificará a todos los empaques.</small> </label>

                                <div class="col-12 col-sm-3 col-md-4 col-lg-3">
                                    {!! Form::text('cant', null, ['class'=>'form-control', 'required', 'placeholder'=>'10']) !!}
                                    {!! Form::hidden('id_local', $local->id) !!}
                                </div>
                                <div class="hidden-down p-t-55"></div>
                                <div class="col-12 col-sm-3 col-md-4 col-lg-3">
                                    {!! Form::submit('Cambiar', ['class'=>'btn btn-sm btn-danger']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}

                </div>
            </div>


            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Listado</h5>
                </div>
                <div class="card-block">

                <!-- envío el id del local para poder regresar desde el perfil a la vista del local -->

                  <div class="row hidden-md-down">

                    <div class="col-lg-3">
                      <b>Nombre Completo</b>
                    </div>
                    <div class="col-lg-2">
                      <b>Rol</b>
                    </div>
                    <div class="col-lg-2">
                      <b>Estado</b>
                    </div>

                    <div class="col-lg-1 text-center">
                      <b>Editar</b>
                    </div>
                    <div class="col-lg-1 text-center">
                      <b>Pagos</b>
                    </div>
                    <div class="col-lg-1 text-center">
                      <b>Turnos</b>
                    </div>
                    <div class="col-lg-1 text-center">
                      <b>Perfil</b>
                    </div>
                    <div class="col-lg-1 text-center">
                      <b>Faltas</b>
                    </div>
                  </div>
                  <hr class="hidden-md-down">


                  @foreach($empaques as $empaque)


                  <div class="row ">

                    <div class="col-6 col-sm-6 col-md-6 hidden-lg-up"><b>Nombre:</b></div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3"> {{ $empaque->User->nombre }} {{ $empaque->User->apellido }}</div>

                    <div class="col-6 col-sm-6 col-md-6 hidden-lg-up"><b>Rol:</b></div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-2"> {{ $empaque->rol }} </div>

                    <div class="col-6 col-sm-6 col-md-6 hidden-lg-up"><b>Estado:</b></div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-2"> {{ $empaque->estado }} </div>

                    <div class="hidden-lg-up p-t-45"></div>
                    <div class="col-6 col-sm-6 col-md-6 hidden-lg-up"><b>Editar:</b></div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-1 text-center">
                      <a href="{{ url('usuario/local/usuario/'.$empaque->id) }}" class="btn btn-info  btn-sm"  data-toggle="tooltip" title="Editar User Local"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    </div>

                    <div class="hidden-lg-up p-t-45"></div>
                    <div class="col-6 col-sm-6 col-md-6 hidden-lg-up"><b>Pagos:</b></div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-1 text-center">
                      <a href="{{ url('usuario/'.$empaque->id.'/ver-pagos') }}" class="btn btn-danger  btn-sm"  data-toggle="tooltip" title="Pagos"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i></a>
                    </div>

                    <div class="hidden-lg-up p-t-45"></div>
                    <div class="col-6 col-sm-6 col-md-6 hidden-lg-up"><b>Turnos:</b></div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-1 text-center">
                       <a href="{{ url('usuario/'.$empaque->id.'/ver-turnos') }}" class="btn btn-primary  btn-sm"  data-toggle="tooltip" title="Turnos"><i class="fa fa-calendar" aria-hidden="true"></i></a>
                    </div>

                    <div class="hidden-lg-up p-t-45"></div>
                    <div class="col-6 col-sm-6 col-md-6 hidden-lg-up"><b>Ver Perfil:</b></div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-1 text-center">
                      <!-- ir a user/id/show || mostrar información del usuario-->
                      <a href="{{ url('usuario/local/'.$local->id.'/perfil/'.$empaque->User->id) }}" class="btn btn-success  btn-sm"  data-toggle="tooltip" title="Perfil"><i class="fa fa-user" aria-hidden="true"></i></a>
                    </div>

                    <div class="hidden-lg-up p-t-45"></div>
                    <div class="col-6 col-sm-6 col-md-6 hidden-lg-up"><b>Faltas:</b></div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-1 text-center">
                      <!-- ir a user/id/show || mostrar información del usuario-->
                      <a href="{{ url('usuario/local/faltas/'.$empaque->id) }}" class="btn btn-warning  btn-sm"  data-toggle="tooltip" title="Faltas"><i class="fa fa-list" aria-hidden="true"></i></a>
                    </div>

                  </div>
                  <hr class="hidden-lg-up"></hr>
                  <div class="hidden-md-down p-t-25"></div>
                  @endforeach

                      <div class="text-center">
                        {!! $empaques->links('vendor.pagination.simple-bootstrap-4') !!}
                      </div>

                      <div class="row form-group">
                        <div class="col-lg-12 text-center">

                            <a href="{{ url('usuario/local/'.$local->id.'/opciones') }}" class="btn btn-sm btn-primary">Volver</a>
                        </div>
                      </div>

                        <div class="p-t-35"></div>
                        <div class="alert alert-danger" role="alert">
                            <strong>** </strong> Debe haber al menos 1 encargado en el local para poder enviarle la boleta.
                        </div>


                </div>
            </div>
    </div>
</section>
@endsection



@section('js')


@endsection


