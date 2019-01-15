@extends('layouts.global-externo')

@section('content')

<section>
    <div class="container">

        <h4 class="text-center">Planillas</h4>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Editar planilla</h5>
            </div>
            <div class="card-body">
                <b class="text-center">@include('incluir/mensajes')</b>
                          {!! Form::open(['route' => ['admin.planilla.editar', $planilla], 'method' => 'PUT']) !!}
                            
                              <div class="row form-group">
                                <div class="col-md-2 col-lg-2"> <b>ID Planilla : </b> </div>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('id', $planilla->id, ['class'=>'form-control', 'readonly']) !!}   </div>

                                <div class="col-md-2 col-lg-2"> <b>Local : </b> </div>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('local_id', $planilla->local->nombre, ['class'=>'form-control', 'readonly']) !!}   </div>
                              </div>
                            

                            
                              <div class="row form-group">
                                <label class="col-md-2 col-lg-2">Inicio Uso :</label>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('inicioPlanilla', $planilla->inicioPlanilla, ['class'=>'form-control', 'readonly']) !!}   </div>

                                <label class="col-md-2 col-lg-2">Fin Uso :</label>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('finPlanilla', $planilla->finPlanilla, ['class'=>'form-control', 'readonly']) !!}   </div>
                              </div>
                            
                              <div class="row form-group">
                                <label class="col-md-2 col-lg-2">Inicio Toma :</label>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('inicioToma', $planilla->inicioToma, ['class'=>'datetimepicker form-control', 'placeholder' => '2016-08-17 23:45:00']) !!}   </div>

                                <label class="col-md-2 col-lg-2">Fin Toma :</label>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('finToma', $planilla->finToma, ['class'=>'datetimepicker form-control', 'placeholder' => '2016-08-17 23:59:00']) !!}   </div>
                              </div>
                            
                              <div class="row form-group">
                                <label class="col-md-2 col-lg-2">Inicio Repechaje:</label>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('inicioRepechaje', $planilla->inicioRepechaje, ['class'=>'datetimepicker form-control', 'placeholder' => '2016-08-18 23:45:00']) !!}   </div>

                                <label class="col-md-2 col-lg-2">Fin Repechaje :</label>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('finRepechaje', $planilla->finRepechaje, ['class'=>'datetimepicker form-control', 'placeholder' => '2016-08-18 23:59:00']) !!}   </div>
                              </div>
                            
                              <div class="row form-group">
                                <label class="col-md-2 col-lg-2">Inicio Pre-Toma :</label>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('inicioPreToma', $planilla->inicioPreToma, ['class'=>'datetimepicker form-control', 'placeholder' => '2016-08-16 23:45:00']) !!}   </div>

                                <label class="col-md-2 col-lg-2">Fin Pre-Toma :</label>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('finPreToma', $planilla->finPreToma, ['class'=>'datetimepicker form-control', 'placeholder' => '2016-08-16 23:59:00']) !!}   </div>
                              </div>

                              <hr>
                              
                              <div class="row">
                                <div class="col-md-12 text-center">
                                  {!! Form::submit('Guardar', ['class'=>'btn btn-sm btn-success']) !!}
                                  <a href="{{ url('admin/planilla/'.$planilla->id.'/opciones') }}" class="btn btn-primary btn-sm"  data-toggle="tooltip" title="Opciones">Regresar</a>
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


