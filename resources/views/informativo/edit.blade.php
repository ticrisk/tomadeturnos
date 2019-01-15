@extends('layouts.global-nero')

@section('content')
<section>
    <div class="container">

        <h3 class="text-center">Noticia</h3>


        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Editar</h5>
            </div>
            <div class="card-body">
                <b class="text-center">@include('incluir/mensajes')</b>

                          {!! Form::open(['route' => ['informativo.update', $informativo], 'method' => 'PUT']) !!}

                            <div class="row form-group">
                                <label class="col-lg-2">Título</label>
                                <div class="col-lg-10">
                                    {!! Form::text('titulo', $informativo->titulo, ['class'=>'form-control','required', 'placeholder'=>'Título Obligatorio']) !!}
                                </div>
                            </div>  


                            <div class="row form-group">
                                <label class="col-lg-2">Descripción</label>
                                <div class="col-lg-10">
                                    {!! Form::textarea('descripcion', $informativo->descripcion, ['class'=>'form-control', 'required', 'placeholder'=>'Descripción Obligatorio']) !!}
                                </div>
                            </div>  

                            <div class="row form-group">
                                <label class="col-lg-2">Estado</label>
                                <div class="col-lg-10">
                                    {!! Form::select('estado',[$informativo->estado=>$informativo->estado, 'Privado' => 'Privado', 'Público' => 'Público'], null,['class'=>'form-control select-category']) !!}
                                </div>
                            </div>                              

                            <div class="row form-group">
                                <label class="col-lg-2">Tipo</label>
                                <div class="col-lg-10">
                                    {!! Form::select('tipo',[$informativo->tipo=>$informativo->tipo, 'Index' => 'Index', 'Locales' => 'Locales', 'Encargados' => 'Encargados', 'Otra' => 'Otra'], null,['class'=>'form-control select-category']) !!}
                                </div>
                            </div>
                            
                            <div class="row form-group">
                              <div class="col-lg-12 text-center">
                                {!! Form::submit('Guardar', ['class'=>'btn btn-sm btn-success']) !!}
                                <a href="{{ url('informativo') }}" class="btn btn-sm btn-primary">Volver</a>
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


