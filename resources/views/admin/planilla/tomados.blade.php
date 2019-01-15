@extends('layouts.global-externo')

@section('content')

<section>
  <div class="container">

    <h4 class="text-center">Planilla</h4>

    <div class="card card-primary">
      <div class="card-header">
        <h5 class="card-title">Cant. turnos tomado por empaque</h5>
      </div>
      <div class="card-body">
        <b class="text-center">@include('incluir/mensajes')</b>
                          
                          <div class="row hidden-md-down text-center">
                            <label class="col-lg-2">Nombre</label>
                            <label class="col-lg-2">Rol</label>
                            <label class="col-lg-1">Total</label>
                            <label class="col-lg-1">Toma</label>
                            <label class="col-lg-1">Repechaje</label>
                            <label class="col-lg-1">Asignado</label>
                            <label class="col-lg-1">Pre-Toma</label>
                            <label class="col-lg-1">Cedido</label>
                            <label class="col-lg-1">Cambio</label>
                            <label class="col-lg-1">Regalo</label>
                            
                          </div>
                          <hr  class="row hidden-md-down">
                          @foreach($usuarios as $usuario)

                                <div class="row form-group">
                                  <label  class="col-6 hidden-lg-up">Nombre :</label>
                                  <div class="col-6 col-lg-2 text-center"> {{ $usuario->nombre }} {{ $usuario->apellido }} </div>

                                  <label  class="col-6 hidden-lg-up">Rol :</label>
                                  <div class="col-6 col-lg-2 text-center"> {{ $usuario->rol }} </div>

                                  <label  class="col-6 hidden-lg-up">Total :</label>
                                  <div class="col-6 col-lg-1 text-center"> {{ $usuario->cantTurnos }} </div>

                                  <label  class="col-6 hidden-lg-up">Toma :</label>
                                  <div class="col-6 col-lg-1 text-center"> {{ $usuario->toma }} </div>

                                  <label  class="col-6 hidden-lg-up"> Repechaje : </label>
                                  <div class="col-6 col-lg-1 text-center"> {{ $usuario->repechaje }} </div>

                                  <label  class="col-6 hidden-lg-up">Asignado :</label>
                                  <div class="col-6 col-lg-1 text-center"> {{ $usuario->asignar }} </div>

                                  <label  class="col-6 hidden-lg-up">Pre-Toma :</label>
                                  <div class="col-6 col-lg-1 text-center"> {{ $usuario->pretoma }} </div>

                                  <label  class="col-6 hidden-lg-up">Cedido:</label>
                                  <div class="col-6 col-lg-1 text-center"> {{ $usuario->cedido }} </div>

                                  <label  class="col-6 hidden-lg-up"> Cambio :</label>
                                  <div class="col-6 col-lg-1 text-center"> {{ $usuario->cambio }} </div>

                                  <label  class="col-6 hidden-lg-up">Regalo :</label>
                                  <div class="col-6 col-lg-1 text-center"> {{ $usuario->regalo }} </div>

                                </div>
                                  
                                <hr>
                          @endforeach

                          <div class="row form-group">
                              <div class="col-12 hidden-sm-up d-flex">
                                  {!! $usuarios->links('vendor.pagination.simple-bootstrap-4') !!}
                              </div>
                              <div class="col-md-12 hidden-xs-down d-flex">
                                  {!! $usuarios->links('vendor.pagination.bootstrap-4') !!}
                              </div>
                          </div>
                            <div class="row">
                              <div class="col-md-12 text-center">
                                <a href="{{ url('admin/planilla/'.$planilla->id.'/opciones') }}" class="btn btn-success  btn-sm"  data-toggle="tooltip" title="Opciones">Regresar</a>
                                <a href="{{ url('admin/planilla/'.$planilla->id.'/cant-turnos-tomados') }}" class="btn btn-info  btn-sm"  data-toggle="tooltip" title="Generar PDF">Imprimir</a>
                              </div>
                            </div>  

                          <div class="p-t-35"></div>
                          <div class="alert alert-info" role="alert">
                            <strong>** </strong> El total es la suma de los turnos tomados, asignados, pre-toma, etc.
                          </div>
      </div>
    </div>
  </div>
</section>
@endsection



@section('js')


@endsection


