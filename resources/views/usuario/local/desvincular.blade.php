@extends('layouts.global-externo')

@section('content')
<section>
        <div class="container">

            <h4 class="text-center">Usuario</h4>
            <p class="m-b-25 text-center">Información del usuario</p>

            <div class="card card-info">
                <div class="card-header">
                    <h5 class="card-title">Info Adicional</h5>
                </div>
                <div class="card-block">

                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-1">
                            <b>ID :</b> {{ $local_user->user->id }}
                        </div>

                        <div class="col-12 col-sm-6 col-md-6 col-lg-2">
                            <b>Rut :</b> {{ $local_user->user->rut }}
                        </div>

                        <div class="col-12 col-sm-12 col-md-12  col-lg-5">
                            <b>Nombre :</b> {{ $local_user->user->nombre }} {{ $local_user->user->apellido }}
                        </div>

                        <div class="col-12 col-sm-6 col-md-6 col-lg-2">
                            <b>Rol :</b> {{ $local_user->user->rol }}
                        </div>

                        <div class="col-12 col-sm-6 col-md-6 col-lg-2">
                            <b>Estado :</b> {{ $local_user->user->estado }}
                        </div>
                    </div>

                </div>
            </div>


            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Desvincular Usuario</h5>
                </div>
                <div class="card-block">
                    <b class="text-center">@include('incluir/mensajes')</b>
                          {!! Form::open(['route' => ['usuario.local.putDesvincularUsuarioLocal', $local_user], 'method' => 'PUT']) !!}

                            <div class="form-group row">
                                <label class="col-6 col-sm-6 col-md-2 col-lg-2">ID Local User</label>
                                <div class="col-6 col-sm-6 col-md-4 col-lg-4">
                                    {!! Form::text('user_id', $local_user->id, ['class'=>'form-control', 'readonly']) !!}
                                </div>

                                <div class="hidden-md-up p-t-55"></div>
                                <label class="col-6 col-sm-6 col-md-2 col-lg-2">Local</label>
                                <div class="col-6 col-sm-6 col-md-4 col-lg-4">
                                    {!! Form::text('local_id', $local_user->local->nombre, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>    

                            <div class="form-group row">
                                <label class="col-6 col-sm-6 col-md-2 col-lg-2">Cupos Toma</label>
                                <div class="col-6 col-sm-6 col-md-4 col-lg-4">
                                    {!! Form::text('cuposToma', $local_user->cuposToma, ['class'=>'form-control', 'readonly']) !!}
                                </div>

                                <div class="hidden-md-up p-t-55"></div>
                                <label class="col-6 col-sm-6 col-md-2 col-lg-2">Cupos Pre Toma</label>
                                <div class="col-6 col-sm-6 col-md-4 col-lg-4">
                                    {!! Form::text('cuposPreToma', $local_user->cuposPreToma, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-6 col-sm-6 col-md-2 col-lg-2">Cupos Repechaje</label>
                                <div class="col-6 col-sm-6 col-md-4 col-lg-4">
                                    {!! Form::text('cuposRepechaje', $local_user->cuposRepechaje, ['class'=>'form-control', 'readonly']) !!}
                                </div>

                                <div class="hidden-md-up p-t-55"></div>
                                <label class="col-6 col-sm-6 col-md-2 col-lg-2"></label>
                                <div class="col-6 col-sm-6 col-md-4 col-lg-4">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-6 col-sm-6 col-md-2 col-lg-2">Inicio Castigo</label>
                                <div class="col-6 col-sm-6 col-md-4 col-lg-4">
                                    {!! Form::text('inicioCastigo', $local_user->inicioCastigo, ['class'=>'form-control', 'placeholder' => '2018-03-21 23:45:00', 'readonly']) !!}
                                </div>

                                <div class="hidden-md-up p-t-55"></div>
                                <label class="col-6 col-sm-6 col-md-2 col-lg-2">Termino Castigo</label>
                                <div class="col-6 col-sm-6 col-md-4 col-lg-4">
                                    {!! Form::text('terminoCastigo', $local_user->terminoCastigo, ['class'=>'form-control', 'placeholder' => '2018-03-29 23:45:00', 'readonly']) !!}
                                </div>
                            </div>    


                            <div class="form-group row">
                                <label class="col-6 col-sm-6 col-md-2 col-lg-2">Rol</label>
                                <div class="col-6 col-sm-6 col-md-4 col-lg-4">
                                	
                                    {!! Form::text('rol', $local_user->rol, ['class'=>'form-control', 'readonly']) !!}
                                    
                                </div>

                                <div class="hidden-md-up p-t-55"></div>
                                <label class="col-6 col-sm-6 col-md-2 col-lg-2">Estado</label>
                                <div class="col-6 col-sm-6 col-md-4 col-lg-4">
                                	
                                    {!! Form::text('estado', $local_user->estado, ['class'=>'form-control', 'readonly']) !!}
                                    
                                </div>
                            </div>  


                            <div class="form-group row">
                              <div class="col-md-12 text-center">
                                {!! Form::submit('Desvincular', ['class'=>'btn btn-sm btn-danger']) !!}
                                <a href="{{ url('usuario/local/'.$local_user->local_id.'/empaques') }}" class="btn btn-sm btn-primary">Volver</a>
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


