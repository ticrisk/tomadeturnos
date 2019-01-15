@extends('layouts.global-nero')

@section('content')

  <!-- content 
  <div id="content" class="app-content" role="main">
    <div class="app-content-body ">
        -->

        <div class="bg-light lter b-b wrapper-md">
          <h1 class="m-n font-thin h3">Usuario</h1>
        </div>
        <div class="wrapper-md" ng-controller="FormDemoCtrl">

              <div class="row">
               
                <div class="col-sm-12">
                  <div class="panel panel-default">
                    <div class="panel-heading font-bold">Información del Usuario</div>
                    <div class="panel-body">
                        
                        
                          <!--<form class="bs-example form-horizontal">-->
                          <div class="bs-example form-horizontal">
                         
                            

                             <div class="form-group">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  padding-bottom-20 text-center">
                                    <img src="{{ asset('img/user/'.$usuario->avatar) }}" alt="foto perfil" class="img-circle">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-1 control-label">ID</label>
                                <div class="col-lg-5">
                                    {!! Form::text('id', $usuario->id, ['class'=>'form-control', 'readonly']) !!}
                                </div>

                                <label class="col-lg-1 control-label">Rut</label>
                                <div class="col-lg-5">
                                    {!! Form::text('rut', $usuario->rut, ['class'=>'form-control', 'readonly']) !!}
                                
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-1 control-label">E-mail</label>
                                <div class="col-lg-5">
                                {!! 
                                    Form::text('email', $usuario->email, ['class'=>'form-control', 'readonly']) 
                                !!}
                                </div>

                                <label class="col-lg-1 control-label">Ult. Conexión</label>
                                <div class="col-lg-5">
                                    {!! Form::text('ultimaConexion', $usuario->ultimaConexion, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>         

                            <div class="form-group">
                                <label class="col-lg-1 control-label">Nombre</label>
                                <div class="col-lg-5">
                                    {!! Form::text('nombre', $usuario->nombre, ['class'=>'form-control', 'readonly']) !!}
                                </div>

                                <label class="col-lg-1 control-label">Apellido</label>
                                <div class="col-lg-5">
                                    {!! Form::text('apellido', $usuario->apellido, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>  

                            <div class="form-group">
                                <label class="col-lg-1 control-label">Red Social</label>
                                <div class="col-lg-5">
                                    {!! Form::text('redSocial', $usuario->redSocial, ['class'=>'form-control', 'readonly']) !!}
                                </div>

                                <label class="col-lg-1 control-label">Celular</label>
                                <div class="col-lg-5">
                                    {!! Form::text('celular', $usuario->celular, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>     

                            <div class="form-group">
                                <label class="col-lg-1 control-label">Genero</label>
                                <div class="col-lg-5">
                                    {!! Form::text('genero', $usuario->genero, ['class'=>'form-control', 'readonly']) !!}
                               
                                </div>

                                <label class="col-lg-1 control-label">Hijos</label>
                                <div class="col-lg-5">
                                    {!! Form::text('hijos', $usuario->hijos, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div> 

                            <div class="form-group">
                                <label class="col-lg-1 control-label">Región</label>
                                <div class="col-lg-5">
                                    {!! Form::text('region', $region, ['class'=>'form-control', 'readonly']) !!}
                                </div>

                                <label class="col-lg-1 control-label">Comuna</label>
                                <div class="col-lg-5">
                                    
                                    {!! Form::text('comuna_id', $usuario->comuna_id, ['class'=>'form-control', 'readonly']) !!}
                                    
                                </div>
                            </div>   

                            <div class="form-group">
                                <label class="col-lg-1 control-label">Dirección</label>
                                <div class="col-lg-5">
                                    {!! Form::text('direccion', $usuario->direccion, ['class'=>'form-control','readonly']) !!}
                                </div>

                                <label class="col-lg-1 control-label">Foto</label>
                                <div class="col-lg-5">
                                    {!! Form::text('direccion', $usuario->avatar, ['class'=>'form-control','readonly']) !!}
                                </div>
                            </div>    

                            <div class="form-group">
                                <label class="col-lg-1 control-label">Universidad</label>
                                <div class="col-lg-5">
                                
                                    {!! Form::text('universidad_id', $usuario->universidad_id, ['class'=>'form-control', 'readonly']) !!}
                                                               

                                </div>

                                <label class="col-lg-1 control-label">Carrera</label>
                                <div class="col-lg-5">
                                
                                    {!! Form::text('carrera_id', $usuario->carrera_id, ['class'=>'form-control','readonly']) !!}
                                
                                </div>
                            </div>                                                                                 

                            <div class="form-group">
                                <label class="col-lg-1 control-label">Rol</label>
                                <div class="col-lg-5">
                                    {!! Form::text('rol', $usuario->rol, ['class'=>'form-control', 'readonly']) !!}
                                </div>

                                <label class="col-lg-1 control-label">Estado</label>
                                <div class="col-lg-5">
                                    {!! Form::text('estado', $usuario->estado, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>      

                            <div class="form-group">
                                <label class="col-lg-1 control-label">Fecha de Registro</label>
                                <div class="col-lg-5">
                                    {!! Form::text('created_at', $usuario->created_at, ['class'=>'form-control', 'readonly']) !!}
                                </div>

                                <label class="col-lg-1 control-label">Ult. Actualización</label>
                                <div class="col-lg-5">
                                    {!! Form::text('updated_at', $usuario->updated_at, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>                                   
                                                                                                                  
                            <div class="form-group">
                              <div class="col-lg-12 text-center">
                                <a href="{{ url('local'..'/empaques') }}" class="btn btn-primary  btn-sm"  data-toggle="tooltip" title="volver">Volver</a>
                              </div>
                            </div>
                         
                          </div>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>

<!--

    </div>
</div>

-->



@endsection




