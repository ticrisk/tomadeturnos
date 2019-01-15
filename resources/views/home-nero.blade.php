@extends('layouts.home-nero')

<!--MetaTags html Basic-->
@section('title', '- Toma de Turnos - Empaques Supermercados Propineros')
@section('description', 'Proyecto Nero es una organización sin fines de lucro que brinda a los empaques universitarios  el mejor sistema de calendarización y toma de turnos online para que asistan a trabajar a sus turnos semanalmente como propineros en los distintos supermercados de Chile. ¡Organízate y toma turnos gratis!.')
@section('keywords', 'Toma, Turnos, Gratis, Empaques, Propineros, Supermercados, Chile')

<!--MetaTags Facebook-->
@section('urlFB', 'https://www.proyectonero.cl')
@section('typeFB', 'website')
@section('titleFB', '- Plataforma para la toma de turnos online')
@section('descriptionFB', 'Proyecto Nero es un sitio web donde las organizaciones independiente de empaques universitarios pueden tomar turnos  para trabajar en los supermercados.')
@section('imageFB', 'https://www.proyectonero.cl/img/fb-nero.jpg')

<!--MetaTags Twitter-->
@section('titleTW', '- Plataforma para la toma de turnos online')
@section('descriptionTW', 'Proyecto Nero es un sitio web donde las organizaciones independiente de empaques universitarios pueden tomar turnos  para trabajar en los supermercados.')
@section('imageTW', 'https://www.proyectonero.cl/img/fb-nero.jpg')

