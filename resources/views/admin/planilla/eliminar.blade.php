@extends('layouts.global-nero')

@section('content')

<section>
    <div class="container">

        <h4 class="text-center">Planilla</h4>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Eliminar planilla</h5>
            </div>
            <div class="card-body">
                <b class="text-center">@include('incluir/mensajes')</b>

                          {!! Form::open(['route' => ['admin.planilla.deletePlanilla', $planilla], 'method' => 'DELETE']) !!}

                            
                              <div class="row form-group">
                                <label class="col-md-2 col-lg-2">ID Planilla :</label>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('id', $planilla->id, ['class'=>'form-control', 'readonly']) !!}   </div>

                                <label class="col-md-2 col-lg-2">ID Local :</label>
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
                                <div class="col-md-4 col-lg-4"> {!! Form::text('inicioToma', $planilla->inicioToma, ['class'=>'form-control', 'readonly']) !!}   </div>

                                <label class="col-md-2 col-lg-2">Fin Toma :</label>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('finToma', $planilla->finToma, ['class'=>'form-control', 'readonly']) !!}   </div>
                              </div>
                            
                              <div class="row form-group">
                                <label class="col-md-2 col-lg-2">Inicio Repechaje:</label>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('inicioRepechaje', $planilla->inicioRepechaje, ['class'=>'form-control', 'readonly']) !!}   </div>

                                <label class="col-md-2 col-lg-2">Fin Repechaje :</label>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('finRepechaje', $planilla->finRepechaje, ['class'=>'form-control', 'readonly']) !!}   </div>
                              </div>
                            
                              <div class="row form-group">
                                <label class="col-md-2 col-lg-2">Inicio Pre-Toma :</label>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('inicioPreToma', $planilla->inicioPreToma, ['class'=>'form-control', 'readonly']) !!}   </div>

                                <label class="col-md-2 col-lg-2">Fin Pre-Toma :</label>
                                <div class="col-md-4 col-lg-4"> {!! Form::text('finPreToma', $planilla->finPreToma, ['class'=>'form-control', 'readonly']) !!}   </div>
                              </div>

                              <hr>
                              
                              <div class="row">
                                <div class="col-md-12 text-center">
                                  {!! Form::submit('Eliminar', ['class'=>'btn btn-sm btn-danger']) !!}
                                  <a href="{{ url('admin/planilla/'.$planilla->id.'/opciones') }}" class="btn btn-primary btn-sm"  data-toggle="tooltip" title="Opciones">Regresar</a>
                                </div>
                              </div> 

                              {!! Form::close() !!}

                            <div class="p-t-40"></div>
                            <div class="alert alert-danger" role="alert">
                                <strong>** </strong> Si Elimina esta planilla perderá los turnos configurados perteneciente a esta planilla hasta los turnos que han sido tomados por los empaques. Después de eliminar esta planilla, al crear una nueva, se copiarán los turnos de la última planilla existente.
                            </div>
            </div>
        </div>
    </div>
</section>
@endsection



@section('js')


@endsection


