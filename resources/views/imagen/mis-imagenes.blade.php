@extends('layouts.global-nero')

@section('content')
<section>
    <div class="container">

        <h5 class="text-center">Imágenes</h5>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Listado</h5>
            </div>
            <div class="card-body">
                <b class="text-center">@include('incluir/mensajes')</b>
                          
                          <div class="row hidden-md-down">
                              <div class="col-lg-2"><b>Imagen</b></div>
                              <div class="col-lg-5"><b>Título</b></div>
                              <div class="col-lg-1"><b>Tipo</b></div>
                              <div class="col-lg-2"><b>Estado</b></div>
                              <div class="col-lg-1"><b>Editar</b></div>
                              <div class="col-lg-1"><b>Borrar</b></div>
                          </div>
                          <hr class="hidden-md-down">
                          @foreach($imagenes as $imagen)
                            <div class="row form-group">

                                <label class="col-12 col-sm-6 hidden-lg-up">Imagen</label>
                                <div class="col-12 col-sm-6 col-lg-2"><a href="{{ $imagen->link }}" target="_blank"><img src="../img/album/{{ $imagen->imagen }}"  class="img-thumbnail"></a></div>

                                <label class="col-12 col-sm-6  hidden-lg-up">Título</label>
                                <div class="col-12 col-sm-6  col-lg-5"><a href="{{ $imagen->link }}" target="_blank">{{ $imagen->titulo }}</a></div>

                                <label class="col-6 hidden-lg-up">Tipo</label>
                                <div class="col-6 col-lg-1">{{ $imagen->tipo }}</div>

                                <label class="col-6 hidden-lg-up">Estado</label>
                                <div class="col-6 col-lg-2">{{ $imagen->estado }}</div>

                                <label class="col-6 hidden-lg-up">Editar</label>
                                <div class="col-6 col-lg-1">
                                      <a href="{{ url('album/'.$imagen->id.'/edit/') }}" class="btn btn-info  btn-sm"  data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                </div>

                                <div class="p-t-45 hidden-lg-up"></div>
                                <label class="col-6 hidden-lg-up">Borrar</label>
                                <div class="col-6 col-lg-1">
                                    {!! Form::open(['route' => ['album.destroy', $imagen->id], 'method' => 'DELETE']) !!}

                                      <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Eliminar" onclick="return confirm('¿Está seguro que desea eliminar esta imagen?.')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    
                                    {!! Form::close() !!}                                  
                                </div>
                            </div>
                            <hr>
                          @endforeach


                            <div class="row">
                                <div class="col-md-12 text-center">
                                    {!! $imagenes->links('vendor.pagination.simple-bootstrap-4') !!}
                                </div>
                            </div>

                            <div class="row">
                              <div class="col-md-12 text-center">
                                <a href="{{ url('album/create') }}" class="btn btn-sm btn-success">Agregar</a>
                               
                              </div>
                            </div>                              
                        
                       
            </div>
        </div>
    </div>
</section>
@endsection



@section('js')


@endsection


