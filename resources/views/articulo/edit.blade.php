@extends('layouts.global-nero')

@section('content')
<section>
    <div class="container">

        <h3 class="text-center">Artículo</h3>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Editar</h5>
            </div>
            <div class="card-body">

                <b class="text-center">@include('incluir/mensajes')</b>

                          {!! Form::open(['route' => ['blog.update', $art], 'method' => 'PUT', 'files'=>true]) !!}


                            <div class="row form-group">
                                <label class="col-lg-2">Link</label>
                                <div class="col-lg-10">
                                    {!! Form::text('link', $art->link, ['class'=>'form-control', 'required','placeholder'=>'mi-link-personalizado', 'readonly']) !!}
                                </div>
                            </div> 
                          	
                            <div class="row form-group">
                                <label class="col-lg-2">Título</label>
                                <div class="col-lg-10">
                                    {!! Form::text('titulo', $art->titulo, ['class'=>'form-control','required', 'placeholder'=>'Título Obligatorio']) !!}
                                </div>
                            </div>  


                            <div class="row form-group">
                                <label class="col-lg-2">Descripción</label>
                                <div class="col-lg-10">
                                    {!! Form::textarea('descripcion', $art->descripcion, ['class'=>'form-control', 'required', 'placeholder'=>'Descripción Obligatorio']) !!}
                                </div>
                            </div>  


                            <div class="row form-group">
                                <label class="col-lg-2">Párrafo 1</label>
                                <div class="col-lg-10">
                                    {!! Form::textarea('texto', $art->texto, ['class'=>'form-control', 'required', 'placeholder'=>'Texto 1 Obligatorio']) !!}
                                </div>
                            </div>  

                                   
                            <div class="row form-group">
                                <label class="col-lg-2">Párrafo 2</label>
                                <div class="col-lg-10">
                                    {!! Form::textarea('texto2', $art->texto2, ['class'=>'form-control', 'required', 'placeholder'=>'Texto 2 Obligatorio']) !!}
                                </div>
                            </div> 

                            <div class="row form-group">
                                <label class="col-lg-2">Estado</label>
                                <div class="col-lg-10">
                                    {!! Form::select('estado',[$art->estado=>$art->estado, 'Editando' => 'Editando', 'Activo' => 'Activo'], null,['class'=>'form-control select-category']) !!}
                                </div>
                            </div>                              

                            <div class="row form-group">
                                <label class="col-lg-2">Img Artículo</label>
                                <div class="col-lg-10">
                                    {!! Form::file('portada') !!}
                                </div>
                            </div>                             
                                          
                            <div class="row form-group">
                                <label class="col-lg-2">Img Descripción</label>
                                <div class="col-lg-10">
                                    {!! Form::file('imgDescripcion') !!}
                                </div>
                            </div>     

                            <div class="row form-group">
                              <div class="col-lg-12 text-center">
                                {!! Form::submit('Guardar', ['class'=>'btn btn-sm btn-success']) !!}
                                <a href="{{ url('blog/mis-articulos') }}" class="btn btn-sm btn-primary">Volver</a>
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


