@extends('layouts.global-nero')

<?php
  $x = "";
  $semana = array("","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo");
?>

@section('content')
<section>
		<div class="container">

			<h5 class="text-center">Mis Turnos</h5>
			<p class="m-b-25 text-center">Listado de turnos</p>

			<div class="card card-primary">
				<div class="card-header">
					<h5 class="card-title">Próximos turnos</h5>
				</div>
				<div class="card-block">
					<b class="text-center">@include('incluir/mensajes')</b>
		                <div class="row">
							@foreach($proxTurnos as $proxTurno)

								<div class="col-xs-12 col-sm-6 col-md-2 col-lg-2" >

								<b>	{{ $semana[date('N', strtotime($proxTurno->Turno->fecha))] }}	</b>
			                    <br>
									{{ date('d-m-Y', strtotime($proxTurno->Turno->fecha))  }}
								<br>
									<b>{{ $proxTurno->Planilla->Local->Cadena->nombre }}</b>
								<br>
									<b>{{ $proxTurno->Planilla->Local->nombre }}</b>
								<br>
									{{ date('H:i', strtotime($proxTurno->Turno->inicio)) }}
								<br>
									{{ date('H:i', strtotime($proxTurno->Turno->termino)) }}
								<br>
									@if($proxTurno->coordinador == 'Si')
										<b>Coordinación</b>
									@else
										<b>{{ $proxTurno->tipo }}</b>
									@endif
								<br><br>

								@if($proxTurno->tipo != 'Regalando')
									{{--	{!! Form::open(['route' => 'turno.regalarTurno', 'method' => 'POST']) !!}  --}}
									{!! Form::open(['url' => 'turno.regalarTurno']) !!}
										{!! form::hidden('id', $proxTurno->id) !!}
										{!! Form::submit('Regalar', ['class'=>'btn btn-sm btn-success']) !!}
									{!! Form::close() !!}
								@else
									{{--	{!! Form::open(['route' => 'turno.cancelarRegalo', 'method' => 'POST']) !!} --}}
									{!! Form::open(['url' => 'turno.cancelarRegalo']) !!}
										{!! form::hidden('id', $proxTurno->id) !!}
										{!! Form::submit('No Regalar', ['class'=>'btn btn-sm btn-danger']) !!}
									{!! Form::close() !!}
								@endif
								<br>

								<hr>
								</div>

							@endforeach
						</div>

						<div class="row text-center">
							<div class="col-md-12">
								{{ $proxTurnos->links('vendor.pagination.simple-bootstrap-4') }}
							</div>
		                </div>

                    </div>
                  </div>


					<div class="card card-warning">
						<div class="card-header">
							<h5 class="card-title">Historial de turnos</h5>
						</div>
						<div class="card-block">


		                <div class="row">
							@foreach($turnos as $turno)

								<div class="col-xs-12 col-sm-6 col-md-2 col-lg-2" >


									<b>	{{ $semana[date('N', strtotime($turno->Turno->fecha))] }}	</b>
				                    <br>
									{{ date('d-m-Y', strtotime($turno->Turno->fecha))  }}
									<br>
									<b>{{ $turno->Planilla->Local->Cadena->nombre }}</b>
									<br>
									<b>{{ $turno->Planilla->Local->nombre }}</b>
									<br>
									{{ date('H:i', strtotime($turno->Turno->inicio)) }}

									<br>
									{{ date('H:i', strtotime($turno->Turno->termino)) }}

									<br>
										@if($turno->coordinador == 'Si')
											<b>Coordinación</b>
										@else
											<b>{{ $turno->tipo }}</b>
										@endif
									<hr>
								</div>


							@endforeach
						</div>


							<div class="row form-group">
								<div class="col-12 hidden-sm-up d-flex">
									{!! $turnos->links('vendor.pagination.simple-bootstrap-4') !!}
								</div>
								<div class="col-md-12 hidden-xs-down d-flex">
									{!! $turnos->links('vendor.pagination.bootstrap-4') !!}
								</div>
							</div>

                    </div>
                  </div>
                </div>
</section>
@endsection



@section('js')
@endsection