@extends('layouts.global-nero')

@section('content')
<section>
    <div class="container">

        <h3 class="text-center">Noticias</h3>



        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Listado</h5>
            </div>
            <div class="card-body">
                <b class="text-center">@include('incluir/mensajes')</b>
                          <div class="row hidden-md-down">
                              <div class="col-lg-3"><b>Título</b></div>
                              <div class="col-lg-4"><b>Descripción</b></div>
                              <div class="col-lg-2"><b>Tipo</b></div>
                              <div class="col-lg-1"><b>Estado</b></div>
                              <div class="col-lg-1"><b>Editar</b></div>
                              <div class="col-lg-1"><b>Borrar</b></div>
                          </div>
                          <hr class="hidden-md-down">
                          @foreach($informativos as $informativo)
                            <div class="row form-group">
                                <label class="col-6 hidden-lg-up">Título</label>
                                <div class="col-6 col-lg-3">{{ $informativo->titulo }}</div>

                                <label class="col-6 hidden-lg-up">Descripción</label>
                                <div class="col-6 col-lg-4">{{ $informativo->descripcion }}</div>

                                <label class="col-6 hidden-lg-up">Tipo</label>
                                <div class="col-6 col-lg-2">{{ $informativo->tipo }}</div>

                                <label class="col-6 hidden-lg-up">Estado</label>
                                <div class="col-6 col-lg-1">{{ $informativo->estado }}</div>

                                <label class="col-6 hidden-lg-up">Editar</label>
                                <div class="col-6 col-lg-1">
                                      <a href="{{ url('informativo/'.$informativo->id.'/edit') }}" class="btn btn-info  btn-sm center-block"  data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                </div>

                                <div class="p-t-45 hidden-lg-up"></div>
                                <label class="col-6 hidden-lg-up">Borrar</label>
                                <div class="col-6 col-lg-1">
                                    {!! Form::open(['route' => ['informativo.destroy', $informativo->id], 'method' => 'DELETE']) !!}

                                      <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Eliminar" onclick="return confirm('¿Está seguro que desea eliminar este informativo?.')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    
                                    {!! Form::close() !!}                                  
                                </div>
                            </div>
                            <hr>
                          @endforeach


                            <div class="row">
                                <div class="col-md-12 text-center">
                                    {!! $informativos->links('vendor.pagination.simple-bootstrap-4') !!}
                                </div>
                            </div>

                            <div class="row">
                              <div class="col-lg-12 text-center">
                                <a href="{{ url('informativo/create/') }}" class="btn btn-sm btn-success">Agregar</a>
                              </div>
                            </div>                              

                        <div class="p-t-35"></div>
                        <div class="alert alert-info" role="alert">
                            <strong>** </strong> El ultimo informativo actualizado es el que se mostrará por tipo en el index, a los encargados o a los locales.
                            <br>
                            <strong>** </strong> Si creas o actualizas una noticia aparecerá de las primeras.
                        </div>
            </div>
        </div>
    </div>
</section>
@endsection



@section('js')


@endsection


