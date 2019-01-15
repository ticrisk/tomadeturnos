@extends('layouts.global-nero')

@section('content')


<section>
		<div class="container-fluid">

			<h5 class="text-center">Mis Locales</h5>
			<p class="m-b-25 text-center">Listado de mis locales activos</p>

						<div class="card card-primary">
							<div class="card-header">
								<h5 class="card-title">Listado</h5>
							</div>
							<div class="card-body">
								<b class="text-center">@include('incluir/mensajes')</b>
								<div class="row hidden-md-down">
									<label class="col-lg-3 text-center">Nombre del Local</label>
									<label class="col-lg-1 text-center">Rol</label>
									<label class="col-lg-1 text-center">Mi Estado</label>
									<label class="col-lg-1 text-center">Estado Local</label>
									<label class="col-lg-1 text-center">Cuenta</label>
									<label class="col-lg-1 text-center">Precio</label>
									<label class="col-lg-1 text-center">Faltas</label>
									<label class="col-lg-1 text-center">Pagos</label>
									<label class="col-lg-1 text-center">Planillas</label>
									<label class="col-lg-1 text-center">Encargado</label>
								</div>
								<hr class="hidden-md-down">


								@foreach($locales as $local)

								<div class="row">
									<div class="col-6 col-sm-6  col-md-6  hidden-lg-up">
										<b>Local: </b>
									</div>
									<div class="col-6 col-sm-6 col-md-6 col-lg-3 text-center">
										{{ $local->Local->nombre }} - {{ $local->Local->Cadena->nombre }}
									</div>

									<div class="col-6  col-sm-6  col-md-6  hidden-lg-up">
										<b>Rol: </b>
									</div>
									<div class="col-6  col-sm-6 col-md-6 col-lg-1 text-center">
										@if($local->rol == 'Empaque')
											<i class="fa fa-user text-info hidden-md-down" aria-hidden="true" data-toggle="tooltip" title="Empaque"></i>
											<span class="hidden-lg-up">{{ $local->rol }}</span>
										@elseif($local->rol == 'Coordinador')
											<i class="fa fa-user-secret text-info hidden-md-down" aria-hidden="true" data-toggle="tooltip" title="Coordinador"></i>
											<span class="hidden-lg-up">{{ $local->rol }}</span>
										@elseif($local->rol == 'Encargado')
											<i class="fa fa-user-circle text-info hidden-md-down" aria-hidden="true" data-toggle="tooltip" title="Encargado"></i>
											<span class="hidden-lg-up">{{ $local->rol }}</span>
										@else
											<i class="fa fa-wrench text-danger hidden-md-down" aria-hidden="true" data-toggle="tooltip" title="Error"></i>
											<span class="hidden-lg-up">Error</span>
										@endif
									</div>

									<div class="col-6 col-sm-6  col-md-6  hidden-lg-up">
										<b>Mi Estado: </b>
									</div>
									<div class="col-6 col-sm-6 col-md-6 col-lg-1 text-center">
										@if($local->estado == 'Activo')
											<i class="fa fa-check text-success hidden-md-down" aria-hidden="true" data-toggle="tooltip" title="Activo"></i>
											<span class="hidden-lg-up">Activo</span>
										@elseif($local->estado == 'Deudor')
											<i class="fa fa-usd text-danger hidden-md-down" aria-hidden="true" data-toggle="tooltip" title="Deudor"></i>
											<span class="hidden-lg-up">Deudor</span>
										@elseif($local->estado == 'Suspendido')
											<i class="fa fa-exclamation-triangle text-warning hidden-md-down" aria-hidden="true" data-toggle="tooltip" title="Suspendido"></i>
											<span class="hidden-lg-up">Suspendido</span>
										@else
											<i class="fa fa-close text-danger hidden-md-down" aria-hidden="true" data-toggle="tooltip" title="Desvinculado"></i>
											<span class="hidden-lg-up">Desvinculado</span>
										@endif
									</div>

									<div class="col-6 col-sm-6  col-md-6  hidden-lg-up">
										<b>Estado Local: </b>
									</div>
									<div class="col-6 col-sm-6  col-md-6 col-lg-1 text-center">
										@if($local->Local->estado == 'Activo')
											<i class="fa fa-circle text-success" aria-hidden="true" data-toggle="tooltip" title="Activo"></i>
										@else
											<i class="fa fa-circle text-danger" aria-hidden="true" data-toggle="tooltip" title="Bloqueado"></i>
										@endif
									</div>

									<div class="col-6 col-sm-6  col-md-6  hidden-lg-up">
										<b>Cuenta: </b>
									</div>
									<div class="col-6 col-sm-6  col-md-6 col-lg-1 text-center">
										@if($local->Local->cuenta == 'Premium')
											<i class="fa fa-star text-warning" aria-hidden="true" data-toggle="tooltip" title="Premium"></i>
										@else
											<i class="fa fa-star-half-o" aria-hidden="true" data-toggle="tooltip" title="Free"></i>
										@endif
									</div>

									<div class="col-6 col-sm-6  col-md-6  hidden-lg-up">
										<b>Precio: </b>
									</div>
									<div class="col-6 col-sm-6  col-md-6 col-lg-1 text-center">
										{{ '$'.number_format($local->Local->precioMensual,0, '', '.') }}
									</div>

									<div class="hidden-lg-up p-t-35"></div>
									<div class="col-6 col-sm-6 col-md-6 hidden-lg-up">
										<b>Faltas: </b>
									</div>
									<div class="col-6 col-sm-6  col-md-6 col-lg-1 text-center">
										<a href="{{ url('usuario/'.$local->id.'/faltas') }}" class="btn-sm btn-warning"  data-toggle="tooltip" title="mis faltas"><i class="fa fa-thumbs-down"></i></a>
									</div>

									<div class="hidden-lg-up p-t-35"></div>
									<div class="col-6 col-sm-6 col-md-6 hidden-lg-up">
										<b>Pagos: </b>
									</div>
									<div class="col-6 col-sm-6 col-md-6 col-lg-1 text-center">
										<a href="{{ url('usuario/'.$local->id.'/listado-pagos') }}" class="btn-sm btn-danger"  data-toggle="tooltip" title="mis pagos"><i class="fa fa-arrow-circle-up"></i></a>
									</div>

									<div class="hidden-lg-up p-t-35"></div>
									<div class="col-6 col-sm-6 col-md-6 hidden-lg-up">
										<b>Planillas: </b>
									</div>
									<div class="col-6 col-sm-6  col-md-6 col-lg-1 text-center">
										<a href="{{ url('usuario/local/'.$local->local_id.'/listado-planillas') }}" class="btn-sm btn-success"  data-toggle="tooltip" title="ver planillas"><i class="fa fa-file-text"></i></a>
									</div>

									<div class="hidden-lg-up p-t-35"></div>
									<div class="col-6 col-sm-6 col-md-6 hidden-lg-up">
										<b>Encargado: </b>
									</div>
									<div class="col-6 col-sm-6  col-md-6 col-lg-1 text-center">
										@if($local->rol == 'Encargado')
											<a href="{{ url('usuario/local/'.$local->local_id.'/opciones') }}" class="btn-sm btn-primary"  data-toggle="tooltip" title="Configurar"><i class="fa fa-user-circle" aria-hidden="true"></i></a>
										@else
											<button type="button" class="btn btn-xs btn-danger" disabled data-toggle="tooltip" title="Opción para Encargados"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
										@endif
									</div>

								</div>
								<hr class="visible-xs visible-sm visible-md">
								<br>

								@endforeach
							</div>
						</div>

		</div>
</section>

@endsection



@section('js')


@endsection


