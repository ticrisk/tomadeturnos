@extends('layouts.global-externo')

@section('content')
<section>
        <div class="container">

            <h4 class="text-center">Faltas <i class="fa fa-star text-warning pull-right" aria-hidden="true" data-toggle="tooltip" title="Opción Premium"></i></h4>
            <p class="m-b-25 text-center">Listado de faltas</p>

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Listado</h5>
                </div>
                <div class="card-body">
                    <b class="text-center">@include('incluir/mensajes')</b>

                    <div class="row hidden-sm-down">
                                  <div class="col-md-2"><b>Fecha</b></div>
                                  <div class="col-md-1"><b>Tipo</b></div>
                                  <div class="col-md-5"><b>Descripción</b></div>
                                  <div class="col-md-2"><b>Editar</b></div>
                                  <div class="col-md-2"><b>Borrar</b></div>
                     </div>
                  <hr class="hidden-sm-down">

                  @foreach($faltas as $falta)
                    <div class="row">

                        <label class="col-6 col-sm-6 hidden-md-up control-label">Fecha:</label>
                        <div class="col-6 col-sm-6 col-md-2 col-lg-2">
                          {{ $falta->fecha }}
                        </div>

                        <label class="col-6 col-sm-6 hidden-md-up control-label">Tipo:</label>
                        <div class="col-6 col-xs-6 col-sm-6 col-md-1 col-lg-1">
                          {{ $falta->tipo }}
                        </div>



                        <label class="col-12 col-sm-6 hidden-md-up control-label">Descripción:</label>
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                          {{ $falta->descripcion }}
                        </div>

                        <div class="hidden-md-up p-t-35"></div>
                        <label class="col-6 col-sm-6 hidden-md-up control-label">Editar:</label>
                        <div class="col-6 col-sm-6 col-md-2 col-lg-2">
                          <a href="{{ url('usuario/local/editar-falta/'.$falta->id) }}" class="btn btn-info btn-sm"  data-toggle="tooltip" title="Editar">Editar</a>
                        </div>

                        <div class="hidden-md-up p-t-35"></div>
                        <label class="col-6 col-sm-6 hidden-md-up control-label">Borrar:</label>
                        <div class="col-6 col-sm-6 col-md-2 col-lg-2">
                          {!! Form::open(['route' => ['usuario.local.deleteFalta', $falta->id], 'method' => 'DELETE']) !!}

                            <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Eliminar" onclick="return confirm('¿Está seguro que desea eliminar esta falta del empaque?.')">Borrar</button>
                                
                          {!! Form::close() !!}
                        </div>                                                   

                    </div>
                  <hr class="visible-xs visible-sm">

                  @endforeach

                            <div class="row form-group">
                                <div class="col-lg-12 text-center">
                                  {!! $faltas->links('vendor.pagination.simple-bootstrap-4') !!}
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-12 text-center">
                                    <a href="{{ url('usuario/local/agregar-falta/'.$local_user_id) }}" class="btn btn-success  btn-sm"  data-toggle="tooltip" title="Agregar Falta">Agregar</a>

                                    <a href="{{ url('usuario/local/'.$local.'/empaques') }}" class="btn btn-primary  btn-sm"  data-toggle="tooltip" title="Regresar">Volver</a>
                                  </div>
                            </div>

                </div>
            </div>
        </div>
</section>
@endsection



@section('js')


@endsection


