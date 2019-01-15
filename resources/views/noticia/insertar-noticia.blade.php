@extends('layouts.global-externo')

@section('content')
<section>
    <div class="container">

        <h4 class="text-center">Noticia</h4>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Agregar Noticia</h5>
            </div>
            <div class="card-body">
                <b class="text-center">@include('incluir/mensajes')</b>

                          {!! Form::open(['action' => 'NoticiaController@postInsertarNoticia', 'method' => 'POST']) !!}

                          	{!! Form::hidden('local_id', $idLocal) !!}
                          	{!! Form::hidden('local_user_id', $idLocalUser) !!}
                          
                            <div class="row form-group">
                                <label class="col-lg-2">Título</label>
                                <div class="col-lg-10">
                                    {!! Form::text('titulo', null, ['class'=>'form-control','placeholder'=>'Título Obligatoria']) !!}
                                </div>
                            </div>  


                            <div class="row form-group">
                                <label class="col-lg-2">Descripción</label>
                                <div class="col-lg-10">
                                    {!! Form::textarea('descripcion', null, ['class'=>'form-control', 'placeholder'=>'Descripción Obligatoria']) !!}
                                </div>
                            </div>  

                            
                            <div class="row form-group">
                              <div class="col-lg-12 text-center">
                                {!! Form::submit('Guardar', ['class'=>'btn btn-sm btn-success']) !!}
                                <a href="{{ url('noticia/listado-local/'.$idLocal) }}" class="btn btn-sm btn-primary">Volver</a>
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


