@extends('layouts.global-externo')

@section('content')
<section>
        <div class="container">

            <h4 class="text-center">Empaque</h4>
            <p class="m-b-25 text-center">Búsqueda del propinero</p>

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Usuario</h5>
                </div>
                <div class="card-block">

                    <b class="text-center">@include('incluir/mensajes')</b>

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
                            <div class="col-6 col-sm-6 col-md-6 col-lg-3"> {{ $empaque->nombre }} {{ $empaque->apellido }}</div>

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
                                <a href="{{ url('usuario/local/'.$local->id.'/perfil/'.$empaque->user_id) }}" class="btn btn-success  btn-sm"  data-toggle="tooltip" title="Perfil"><i class="fa fa-user" aria-hidden="true"></i></a>
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

                        <div class="row">
                            <div class="col-lg-12 text-center">

                                <a href="{{ url('usuario/local/'.$local->id.'/empaques') }}" class="btn btn-sm btn-primary">Volver</a>
                            </div>
                        </div>


                </div>
            </div>
        </div>
</section>
@endsection



@section('js')


@endsection


