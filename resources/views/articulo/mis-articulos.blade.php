@extends('layouts.global-nero')

@section('content')

<section>
    <div class="container">

        <h3 class="text-center">Artículos</h3>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Listado</h5>
            </div>
            <div class="card-body">

                <b class="text-center">@include('incluir/mensajes')</b>
                          
                          <div class="row hidden-md-down">
                              <div class="col-lg-9"><b>Título</b></div>
                              <div class="col-lg-1"><b>Estado</b></div>
                              <div class="col-lg-1"><b>Editar</b></div>
                              <div class="col-lg-1"><b>Borrar</b></div>
                          </div>
                          <hr class="hidden-md-down">

                          @foreach($articulos as $articulo)
                            <div class="row">

                                <label class="col-12 col-sm-6 hidden-lg-up">Título</label>
                                <div class="col-12 col-sm-6 col-lg-9"><a href="{{ $articulo->link }}" target="_blank">{{ $articulo->titulo }}</a></div>

                                <label class="col-6 hidden-lg-up">Estado</label>
                                <div class="col-6 col-lg-1">{{ $articulo->estado }}</div>

                                <label class="col-6 hidden-lg-up">Editar</label>
                                <div class="col-6 col-lg-1">
                                      <a href="{{ url('blog/'.$articulo->id.'/edit/') }}" class="btn btn-info  btn-sm"  data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                </div>

                                <div class="p-t-45"></div>
                                <label class="col-6 hidden-lg-up">Borrar</label>
                                <div class="col-6 col-lg-1">
                                    {!! Form::open(['route' => ['blog.destroy', $articulo->id], 'method' => 'DELETE']) !!}

                                      <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Eliminar" onclick="return confirm('¿Está seguro que desea eliminar este artículo?.')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    
                                    {!! Form::close() !!}                                  
                                </div>
                            </div>
                            <hr>
                          @endforeach

                            <div class="row">
                              <div class="col-lg-12 text-center">
                                  {!! $articulos->links('vendor.pagination.simple-bootstrap-4') !!}
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-lg-12 text-center">
                                <a href="{{ url('blog/create') }}" class="btn btn-sm btn-success">Agregar</a>
                               
                              </div>
                            </div>                              
                        
                       
            </div>
        </div>
    </div>
</section>

@endsection



@section('js')


@endsection


