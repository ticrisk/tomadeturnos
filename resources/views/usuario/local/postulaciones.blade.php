@extends('layouts.global-externo')

@section('content')

<section>
        <div class="container">

            <h4 class="text-center">Postulaciones <i class="fa fa-star text-warning pull-right" aria-hidden="true" data-toggle="tooltip" title="Opción Premium"></i></h4>
            <p class="m-b-25 text-center">Listado de las postulaciones</p>

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Listado</h5>
                </div>
                <div class="card-block">

                    <b class="text-center">@include('incluir/mensajes')</b>

                        <div class="row hidden-lg-down">

                            <div class="col-xl-4"><b>Descripción</b></div>
                            <div class="col-xl-2"><b>Tipo</b></div>
                            <div class="col-xl-2"><b>Inicio</b></div>
                            <div class="col-xl-2"><b>Termino</b></div>
                            <div class="col-xl-1"><b>Editar</b></div>
                            <div class="col-xl-1"><b>Result</b></div>
                        </div>
                        <hr class="hidden-lg-down">



                        @foreach($postulaciones as $postulacion)
                            <div class="row">

                                <label class="col-6 col-sm-6 col-md-6 col-lg-6 hidden-xl-up">Descripción:</label>
                                <div class="col-6 col-sm-6 col-md- col-lg-6 col-xl-4">{{ $postulacion->descripcion }}</div>

                                <label class="col-6 col-sm-6 col-md-6 col-lg-6 hidden-xl-up">Tipo:</label>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-2">{{ $postulacion->activarLista }}</div>

                                <label class="col-6 col-sm-6 col-md-6 col-lg-6 hidden-xl-up">Inicio:</label>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-2">{{ $postulacion->inicio }}</div>

                                <label class="col-6 col-sm-6 col-md-6 col-lg-6 hidden-xl-up">Termino:</label>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-2">{{ $postulacion->termino }}</div>

                                <label class="col-6 col-sm-6 col-md-6 col-lg-6 hidden-xl-up">Editar:</label>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-1"><a href="{{ url('usuario/local/editarPostulacion/'.$postulacion->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>

                                <div class="hidden-xl-up p-t-35"></div>
                                <label class="col-6 col-sm-6 col-md-6 col-lg-6 hidden-xl-up">Resultados:</label>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-1"><a href="{{ url('usuario/local/resultados/'.$postulacion->id) }}" class="btn btn-sm btn-success"><i class="fa fa-flask" aria-hidden="true"></i></a></div>

                            </div>
                            <hr>
                        @endforeach




                        <div class="text-center">
                            {!! $postulaciones->links('vendor.pagination.simple-bootstrap-4') !!}
                        </div>

                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <a href="{{ url('usuario/local/'.$local.'/agregarPostulacion') }}" class="btn btn-sm btn-success">Agregar</a>
                                |
                                <a href="{{ url('usuario/local/'.$local.'/opciones') }}" class="btn btn-sm btn-primary">Volver</a>
                            </div>
                        </div>

                </div>
            </div>
        </div>
</section>
@endsection



@section('js')


@endsection


