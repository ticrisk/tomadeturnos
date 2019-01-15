@extends('layouts.global-nero')

@section('content')
<section>
		<div class="container">

			<h4 class="text-center">Falta <i class="fa fa-star text-warning pull-right" aria-hidden="true" data-toggle="tooltip" title="Opción Premium"></i></h4>
			<p class="m-b-25 text-center">Listado de mis faltas</p>

			<b class="text-center">@include('incluir/mensajes')</b>

					<div class="card card-primary">
						<div class="card-header">
							<h5 class="card-title">Listado</h5>
						</div>
						<div class="card-body">

							<div class="row hidden-sm-down">
								<div class="col-md-4"><b>Fecha</b></div>
								<div class="col-md-4"><b>Tipo</b></div>
								<div class="col-md-4"><b>Descripción</b></div>
							</div>
							<hr class="hidden-sm-down">


							@foreach($faltas as $falta)

								<div class="row">
									<div class="col-6 col-sm-6 hidden-md-up hidden-lg-up">
										<b>Fecha: </b>
									</div>
									<div class="col-6 col-sm-6 col-md-4 col-lg-4">
										{{ $falta->fecha }}
									</div>

									<div class="col-6  col-sm-6 hidden-md-up hidden-lg-up">
										<b>Tipo: </b>
									</div>
									<div class="col-6  col-sm-6 col-md-4 col-lg-4">
										{{ $falta->tipo }}
									</div>


									<div class="col-6  col-sm-6 hidden-md-up hidden-lg-up">
										<b>Descripción: </b>
									</div>
									<div class="col-6  col-sm-6 col-md-4 col-lg-4">
										{{ $falta->descripcion }}
									</div>
								</div>
								<hr class="visible-xs visible-sm">
								<br>

							@endforeach

							<div class="row">
								<div class="col-md-12">
									{!! $faltas->links('vendor.pagination.simple-bootstrap-4') !!}
								</div>
							</div>

							<div class="col-md-12 text-center">
								<a href="{{ url('usuario/mis-locales') }}" class="btn btn-primary  btn-sm"  data-toggle="tooltip" title="Regresar">Volver</a>
							</div>

						</div>
					</div>
		</div>

</section>
@endsection



@section('js')


@endsection


