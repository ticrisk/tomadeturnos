@extends('layouts.global-externo')

@section('content')

<section>
        <div class="container">

            <h4 class="text-center">Postulación <i class="fa fa-star text-warning pull-right" aria-hidden="true" data-toggle="tooltip" title="Opción Premium"></i></h4>
            <p class="m-b-25 text-center">Insertar Postulación</p>

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Agregar</h5>
                </div>
                <div class="card-block">

                    <b class="text-center">@include('incluir/mensajes')</b>

                            {!! Form::open(['action' => 'UsuarioController@postAgregarPostulacion', 'method' => 'POST'])!!}


                            {!! Form::hidden('local_id', $local) !!}

                            <div class="row form-group">
                                <label class="col-lg-2 control-label">Cupos</label>
                                <div class="col-lg-4">
                                    {!! Form::text('cupos', null,['class'=>'form-control','placeholder'=>'Sólo Números', 'required']) !!}
                                </div>

                                <label class="col-lg-2 control-label">Tipo</label>
                                <div class="col-lg-4">
                                    {!! Form::select('activarLista',['Privada'=>'Privada','Pública'=>'Pública','Azar'=>'Azar'],null, ['class'=>'form-control select-category']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-lg-2 control-label">Inicio</label>
                                <div class="col-lg-4">
                                    {!! Form::text('inicio', null,['class'=>'datetimepicker form-control','placeholder'=>'2017-06-01 23:45:00', 'required']) !!}
                                </div>

                                <label class="col-lg-2 control-label">Termino</label>
                                <div class="col-lg-4">
                                    {!! Form::text('termino', null,['class'=>'datetimepicker form-control','placeholder'=>'2017-06-01 23:59:00', 'required']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-lg-2 control-label">Descripción</label>
                                <div class="col-lg-10">
                                    {!! Form::textarea('descripcion', null,['class'=>'form-control','placeholder'=>'Descripción Obligatorio', 'required']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-lg-12 text-center">
                                    {!! Form::submit('Guardar', ['class'=>'btn btn-sm btn-success']) !!}
                                    <a href="{{ url('usuario/local/'.$local.'/postulaciones') }}" class="btn btn-sm btn-primary">Postulaciones</a>
                                </div>
                            </div>

                            {!! Form::close() !!}

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


