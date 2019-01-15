@extends('layouts.global-nero')

@section('content')

<section>
    <div class="container">

        <h4 class="text-center">Usuario</h4>


        <div class="card card-info">
            <div class="card-header">
                <h5 class="card-title">Información del Usuario</h5>
            </div>
            <div class="card-body">

	        						<div class="row">
			                          
			                                <div class="col-lg-1">
			                                    <b>ID :</b> {{ $local_user->user->id }}
			                                </div>

			                                <div class="col-lg-2">
			                                    <b>Rut :</b> {{ $local_user->user->rut }}
			                                </div>

			                                <div class="col-lg-4">
			                                    <b>Nombre :</b> {{ $local_user->user->nombre }} {{ $local_user->user->apellido }}
			                                </div>

			                                <div class="col-lg-2">
			                                    <b>Rol :</b> {{ $local_user->user->rol }}
			                                </div>

			                                <div class="col-lg-3">
			                                    <b>Estado :</b> {{ $local_user->user->estado }}
			                                </div>

									</div>

	  		</div>
	    </div>



        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Editar usuario del local</h5>
            </div>
            <div class="card-body">

            <b class="text-center">@include('incluir/mensajes')</b>

            {!! Form::open(['route' => ['admin.local.putUsuarioLocal', $local_user], 'method' => 'PUT']) !!}

                {!! Form::hidden('local_id', $local_user->local->id) !!}
                {!! Form::hidden('user_id', $local_user->User->id) !!}
                            <div class="row form-group">
                                <label class="col-md-2">ID Local User</label>
                                <div class="col-md-4">
                                    {!! Form::text('id', $local_user->id, ['class'=>'form-control', 'readonly']) !!}
                                </div>

                                <label class="col-md-2">Local</label>
                                <div class="col-md-4">
                                    {!! Form::text('local_nombre', $local_user->local->nombre, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>    

                            <div class="row form-group">
                                <label class="col-md-2">Cupos Toma</label>
                                <div class="col-md-4">
                                    {!! Form::text('cuposToma', $local_user->cuposToma, ['class'=>'form-control', 'placeholder' => 'Cant. de Cupos', 'required']) !!}
                                </div>

                                <label class="col-md-2">Cupos Pre Toma</label>
                                <div class="col-md-4">
                                    {!! Form::text('cuposPreToma', $local_user->cuposPreToma, ['class'=>'form-control', 'placeholder' => 'Cant. de Cupos', 'required']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-md-2">Cupos Repechaje</label>
                                <div class="col-md-4">
                                    {!! Form::text('cuposRepechaje', $local_user->cuposRepechaje, ['class'=>'form-control', 'placeholder' => 'Cant. de Cupos', 'required']) !!}
                                </div>

                                <label class="col-md-2"></label>
                                <div class="col-md-4">

                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-md-2">Inicio Castigo</label>
                                <div class="col-md-4">
                                    {!! Form::text('inicioCastigo', $local_user->inicioCastigo, ['class'=>'datetimepicker form-control', 'placeholder' => '2016/03/21 23:45:00']) !!}
                                </div>

                                <label class="col-md-2">Termino Castigo</label>
                                <div class="col-md-4">
                                    {!! Form::text('terminoCastigo', $local_user->terminoCastigo, ['class'=>'datetimepicker form-control', 'placeholder' => '2016/03/29 23:45:00']) !!}
                                </div>
                            </div>    


                            <div class="row form-group">
                                <label class="col-md-2">Rol</label>
                                <div class="col-md-4">
                                	
                                    {!! Form::select('rol',[$local_user->rol => $local_user->rol,'Empaque' => 'Empaque', 'Coordinador' => 'Coordinador', 'Encargado' => 'Encargado'], null,['class'=>'form-control select-category']) !!}
                                    
                                </div>

                                <label class="col-md-2">Estado</label>
                                <div class="col-md-4">
                                	
                                    {!! Form::select('estado',[$local_user->estado => $local_user->estado,'Activo' => 'Activo', 'Suspendido' => 'Suspendido', 'Deudor' => 'Deudor', 'Desvinculado' => 'Desvinculado'], null,['class'=>'form-control select-category']) !!}
                                    
                                </div>
                            </div>  


                            <div class="row form-group">
                              <div class="col-md-12 text-center">
                                {!! Form::submit('Guardar', ['class'=>'btn btn-sm btn-success']) !!}
                                <a href="{{ url('admin/local/'.$local_user->local_id.'/empaques') }}" class="btn btn-sm btn-primary">Volver</a>
                              </div>
                            </div>
                         
                          {!! Form::close() !!}

            </div>
        </div>
    </div>
</section>



@endsection



@section('js')

                <script src="{{ asset('plugins/jquery/moment/moment-with-locales.min.js') }}"></script>
                <script src="{{ asset('js/transition.js') }}"></script>
                <script src="{{ asset('js/collapse.js') }}"></script>

                <script src="{{ asset('plugins/jquery/bootstrap-daterangepicker/bootstrap-datetimepicker.min.js') }}"></script>
                <link rel="stylesheet" href="{{ asset('plugins/jquery/bootstrap-daterangepicker/bootstrap-datetimepicker.min.css') }}" type="text/css" />

                <script type="text/javascript">

                    $('.datetimepicker').datetimepicker({
                        locale: 'es',
                        format: 'YYYY-MM-DD HH:mm:ss',
                        //daysOfWeekDisabled: [0],
                    });
                </script>
@endsection


