@extends('layouts.global-externo')

@section('content')

<section>
    <div class="container">

        <h4 class="text-center">Planilla</h4>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Crear la primera planilla del Local</h5>
            </div>
            <div class="card-body">
                <b class="text-center">@include('incluir/mensajes')</b>

                          {!! Form::open(['action' => 'AdminController@postCrearPlanilla', 'method' => 'POST']) !!}

                            
                              <div class="row form-group">
                                <label class="col-md-2 col-lg-2">ID Local :</label>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('local_id', $local->id, ['class'=>'form-control', 'readonly']) !!}   </div>

                                <label class="col-md-2 col-lg-2">ID Local :</label>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('nombreLocal', $local->nombre, ['class'=>'form-control', 'readonly']) !!}   </div>
                              </div>
                            

                            
                              <div class="row form-group">
                                <label class="col-md-2 col-lg-2">Inicio Uso :</label>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('inicioPlanilla', null, ['class'=>'datetimepicker2 form-control', 'placeholder' => '2016-08-22', 'required']) !!}   </div>

                                <label class="col-md-2 col-lg-2">Fin Uso :</label>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('finPlanilla', null, ['class'=>'datetimepicker2 form-control', 'placeholder' => '2016-08-28', 'required']) !!}   </div>
                              </div>
                            
                              <div class="row form-group">
                                <label class="col-md-2 col-lg-2">Inicio Toma :</label>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('inicioToma', null, ['class'=>'datetimepicker form-control', 'placeholder' => '2016-08-17 23:45:00', 'required']) !!}   </div>

                                <label class="col-md-2 col-lg-2">Fin Toma :</label>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('finToma', null, ['class'=>'datetimepicker form-control', 'placeholder' => '2016-08-17 23:59:00', 'required']) !!}   </div>
                              </div>
                            
                              <div class="row form-group">
                                <label class="col-md-2 col-lg-2">Inicio Repechaje:</label>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('inicioRepechaje', null, ['class'=>'datetimepicker form-control', 'placeholder' => '2016-08-18 23:45:00']) !!}   </div>

                                <label class="col-md-2 col-lg-2">Fin Repechaje :</label>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('finRepechaje', null, ['class'=>'datetimepicker form-control', 'placeholder' => '2016-08-18 23:59:00']) !!}   </div>
                              </div>
                            
                              <div class="row form-group">
                                <label class="col-md-2 col-lg-2">Inicio Pre-Toma :</label>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('inicioPreToma', null, ['class'=>'datetimepicker form-control', 'placeholder' => '2016-08-16 23:45:00']) !!}   </div>

                                <label class="col-md-2 col-lg-2">Fin Pre-Toma :</label>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('finPreToma', null, ['class'=>'datetimepicker form-control', 'placeholder' => '2016-08-16 23:59:00']) !!}   </div>
                              </div>

                              <hr>
                              
                              <div class="row">
                                <div class="col-md-12 text-center">
                                  {!! Form::submit('Crear', ['class'=>'btn btn-sm btn-success']) !!}
                                  <a href="{{ url('admin/local/'.$local->id.'/opciones') }}" class="btn btn-primary btn-sm"  data-toggle="tooltip" title="Opciones">Regresar</a>
                                </div>
                              </div>

                              {!! Form::close() !!}

                                <div class="p-t-35"></div>
                                <div class="alert alert-info" role="alert">
                                    <strong>** </strong> El "Inicio de Uso" debe comenzar en un día lunes y el "Fin de Uso" debe terminar un día domingo.
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

        $('.datetimepicker2').datetimepicker({
            locale: 'es',
            format: 'YYYY-MM-DD',
            //daysOfWeekDisabled: [0],
        });
    </script>

@endsection


