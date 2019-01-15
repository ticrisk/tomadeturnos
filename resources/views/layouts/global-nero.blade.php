<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <!-- meta -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  {{-- <meta name="csrf_token" content="{ csrf_token() }" /> --}}
  <title>{{ config('app.name') }} @yield('title')</title>
  <meta name="description" content="@yield('description')" />
  <meta name="keywords" content="@yield('keywords')">
  <meta name="author" content="TicRisk.com">

  <!--MetaTags Facebook-->
  <meta property="og:url" content="@yield('urlFB')">
  <meta property="og:type" content="@yield('typeFB')">
  <meta property="og:title" content="@yield('titleFB')">
  <meta property="og:description" content="@yield('descriptionFB')">
  <meta property="og:image" content="@yield('imageFB')">
  <meta property="og:site_name" content="Proyecto Nero">
  <!--<meta property="og:locale" content="es_CL">-->
  <meta property="fb:app_id" content="164988353976260"/>

  <!-- Twitter Card data -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="ProyectoNero">
  <meta name="twitter:creator" content="TicRisk.com">
  <meta name="twitter:title" content="@yield('titleTW')">
  <meta name="twitter:description" content="@yield('descriptionTW')">
  <meta name="twitter:image" content="@yield('imageTW')">

  <link href='{{ asset("img/iconos/icon_tittle.gif") }}' rel='shortcut icon' type='image/gif'>
  <!-- vendor css -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
  <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/animate/animate.min.css') }}">
  <!-- plugins css -->
  <link rel="stylesheet" href="{{ asset('plugins/owl-carousel/css/owl.carousel.min.css') }}" type="text/css" />
  <!-- theme css -->
  <link rel="stylesheet" href="{{ asset('css/theme.min.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}" type="text/css" />

</head>
<body class="fixed-header">

<!-- header -->
<header id="header">
  <div class="container">
    <div class="navbar-backdrop">
      <div class="navbar">
        <div class="navbar-left  dropdown-profile">
          <a class="navbar-toggle"><i class="fa fa-bars"></i></a>
          <a href="/" class="logo"><img src="{{ asset('img/perfil-proyecto-nero.jpg') }}" alt="logo-nero"></a><!--img/logo-toma-de-turnos.png-->
          <nav class="nav">
            <ul>
              <!--<li><a href="/">Casablanca</a></li>-->
              @if(auth()->guard()->guest())
                @include('incluir/menu-nero/principal')
              @elseif(Auth::user()->rol == "Usuario")
                @include('incluir/reloj')
                @include('incluir/menu-nero/usuario')
              @elseif(Auth::user()->rol == "Admin")
                @include('incluir/reloj')
                @include('incluir/menu-nero/administrador')
              @else
                @include('incluir/menu-nero/principal')
              @endif
            </ul>
          </nav>
        </div>
        <div class="nav navbar-right">

          @guest
            <ul>
              <li class="hidden-md-down"><a href="{{ url('login') }}">Login</a></li>
              <li class="hidden-md-down"><a href="{{ url('registro') }}">Registro</a></li>
            </ul>
          @else

            <ul>
              <li class="dropdown dropdown-profile">
                <a href="/" data-toggle="dropdown"><img src="{{ asset('img/user/'.Auth::user()->avatar) }}" alt="img-avatar"> <span>{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</span></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item active" href="{{ url('user/'.Auth::user()->id.'/edit/') }}"><i class="fa fa-user"></i> Mi Perfil</a>
                  <a class="dropdown-item" href="{{ url('usuario/mis-locales') }}"><i class="fa fa-flag"></i> Mis Locales</a>

                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('logout') }}">
                    <i class="fa fa-sign-out"></i> Logout
                  </a>
                </div>
              </li>
            </ul>


          @endguest
        </div>
      </div>

    </div>

  </div>
  @if (Auth::check())
    <section class="breadcrumbs">
      <div class="container">
        <ol class="breadcrumb">
          <center><b><li class="active" id="status"><i class="fa fa-spinner"></i></li></b></center>
        </ol>
      </div>
    </section>
  @endif
