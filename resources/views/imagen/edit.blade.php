@extends('layouts.global-externo')

@section('content')
<section>
    <div class="container">

        <h3 class="text-center">Imagen</h3>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Editar</h5>
            </div>
            <div class="card-body">

                <b class="text-center">@include('incluir/mensajes')</b>
                          {!! Form::open(['route' => ['album.update', $imagen], 'method' => 'PUT', 'files'=>true]) !!}

                            <div class="row form-group">
                                <label class="col-lg-2">Link</label>
                                <div class="col-lg-10">
                                    {!! Form::text('link', $imagen->link, ['class'=>'form-control', 'required','placeholder'=>'mi-link-personalizado', 'readonly']) !!}
                                </div>
                            </div> 
                          	
                            <div class="row form-group">
                                <label class="col-lg-2">Título</label>
                                <div class="col-lg-10">
                                    {!! Form::text('titulo', $imagen->titulo, ['class'=>'form-control','required', 'placeholder'=>'Título Obligatorio']) !!}
                                </div>
                            </div>  


                            <div class="row form-group">
                                <label class="col-lg-2">Descripción</label>
                                <div class="col-lg-10">
                                    {!! Form::textarea('descripcion', $imagen->descripcion, ['class'=>'form-control', 'required', 'placeholder'=>'Descripción Obligatorio']) !!}
                                </div>
                            </div>  


                            <div class="row form-group">
                                <label class="col-lg-2">Tipo</label>
                                <div class="col-lg-10">
                                    {!! Form::select('tipo',[$imagen->tipo=>$imagen->tipo, 'Meme' => 'Meme', 'Frase' => 'Frase', 'Banner' => 'Banner', 'Otra' => 'Otra'], null,['class'=>'form-control select-category']) !!}
                                </div>
                            </div>                         

                            <div class="row form-group">
                                <label class="col-lg-2">Estado</label>
                                <div class="col-lg-10">
                                    {!! Form::select('estado',[$imagen->estado=>$imagen->estado, 'Privado' => 'Privado', 'Activo' => 'Activo'], null,['class'=>'form-control select-category']) !!}
                                </div>
                            </div>                              

                            <div class="row form-group">
                                <label class="col-lg-2">Imagen</label>
                                <div class="col-lg-10">
                                    {!! Form::file('imagen') !!}
                                </div>
                            </div>                             

                            <div class="row form-group">
                              <div class="col-lg-12 text-center">
                                {!! Form::submit('Guardar', ['class'=>'btn btn-sm btn-success']) !!}
                                <a href="{{ url('album/mis-imagenes') }}" class="btn btn-sm btn-primary">Volver</a>
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


