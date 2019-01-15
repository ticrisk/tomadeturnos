@extends('layouts.global-nero')

@section('content')
<section>
		<div class="container">

			<h5 class="text-center">Toma de Turnos</h5>
			<!--<p class="m-b-25 text-center">Listado de faltas</p>-->

			<b class="text-center">@include('incluir/mensajes')</b>

								@foreach($misLocales as $miLocal)


						<div class="card card-primary">
							<div class="card-header">
								<h5 class="card-title">{{ $miLocal->Local->Cadena->nombre }} - {{ $miLocal->Local->nombre }}</h5>
							</div>
							<div class="card-body">

								<div class="row">


										<div class="col-md-2 col-lg-2">
											<a href="{{ url('turno/pre-toma/'.$miLocal->local_id) }}" class="btn btn-sm btn-block btn-warning">Pre-Toma</a>
										</div>

									    <div class="hidden-md-up p-t-45"></div>
										<div class="col-md-2 col-lg-2">
											<a href="{{ url('turno/toma/'.$miLocal->local_id) }}" class="btn btn-sm btn-block btn-success">Tomar Turnos</a>
										</div>

									    <div class="hidden-md-up p-t-45"></div>
										<div class="col-md-2 col-lg-2">
											<a href="{{ url('turno/repechaje/'.$miLocal->local_id) }}" class="btn btn-sm btn-block btn-info">Repechaje</a>
										</div>

										<div class="hidden-md-up p-t-45"></div>
										<div class="col-md-2 col-lg-2">
											<a href="{{ url('turno/regalos/'.$miLocal->local_id) }}" class="btn btn-sm btn-block btn-primary">Regalos</a>
										</div>

									    <div class="hidden-md-up p-t-45"></div>
										<div class="col-md-2 col-lg-2">
											<a href="" class="btn btn-sm btn-block btn-secondary" disabled="disabled">Cambiar</a>
										</div>

									    <div class="hidden-md-up p-t-45"></div>
										<div class="col-md-2 col-lg-2">
											<a href="{{ url('turno/ceder/'.$miLocal->local_id) }}" class="btn btn-sm btn-block btn-danger">Ceder</a>
										</div>



									</div>

							</div>
						</div>

								@endforeach

		</div>
</section>


@endsection



@section('js')


@endsection