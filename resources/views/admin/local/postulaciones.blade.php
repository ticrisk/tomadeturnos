@extends('layouts.global-nero')

@section('content')
<section>
    <div class="container">

        <h4 class="text-center">Postulaciones</h4>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Listado</h5>
            </div>
            <div class="card-body">
                <b class="text-center">@include('incluir/mensajes')</b>

                        <div class="row hidden-md-down">
                            <label class="col-lg-1">ID</label>
                            <label class="col-lg-3">Descripción</label>
                            <label class="col-lg-2">Tipo</label>
                            <label class="col-lg-2">Inicio</label>
                            <label class="col-lg-2">Termino</label>
                            <label class="col-lg-1">Editar</label>
                            <label class="col-lg-1">Resultados</label>
                        </div>
                        <hr class="hidden-md-down">



                        @foreach($postulaciones as $postulacion)
                            <div class="row">
                                <label class="col-6 hidden-lg-up">ID</label>
                                <div class="col-6 col-lg-1">{{ $postulacion->id }}</div>

                                <label class="col-6 hidden-lg-up">Descripción</label>
                                <div class="col-xs-6 col-md-3 col-lg-3">{{ $postulacion->descripcion }}</div>

                                <label class="col-6 hidden-lg-up">Tipo</label>
                                <div class="col-6 col-lg-2">{{ $postulacion->activarLista }}</div>

                                <label class="col-6 hidden-lg-up">Inicio</label>
                                <div class="col-6 col-lg-2">{{ $postulacion->inicio }}</div>

                                <label class="col-6 hidden-lg-up">Termino</label>
                                <div class="col-6 col-lg-2">{{ $postulacion->termino }}</div>

                                <label class="col-6 hidden-lg-up">Editar</label>
                                <div class="col-6 col-lg-1"><a href="{{ url('admin/local/editarPostulacion/'.$postulacion->id) }}" class="btn btn-xs btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>

                                <label class="col-6 hidden-lg-up">Resultados</label>
                                <div class="col-6 col-lg-1"><a href="{{ url('admin/local/resultados/'.$postulacion->id) }}" class="btn btn-xs btn-success"><i class="fa fa-unlock" aria-hidden="true"></i></a></div>

                            </div>
                                <hr>
                        @endforeach




                        <div class="text-center">
                            {!! $postulaciones->links('vendor.pagination.simple-bootstrap-4') !!}
                        </div>

                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <a href="{{ url('admin/local/'.$local.'/agregarPostulacion') }}" class="btn btn-sm btn-success">Agregar</a>
                                |
                                <a href="{{ url('admin/local/'.$local.'/opciones') }}" class="btn btn-sm btn-primary">Volver</a>
                            </div>
                        </div>


            </div>
        </div>
    </div>
</section>
@endsection



@section('js')


@endsection