@section('content')

    <!-- Banner inicial -->
    <section class="hero hero-game" style="background-image: url('img/portada-proyecto-nero.jpg');"><!--img/hero/hero.jpg-->
        <div class="overlay text-center"><b> @include('incluir/mensajes') </b></div>
        <div class="container">
            <div class="hero-block">

                <div class="hero-left">
                    <h2 class="hero-title"><span class="text-danger">P</span>royecto <span class="text-danger">N</span>ero</h2>
                    <p>Sistema de toma de turnos on-line para los empaques de supermercados.</p>
                    @auth
                    <a class="btn btn-primary btn-shadow btn-rounded btn-lg" href="{{ url('turno') }}"  role="button">Tomar Turnos <i class="fa fa-play"></i></a>
                    <a class="btn btn-danger btn-shadow btn-rounded btn-lg m-l-10" href="{{ url('turno/mis-turnos') }}"  role="button">Mis Turnos <i class="fa fa-shopping-cart"></i></a>
                    @endauth

                    @guest
                    <a class="btn btn-primary btn-shadow btn-rounded btn-lg" href="{{ url('login') }}"  role="button">Iniciar Sesión <i class="fa fa-play"></i></a>
                    <a class="btn btn-outline-default btn-shadow btn-rounded btn-lg m-l-10" href="{{ url('registro') }}"  role="button">Registrarme <i class="fa fa-shopping-cart"></i></a>
                    @endguest
                </div>
                <div class="hero-right">
                    <div class="hero-review">
                        <span>Supermercados</span>
                        <a href="#!" class="chart easypiechart" data-percent="{{ $cantLocales }}" data-scale-color="#e3e3e3"><span>{{ $cantLocales }}</span></a>
                    </div>
                    <div class="hero-review">
                        <span>Empaques</span>
                        <a href="#!">{{ $cantEmpaques }}</a>
                    </div>
                    <div class="hero-review">
                        <span>Registrados</span>
                        <a href="#!">{{ $cantRegistrados }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{--
    <section class="hero" style="background-image: url('img/portada-proyecto-nero.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="hero-block">
                <h2 class="hero-title">Proyecto Nero</h2>
                <p>Sistema de toma de turnos on-line para los empaques de supermercados</p>
                @guest
                <a class="btn btn-primary btn-lg btn-shadow btn-md btn-rounded" href="{{ url('login') }}" role="button">Iniciar Sesión</a>
                @endguest
            </div>
        </div>
    </section>
    --}}
    @if($existe == 'Si')
        <div class="alert alert-primary text-center" role="alert">
            <h3><b>{{ $informativo->titulo }}</b></h3>
            <p>{{ $informativo->descripcion }}</p>
            <i>{{ date('d-m-Y', strtotime($informativo->updated_at)) }}</i>
        </div>
    @endif

    <section>
        <div class="container">
            <!--<h5>Widgets</h5>
            <p>Gameforest is including custom widgets like post lists, game and game lists. You can use everywhere these widgets in the theme.</p>-->
            <div class="row ">


                <div class="col-lg-4 p-y-5">
                    <!-- widget-games -->
                    <div class="widget widget-games">
                        <a href="#!" style="background-image: url('img/gallery/empaques-datos.jpg')">
                            <span class="overlay"></span>
                            <div class="widget-block">
                                <!--<div class="count">1</div>-->
                                <div class="description">
                                    <h5 class="title text-center">Datos Estadísticos</h5>
                                    <!--<span class="date">Nov 14, 2017</span>-->
                                </div>
                            </div>
                        </a>
                        <a href="#!" style="background-image: url('img/gallery/locales-estadisticas.jpg')">
                            <span class="overlay"></span>
                            <div class="widget-block">
                                <div class="count">{{ $cantLocales }}</div>
                                <div class="description">
                                    <h5 class="title">Supermercados Asociados</h5>
                                    <span class="date">¡Únete a la rebelión!</span>
                                </div>
                            </div>
                        </a>
                        <a href="#!" style="background-image: url('img/gallery/empaques-supermercados.png')">
                            <span class="overlay"></span>
                            <div class="widget-block">
                                <div class="count">{{ $cantEmpaques }}</div>
                                <div class="description">
                                    <h5 class="title">Empaques Trabajando</h5>
                                    <span class="date">¡Cada día somos más!</span>
                                </div>
                            </div>
                        </a>
                        <a href="#!" style="background-image: url('img/gallery/empaques-registrados.jpg')">
                            <span class="overlay"></span>
                            <div class="widget-block">
                                <div class="count">{{ $cantRegistrados }}</div>
                                <div class="description">
                                    <h5 class="title">Personas Registradas</h5>
                                    <span class="date">¡Esperando una oportunidad!</span>
                                </div>
                            </div>
                        </a>
                        <a href="#!" style="background-image: url('img/gallery/empaques-felices.jpg')">
                            <span class="overlay"></span>
                            <div class="widget-block">
                                <div class="count">{{ $cantImagenes }}</div>
                                <div class="description">
                                    <h5 class="title">Imágenes Entretenidas</h5>
                                    <span class="date">¡Diversión cada semana!</span>
                                </div>
                            </div>
                        </a>
                        <a href="#!" style="background-image: url('img/gallery/noticias-empaques.jpg')">
                            <span class="overlay"></span>
                            <div class="widget-block">
                                <div class="count">{{ $cantArticulos }}</div>
                                <div class="description">
                                    <h5 class="title">Artículos Informativos</h5>
                                    <span class="date">¡Propineros informados!</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 p-y-5">
                    <!-- widget game -->
                    <div class="widget widget-game">
                        <div class="widget-block" style="background-image: url('img/gallery/nero1.jpg')">
                            <div class="overlay"></div>
                            <div class="widget-item">
                                <h4>Proyecto Nero</h4>
                                <span class="meta">Somos mejor plataforma para la toma de turnos online.</span>

                                <h5>Funciona en</h5>
                                <a href="#!"><span class="badge badge-xbox-one">Notebook</span></a>
                                <div class="hidden-sm-up"><div class="m-b-15"></div></div>
                                <a href="#!"><span class="badge badge-ps4">SmartPhone</span></a>
                                <div class="hidden-sm-up"><div class="m-b-15"></div></div>
                                <a href="#!"><span class="badge badge-steam">Tablet</span></a>

                                <h5>¿Qué es Proyecto Nero?</h5>
                                <p>Proyecto Nero es un sitio web donde las organizaciones independiente de empaques universitarios pueden tomar turnos online semanalmente para trabajar en sus respectivos supermercados.</p>

                                <h5>Desarrollado</h5>
                                <p>Ayudando a los empaques desde el 2014. <br>Actualmente, estamos en la versión 5.0.1</p>
                                <div class="m-b-35"></div>
                                <a href="{{ url('solicitar-demo') }}" class="btn btn-outline-default btn-block">Solicitar Demo <i class="fa fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 p-y-5">
                    <!-- widget gallery -->
                    <div class="widget widget-post">
                        <!--<h5 class="widget-title">Recommended</h5>-->
                        <a href="album/{{ $memeLast->link }}">
                            <img src="img/album/{{ $memeLast->imagen }}" alt="meme-last">
                        </a>
                        <h4>
                            <a href="album/{{ $memeLast->link }}">{{ $memeLast->titulo }}</a>
                        </h4>
                        <span><i class="fa fa-clock-o"></i> {{ date('d-m-Y', strtotime($memeLast->updated_at)) }}</span>
                        <p>{{ $memeLast->descripcion }}</p>
                        <ul class="widget-list">
                            <li>
                                <div class="widget-img">
                                    <a href="album/{{ $meme->link }}">
                                        <img src="img/album/{{ $meme->imagen }}" alt="img-meme">
                                    </a>
                                </div>
                                <div>
                                    <h4>
                                        <a href="album/{{ $meme->link }}">{{ $meme->titulo }}</a>
                                    </h4>
                                    <span>{{ date('d-m-Y', strtotime($meme->updated_at)) }}</span>
                                </div>
                            </li>
                            <li>
                                <div class="widget-img">
                                    <a href="blog/{{ $articulo->link }}">
                                        <img src="img/articulos/{{ $articulo->portada }}" alt="img-articulos">
                                    </a>
                                </div>
                                <div>
                                    <h4>
                                        <a href="blog/{{ $articulo->link }}">{{ $articulo->titulo }}</a>
                                    </h4>
                                    <span>{{ date('d-m-Y', strtotime($articulo->updated_at)) }}</span>
                                </div>
                            </li>
                            <li>
                                <div class="widget-img">
                                    <a href="album/{{ $frase->link }}">
                                        <img src="img/album/{{ $frase->imagen }}" alt="img-frase">
                                    </a>
                                </div>
                                <div>
                                    <h4>
                                        <a href="album/{{ $frase->link }}">{{ $frase->titulo }}</a>
                                    </h4>
                                    <span>{{ date('d-m-Y', strtotime($frase->updated_at)) }}</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-secondary no-border-bottom"><!-- p-y-80 -->
        <div class="container">
            <div class="heading">
                <i class="fa fa-star"></i>
                <h2>Características</h2>
                <p>Observa algunas de nuestras cualidades que hemos logrado gracias al apoyo de todos los empaques que participan en esta gran causa social.</p>
            </div>
            <div class="owl-carousel owl-list">
                <div class="card card-review">
                    <a class="card-img" href="#!">
                        <img src="img/iconos/ganador.png" alt=""><!-- img/review/review-1.jpg -->
                        <div class="badge badge-success"></div>
                    </a>
                    <div class="card-block">
                        <h4 class="card-title"><a href="review-post.html">Ganador</a></h4>
                        <p>El mejor sistema de toma de turnos online elegido por los empaques universitarios de Chile.</p>
                    </div>
                </div>
                <div class="card card-review">
                    <a class="card-img" href="#!">
                        <img src="img/iconos/gratis.png" alt="">
                        <div class="badge badge-danger"></div>
                    </a>
                    <div class="card-block">
                        <h4 class="card-title">
                            <a href="#!">Free & Premium</a>
                        </h4>
                        <p>Elige entre la versión básica que es gratuita o la versión pagada que cuenta con muchas más opciones.</p>
                    </div>
                </div>
                <div class="card card-review">
                    <a class="card-img" href="#!">
                        <img src="img/iconos/team.png" alt=""><!-- img/review/review-1.jpg -->
                        <div class="badge badge-success"></div>
                    </a>
                    <div class="card-block">
                        <h4 class="card-title"><a href="#!">Toma de Turnos</a></h4>
                        <p>Hasta 3 vista diferentes para la toma de turnos online desde un dispositivo pequeño.</p>
                    </div>
                </div>
                <div class="card card-review">
                    <a class="card-img" href="#!">
                        <img src="img/iconos/networking.png" alt="">
                        <div class="badge badge-success"></div>
                    </a>
                    <div class="card-block">
                        <h4 class="card-title"><a href="#!">Control Completo</a></h4>
                        <p>El encargado tiene control completo de las configuraciones de su local. Ej: Agregar, bloquear o eliminar un propinero.</p>
                    </div>
                </div>
                <div class="card card-review">
                    <a class="card-img" href="#!">
                        <img src="img/iconos/analytics.png" alt="">
                        <div class="badge badge-warning"></div>
                    </a>
                    <div class="card-block">
                        <h4 class="card-title"><a href="#!">Estadísticas</a></h4>
                        <p>Generar informes de la cantidad de turnos que tomaron los empaques en un rango de fechas, entre otras informaciones.</p>
                    </div>
                </div>
                <div class="card card-review">
                    <a class="card-img" href="#!">
                        <img src="img/iconos/clipboard.png" alt="">
                        <div class="badge badge-danger"></div>
                    </a>
                    <div class="card-block">
                        <h4 class="card-title"><a href="#!">Configurable</a></h4>
                        <p>Otras opciones de configuración puede ser elegir el día y hora de la toma de turnos, pre-toma y repechaje.</p>
                    </div>
                </div>
                <div class="card card-review">
                    <a class="card-img" href="#!">
                        <img src="img/iconos/curriculum.png" alt="">
                        <div class="badge badge-danger"></div>
                    </a>
                    <div class="card-block">
                        <h4 class="card-title">
                            <a href="#!">Generador PDF</a>
                        </h4>
                        <p>Los empaques pueden generar un .pdf con los turnos que han sido tomados en la toma de turnos.</p>
                    </div>
                </div>
                <div class="card card-review">
                    <a class="card-img" href="#!">
                        <img src="img/iconos/user.png" alt="">
                        <div class="badge badge-success"></div>
                    </a>
                    <div class="card-block">
                        <h4 class="card-title"><a href="#!">Publicación</a></h4>
                        <p>Puedes publicar instantaneamente en un grupo de Facebook o de WhatsApp que estas regalando un turno.</p>
                    </div>
                </div>
                <div class="card card-review">
                    <a class="card-img" href="#!">
                        <img src="img/iconos/rapido.png" alt=""><!-- img/review/review-1.jpg -->
                        <div class="badge badge-success"></div>
                    </a>
                    <div class="card-block">
                        <h4 class="card-title"><a href="#!">Velocidad y Soporte</a></h4>
                        <p>Uno de los fuerte del sitio web es la velocidad a la hora de tomar turnos online y el soporte 24/7 que brindamos.</p>
                    </div>
                </div>
                <div class="card card-review">
                    <a class="card-img" href="#!">
                        <img src="img/iconos/tower.png" alt="">
                        <div class="badge badge-warning"></div>
                    </a>
                    <div class="card-block">
                        <h4 class="card-title"><a href="#!">Seguridad</a></h4>
                        <p>Proyecto Nero garantiza salvaguardar la información registrada de todos los empaques del sistema.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="">
        <div class="container">
            <div class="heading">
                <i class="fa fa-users"></i>
                <h2>Ideales </h2>
                <p>Tenemos la completa convicción que esta causa social está acabando poco a poco con el lucro y los abusos que se cometen a todos los empaques de Chile.</p>
            </div>
            <div class="row">


                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card card-lg border-primary">
                        <div class="card-img">
                            <a href="{{ url('tomar-turnos-online') }}"><img src="img/gallery/perfil-proyecto-nero.jpg" class="card-img-top" alt="toma-turnos-online"></a>
                            <div class="badge badge-danger">Toma</div>
                            <div class="card-likes">
                                <a href="#">15</a>
                            </div>
                        </div>
                        <div class="card-block">
                            <h4 class="card-title"><a href="{{ url('tomar-turnos-online') }}">Toma de turnos online</a></h4>
                            <div class="card-meta"><span></span></div>
                            <p class="card-text"><br>Si aún tienes dudas de elegir a Proyecto Nero como plataforma para la toma de turnos online. Acá podrás leer las ventajas que tiene nuestro sistema y que pone a disposición a todos los empaques de supermercados.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card card-lg border-primary">
                        <div class="card-img">
                            <a href="{{ url('sobre-nosotros') }}"><img src="img/gallery/mural-mapuche.jpg" class="card-img-top" alt="mural-mapuche"></a>
                            <div class="badge badge-warning">Nosotros</div>
                            <div class="card-likes">
                                <a href="#">15</a>
                            </div>
                        </div>
                        <div class="card-block">
                            <h4 class="card-title"><a href="{{ url('sobre-nosotros') }}">Conoce un poco más sobre Proyecto Nero</a></h4>
                            <div class="card-meta"><span> </span></div>
                            <p class="card-text text-justify">En este artículo se detallará quienes somos, el porqué nació Proyecto Nero y cuales son los ideales que intentamos inculcar a los empaques universitarios para hacer de este rubro un mejor trabajo.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card card-lg border-primary">
                        <div class="card-img">
                            <a href="{{ url('propineros-supermercados') }}"><img src="img/gallery/team.jpg" class="card-img-top" alt="img-frase"></a>
                            <div class="badge badge-primary">Empaques</div>
                            <div class="card-likes">
                                <a href="#">15</a>
                            </div>
                        </div>
                        <div class="card-block">
                            <h4 class="card-title"><a href="{{ url('propineros-supermercados') }}">Empaques de supermercados</a></h4>
                            <div class="card-meta"><span></span></div>
                            <p class="card-text text-justify"><br>Acá responderemos algunas de estas preguntas: ¿Qué es un empaque universitario?, ¿Cuales son las características de las organizaciones independientes? y ¿Por qué es necesario unificar a los empaques?.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>



    <section class="bg-secondary no-border-bottom">
        <div class="container">
            <div class="heading">
                <i class="fa fa-commenting"></i>
                <h2>Opiniones </h2>
                <p>En esta sección puedes leer algunas opiniones de los empaques universitarios que ocupan Proyecto Nero para la toma de turnos online. Si deseas ver más opiniones, <a href="https://www.facebook.com/pg/EmpaquesNero/reviews/" target="_blank"><u>pincha aquí</u></a>.</p>
            </div>
            <div class="row text-center">
                <div class="col-lg-3">
                    <figure class="figure">
                        <a href="#!"><img src="img/iconos/empaque-supermercado-1.png" alt="empaque-1"  class="rounded-circle"></a>
                    </figure>
                    <div class="p-t-30"></div>
                    <a href="#!"><h4><b>Isa M.</b></h4></a>
                    <p>Excelente plataforma , cumple a cabalidad con lo que se ofrece , comunicación muy fluida y de rápida solución con Soporte.</p>
                </div>
                <div class="col-lg-3">
                    <figure class="figure">
                        <a href="#!"><img src="img/iconos/empaque-supermercado-8.png" alt="empaque-8"  class="rounded-circle"></a>
                    </figure>
                    <div class="p-t-30"></div>
                    <a href="#!"><h4><b>Cristobal C.</b></h4></a>
                    <p>Gran plataforma y un apoyo increíble a todos los empaques estudiantes que hacemos esto. En fin esto es un proyecto social que se agradece!!</p>
                </div>
                <div class="col-lg-3">
                    <figure class="figure">
                        <a href="#!"><img src="img/iconos/empaque-supermercado-2.png" alt="empaque-2"  class="rounded-circle"></a>
                    </figure>
                    <div class="p-t-30"></div>
                    <a href="#!"><h4><b>Francisca L.</b></h4></a>
                    <p>Super conforme con la página proyecto Nero , comprometidos con todos los estudiantes y lo más importante sin fines de lucro !!!! Rápida y eficaz a la hora de tomar turnos.</p>
                </div>
                <div class="col-lg-3">
                    <figure class="figure">
                        <a href="#!"><img src="img/iconos/empaque-supermercado-4.png" alt="empaque-4"  class="rounded-circle"></a>
                    </figure>
                    <div class="p-t-30"></div>
                    <a href="#!"><h4><b>Alejandra G.</b></h4></a>
                    <p>Lejos el mejor sitio web para la toma turnos online. Nosotros nos emancipamos de organiza-t que nos cobraban 3600.</p>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-lg-3">
                    <figure class="figure">
                        <a href="#!"><img src="img/iconos/empaque-supermercado-5.png" alt="empaque-5"  class="rounded-circle"></a>
                    </figure>
                    <div class="p-t-30"></div>
                    <a href="#!"><h4><b>Yessica N.</b></h4></a>
                    <p>Excelente organización!!! el cobro que realizan es razonable para los empaques, recomiendo 100%.</p>
                </div>
                <div class="col-lg-3">
                    <figure class="figure">
                        <a href="#!"><img src="img/iconos/empaque-supermercado-6.png" alt="empaque-6"  class="rounded-circle"></a>
                    </figure>
                    <div class="p-t-30"></div>
                    <a href="#!"><h4><b>Miguel C.</b></h4></a>
                    <p>Muy buena página, rápida y sencilla. De gran ayuda. Se agradece la buena gestión y el desinterés.</p>
                </div>
                <div class="col-lg-3">
                    <figure class="figure">
                        <a href="#!"><img src="img/iconos/empaque-supermercado-7.png" alt="empaque-7"  class="rounded-circle"></a>
                    </figure>
                    <div class="p-t-30"></div>
                    <a href="#!"><h4><b>Camilo V.</b></h4></a>
                    <p>Buena la página, hemos probado varias plataformas y esta es lejos la mejor de todas! recomendable.</p>
                </div>
                <div class="col-lg-3">
                    <figure class="figure">
                        <a href="#!"><img src="img/iconos/empaque-supermercado-3.png" alt="empaque-3"  class="rounded-circle"></a>
                    </figure>
                    <div class="p-t-30"></div>
                    <a href="#!"><h4><b>Tomás S.</b></h4></a>
                    <p>Página simple para poder tomar turnos y rápida en cuanto a que no se cae como otras páginas, lo cual siempre se agradece a la hora de tomar turnos. Buena interfaz, buena plataforma, todo lo que se necesita a la hora de poder tomar turnos!.</p>
                </div>
            </div>
        </div>
    </section>

@endsection


@section('js')
    <script src="{{ asset('plugins/easypiechart/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('plugins/easypiechart/jquery.easypiechart.min.js') }}"></script>
    <script>
        (function($) {
            "use strict";
            // easyPieChart
            $('.chart').easyPieChart({
                barColor: '#5eb404',
                trackColor: '#e3e3e3',
                easing: 'easeOutBounce',
                onStep: function(from, to, percent) {
                    $(this.el).find('span').text(Math.round(percent));
                }
            });

            // lightbox
            /*
            $('[data-lightbox]').lightbox({
                disqus: 'gameforestyakuzieu'
            });
            */
        })(jQuery);
    </script>
    <!-- Google Universal Analytics -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-34775412-1', 'auto');
        ga('send', 'pageview');

    </script>
@endsection