@extends('layouts.global-externo')

<!--MetaTags html Basic-->
@section('title', '- Frases Proyecto Nero - Plataforma Para Tomar Turnos On-line - Empaques Supermercados - Propineros Universitarios - ')
@section('description', 'Frases Proyecto Nero - Listado de frases subidas a nuestra plataforma web donde las organizaciones independiente de empaques universitarios pueden tomar turnos on-line para trabajar en sus respectivos supermercados.')
@section('keywords', 'Frases, Toma, Turnos, Empaques, Propineros, Supermercados, Chile')

<!--MetaTags Facebook-->
@section('urlFB', 'https://www.proyectonero.cl/album/frases')
@section('typeFB', 'website')
@section('titleFB', 'Frases Proyecto Nero - Plataforma Para Tomar Turnos On-line')
@section('descriptionFB', 'Frases Proyecto Nero - Listado de frases subidas a nuestra plataforma web donde las organizaciones independiente de empaques universitarios pueden tomar turnos on-line para trabajar en sus respectivos supermercados.')
@section('imageFB', 'https://www.proyectonero.cl/img/fb-nero.jpg')

<!--MetaTags Twitter-->
@section('titleTW', 'Frases Proyecto Nero - Plataforma Para Tomar Turnos On-line')
@section('descriptionTW', 'Frases Proyecto Nero - Listado de frases subidas a nuestra plataforma web donde las organizaciones independiente de empaques universitarios pueden tomar turnos on-line para trabajar en sus respectivos supermercados.')
@section('imageTW', 'http://www.proyectonero.cl/img/fb-nero.jpg')

@section('content')

	<section>
		<div class="container">
			<h2 class="m-b-30 text-center">Frases</h2>

			<div class="post-columns">

			@foreach($frases as $frase)

				<!-- post -->
					<div class="post post-card">
						<h2 class="post-title"><a href="{{ $frase->link }}">{{ $frase->titulo }}</a></h2>
						<div class="post-meta">
							<span><i class="fa fa-calendar"></i> {{ date('d-m-Y', strtotime($frase->updated_at)) }} </span>
							<span><a href="#"><i class="fa fa-book"></i> Frases</a></span>
							<span><a href="#"><i class="fa fa-pencil"></i> Nero</a></span>
						</div>
						<div class="post-thumbnail">
							<img src="../img/album/{{ $frase->imagen }}" alt="{{ $frase->titulo }}">
						</div>
						<p>{{ $frase->descripcion }}</p>
						<div class="post-footer">
							<a class="btn btn-outline-primary" href="{{ $frase->link }}" role="button">Ver Frase</a>
							<a class="float-right p-t-10" href="#"><i class="fa fa-thumbs-up text-primary"></i> </a>
						</div>
					</div>
				@endforeach
			</div>
			<div class="row">
				<div class="col-lg-12 text-center">
					{!! $frases->links('vendor.pagination.simple-bootstrap-4') !!}
				</div>
			</div>
		</div>
	</section>


@endsection



@section('js')


@endsection


