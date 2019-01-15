@extends('layouts.global-externo')

@section('content')


    <section>
        <div class="container">

            <h3 class="text-center">Postulaciones</h3>
            <p class="m-b-25 text-center">Acá puedes participar en una postulación privada</p>


            <div class="row">

                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5 class="card-title">Aspirante</h5>
                        </div>
                        <div class="card-body">
                            <b class="text-center">@include('incluir/mensajes')</b>
                            {!! Form::open(['action' => 'PostulacionController@postAspirante', 'method' => 'POST']) !!}


                            <div class="row form-group text-center">
                                <label class="col-lg-2 control-label">Postulación</label>
                                <div class="col-lg-4">
                                    {!! Form::select('id',$postulaciones, null,['class'=>'form-control select-category','placeholder'=>'Seleccione una Postulación','id'=>'id', 'required']) !!}
                                </div>

                                <label class="col-lg-2 control-label">Código Postulación</label>
                                <div class="col-lg-4">
                                    {!! Form::text('codigoPostulacion', null,['class'=>'form-control','placeholder'=>'Código Obligatorio', 'required']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-lg-12">
                                    <center> {!! Recaptcha::render() !!} </center>
                                </div>
                            </div>



                            <div class="row form-group">
                                <div class="col-lg-12 text-center">
                                    {!! Form::submit('Guardar', ['class'=>'btn btn-sm btn-success']) !!}
                                    <a href="{{ url('postulaciones') }}" class="btn btn-sm btn-primary">Postulaciones</a>
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection