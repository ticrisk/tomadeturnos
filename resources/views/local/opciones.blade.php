@extends('layouts.global-nero')

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
                    <div class="panel-heading font-bold">Opciones del Local</div>
                    <div class="panel-body">
                          <b class="text-center">@include('incluir/mensajes')</b>
                          
                            <div class="row">
                              <div class="col-md-1 ">
                                <b>ID</b>
                              </div>
                              <div class="col-md-2">
                                <b>Cadena</b>
                              </div>
                              <div class="col-md-2">
                                <b>Nombre</b>
                              </div>
                              <div class="col-md-1">
                                <b>Cuenta</b>
                              </div>
                              <div class="col-md-1">
                                <b>Estado</b>
                              </div> 
                              
                              <div class="col-md-2">
                                <b>Crear Planilla</b>
                              </div>   
                              <div class="col-md-1">
                                <b>Planillas</b>
                              </div>                                                         
                              <div class="col-md-1">
                                <b>Modificar</b>
                              </div>
                              <div class="col-md-1">
                                <b>Eliminar</b>
                              </div>                              
                            </div>

                            <hr>

                            <div class="row">
                              <div class="col-md-1 ">
                                <b>ID</b>
                              </div>
                              <div class="col-md-2">
                                <b>Cadena</b>
                              </div>
                              <div class="col-md-2">
                                <b>Nombre</b>
                              </div>
                              <div class="col-md-1">
                                <b>Cuenta</b>
                              </div>
                              <div class="col-md-1">
                                <b>Estado</b>
                              </div> 
                              
                              <div class="col-md-2">
                                <b>Crear Planilla</b>
                              </div>   
                              <div class="col-md-1">
                                <b>Planillas</b>
                              </div>                                                         
                              <div class="col-md-1">
                                <a href="{{ url('local/'.$local->id.'/edit') }}" class="btn btn-info  btn-sm"  data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                              </div>
                              <div class="col-md-1">
                                <a href="{{ url('local/'.$local->id) }}" class="btn btn-danger  btn-sm"  data-toggle="tooltip" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              </div>                              
                            </div> 

                            <div class="row">
                              <div class="col-lg-12 text-center">
                                <a href="{{ url('local') }}" class="btn btn-sm btn-primary">Volver</a>
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


