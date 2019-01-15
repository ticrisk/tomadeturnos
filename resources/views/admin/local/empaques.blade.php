@extends('layouts.global-nero')

@section('content')

<section>
    <div class="container">

        <h4 class="text-center">Local</h4>
        <b class="text-center">@include('incluir/mensajes')</b>

        <div class="card card-info">
            <div class="card-header">
                <h5 class="card-title">Información del local - Filtrar</h5>
            </div>
            <div class="card-body">


                    <div class="row">
                        <div class="col-md-3"> <b>ID Local:</b>  {{ $local->id }} </div>
                        <div class="col-md-3"> <b>Cadena:</b> {{ $local->Cadena->nombre }}</div>
                        <div class="col-md-3"> <b>Local:</b> {{ $local->nombre }}</div>
                        <div class="col-md-3"> <b>Cuenta:</b> {{ $local->cuenta }}</div>
                    </div>

                     <hr>

                    <div class="row">
                        <div class="col-md-3"> <b>Total Usuarios:</b> <a href="{{ action('AdminController@empaques', ['id' => $local->id]) }}">{{ $cantUsuarios }}</a> </div>
                        <div class="col-md-3"> <b>Encargados:</b> <a href="{{ action('AdminController@empaques', ['id' => $local->id, 'estado' => 'encargados']) }}">{{ $cantEncargados }}</a> </div>
                        <div class="col-md-3"> <b>Coordinadores:</b> <a href="{{ action('AdminController@empaques', ['id' => $local->id, 'estado' => 'coordinadores']) }}">{{ $cantCoordinadores }}</a> </div>
                        <div class="col-md-3"> <b>Empaques:</b> <a href="{{ action('AdminController@empaques', ['id' => $local->id, 'estado' => 'empaques']) }}">{{ $cantEmpaques }}</a> </div>
                    </div>

                      <hr>

                    <div class="row">
                        <div class="col-md-3"><b>Usuarios Activos:</b> <a href="{{ action('AdminController@empaques', ['id' => $local->id, 'estado' => 'activos']) }}">{{ $cantActivos }}</a> </div>
                        <div class="col-md-3"><b>Usuarios Deudores:</b> <a href="{{ action('AdminController@empaques', ['id' => $local->id, 'estado' => 'deudores']) }}">{{ $cantDeudores }}</a> </div>
                        <div class="col-md-3"><b>Usuarios Suspendidos:</b> <a href="{{ action('AdminController@empaques', ['id' => $local->id, 'estado' => 'suspendidos']) }}">{{ $cantSuspendidos }}</a> </div>
                        <div class="col-md-3"><b>Usuarios Desvinculados:</b> <a href="{{ action('AdminController@empaques', ['id' => $local->id, 'estado' => 'desvinculados']) }}">{{ $cantDesvinculados }}</a></div>
                    </div>

            </div>
        </div>

        <div class="card card-warning">
            <div class="card-header">
                <h5 class="card-title">Atajo - ¡Cuidado!</h5>
            </div>
            <div class="card-block">

                {!! Form::open(['action' => 'AdminController@postAgregar', 'method' => 'POST'])!!}
                <div class="row">

                    <label class="col-12 col-sm-6 col-md-4 col-lg-4">Agregar Persona (Rut) <br> <small  class="form-text">Configuración por defecto.</small> </label>

                    <div class="col-12 col-sm-3 col-md-4 col-lg-3">
                        {!! Form::text('rut', null, ['class'=>'form-control', 'required', 'placeholder'=>'18785418-6']) !!}
                        {!! Form::hidden('local', $local->id) !!}
                    </div>
                    <div class="hidden-down p-t-55"></div>
                    <div class="col-12 col-sm-3 col-md-4 col-lg-3">
                        {!! Form::submit('Agregar', ['class'=>'btn btn-xs btn-success']) !!}
                    </div>
                </div>

                {!! Form::close() !!}

                <hr class="hidden-sm-up">

                {!! Form::open(['route' => 'admin.local.busqueda', 'method' => 'GET'])!!}
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
                {!! Form::open(['action' => 'AdminController@cuposTomaPorDefecto', 'method' => 'POST'])!!}
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
                {!! Form::open(['action' => 'AdminController@cuposPreTomaPorDefecto', 'method' => 'POST'])!!}
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
                {!! Form::open(['action' => 'AdminController@cuposRepechajePorDefecto', 'method' => 'POST'])!!}
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
                <h5 class="card-title">Empaques del local</h5>
            </div>
            <div class="card-body">
                          
                            <div class="row hidden-sm-down">

                              <label class="col-md-4">Nombre Completo</label>
                              <label class="col-md-2">Rol</label>
                              <label class="col-md-2">Estado</label>
                              
                              <label class="col-md-1 text-center">Editar</label>
                              <label class="col-md-1 text-center">Pagos</label>
                              <label class="col-md-1 text-center">Turnos</label>
                              <label class="col-md-1 text-center">Perfil</label>
                                                          
                            </div>

                            <hr class="hidden-sm-down">

                            @foreach($empaques as $empaque)

                            <div class="row form-group">

                                <label class="col-6 hidden-md-up">Nombre:</label>
                                <div class="col-6 col-md-4"> {{ $empaque->User->nombre }} {{ $empaque->User->apellido }}  </div>

                                <label class="col-6 hidden-md-up">Rol:</label>
                                <div class="col-6 col-md-2"> {{ $empaque->rol }} </div>

                                <label class="col-6 hidden-md-up">Estado:</label>
                                <div class="col-6 col-md-2"> {{ $empaque->estado }} </div>

                                <label class="col-6 hidden-md-up">Editar User:</label>
                                <div class="col-6 col-md-1 text-md-center">
                                    <a href="{{ url('admin/local/usuario/'.$empaque->id) }}" class="btn btn-info  btn-sm"  data-toggle="tooltip" title="Editar User Local"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                </div>

                                <div class="p-t-45 hidden-md-up"></div>
                                <label class="col-6 hidden-md-up">Pagos:</label>
                                <div class="col-6 col-md-1 text-md-center">
                                    <a href="{{ url('admin/local/listado-pagos/'.$empaque->id) }}" class="btn btn-danger btn-sm"  data-toggle="tooltip" title="Pagos"><i class="fa fa-arrow-circle-up"></i></a>
                                    {{-- <a href="{{ url('admin/local/desvincular/'.$empaque->id) }}" class="btn btn-danger  btn-sm"  data-toggle="tooltip" title="Desvincular User Local"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> --}}
                                </div>

                                <div class="p-t-45 hidden-md-up"></div>
                                <label class="col-6 hidden-md-up">Turnos:</label>
                                <div class="col-6 col-md-1 text-md-center">
                                    <a href="{{ url('admin/usuario/'.$empaque->id.'/ver-turnos/') }}" class="btn btn-primary  btn-sm"  data-toggle="tooltip" title="Ver Turnos"><i class="fa fa-calendar" aria-hidden="true"></i></a>
                                </div>

                                <div class="p-t-45 hidden-md-up"></div>
                                <label class="col-6 hidden-md-up">Perfil:</label>
                                <div class="col-6 col-md-1 text-md-center">
                                    <a href="{{ url('admin/local/'.$local->id.'/perfil/'.$empaque->User->id) }}" class="btn btn-success  btn-sm"  data-toggle="tooltip" title="Perfil"><i class="fa fa-user" aria-hidden="true"></i></a>
                                </div>
                                                          
                            </div>
                            <hr class="hidden-md-up">
                            @endforeach

                            <div class="text-center">
                              {!! $empaques->links('vendor.pagination.simple-bootstrap-4') !!}
                             
                            </div>    

                            <div class="row">
                              <div class="col-lg-12 text-center">
                                <a href="{{ url('admin/local/'.$local->id.'/opciones') }}" class="btn btn-sm btn-primary">Volver</a>
                              </div>
                            </div>


                            <div class="p-t-35"></div>
                            <div class="alert alert-danger" role="alert">
                                <strong>** </strong> Debe haber al menos 1 encargado en el local para enviarle la boleta.
                            </div>
                           
            </div>
        </div>
    </div>

</section>
@endsection



@section('js')


@endsection


