@extends('layouts.global-externo')

@section('content')

  <!-- content 
  <div id="content" class="app-content" role="main">
    <div class="app-content-body ">
        -->

        <div class="bg-light lter b-b wrapper-md">
          <h1 class="m-n font-thin h3">Planillas</h1>
        </div>
        <div class="wrapper-md" ng-controller="FormDemoCtrl">

              <div class="row">
               
                <div class="col-sm-12">
                  <div class="panel panel-default">
                    <div class="panel-heading font-bold">Listado de Planillas del Local</div>
                    <div class="panel-body">
                          
                          
                            <div class="row hidden-xs hidden-sm">
                              <div class="col-md-1 ">
                                <b>ID</b>
                              </div>
                              <div class="col-md-1">
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
                              
                              <div class="col-md-2 text-center">
                                <b>Opciones Planilla</b>
                              </div>   
                              <div class="col-md-2 text-center">
                                <b>Opciones Turnos</b>
                              </div>                                                         
                             
                                                           
                            </div>
                            <hr class="hidden-xs hidden-sm">

							<b class="text-center">@include('incluir/mensajes')</b>

                          @foreach($planillas as $planilla)

                          <!-- Vista PC -->

                            <div class="row hidden-xs hidden-sm">
                              <div class="col-md-1">
                                {{ $planilla->id }}
                              </div>
                              <div class="col-md-1">
                                {{ $planilla->inicioPlanilla }}
                              </div>
                              <div class="col-md-2">
                                {{ $planilla->finPlanilla }}
                              </div>
                              <div class="col-md-2">
                                {{ $planilla->inicioToma }}
                              </div>
                              <div class="col-md-2">
                                {{ $planilla->finToma }}
                              </div> 
                             
                              <div class="col-md-2 text-center">
                                <a href="{{ url('admin/planilla/'.$planilla->id.'/opciones') }}" class="btn btn-success  btn-sm"  data-toggle="tooltip" title="Opciones">Configurar</a>
                              </div>         
                              <div class="col-md-2 text-center">
                                <a href="#" class="btn btn-primary  btn-sm"  data-toggle="tooltip" title="Opciones" disabled="disabled">Configurar</a>
                              </div>                                                     
                              
                                                           
                            </div>
                            <hr class="hidden-xs hidden-sm">

                          <!-- FIn Vista PC -->


                          <!-- Vista Mobile -->

                          <div class="row hidden-md hidden-lg">
                            <div class="col-xs-6 col-sm-6"> <b>ID :</b> </div>
                            <div class="col-xs-6 col-sm-6"> {{ $planilla->id }} </div>
                          </div>

                          <div class="row hidden-md hidden-lg">
                            <div class="col-xs-6 col-sm-6"> <b>Inicio Uso :</b> </div>
                            <div class="col-xs-6 col-sm-6"> {{ $planilla->inicioPlanilla }} </div>
                          </div>

                          <div class="row hidden-md hidden-lg">
                            <div class="col-xs-6 col-sm-6"> <b>Fin Uso :</b> </div>
                            <div class="col-xs-6 col-sm-6"> {{ $planilla->finPlanilla }} </div>
                          </div>

                          <div class="row hidden-md hidden-lg">
                            <div class="col-xs-6 col-sm-6"> <b>Inicio Toma :</b> </div>
                            <div class="col-xs-6 col-sm-6"> {{ $planilla->inicioToma }} </div>
                          </div>

                          <div class="row hidden-md hidden-lg">
                            <div class="col-xs-6 col-sm-6"> <b>Fin Toma :</b> </div>
                            <div class="col-xs-6 col-sm-6"> {{ $planilla->finToma }} </div>
                          </div>
                          <br/>
                          <div class="row hidden-md hidden-lg">
                            <div class="col-xs-6 col-sm-6"> <b>Configurar :</b> </div>
                            <div class="col-xs-6 col-sm-6">
                             <a href="{{ url('admin/planilla/'.$planilla->id.'/opciones') }}" class="btn btn-success  btn-sm"  data-toggle="tooltip" title="Opciones">Configurar</a>
                            </div>
                          </div>  
                          <br class="hidden-md hidden-lg" />
                          <div class="row hidden-md hidden-lg">
                            <div class="col-xs-6 col-sm-6"> <b>Configurar :</b> </div>
                            <div class="col-xs-6 col-sm-6">
                             <a href="#" class="btn btn-primary  btn-sm"  data-toggle="tooltip" title="Opciones" disabled="disabled">Configurar</a>
                            </div>
                          </div>                
                                                                                    
                          

                          <hr class="hidden-md hidden-lg">

                          <!-- Fin Vista Mobile -->
                          @endforeach              
                          
                            <div class="text-center">
                              	{!! $planillas->render() !!}
                            </div>     


                            <div class="row">
                            	<div class="col-md-12 text-center">
                            		<a href="{{ url('admin/local/listado') }}" class="btn btn-info  btn-sm"  data-toggle="tooltip" title="Opciones">Regresar</a>
                            	</div>
                            </div>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>

<!--

    </div>
</div>

-->



@endsection



@section('js')


@endsection


