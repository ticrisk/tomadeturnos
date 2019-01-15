<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Gameforest - Gaming Theme HTML</title>
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
                <div class="navbar-left">
                    <a class="navbar-toggle"><i class="fa fa-bars"></i></a>
                    <a href="/" class="logo"><img src="img/logo.png" alt="Proyecto Nero"></a>
                    <nav class="nav">
                        <ul>

                            @if (Auth::guest())
                                @include('incluir/panel-principal')

                            @elseif(Auth::user()->rol == "Usuario")
                                @include('incluir/reloj')
                                @include('incluir/panel-usuario')

                            @elseif(Auth::user()->rol == "Admin")
                                @include('incluir/reloj')
                                @include('incluir/panel-administrador')

                            @else
                                @include('incluir/panel-principal')
                            @endif

                        </ul>
                    </nav>
                </div>
                <div class="nav navbar-right">

                    @if (Auth::guest())
                        <ul>
                            <li class="hidden-xs-down"><a href="{{ url('auth/login') }}">Login</a></li>
                            <li class="hidden-xs-down"><a href="{{ url('/registro') }}">Registro</a></li>
                        </ul>
                    @else

                        <ul>
                            <li class="dropdown dropdown-profile">
                                <a href="/" data-toggle="dropdown"><img src="{{ asset('img/user/'.Auth::user()->avatar) }}" alt="img-avatar"> <span>{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</span></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item active" href="{{ url('user/'.Auth::user()->id.'/edit/') }}"><i class="fa fa-user"></i> Mi Perfil</a>
                                    <a class="dropdown-item" href="{{ url('usuario/mis-locales') }}"><i class="fa fa-flag"></i> Mis Locales</a>

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ url('logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
                                </div>
                            </li>
                        </ul>


                    @endif
                </div>
            </div>
        </div>
        <div class="navbar-search">
            <div class="container">
                <form method="post">
                    <input type="text" class="form-control" placeholder="Search...">
                    <i class="fa fa-times close"></i>
                </form>
            </div>
        </div>
    </div>
</header>
<!-- /header -->



@if (Auth::check())

    <div class="container">

        <label class="text-center" id="status">'</label>
        <hr>
    </div>

@endif

@yield('content')



<!-- footer -->
<!--
<footer id="footer">
  <div class="container">

    <div class="row">
      <div class="col-sm-12 col-md-5">
        <h4 class="footer-title">About Gameforest</h4>
        <p>Gameforest is a Bootstrap Gaming theme. Build your own gaming theme with gameforest and you will love to use it. Clean and pure coded HTML, CSS files what is included in your downloaded package.</p>
        <p>Attached more then 60+ HTML pages and customized elements. Copy and paste your favourite section or build your own so easily.</p>
      </div>
      <div class="col-sm-12 col-md-3">
        <h4 class="footer-title">Platform</h4>
        <div class="row">
          <div class="col">
            <ul>
              <li><a href="#">Playstation 4</a></li>
              <li><a href="#">Xbox One</a></li>
              <li><a href="#">PC</a></li>
              <li><a href="#">Steam</a></li>
            </ul>
          </div>
          <div class="col">
            <ul>
              <li><a href="games.html">Games</a></li>
              <li><a href="reviews.html">Reviews</a></li>
              <li><a href="videos.html">Videos</a></li>
              <li><a href="forums.html">Forums</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-4">
        <h4 class="footer-title">Subscribe</h4>
        <p>Subscribe to our newsletter and get notification when new games are available.</p>
        <div class="input-group m-t-25">
          <input type="text" class="form-control" placeholder="Email">
          <span class="input-group-btn">
            <button class="btn btn-primary" type="button">Subscribe</button>
          </span>
        </div>
      </div>
    </div>


    <div class="footer-bottom">

      <div class="footer-social">
        <a href="https://facebook.com/yakuthemes" target="_blank" data-toggle="tooltip" title="facebook"><i class="fa fa-facebook"></i></a>
        <a href="https://twitter.com/yakuthemes" target="_blank" data-toggle="tooltip" title="twitter"><i class="fa fa-twitter"></i></a>
        <a href="https://steamcommunity.com/id/yakuzi" target="_blank" data-toggle="tooltip" title="steam"><i class="fa fa-steam"></i></a>
        <a href="https://www.twitch.tv/" target="_blank" data-toggle="tooltip" title="twitch"><i class="fa fa-twitch"></i></a>
        <a href="https://www.youtube.com/user/1YAKUZI" target="_blank" data-toggle="tooltip" title="youtube"><i class="fa fa-youtube"></i></a>
      </div>

      <p>Copyright &copy; 2017 <a href="https://themeforest.net/item/gameforest-responsive-gaming-html-theme/5007730" target="_blank">Gameforest</a>. All rights reserved.</p>
    </div>
  </div>
</footer>
-->
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
