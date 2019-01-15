@extends('layouts.global-nero')

<!--MetaTags html Basic-->
@section('title', '- Memes Proyecto Nero - Plataforma Para Tomar Turnos On-line - Empaques Supermercados - Propineros Universitarios - ')
@section('description', 'Memes Proyecto Nero - Listado de imagenes graciosas subidas a nuestra plataforma web donde las organizaciones independiente de empaques universitarios pueden tomar turnos on-line para trabajar en sus respectivos supermercados.')
@section('keywords', 'Memes, Toma, Turnos, Empaques, Propineros, Supermercados, Chile')

<!--MetaTags Facebook-->
@section('urlFB', 'https://www.proyectonero.cl/album/memes')
@section('typeFB', 'website')
@section('titleFB', 'Memes Proyecto Nero - Plataforma Para Tomar Turnos On-line')
@section('descriptionFB', 'Memes Proyecto Nero - Listado de imagenes graciosas subidas a nuestra plataforma web donde las organizaciones independiente de empaques universitarios pueden tomar turnos on-line para trabajar en sus respectivos supermercados.')
@section('imageFB', 'https://www.proyectonero.cl/img/fb-nero.jpg')

<!--MetaTags Twitter-->
@section('titleTW', 'Memes Proyecto Nero - Plataforma Para Tomar Turnos On-line')
@section('descriptionTW', 'Memes Proyecto Nero - Listado de imagenes graciosas subidas a nuestra plataforma web donde las organizaciones independiente de empaques universitarios pueden tomar turnos on-line para trabajar en sus respectivos supermercados.')
@section('imageTW', 'https://www.proyectonero.cl/img/fb-nero.jpg')

@section('content')

	<section>
		<div class="container">
			<h2 class="m-b-30 text-center">Memes</h2>

			<div class="post-columns">

				@foreach($memes as $meme)

					<!-- post -->
					<div class="post post-card">
						<h2 class="post-title"><a href="{{ $meme->link }}">{{ $meme->titulo }}</a></h2>
						<div class="post-meta">
							<span><i class="fa fa-calendar"></i> {{ date('d-m-Y', strtotime($meme->updated_at)) }} </span>
							<span><a href="#"><i class="fa fa-book"></i> Memes</a></span>
							<span><a href="#"><i class="fa fa-pencil"></i> Nero</a></span>
						</div>
						<div class="post-thumbnail">
							<img src="../img/album/{{ $meme->imagen }}" alt="{{ $meme->titulo }}">
						</div>
						<p>{{ $meme->descripcion }}</p>
						<div class="post-footer">
							<a class="btn btn-outline-primary" href="{{ $meme->link }}" role="button">Ver Meme</a>
							<a class="float-right p-t-10" href="#"><i class="fa fa-thumbs-up text-primary"></i> </a>
						</div>
					</div>
				@endforeach
			</div>
			<div class="row">
				<div class="col-lg-12 text-center">
					{!! $memes->links('vendor.pagination.simple-bootstrap-4') !!}
				</div>
			</div>
		</div>
	</section>

@endsection



@section('js')


@endsection


