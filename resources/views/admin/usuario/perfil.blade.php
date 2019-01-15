@extends('layouts.global-externo')

@section('content')

<section>
    <div class="container">

        <h4 class="text-center">Empaque</h4>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Perfil</h5>
            </div>
            <div class="card-body">
                <b class="text-center">@include('incluir/mensajes')</b>

                            <div class="row form-group">
                                <div class="col-lg-12 text-center">
                                    <figure class="figure">
                                        <img src="{{ asset('img/user/'.$usuario->avatar) }}" alt="foto perfil" class="rounded-circle">
                                    </figure>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-lg-2">ID</label>
                                <div class="col-lg-4"> {!! Form::text('id', $usuario->id, ['class'=>'form-control', 'readonly']) !!} </div>

                                <label class="col-lg-2">Rut</label>
                                <div class="col-lg-4"> {!! Form::text('rut', $usuario->rut, ['class'=>'form-control', 'readonly']) !!} </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-lg-2">E-mail</label>
                                <div class="col-lg-4"> {!!  Form::text('email', $usuario->email, ['class'=>'form-control', 'readonly'])  !!} </div>

                                <label class="col-lg-2">Ult. Conexión</label>
                                <div class="col-lg-4"> {!! Form::text('ultimaConexion', $usuario->ultimaConexion, ['class'=>'form-control', 'readonly']) !!} </div>
                            </div>         

                            <div class="row form-group">
                                <label class="col-lg-2">Nombre</label>
                                <div class="col-lg-4"> {!! Form::text('nombre', $usuario->nombre, ['class'=>'form-control', 'readonly']) !!} </div>

                                <label class="col-lg-2">Apellido</label>
                                <div class="col-lg-4"> {!! Form::text('apellido', $usuario->apellido, ['class'=>'form-control', 'readonly']) !!} </div>
                            </div>  

                            <div class="row form-group">
                                <label class="col-lg-2">Red Social</label>
                                <div class="col-lg-4"> {!! Form::text('redSocial', $usuario->redSocial, ['class'=>'form-control', 'readonly']) !!} </div>

                                <label class="col-lg-2">Celular</label>
                                <div class="col-lg-4"> {!! Form::text('celular', $usuario->celular, ['class'=>'form-control', 'readonly']) !!} </div>
                            </div>     

                            <div class="row form-group">
                                <label class="col-lg-2">Genero</label>
                                <div class="col-lg-4"> {!! Form::text('genero', $usuario->genero, ['class'=>'form-control', 'readonly']) !!} </div>

                                <label class="col-lg-2">Hijos</label>
                                <div class="col-lg-4"> {!! Form::text('hijos', $usuario->hijos, ['class'=>'form-control', 'readonly']) !!} </div>
                            </div> 

                            <div class="row form-group">
                                <label class="col-lg-2">Región</label>
                                <div class="col-lg-4"> {!! Form::text('region', $region, ['class'=>'form-control', 'readonly']) !!} </div>

                                <label class="col-lg-2">Comuna</label>
                                <div class="col-lg-4"> {!! Form::text('comuna_id', $usuario->comuna_id, ['class'=>'form-control', 'readonly']) !!} </div>
                            </div>   

                            <div class="row form-group">
                                <label class="col-lg-2">Dirección</label>
                                <div class="col-lg-4">
                                    {!! Form::text('direccion', $usuario->direccion, ['class'=>'form-control','readonly']) !!}
                                </div>

                                <label class="col-lg-2">Foto</label>
                                <div class="col-lg-4">
                                    {!! Form::text('direccion', $usuario->avatar, ['class'=>'form-control','readonly']) !!}
                                </div>
                            </div>    

                            <div class="row form-group">
                                <label class="col-lg-2">Universidad</label>
                                <div class="col-lg-4"> {!! Form::text('universidad_id', $usuario->universidad_id, ['class'=>'form-control', 'readonly']) !!} </div>

                                <label class="col-lg-2">Carrera</label>
                                <div class="col-lg-4"> {!! Form::text('carrera_id', $usuario->carrera_id, ['class'=>'form-control','readonly']) !!} </div>
                            </div>                                                                                 

                            <div class="row form-group">
                                <label class="col-lg-2">Rol</label>
                                <div class="col-lg-4"> {!! Form::text('rol', $usuario->rol, ['class'=>'form-control', 'readonly']) !!} </div>

                                <label class="col-lg-2">Estado</label>
                                <div class="col-lg-4"> {!! Form::text('estado', $usuario->estado, ['class'=>'form-control', 'readonly']) !!} </div>
                            </div>      

                            <div class="row form-group">
                                <label class="col-lg-2">Fecha de Registro</label>
                                <div class="col-lg-4"> {!! Form::text('created_at', $usuario->created_at, ['class'=>'form-control', 'readonly']) !!} </div>

                                <label class="col-lg-2">Ult. Actualización</label>
                                <div class="col-lg-4"> {!! Form::text('updated_at', $usuario->updated_at, ['class'=>'form-control', 'readonly']) !!} </div>
                            </div>                                   
                                                                                                                  
                            <div class="row form-group">
                              <div class="col-lg-12 text-center">
                                <a href="{{ url('admin/usuario/listado') }}" class="btn btn-primary  btn-sm"  data-toggle="tooltip" title="Regresar">Volver</a>
                              </div>
                            </div>
                         
            </div>
        </div>
    </div>
</section>

@endsection




