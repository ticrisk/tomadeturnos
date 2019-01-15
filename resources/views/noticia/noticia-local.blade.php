@extends('layouts.global-nero')

@section('content')
    <section>
        <div class="container">

            <h5 class="text-center">Noticias <i class="fa fa-star text-warning pull-right" aria-hidden="true" data-toggle="tooltip" title="Opción Premium"></i></h5>
            <p class="m-b-25 text-center">Listado de las noticias</p>

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Listado</h5>
                </div>
                <div class="card-block">

                    <b class="text-center">@include('incluir/mensajes')</b>
                          
                          <div class="row hidden-md-down">
                              <div class="col-lg-4"><b>Título</b></div>
                              <div class="col-lg-6"><b>Descripción</b></div>
                              <div class="col-lg-1"><b>Editar</b></div>
                              <div class="col-lg-1"><b>Borrar</b></div>
                          </div>
                          <hr class="hidden-md-down">
                          @foreach($noticias as $noticia)
                            <div class="row">
                                <label class="col-6 col-md-6 hidden-lg-up control-label">Título:</label>
                                <div class="col-6 col-md-6 col-lg-4">{{ $noticia->titulo }}</div>

                                <label class="col-6 col-md-6 hidden-lg-up control-label">Descripción:</label>
                                <div class="col-6 col-md-6 col-lg-6">{{ $noticia->descripcion }}</div>

                                <label class="col-6 col-md-6 hidden-lg-up control-label">Editar:</label>
                                <div class="col-6 col-md-6 col-lg-1">
                                      <a href="{{ url('noticia/editar-noticia/'.$noticia->id) }}" class="btn btn-info  btn-sm center-block"  data-toggle="tooltip" title="Opciones"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                </div>

                                <div class="hidden-lg-up p-t-40"></div>
                                <label class="col-6 col-md-6 hidden-lg-up control-label">Eliminar:</label>
                                <div class="col-6 col-md-6 col-lg-1">
                                    {!! Form::open(['route' => ['noticia.deleteNoticia', $noticia->id], 'method' => 'DELETE']) !!}

                                      <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Eliminar" onclick="return confirm('¿Está seguro que desea eliminar esta noticia?.')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    
                                    {!! Form::close() !!}                                  
                                </div>
                            </div>
                            <hr>
                          @endforeach

                            <div class="row form-group">
                              <div class="col-lg-12 text-center">
                                  {!! $noticias->links('vendor.pagination.simple-bootstrap-4') !!}
                              </div>
                            </div>

                            <div class="row form-group">
                              <div class="col-lg-12 text-center">
                                <a href="{{ url('noticia/agregar-noticia/'.$idLocal) }}" class="btn btn-sm btn-success">Agregar</a>
                                  <a href="{{ url('usuario/local/'.$idLocal.'/opciones') }}" class="btn btn-sm btn-primary">Volver</a>
                              </div>
                            </div>

                        <div class="p-t-35"></div>
                        <div class="alert alert-info" role="alert">
                            <strong>** </strong> La primera noticia que aparece en la lista es la que se va a mostrar a los empaques del local.
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


