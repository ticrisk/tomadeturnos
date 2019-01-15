@extends('layouts.global-externo')

<!--MetaTags html Basic-->
@section('title', '- Login - Plataforma Para Tomar Turnos On-line')
@section('description', 'Login Proyecto Nero - Iniciar sesión en nuestra plataforma web donde las organizaciones independiente de empaques universitarios pueden tomar turnos on-line para trabajar en sus respectivos supermercados.')
@section('keywords', 'Login, Toma, Turnos, Empaques, Propineros, Supermercados, Chile')

<!--MetaTags Facebook-->
@section('urlFB', 'https://www.proyectonero.cl/auth/login')
@section('typeFB', 'website')
@section('titleFB', 'Login Proyecto Nero - Plataforma Para Tomar Turnos On-line')
@section('descriptionFB', 'Proyecto Nero es un sitio web donde las organizaciones independiente de empaques universitarios pueden tomar turnos on-line para trabajar en sus respectivos supermercados.')
@section('imageFB', 'https://www.proyectonero.cl/img/fb-nero.jpg')

<!--MetaTags Twitter-->
@section('titleTW', 'Login Proyecto Nero - Plataforma Para Tomar Turnos On-line')
@section('descriptionTW', 'Proyecto Nero es un sitio web donde las organizaciones independiente de empaques universitarios pueden tomar turnos on-line para trabajar en sus respectivos supermercados.')
@section('imageTW', 'https://www.proyectonero.cl/img/fb-nero.jpg')


@section('content')


    <!-- main -->
    <section class="bg-image bg-image-sm" style="background-image: url('../img/carousel/wall-login.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-4 mx-auto">
                    <div class="card m-b-0">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fa fa-sign-in"></i> Iniciar Sesión</h4>
                        </div>
                        <div class="card-block">
                            <b class="text-center">@include('incluir/mensajes')</b>
                            {{--<form role="form" method="POST" action="{{ route('login') }}">--}}
                            {!! Form::open(['route' => 'login', 'method' => 'POST']) !!}

                                <div class="form-group input-icon-left m-b-10">
                                    <i class="fa fa-user"></i>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-secondary"  placeholder="E-mail">

                                </div>
                                <div class="form-group input-icon-left m-b-15">
                                    <i class="fa fa-lock"></i>
                                    <input type="password" name="password" id="password" class="form-control form-control-secondary" placeholder="Contraseña">
                                </div>

                                <button type="submit" class="btn btn-primary btn-block m-t-10">Login <i class="fa fa-sign-in"></i></button>
                            {{--</form>--}}
                            {!! Form::close() !!}
                                <div class="divider">
                                    <span>¿Perdiste tu contraseña?</span>
                                </div>
                                <a class="btn btn-secondary btn-block" href="{{ url('password/reset') }}" role="button">Recuperar Password</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /main -->


@endsection
