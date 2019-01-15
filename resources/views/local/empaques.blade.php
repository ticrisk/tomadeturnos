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
                    <div class="panel-heading font-bold">Empaques del Local</div>
                    <div class="panel-body">
                          <b class="text-center">@include('incluir/mensajes')</b>
                          
                            <div class="row">
                              <div class="col-md-2 text-center">
                                <b>ID Local User</b>
                              </div>
                              <div class="col-md-2">
                                <b>Nombre</b>
                              </div>
                              <div class="col-md-2">
                                <b>Apellido</b>
                              </div>
                              <div class="col-md-1">
                                <b>Rol</b>
                              </div>
                              <div class="col-md-2">
                                <b>Estado</b>
                              </div> 
                              
                              <div class="col-md-1 text-center">
                                <b>Modificar</b>
                              </div>   
                              <div class="col-md-1 text-center">
                                <b>Desvincular</b>
                              </div>                                                         
                              <div class="col-md-1 text-center">
                                <b>Perfil</b>
                              </div>
                                                          
                            </div>

                            <hr>

                            @foreach($empaques as $empaque)

                            <div class="row">
                              <div class="col-md-2 text-center">
                                {{ $empaque->id }}
                              </div>
                              <div class="col-md-2">
                                {{ $empaque->User->nombre }}
                              </div>
                              <div class="col-md-2">
                                {{ $empaque->User->apellido }}
                              </div>
                              <div class="col-md-1">
                                {{ $empaque->rol }}
                              </div>
                              <div class="col-md-2">
                                {{ $empaque->estado }}
                              </div> 
                              
                              <div class="col-md-1 text-center">
                                <a href="{{ url('admin/'.$empaque->id.'/edit') }}" class="btn btn-info  btn-sm"  data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                              </div>   
                              <div class="col-md-1 text-center">
                                {!! Form::open(['route' => ['admin.destroy', $empaque->id], 'method' => 'DELETE']) !!}
                                  <!--<button type="submit">Eliminar</button>-->
                                  <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Eliminar" onclick="return confirm('¿Esta seguro que desea Desvincular este Usuario?')"><i class="fa fa-trash"></i></button>
                                {!! Form::close() !!}
                              </div>                                                         
                              <div class="col-md-1 text-center">
                                <!-- ir a user/id/show || mostrar información del usuario-->
                                <a href="{{ url('user/'.$empaque->User->id) }}" class="btn btn-success  btn-sm"  data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                              </div>
                                                          
                            </div> 
                            <hr>

                            @endforeach

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


