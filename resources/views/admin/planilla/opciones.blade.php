@extends('layouts.global-externo')

@section('content')

<section>
  <div class="container">

    <h4 class="text-center">Planillas</h4>

    <div class="card card-primary">
      <div class="card-header">
        <h5 class="card-title">Opciones</h5>
      </div>
      <div class="card-body">
        <b class="text-center">@include('incluir/mensajes')</b>
                          
                            <p><b><i>Opciones Free</i></b></p>
                            <div class="row form-group">

                              <div class="col-12 col-md-3">
                                <a href="{{ url('admin/planilla/'.$planilla->id.'/editar') }}" class="btn btn-success  btn-sm btn-block"  data-toggle="tooltip" title="Opciones">Editar Planilla</a>
                              </div>

                              <div class="p-t-45 hidden-md-up"></div>
                              <div class="col-12 col-md-3">
                                <a href="{{ url('admin/planilla/'.$planilla->id.'/editarTurnos') }}" class="btn btn-info  btn-sm btn-block"  data-toggle="tooltip" title="Opciones">Editar Turnos</a>
                              </div>

                              <div class="p-t-45 hidden-md-up"></div>
                              <div class="col-12 col-md-3">
                                <a href="{{ url('admin/planilla/'.$planilla->id.'/turnos') }}" class="btn btn-primary  btn-sm btn-block"  data-toggle="tooltip" title="Opciones">Ver Turnos</a>
                              </div>

                              <div class="p-t-45"></div>
                              <div class="col-12 col-md-3">
                                <a href="{{ url('admin/planilla/'.$planilla->id.'/eliminar') }}" class="btn btn-danger  btn-sm btn-block"  data-toggle="tooltip" title="Opciones">Eliminar Planilla</a>
                              </div>                               


                            </div>

                            <p><b><i>Opciones Premium</i></b></p>
                            <div class="row form-group">

                              <div class="col-12 col-md-3 text-center">
                                <a href="{{ url('admin/planilla/'.$planilla->id.'/asignar') }}" class="btn btn-success  btn-sm btn-block"  data-toggle="tooltip" title="Opciones">Asignar Turno</a>
                              </div>

                              <div class="p-t-45 hidden-md-up"></div>
                              <div class="col-12 col-md-3 text-center">
                                <a href="{{ url('admin/planilla/'.$planilla->id.'/disponible') }}" class="btn btn-info  btn-sm btn-block"  data-toggle="tooltip" title="Turnos Disponibles">Disponible</a>
                              </div>

                              <div class="p-t-45 hidden-md-up"></div>
                              <div class="col-12 col-md-3 text-center">
                                <a href="{{ url('admin/planilla/'.$planilla->id.'/tomados') }}" class="btn btn-primary  btn-sm btn-block"  data-toggle="tooltip" title="Cantidad Turnos Tomados">Cant. Tomados</a>
                              </div>

                              <div class="p-t-45 hidden-md-up"></div>
                              <div class="col-12 col-md-3">
                                <a href="{{ url('admin/planilla/'.$planilla->id.'/pdf') }}" class="btn btn-warning  btn-sm btn-block"  data-toggle="tooltip" title="Imprimir">Imprimir Planilla</a>
                              </div>

                                <div class="p-t-45"></div>
                                <div class="col-xs-12 col-md-3 text-center">
                                    {!! Form::open(['route' => ['admin.planilla.deletePreToma', $planilla->id], 'method' => 'DELETE']) !!}
                                    <button type="submit" class="btn btn-danger btn-sm btn-block" data-toggle="tooltip" title="Eliminar Pre-Toma" onclick="return confirm('¿Está seguro que desea eliminar los empaques que tomaron Pre-Toma?.')">Borrar Pre-Toma</button>
                                    {!! Form::close() !!}
                                </div>

                                <div class="p-t-45"></div>
                                <div class="col-xs-12 col-md-3 text-center">
                                    {!! Form::open(['route' => ['admin.planilla.deleteRepechaje', $planilla->id], 'method' => 'DELETE']) !!}
                                    <button type="submit" class="btn btn-danger btn-sm btn-block" data-toggle="tooltip" title="Eliminar Repechaje" onclick="return confirm('¿Está seguro que desea eliminar los empaques que tomaron Repechaje?.')">Borrar Repechaje</button>
                                    {!! Form::close() !!}
                                </div>

                                <div class="p-t-45"></div>
                                <div class="col-xs-12 col-md-3 text-center">
                                    {!! Form::open(['route' => ['admin.planilla.deleteTomaDeTurnos', $planilla->id], 'method' => 'DELETE']) !!}
                                    <button type="submit" class="btn btn-danger btn-sm btn-block" data-toggle="tooltip" title="Eliminar Toma de Turnos" onclick="return confirm('¿Está seguro que desea eliminar los empaques que tomaron turnos en la Toma de Turnos?.')">Borrar Toma de Turnos</button>
                                    {!! Form::close() !!}
                                </div>

                                <div class="p-t-45"></div>
                                <div class="col-xs-12 col-md-3 text-center">
                                    {!! Form::open(['route' => ['admin.planilla.deleteToma', $planilla->id], 'method' => 'DELETE']) !!}
                                    <button type="submit" class="btn btn-danger btn-sm btn-block" data-toggle="tooltip" title="Eliminar Todos los Turnos" onclick="return confirm('¿Está seguro que desea eliminar los empaques que tomaron turnos?. No se eliminarán los empaques con turnos fijos (Asignados y Coordinadores).')">Borrar Los Turnos</button>
                                    {!! Form::close() !!}
                                </div>
                              </div> 


                            <hr>
                            <div class="row">
                              <div class="col-md-12 text-center">
                                <a href="{{ url('admin/planilla/local/'.$planilla->local_id) }}" class="btn btn-success  btn-sm"  data-toggle="tooltip" title="Opciones">Regresar</a>
                              </div>
                            </div>                            
                 
                    </div>
                  </div>
                </div>
</section>
@endsection



@section('js')


@endsection


