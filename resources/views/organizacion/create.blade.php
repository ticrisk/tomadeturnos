@extends('layouts.global-externo')

@section('content')
<section>
    <div class="container">

        <h4 class="text-center">Organización</h4>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Agregar Organización</h5>
            </div>
            <div class="card-body">
                <b class="text-center">@include('incluir/mensajes')</b>

                          {!! Form::open(['route' => 'organizacion.store', 'method' => 'POST'])!!}

                            <div class="row form-group">
                                <label class="col-lg-2 control-label">Nombre</label>
                                <div class="col-lg-10">
                                    {!! Form::text('nombre', null,['class'=>'form-control','placeholder'=>'Nombre Obligatorio', 'required']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                              <div class="col-lg-12 text-center">
                                {!! Form::submit('Guardar', ['class'=>'btn btn-sm btn-success']) !!}
                                <a href="{{ url('organizacion') }}" class="btn btn-sm btn-primary">Ir a Org.</a>
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


