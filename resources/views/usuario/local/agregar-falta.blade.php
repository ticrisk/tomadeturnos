@extends('layouts.global-nero')

@section('content')

<section>
        <div class="container">

            <h4 class="text-center">Falta <i class="fa fa-star text-warning pull-right" aria-hidden="true" data-toggle="tooltip" title="Opción Premium"></i></h4>
            <p class="m-b-25 text-center">Asignar falta al usuario</p>

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Agregar Usuario</h5>
                </div>
                <div class="card-block">

                    <b class="text-center">@include('incluir/mensajes')</b>

                          {!! Form::open(['action' => 'UsuarioController@postAgregarFalta', 'method' => 'POST']) !!}

                            {!! Form::hidden('local_user_id', $local_user_id) !!}
                            {!! Form::hidden('local_id', $local_id) !!}

                            <div class="row form-group">
                                <label class="col-md-2 col-lg-2 control-label">Fecha</label>
                                <div class="col-md-4 -lg-4">
                                    {!! Form::text('fecha', null, ['class'=>'datetimepicker form-control','placeholder'=>'2018-12-31 13:30:00']) !!}
                                </div>
                                
                                <label class="col-md-2 col-lg-2 control-label">Tipo</label>
                                <div class="col-md-4 col-lg-4">
                                    {!! Form::select('tipo',['Leve'=>'leve','Media'=>'Media','Grave'=>'Grave'],null, ['class'=>'form-control select-category']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-lg-2 control-label">Descripción</label>
                                <div class="col-lg-10">
                                    {!! Form::textarea('descripcion', null, ['class'=>'form-control']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                              <div class="col-lg-12 text-center">
                                {!! Form::submit('Guardar', ['class'=>'btn btn-sm btn-success']) !!}
                                <a href="{{ url('usuario/local/faltas/'.$local_user_id) }}" class="btn btn-sm btn-primary">Volver</a>
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


