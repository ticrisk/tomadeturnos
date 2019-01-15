@extends('layouts.global-nero')

@section('content')

<section>
    <div class="container">

        <h4 class="text-center">Empaque</h4>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Asignar Local</h5>
            </div>
            <div class="card-body">
                <b class="text-center">@include('incluir/mensajes')</b>

                         {!! Form::open(['action' => 'AdminController@postAsignarUsuario', 'method' => 'POST'])!!}
                            <div class="row form-group">
                                <label class="col-lg-2">ID</label>
                                <div class="col-lg-4">
                                    {!! Form::text('user_id', $usuario->id, ['class'=>'form-control', 'readonly']) !!}
                                </div>

                                <label class="col-lg-2">Rut</label>
                                <div class="col-lg-4">
                                    {!! Form::text('rut', $usuario->rut, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>    

                            <div class="row form-group">
                                <label class="col-lg-2">Nombre</label>
                                <div class="col-lg-4">
                                    {!! Form::text('nombre', $usuario->nombre, ['class'=>'form-control', 'readonly']) !!}
                                </div>

                                <label class="col-lg-2">Apellido</label>
                                <div class="col-lg-4">
                                    {!! Form::text('apellido', $usuario->apellido, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>    
                            
                            <hr>

                            <div class="row form-group">
                                <label class="col-lg-1">Rol</label>
                                <div class="col-lg-3">
                                    {!! Form::select('rol',['Empaque' => 'Empaque', 'Coordinador' => 'Coordinador', 'Encargado' => 'Encargado'], null,['class'=>'form-control select-category']) !!}
                                </div>

                                <label class="col-lg-1">Cadena</label>
                                <div class="col-lg-3">
                                    {!! Form::select('cadena_id',$cadena,null,['class'=>'form-control select-category','placeholder'=>'Selecciona una Cadena', 'required','id'=>'cadena']) !!}
                                </div>

                                <label class="col-lg-1">Local</label>
                                <div class="col-lg-3">
                                    {!! Form::select('local_id',$local,null,['class'=>'form-control select-category','placeholder'=>'Selecciona un Local','id'=>'local_id']) !!}
                                </div>
                            </div>    

 
                                                                                        
                            
                            <div class="row form-group">
                              <div class="col-lg-12 text-center">
                                {!! Form::submit('Asignar', ['class'=>'btn btn-sm btn-success']) !!}
                                <a href="{{ url('admin/usuario/listado') }}" class="btn btn-sm btn-primary">Volver</a>
                              </div>
                            </div>
                         
                          {!! Form::close() !!}

            </div>
        </div>
    </div>
</section>
@endsection



@section('js')
    {!! Html::script('js/dropdown.js') !!}

@endsection


