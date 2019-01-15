@extends('layouts.global-externo')

@section('content')
<section>
        <div class="container">

            <h5 class="text-center">Postulación <i class="fa fa-star text-warning pull-right" aria-hidden="true" data-toggle="tooltip" title="Opción Premium"></i></h5>
            <p class="m-b-25 text-center">Eliminar postulación</p>

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Borrar</h5>
                </div>
                <div class="card-block">

                            {!! Form::open(['route' => ['usuario.local.deleteEliminarPostulacion', $postulacion], 'method' => 'DELETE'])!!}

                            <b class="text-center">@include('incluir/mensajes')</b>
                            {!! Form::hidden('local_id', $postulacion->local_id) !!}

                            <div class="row form-group">
                                <label class="col-lg-2 control-label">Cupos</label>
                                <div class="col-lg-4">
                                    {!! Form::text('cupos', $postulacion->cupos,['class'=>'form-control', 'required', 'readonly']) !!}
                                </div>

                                <label class="col-lg-2 control-label">Pública</label>
                                <div class="col-lg-4">
                                    {!! Form::text('activarLista',$postulacion->activarLista, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-lg-2 control-label">Inicio</label>
                                <div class="col-lg-4">
                                    {!! Form::text('inicio', $postulacion->inicio,['class'=>'form-control', 'required', 'readonly']) !!}
                                </div>

                                <label class="col-lg-2 control-label">Termino</label>
                                <div class="col-lg-4">
                                    {!! Form::text('termino', $postulacion->termino,['class'=>'form-control','required' , 'readonly']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-lg-2 control-label">Descripción</label>
                                <div class="col-lg-10">
                                    {!! Form::textarea('descripcion', $postulacion->descripcion,['class'=>'form-control','required', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-lg-12 text-center">
                                    {!! Form::submit('Eliminar', ['class'=>'btn btn-sm btn-danger']) !!}
                                    <a href="{{ url('usuario/local/'.$postulacion->local_id.'/postulaciones') }}" class="btn btn-sm btn-primary">Postulaciones</a>
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


