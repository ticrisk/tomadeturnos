@extends('layouts.global-externo')

@section('content')


    <section>
        <div class="container">

            <h5 class="text-center">Asociarme</h5>
            <p class="m-b-25 text-center">Acá puedes asignarte como empaque directamente a tu local</p>


            <div class="row">

                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5 class="card-title">Asociarme</h5>
                        </div>
                        <div class="card-block">
                            <b class="text-center">@include('incluir/mensajes')</b>
                            {!! Form::open(['action' => 'LocalController@postVincular', 'method' => 'POST']) !!}


                            <div class="row form-group">
                                <label class="col-lg-2">Local</label>
                                <div class="col-lg-4">
                                    {!! Form::select('local_id',$locales, null,['class'=>'form-control select-category','placeholder'=>'Selecciona un local','id'=>'local_id', 'required']) !!}
                                </div>

                                <label class="col-lg-2">Código</label>
                                <div class="col-lg-4">
                                    {!! Form::text('codigo', null,['class'=>'form-control','placeholder'=>'Código Obligatorio', 'required']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-lg-12">
                                    <center>{!! Recaptcha::render() !!}</center>
                                </div>
                            </div>



                            <div class="row form-group">
                                <div class="col-lg-12 text-center">
                                    {!! Form::submit('Guardar', ['class'=>'btn btn-sm btn-success']) !!}
                                    <a href="{{ url('local') }}" class="btn btn-sm btn-primary">Ir Locales</a>
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