@extends('layouts.global-nero')

@section('content')
<section>
        <div class="container">

            <h4 class="text-center">Perfil</h4>
            <p class="m-b-25 text-center">Información del usuario</p>

            <b class="text-center">@include('incluir/mensajes')</b>

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Usuario</h5>
                </div>
                <div class="card-block">

                            <div class="row form-group">
                                <div class="col-lg-12 text-center">
                                    <figure class="figure">
                                        <img src="{{ asset('img/user/'.$usuario->avatar) }}" alt="foto perfil" class="rounded-circle">
                                    </figure>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-lg-2 control-label">ID</label>
                                <div class="col-lg-4">
                                    {!! Form::text('id', $usuario->id, ['class'=>'form-control', 'readonly']) !!}
                                </div>

                                <label class="col-lg-2 control-label">Rut</label>
                                <div class="col-lg-4">
                                    {!! Form::text('rut', $usuario->rut, ['class'=>'form-control', 'readonly']) !!}
                                
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-lg-2 control-label">E-mail</label>
                                <div class="col-lg-4">
                                {!! 
                                    Form::text('email', $usuario->email, ['class'=>'form-control', 'readonly']) 
                                !!}
                                </div>

                                <label class="col-lg-2 control-label">Ult. Conexión</label>
                                <div class="col-lg-4">
                                    {!! Form::text('ultimaConexion', $usuario->ultimaConexion, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>         

                            <div class="row form-group">
                                <label class="col-lg-2 control-label">Nombre</label>
                                <div class="col-lg-4">
                                    {!! Form::text('nombre', $usuario->nombre, ['class'=>'form-control', 'readonly']) !!}
                                </div>

                                <label class="col-lg-2 control-label">Apellido</label>
                                <div class="col-lg-4">
                                    {!! Form::text('apellido', $usuario->apellido, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>  

                            <div class="row form-group">
                                <label class="col-lg-2 control-label">Red Social</label>
                                <div class="col-lg-4">
                                    {!! Form::text('redSocial', $usuario->redSocial, ['class'=>'form-control', 'readonly']) !!}
                                </div>

                                <label class="col-lg-2 control-label">Celular</label>
                                <div class="col-lg-4">
                                    {!! Form::text('celular', $usuario->celular, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>     

                            <div class="row form-group">
                                <label class="col-lg-2 control-label">Genero</label>
                                <div class="col-lg-4">
                                    {!! Form::text('genero', $usuario->genero, ['class'=>'form-control', 'readonly']) !!}
                               
                                </div>

                                <label class="col-lg-2 control-label">Hijos</label>
                                <div class="col-lg-4">
                                    {!! Form::text('hijos', $usuario->hijos, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div> 

                            <div class="row form-group">
                                <label class="col-lg-2 control-label">Región</label>
                                <div class="col-lg-4">
                                    {!! Form::text('region', $region, ['class'=>'form-control', 'readonly']) !!}
                                </div>

                                <label class="col-lg-2 control-label">Comuna</label>
                                <div class="col-lg-4">
                                    
                                    {!! Form::text('comuna_id', $usuario->comuna_id, ['class'=>'form-control', 'readonly']) !!}
                                    
                                </div>
                            </div>   

                            <div class="row form-group">
                                <label class="col-lg-2 control-label">Dirección</label>
                                <div class="col-lg-4">
                                    {!! Form::text('direccion', $usuario->direccion, ['class'=>'form-control','readonly']) !!}
                                </div>

                                <label class="col-lg-2 control-label">Foto</label>
                                <div class="col-lg-4">
                                    {!! Form::text('direccion', $usuario->avatar, ['class'=>'form-control','readonly']) !!}
                                </div>
                            </div>    

                            <div class="row form-group">
                                <label class="col-lg-2 control-label">Universidad</label>
                                <div class="col-lg-4">
                                
                                    {!! Form::text('universidad_id', $usuario->universidad_id, ['class'=>'form-control', 'readonly']) !!}
                                                               

                                </div>

                                <label class="col-lg-2 control-label">Carrera</label>
                                <div class="col-lg-4">
                                
                                    {!! Form::text('carrera_id', $usuario->carrera_id, ['class'=>'form-control','readonly']) !!}
                                
                                </div>
                            </div>                                                                                 

                            <div class="row form-group">
                                <label class="col-lg-2 control-label">Rol</label>
                                <div class="col-lg-4">
                                    {!! Form::text('rol', $usuario->rol, ['class'=>'form-control', 'readonly']) !!}
                                </div>

                                <label class="col-lg-2 control-label">Estado</label>
                                <div class="col-lg-4">
                                    {!! Form::text('estado', $usuario->estado, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>      

                            <div class="row form-group">
                                <label class="col-lg-2 control-label">Fecha de Registro</label>
                                <div class="col-lg-4">
                                    {!! Form::text('created_at', $usuario->created_at, ['class'=>'form-control', 'readonly']) !!}
                                </div>

                                <label class="col-lg-2 control-label">Ult. Actualización</label>
                                <div class="col-lg-4">
                                    {!! Form::text('updated_at', $usuario->updated_at, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>                                   
                                                                                                                  
                            <div class="row form-group">
                              <div class="col-lg-12 text-center">
                                <a href="{{ url('usuario/local/'.$idLocal.'/empaques') }}" class="btn btn-primary  btn-sm"  data-toggle="tooltip" title="Regresar">Volver</a>
                              </div>
                            </div>


                </div>
            </div>
        </div>
</section>
@endsection




