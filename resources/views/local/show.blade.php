@extends('layouts.global-externo')

@section('content')

  <!-- content 
  <div id="content" class="app-content" role="main">
    <div class="app-content-body ">
        -->

        <div class="bg-light lter b-b wrapper-md">
          <h1 class="m-n font-thin h3">Local</h1>
        </div>
        <div class="wrapper-md" ng-controller="FormDemoCtrl">

              <div class="row">
               
                <div class="col-sm-12">
                  <div class="panel panel-default">
                    <div class="panel-heading font-bold">Eliminar Local</div>
                    <div class="panel-body">
                                                
                          
                          <div class="bs-example form-horizontal">
                          {!! Form::open(['route' => ['local.destroy', $local], 'method' => 'DELETE'])!!}

                            <b class="text-center">@include('incluir/mensajes')</b>

                                   

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nombre</label>
                                <div class="col-lg-10">
                                    {!! Form::text('nombre', $local->nombre,['class'=>'form-control','placeholder'=>'Nombre Obligatorio', 'required', 'readonly']) !!}
                                </div>

                            </div>  
 
                                                                                        
                            
                            <div class="form-group">
                              <div class="col-lg-12 text-center">
                                {!! Form::submit('Eliminar', ['class'=>'btn btn-sm btn-danger']) !!}
                                <a href="{{ url('local') }}" class="btn btn-sm btn-primary">Volver</a>
                              </div>
                            </div>
                         
                          {!! Form::close() !!}

                            <p class="text-danger">** Si Elimina este Local se eliminaran en cascada los empaques asignados, planillas, turnos tomados, faltas y todo lo relacionado con el local.</p>
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


