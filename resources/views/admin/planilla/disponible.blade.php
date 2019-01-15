@extends('layouts.global-nero')

<?php
  
  $semana = array("","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo");
?>
@section('content')

<section>
    <div class="container">

        <h4 class="text-center">Estadísticas</h4>
        <b class="text-center">@include('incluir/mensajes')</b>

        <div class="card card-warning">
            <div class="card-header">
                <h5 class="card-title">Turnos con más empaques de lo permitido</h5>
            </div>
            <div class="card-body">

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
            <div class="card-body">
                          
                          <div class="row" >
                          		@foreach($arraySobra as $arr)
                          			<div class="col-md-12">
                          			({{ $arr->cantTurnosSobra }}) {{ $semana[date('N',strtotime($arr->fecha))] }} {{ date('d-m-Y', strtotime($arr->fecha)) }} => {{ date('H:i', strtotime($arr->inicio)) }} - {{ date('H:i', strtotime($arr->termino)) }}
                          			</div>
                          		@endforeach                          		
                          	
                          </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a href="{{ url('admin/planilla/'.$planilla->id.'/turnos') }}" class="btn btn-sm btn-success">Ver Turnos  </a>
                                <a href="{{ url('admin/planilla/'.$planilla->id.'/opciones') }}" class="btn btn-sm btn-primary">Opciones</a>
                            </div>
                        </div>

            </div>
        </div>
    </div>
</section>

@endsection



@section('js')


@endsection                          