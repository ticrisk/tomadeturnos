@extends('layouts.global-externo')
<?php
  
  $semana = array("","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo");
?>
@section('content')
<section>
        <div class="container">

            <h4 class="text-center">Planilla <i class="fa fa-star text-warning pull-right" aria-hidden="true" data-toggle="tooltip" title="Opción Premium"></i></h4>
            <p class="m-b-25 text-center">Listado de turnos que sobran o tienen problemas</p>

            <b class="text-center">@include('incluir/mensajes')</b>

            <div class="card card-info">
                <div class="card-header">
                    <h5 class="card-title">Turnos con más empaques de lo permitido</h5>
                </div>
                <div class="card-block">
                          <div class="row">
                            
                              @foreach($arrayError as $arr)
                              <div class="col-md-12">
                                 {{ $semana[date('N',strtotime($arr->fecha))] }} {{ date('d-m-Y', strtotime($arr->fecha)) }} => {{ date('H:i', strtotime($arr->inicio)) }} - {{ date('H:i', strtotime($arr->termino)) }}
                              </div>
                              @endforeach
                            
                          </div>



                    </div>
                  </div>


            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Turnos que no han sido tomados</h5>
                </div>
                <div class="card-block">
                          
                          <div class="row" >
                          		@foreach($arraySobra as $arr)
                                <div class="col-md-12">
                                ({{ $arr->cantTurnosSobra }}) {{ $semana[date('N',strtotime($arr->fecha))] }} {{ date('d-m-Y', strtotime($arr->fecha)) }} => {{ date('H:i', strtotime($arr->inicio)) }} - {{ date('H:i', strtotime($arr->termino)) }}
                                </div>
                          		@endforeach                          		
                          	
                          </div>

                          <div class="row">
                                <div class="col-md-12 text-center">
                                  <a href="{{ url('usuario/planilla/'.$planilla->id.'/turnos') }}" class="btn btn-sm btn-success">Ver Turnos</a>
                                  <a href="{{ url('usuario/planilla/'.$planilla->id.'/opciones') }}" class="btn btn-sm btn-primary">Regresar</a>
                                </div>
                            </div>
                </div>
            </div>
        </div>
</section>
@endsection



@section('js')


@endsection                          