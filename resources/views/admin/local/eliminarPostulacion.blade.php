@extends('layouts.global-nero')

@section('content')


    <div class="container">

        <h5 class="text-center">Postulación</h5>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Eliminar Postulación</h5>
            </div>
            <div class="card-body">
                <b class="text-center">@include('incluir/mensajes')</b>

                            {!! Form::open(['route' => ['admin.local.deleteEliminarPostulacion', $postulacion], 'method' => 'DELETE'])!!}


                            {!! Form::hidden('local_id', $postulacion->local_id) !!}

                            <div class="row form-group">
                                <label class="col-lg-2">Cupos</label>
                                <div class="col-lg-4">
                                    {!! Form::text('cupos', $postulacion->cupos,['class'=>'form-control', 'required', 'readonly']) !!}
                                </div>

                                <label class="col-lg-2">Pública</label>
                                <div class="col-lg-4">
                                    {!! Form::text('activarLista',$postulacion->activarLista, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-lg-2">Inicio</label>
                                <div class="col-lg-4">
                                    {!! Form::text('inicio', $postulacion->inicio,['class'=>'form-control', 'required', 'readonly']) !!}
                                </div>

                                <label class="col-lg-2">Termino</label>
                                <div class="col-lg-4">
                                    {!! Form::text('termino', $postulacion->termino,['class'=>'form-control','required' , 'readonly']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-lg-2">Descripción</label>
                                <div class="col-lg-10">
                                    {!! Form::textarea('descripcion', $postulacion->descripcion,['class'=>'form-control','required', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-lg-12 text-center">
                                    {!! Form::submit('Eliminar', ['class'=>'btn btn-sm btn-danger']) !!}
                                    <a href="{{ url('admin/local/'.$postulacion->local_id.'/postulaciones') }}" class="btn btn-sm btn-primary">Postulaciones</a>
                                </div>
                            </div>

                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>

@endsection



@section('js')


@endsection


