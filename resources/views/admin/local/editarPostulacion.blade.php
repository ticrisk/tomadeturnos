@extends('layouts.global-nero')

@section('content')

<section>
    <div class="container">

        <h4 class="text-center">Postulación</h4>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Editar Postulación</h5>
            </div>
            <div class="card-body">
                <b class="text-center">@include('incluir/mensajes')</b>

                            {!! Form::open(['route' => ['admin.local.putEditarPostulacion', $postulacion], 'method' => 'PUT'])!!}


                            {!! Form::hidden('local_id', $postulacion->local_id) !!}

                            <div class="row form-group">
                                <label class="col-lg-2">Cupos</label>
                                <div class="col-lg-4">
                                    {!! Form::text('cupos', $postulacion->cupos,['class'=>'form-control','placeholder'=>'Sólo Números', 'required']) !!}
                                </div>

                                <label class="col-lg-2">Tipo</label>
                                <div class="col-lg-4">
                                    {!! Form::select('activarLista',['Privada'=>'Privada','Pública'=>'Pública','Azar'=>'Azar'],$postulacion->activarLista, ['class'=>'form-control select-category']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-lg-2">Inicio</label>
                                <div class="col-lg-4">
                                    {!! Form::text('inicio', $postulacion->inicio,['class'=>'datetimepicker form-control','placeholder'=>'2017-06-01 23:45:00', 'required']) !!}
                                </div>

                                <label class="col-lg-2">Termino</label>
                                <div class="col-lg-4">
                                    {!! Form::text('termino', $postulacion->termino,['class'=>'datetimepicker form-control','placeholder'=>'2017-06-01 23:59:00', 'required']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-lg-2">Descripción</label>
                                <div class="col-lg-10">
                                    {!! Form::textarea('descripcion', $postulacion->descripcion,['class'=>'form-control','placeholder'=>'Descripción Obligatorio', 'required']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-lg-12 text-center">
                                    {!! Form::submit('Guardar', ['class'=>'btn btn-xs btn-success']) !!}
                                    <a href="{{ url('admin/local/'.$postulacion->local_id.'/postulaciones') }}" class="btn btn-xs btn-primary">Volver</a>
                                    <a href="{{ url('admin/local/eliminarPostulacion/'.$postulacion->id) }}" class="btn btn-xs btn-danger">Borrar</a>
                                </div>
                            </div>

                            {!! Form::close() !!}

                            <div class="p-t-35"></div>
                            <div class="alert alert-danger" role="alert">
                                <strong>** </strong> Si modifica o elimina una postulación se eliminarán los postulantes que guardaste o tomaron los cupos.
                            </div>

                    </div>
                </div>
            </div>
</section>
@endsection



@section('js')
    <script src="{{ asset('plugins/jquery/moment/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('js/transition.js') }}"></script>
    <script src="{{ asset('js/collapse.js') }}"></script>

    <script src="{{ asset('plugins/jquery/bootstrap-daterangepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('plugins/jquery/bootstrap-daterangepicker/bootstrap-datetimepicker.min.css') }}" type="text/css" />

    <script type="text/javascript">

        $('.datetimepicker').datetimepicker({
            locale: 'es',
            format: 'YYYY-MM-DD HH:mm:ss',
            //daysOfWeekDisabled: [0],
        });
    </script>

@endsection


