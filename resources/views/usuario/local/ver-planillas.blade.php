@extends('layouts.global-externo')

@section('content')
<section>
        <div class="container">

            <h4 class="text-center">Planillas</h4>

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Listado</h5>
                </div>
                <div class="card-block">
                    <b class="text-center">@include('incluir/mensajes')</b>
                            <div class="row hidden-sm-down">
                              <div class="col-md-1 ">
                                <b>ID</b>
                              </div>
                              <div class="col-md-2">
                                <b>Comienza</b>
                              </div>
                              <div class="col-md-2">
                                <b>Termina</b>
                              </div>
                              <div class="col-md-2">
                                <b>Inicio Toma</b>
                              </div>
                              <div class="col-md-2">
                                <b>Fin Toma</b>
                              </div> 
                              
                              <div class="col-md-3 text-center">
                                <b>Opciones Planilla</b>
                              </div>   

                                                           
                            </div>
                            <hr class="hidden-xs hidden-sm">

                          @foreach($planillas as $planilla)

                          <div class="row">
                              <div class="col-6 col-sm-6 hidden-md-up control-label"><b>ID:</b></div>
                              <div class="col-6 col-sm-6 col-md-1">{{ $planilla->id }}</div>

                              <div class="col-6 col-sm-6 hidden-md-up control-label"> <b>Inicio Uso:</b> </div>
                              <div class="col-6 col-sm-6 col-md-2">{{ $planilla->inicioPlanilla }}</div>

                              <div class="col-6 col-sm-6 hidden-md-up control-label"> <b>Fin Uso:</b> </div>
                              <div class="col-6 col-sm-6 col-md-2">{{ $planilla->finPlanilla }}</div>

                              <div class="col-6 col-sm-6 hidden-md-up control-label"> <b>Inicio Toma:</b> </div>
                              <div class="col-6 col-sm-6 col-md-2">{{ $planilla->inicioToma }}</div>

                              <div class="col-6 col-sm-6 hidden-md-up control-label"> <b>Fin Toma:</b> </div>
                              <div class="col-6 col-sm-6 col-md-2">{{ $planilla->finToma }}</div>

                              <div class="hidden-md-up p-t-35"></div>
                              <div class="col-6 col-sm-6 hidden-md-up control-label"> <b>Planilla :</b> </div>
                              <div class="col-6 col-sm-6 col-md-3 text-center">
                                <a href="{{ url('usuario/planilla/'.$planilla->id.'/opciones') }}" class="btn btn-success  btn-sm"  data-toggle="tooltip" title="Opciones">Configurar</a>
                              </div>         
                          </div>

                          <hr>
                          @endforeach

                            <div class="row form-group">
                                <div class="col-12 hidden-sm-up d-flex">
                                    {!! $planillas->links('vendor.pagination.simple-bootstrap-4') !!}
                                </div>
                                <div class="col-md-12 hidden-xs-down d-flex">
                                    {!! $planillas->links('vendor.pagination.bootstrap-4') !!}
                                </div>
                            </div>


                            <div class="row form-group">
                            	<div class="col-md-12 text-center">
                            		<a href="{{ url('usuario/local/'.$local.'/opciones') }}" class="btn btn-info  btn-sm"  data-toggle="tooltip" title="Opciones">Regresar</a>
                            	</div>
                            </div>
                </div>
            </div>
        </div>
</section>
@endsection



@section('js')


@endsection


