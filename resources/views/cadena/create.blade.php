@extends('layouts.global-nero')

@section('content')
<section>
    <div class="container">

        <h4 class="text-center">Cadena</h4>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Agregar Cadena</h5>
            </div>
            <div class="card-body">
                <b class="text-center">@include('incluir/mensajes')</b>

                          {!! Form::open(['route' => 'cadena.store', 'method' => 'POST'])!!}

                            <div class="row form-group">
                                <label class="col-lg-2 control-label">Nombre</label>
                                <div class="col-lg-10">
                                    {!! Form::text('nombre', null,['class'=>'form-control','placeholder'=>'Nombre Obligatorio', 'required']) !!}
                                </div>

                            </div>  
 
                                                                                        
                            
                            <div class="row form-group">
                              <div class="col-lg-12 text-center">
                                {!! Form::submit('Guardar', ['class'=>'btn btn-sm btn-success']) !!}
                                <a href="{{ url('cadena') }}" class="btn btn-sm btn-primary">Ir Cadenas</a>
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


