@extends('layouts.global-nero')

@section('content')
<section>
    <div class="container">

        <h4 class="text-center">Noticias <i class="fa fa-star text-warning pull-right" aria-hidden="true" data-toggle="tooltip" title="Opción Premium"></i></h4>
        <p class="m-b-25 text-center">Agregar noticia</p>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Agregar</h5>
            </div>
            <div class="card-block">

                <b class="text-center">@include('incluir/mensajes')</b>

                          {!! Form::open(['action' => 'NoticiaController@postAgregarNoticia', 'method' => 'POST']) !!}
                            {{-- <form role="form" method="POST" action="{{ route('login') }}"> --}}

                          	{!! Form::hidden('local_id', $idLocal) !!}
                          	{!! Form::hidden('local_user_id', $idLocalUser) !!}
                          	
                            <div class="row form-group">
                                <label class="col-lg-2 control-label">Título</label>
                                <div class="col-lg-10">
                                    {!! Form::text('titulo', null, ['class'=>'form-control','placeholder'=>'Título Obligatoria']) !!}
                                </div>
                            </div>  


                            <div class="row form-group">
                                <label class="col-lg-2 control-label">Descripción</label>
                                <div class="col-lg-10">
                                    {!! Form::textarea('descripcion', null, ['class'=>'form-control', 'placeholder'=>'Descripción Obligatoria']) !!}
                                </div>
                            </div>  


                                   

                                                                                        
                            
                            <div class="row form-group">
                              <div class="col-lg-12 text-center">
                                {!! Form::submit('Guardar', ['class'=>'btn btn-sm btn-success']) !!}
                                <a href="{{ url('noticia/noticia-local/'.$idLocal) }}" class="btn btn-sm btn-primary">Volver</a>
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


