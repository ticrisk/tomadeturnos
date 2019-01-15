@extends('layouts.global-externo')

<!--MetaTags html Basic-->
@section('title', '- Blog Noticias - Empaques Propineros - Supermercados')
@section('description', 'Listado de artículos de Proyecto Nero, Blog enfocado para los empaques/propineros revolucionarios de todo Chile que trabajan en supermercados.')
@section('keywords', 'Artículos, Noticias, Empaques, Propineros, Supermercado, Chile')

<!--MetaTags Facebook-->
@section('urlFB', 'https://www.proyectonero.cl/blog')
@section('typeFB', 'website')
@section('titleFB', 'Blog Noticias - Empaques Propineros - Supermercados - Proyecto Nero')
@section('descriptionFB', 'Listado de artículos de Proyecto Nero, Blog enfocado para los empaques/propineros revolucionarios de todo Chile que trabajan en supermercados.')
@section('imageFB', 'https://www.proyectonero.cl/img/fb-nero.jpg')

<!--MetaTags Twitter-->
@section('titleTW', 'Blog Noticias - Empaques Propineros - Supermercados - Proyecto Nero')
@section('descriptionTW', 'Listado de artículos de Proyecto Nero, Blog enfocado para los empaques/propineros revolucionarios de todo Chile que trabajan en supermercados.')
@section('imageTW', 'https://www.proyectonero.cl/img/fb-nero.jpg')

@section('content')
	<!-- main -->
	<section>
		<div class="container">
			<h2 class="m-b-30 text-center">Artículos</h2>
			<div class="row">
				<div class="col-lg-8">
					<!-- post -->
					@foreach($articulos as $articulo)
					<div class="post post-md">
						<div class="post-thumbnail">
							<a href="{{ url('blog/'.$articulo->link) }}"><img src="../img/articulos/{{ $articulo->imgDescripcion }}" alt="{{ $articulo->titulo }}"></a>
						</div>
						<div class="post-block">
							<h2 class="post-title"><a href="{{ url('blog/'.$articulo->link) }}">{{ $articulo->titulo }}</a></h2>
							<div class="post-meta">
								<span><i class="fa fa-calendar"></i> {{ date('d-m-Y', strtotime($articulo->updated_at)) }} </span>
								<span><a href="#"><i class="fa fa-book"></i> Artículo</a></span>
								<span><a href="#"><i class="fa fa-pencil"></i> Nero</a></span>
							</div>
							<p>{{ $articulo->descripcion }}</p>
						</div>
					</div>
					@endforeach
					<div class="row">
						<div class="col-lg-12 text-center">
							{!! $articulos->links('vendor.pagination.simple-bootstrap-4') !!}
						</div>
					</div>
				</div>


				<!-- sidebar -->
				<div class="col-lg-4">
					<div class="sidebar">

						<!-- widget post  -->
						<div class="widget widget-post">
							<h5 class="widget-title">Importantes</h5>
							<a href="#"><img src="http://kryptomonedas.net/wp-content/uploads/2017/07/disseny_proximamente-660x330.jpg" alt=""></a>
							<h4><a href="#">Próximamente</a></h4>
							<span><i class="fa fa-calendar"></i> June 12, 2017</span>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel neque sed ante facilisis efficitur.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
   





@endsection



@section('js')


@endsection


