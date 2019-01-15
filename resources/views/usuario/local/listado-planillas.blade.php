@extends('layouts.global-externo')

@section('content')
<section>
        <div class="container">

            <h5 class="text-center">Planillas</h5>
            <p class="m-b-25 text-center">Listado de mis planillas</p>

            <b class="text-center">@include('incluir/mensajes')</b>
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5 class="card-title">Listado</h5>
                        </div>
                        <div class="card-block">
                          
                          
                            <div class="row hidden-md-down">
                              <div class="col-lg-2 ">
                                <b>ID</b>
                              </div>
                              <div class="col-lg-2">
                                <b>Comienza</b>
                              </div>
                              <div class="col-lg-2">
                                <b>Termina</b>
                              </div>
                              <div class="col-lg-2">
                                <b>Inicio Toma</b>
                              </div>
                              <div class="col-lg-2">
                                <b>Fin Toma</b>
                              </div> 
                              
                              <div class="col-lg-1 text-center">
                                <b>Turnos</b>
                              </div>   
                              <div class="col-lg-1 text-center">
                                <b>PDF</b>
                              </div>                                                         
                             
                                                           
                            </div>
                            <hr  class="hidden-md-down">

							

                          @foreach($planillas as $planilla)

                            <div class="row">
                                <div class="col-6 col-sm-6 col-md-6 hidden-lg-up">
                                    <b>ID: </b>
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-2">
                                    {{ $planilla->id }}
                                </div>

                                <div class="col-6 col-sm-6 col-md-6 hidden-lg-up">
                                    <b>Inicio Planilla: </b>
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-2">
                                    {{ $planilla->inicioPlanilla }}
                                </div>

                                <div class="col-6 col-sm-6  col-md-6 hidden-lg-up">
                                    <b>Fin Planilla: </b>
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-2">
                                    {{ $planilla->finPlanilla }}
                                </div>

                                <div class="col-6 col-sm-6 col-md-6 hidden-lg-up">
                                    <b>Inicio Toma: </b>
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-2">
                                    {{ $planilla->inicioToma }}
                                </div>

                                <div class="col-6 col-sm-6 col-md-6 hidden-lg-up">
                                    <b>Fin Toma: </b>
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-2">
                                    {{ $planilla->finToma }}
                                </div>

                                <div class="hidden-lg-up p-t-35"></div>

                                <div class="col-6 col-sm-6 col-md-6 hidden-lg-up">
                                    <b>Ver Turnos: </b>
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-1 text-center">
                                    <a href="{{ url('usuario/planilla/'.$planilla->id.'/turnos-tomados') }}" class="btn-sm btn-success"  data-toggle="tooltip" title="Ver Turnos">Ver</a>
                                </div>

                                <div class="hidden-lg-up p-t-35"></div>
                                <div class="col-6 col-sm-6 col-md-6 hidden-lg-up">
                                    <b>Descargar: </b>
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-1 text-center">
                                    <a href="{{ url('usuario/planilla/'.$planilla->id.'/pdf-turnos') }}" class="btn-sm btn-danger"  data-toggle="tooltip" title="Descargar">Ver</a>
                                </div>
                            </div>

                          <hr class="hidden-md hidden-lg">

                          @endforeach

                            <div class="row">
                                <div class="col-md-12">
                                  {!! $planillas->links('vendor.pagination.simple-bootstrap-4') !!}
                                </div>
                            </div>


                            <div class="row">
                            	<div class="col-md-12 text-center">
                            		<a href="{{ url('usuario/mis-locales') }}" class="btn btn-info  btn-sm"  data-toggle="tooltip" title="Regresar">Regresar</a>
                            	</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection



@section('js')


@endsection


