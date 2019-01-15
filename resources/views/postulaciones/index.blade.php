@extends('layouts.global-externo')

@section('title', '- Trabajar de Empaque en Supermercado - Propineros Universitarios')
@section('description', 'Postulaciones para trabajar de empaque en los supermercados. Busca trabajo como empaque universitario.')
@section('keywords', 'Supermercados, Toma, Turnos, Empaques, Propineros, Supermercados, Chile, Trabajar')

<!--MetaTags Facebook-->
@section('urlFB', 'https://www.proyectonero.cl/postulaciones')
@section('typeFB', 'website')
@section('titleFB', 'Proyecto Nero - Postulaciones para trabajar de empaque')
@section('descriptionFB', 'Postulaciones para trabajar de empaque en los supermercados. Busca trabajo como empaque universitario.')
@section('imageFB', 'https://www.proyectonero.cl/img/fb-nero.jpg')

<!--MetaTags Twitter-->
@section('titleTW', 'Proyecto Nero - Postulaciones para trabajar de empaque')
@section('descriptionTW', 'Postulaciones para trabajar de empaque en los supermercados. Busca trabajo como empaque universitario.')
@section('imageTW', 'https://www.proyectonero.cl/img/fb-nero.jpg')

@section('content')

<section>
    <div class="container">

        <h3 class="text-center">Postulaciones</h3>
        <p class="m-b-25 text-center">Listado de postulaciones</p>
        <b class="text-center">@include('incluir/mensajes')</b>

        <div class="row">
            @foreach($postulaciones as $postulacion)
                <div class="col-sm-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5 class="card-title">Postulación {{ $postulacion->id }} <br> {{ $postulacion->cadenaNombre }} - {{ $postulacion->nombre }}</h5>
                        </div>

                        <div class="card-body">

                            <div class="text-center">
                                <b>Estado :</b> {{ $postulacion->activa }}
                                <br>
                                <b>Inicio :</b> {{ $postulacion->inicio }}
                                <br>
                                <b>Termino :</b> {{ $postulacion->termino }}
                                <br>
                                <b>Tipo :</b> {{ $postulacion->activarLista }}
                                <br>
                                <b>Cupos :</b> {{ $postulacion->cupos }}
                                <br>
                                <br>
                                <p class="text-center">{{ $postulacion->descripcion }}</p>
                                <hr>
                                @if(Auth::guest())
                                    <a href="{{ url('login') }}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Login">Iniciar Sesión</a>
                                @elseif($postulacion->activa == 'Azar')
                                    <a href="{{ url('postulaciones/postulacion/'.$postulacion->id) }}" class="btn btn-danger btn-sm disabled" role="button" aria-disabled="true" data-toggle="tooltip" title="Postulación Automática">Postulación Automática</a>
                                @elseif($postulacion->activa == 'Finalizada')
                                    <a href="{{ url('postulaciones/postulacion/'.$postulacion->id) }}" class="btn btn-danger btn-sm disabled" role="button" aria-disabled="true" data-toggle="tooltip" title="Postulación Finalizada">Finalizada</a>
                                @else
                                    <a href="{{ url('postulaciones/postulacion/'.$postulacion->id) }}" class="btn btn-success  btn-sm"  data-toggle="tooltip" title="Ir a la Postulación">Ir a la Postulación</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center">
            {!! $postulaciones->links('vendor.pagination.simple-bootstrap-4') !!}
        </div>

    </div>
</section>

@endsection