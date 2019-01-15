@extends('layouts.global-nero')

@section('content')
<section>
    <div class="container">

        <h4 class="text-center">Noticia</h4>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Modificar Noticia</h5>
            </div>
            <div class="card-body">
                <b class="text-center">@include('incluir/mensajes')</b>

                          {!! Form::open(['route' => ['noticia.putNoticia', $noticia], 'method' => 'PUT'])!!}

                            {!! Form::hidden('id', $noticia->id) !!}
                            {!! Form::hidden('estado', $noticia->estado) !!}
                            {!! Form::hidden('local_id', $noticia->local_id) !!}
                            {!! Form::hidden('local_user_id', $noticia->local_user_id) !!}

                            <div class="row form-group">
                                <label class="col-lg-2">Título</label>
                                <div class="col-lg-10">
                                    {!! Form::text('titulo', $noticia->titulo,['class'=>'form-control','placeholder'=>'Título Obligatoria']) !!}
                                </div>
                            </div>  


                            <div class="row form-group">
                                <label class="col-lg-2">Descripción</label>
                                <div class="col-lg-10">
                                    {!! Form::textarea('descripcion', $noticia->descripcion, ['class'=>'form-control', 'placeholder'=>'Descripción Obligatoria']) !!}
                                </div>
                            </div>  


                            <div class="row form-group">
                                <label class="col-lg-2">Creado</label>
                                <div class="col-lg-4">
                                    {!! Form::text('created_at', $noticia->created_at, ['class'=>'form-control', 'readonly']) !!}
                                </div>

                                <label class="col-lg-2">Actualizado</label>
                                <div class="col-lg-4">
                                    {!! Form::text('updated_at', $noticia->updated_at, ['class'=>'form-control', 'readonly']) !!}
                                </div>                                
                            </div>         

                                                                                        
                            
                            <div class="row form-group">
                              <div class="col-lg-12 text-center">
                                {!! Form::submit('Guardar', ['class'=>'btn btn-sm btn-success']) !!}
                                <a href="{{ url('noticia/listado-local/'.$noticia->local_id) }}" class="btn btn-sm btn-primary">Volver</a>
                              </div>
                            </div>
                         
                          {!! Form::close() !!}

            </div>
        </div>
    </div>
</section>
@endsection



@section('js')


@endsection


