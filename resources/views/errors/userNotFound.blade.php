@extends('layouts.global-externo')

@section('content')

	<div class="bg-light lter b-b wrapper-md">
          <h1 class="m-n font-thin h3">Error</h1>
        </div>
		<section class="elements">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-sm-30 text-center">
						<h3 class="text-center"><b>Página No Encontrada.</b></h3>
						<b class="text-center">@include('incluir/mensajes')</b>
						<p class="text-center">
							Intentas hacer algo NO permitido. Te recomendamos describir al Administrador paso a paso lo que intentas hacer.
							<br />
							Por motivos de seguridad registramos su IP. Si continua los errores contáctese con el Administrador para no bloquear su IP y la cuenta.
							<br/><br/>
							<b><a href="{{ url('/') }}">Volver al Inicio</a></b>
							<br /><br/>

							<figure class="figure">
								<img src="{{ asset('img/iconos/user-not-found.png') }}" alt="img-error" class="rounded-circle">
							</figure>
						</p>
						
						

	
					

					</div>



				</div>
			</div>
		</section>


@endsection