</header>
<!-- /header -->

@if (Auth::check())
  <div class="m-t-45 hidden-lg-up"></div>
  <div class="m-t-20 hidden-md-down"></div>
@endif

<div id="app"><!-- Div Vue -->
@yield('content')
</div>

<!-- footer -->

<footer id="footer">
  <div class="container">

    <div class="row">
      <div class="col-sm-12 col-md-5">
        <h4 class="footer-title">Sobre Nosotros</h4>
        <p>Somos una organización sin fines de lucro que presta servicios a los empaques universitarios
          para que puedan tomar turnos on-line semanalmente de forma gratuita o a muy bajo costo.</p>
      </div>
      <div class="col-sm-12 col-md-3">
        <h4 class="footer-title">Interés</h4>
        <div class="row">
          <div class="col">
            <ul>
              <li><a href="https://www.proyectonero.cl">Proyecto Nero</a></li>
              <li><a href="http://www.startupchile.org/" target="_blank">Start-Up</a></li>
            </ul>
          </div>
          <div class="col">
            <ul>
              <li><a href="http://www.ticrisk.com" target="_blank">TicRisk</a></li>
              <li><a href="https://www.corfo.cl" target="_blank">Corfo</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-4 text-center">
        <figure class="figure">
          <img src="{{ asset('img/toma-de-turnos.png') }}" alt="toma de turnos online" class="rounded w-50" width="200" height="200">
        </figure>
      </div>
    </div>

    <div class="footer-bottom">

      <div class="footer-social">
        <a href="https://www.facebook.com/EmpaquesNero/" target="_blank" data-toggle="tooltip" title="facebook"><i class="fa fa-facebook"></i></a>
        <a href="https://twitter.com/EmpaquesNero" target="_blank" data-toggle="tooltip" title="twitter"><i class="fa fa-twitter"></i></a>
        <a href="https://www.instagram.com/empaquesnero/" target="_blank" data-toggle="tooltip" title="instagram"><i class="fa fa-instagram"></i></a>
        <a href="https://www.linkedin.com/in/empaquesnero/" target="_blank" data-toggle="tooltip" title="linkedin"><i class="fa fa-linkedin"></i></a>
        <a href="https://www.youtube.com/channel/UC0CULoxcxlTZBAE33sQUJhg" target="_blank" data-toggle="tooltip" title="youtube"><i class="fa fa-youtube"></i></a>
        <a href="{{ url('contacto') }}" target="_blank" data-toggle="tooltip" title="Contacto"><i class="fa fa-envelope"></i></a>
      </div>

      <p>Copyright &copy; 2014 - {{ date('Y') }}. <a href="https://www.proyectonero.cl" target="_blank">Proyecto Nero</a>. All Rights Reserved.</p>
    </div>
  </div>
</footer>
<!-- /footer -->

<!-- vendor js -->
<script src="{{ asset('plugins/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('plugins/popper/popper.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>


<!-- plugins js -->
<script src="{{ asset('plugins/lightbox/lightbox.js') }}"></script>
<script src="{{ asset('plugins/owl-carousel/js/owl.carousel.min.js') }}"></script>
<script>
    (function($) {
        "use strict";

        // Full Width Carousel
        $('.owl-slide').owlCarousel({
            nav: true,
            loop: true,
            autoplay: true,
            items: 1
        });

        // Recent Reviews
        $('.owl-list').owlCarousel({
            margin: 25,
            nav: true,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                500: {
                    items: 2
                },
                701: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        });

        // lightbox
        $('[data-lightbox]').lightbox();
    })(jQuery);
</script>

<!-- theme js -->
<script src="{{ asset('js/theme.min.js') }}"></script>


@yield('js')

</body>
</html>
