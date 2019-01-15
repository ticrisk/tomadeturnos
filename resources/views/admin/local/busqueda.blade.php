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
                            <div class="col-6 col-md-4"> {{ $empaque->nombre }} {{ $empaque->apellido }}  </div>

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
                                <a href="{{ url('admin/local/'.$local->id.'/perfil/'.$empaque->id_user) }}" class="btn btn-success  btn-sm"  data-toggle="tooltip" title="Perfil"><i class="fa fa-user" aria-hidden="true"></i></a>
                            </div>

                        </div>
                        <hr class="hidden-md-up">
                    @endforeach


                    <div class="row">
                        <div class="col-lg-12 text-center">

                            <a href="{{ url('admin/local/'.$local->id.'/empaques') }}" class="btn btn-sm btn-primary">Volver</a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
@endsection



@section('js')


@endsection


