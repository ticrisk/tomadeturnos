@extends('layouts.global-nero')

@section('content')
<section>
    <div class="container">

        <h4 class="text-center">Noticia</h4>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Listado</h5>
            </div>
            <div class="card-body">
                <b class="text-center">@include('incluir/mensajes')</b>
                          
                          <div class="row hidden-sm-down">
                              <label class="col-md-4">Título</label>
                              <label class="col-md-6">Descripción</label>
                              <label class="col-md-1">Editar</label>
                              <label class="col-md-1">Borrar</label>
                          </div>
                          <hr class=" hidden-sm-down">
                          @foreach($noticias as $noticia)
                            <div class="row">
                                <label class="col-6 hidden-md-up">Título:</label>
                                <div class="col-6 col-md-4">{{ $noticia->titulo }}</div>

                                <label class="col-6 hidden-md-up">Descripción:</label>
                                <div class="col-6 col-md-6">{{ $noticia->descripcion }}</div>

                                <div class="p-t-35 hidden-md-up"></div>
                                <label class="col-6 hidden-md-up">Editar:</label>
                                <div class="col-6 col-md-1">
                                      <a href="{{ url('noticia/modificar-noticia/'.$noticia->id) }}" class="btn btn-info  btn-xs"  data-toggle="tooltip" title="Opciones"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                </div>

                                <div class="p-t-35 hidden-md-up"></div>
                                <label class="col-6 hidden-md-up">Borrar:</label>
                                <div class="col-6 col-md-1">
                                    {!! Form::open(['route' => ['noticia.eliminarNoticia', $noticia->id], 'method' => 'DELETE']) !!}

                                      <button type="submit" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Eliminar" onclick="return confirm('¿Está seguro que desea eliminar esta noticia?.')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    
                                    {!! Form::close() !!}                                  
                                </div>
                            </div>
                            <hr>
                          @endforeach

                            <div class="row">
                              <div class="col-lg-12 text-center">
                                  {!! $noticias->render() !!}
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-lg-12 text-center">
                                <a href="{{ url('noticia/insertar-noticia/'.$idLocal) }}" class="btn btn-sm btn-success">Agregar</a>
                                <a href="{{ url('admin/local/'.$idLocal.'/opciones') }}" class="btn btn-sm btn-primary">Volver</a>
                              </div>
                            </div>


                            <div class="p-t-35"></div>
                            <div class="alert alert-danger" role="alert">
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


