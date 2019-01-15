@extends('layouts.global-externo')

<!--MetaTags html Basic-->
@section('title', '- Supermercados de Chile  - Empaques Supermercados - Propineros Universitarios')
@section('description', 'Supermercados de Chile. Permite a las organizaciones independiente de empaques universitarios pueden tomar turnos on-line para trabajar en sus respectivos supermercados.')
@section('keywords', 'supermercados, locales, retail, Empaques, Propineros, Supermercados, Chile')

<!--MetaTags Facebook-->
@section('urlFB', 'https://www.proyectonero.cl/sobre-nosotros')
@section('typeFB', 'website')
@section('titleFB', 'Supermercados de Chile - Plataforma Para Tomar Turnos On-line')
@section('descriptionFB', 'Supermercados de Chile. Proyecto Nero permite a las organizaciones independiente de empaques universitarios pueden tomar turnos on-line para trabajar en sus respectivos supermercados.')
@section('imageFB', 'https://www.proyectonero.cl/img/fb-nero.jpg')

<!--MetaTags Twitter-->
@section('titleTW', 'Supermercados de Chile Proyecto Nero - Plataforma Para Tomar Turnos On-line')
@section('descriptionTW', 'Supermercados de Chile. Proyecto Nero permite a las organizaciones independiente de empaques universitarios pueden tomar turnos on-line para trabajar en sus respectivos supermercados.')
@section('imageTW', 'https://www.proyectonero.cl/img/fb-nero.jpg')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-1 hidden-md-down">
                    <!-- widget share -->
                    <div class="widget widget-share" data-fixed="widget">
                        <!--<div class="widget-block">-->
                        <!--<span>Compartir</span>-->

                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                            <a class="a2a_button_facebook"></a><div class="p-t-40"></div>
                            <a class="a2a_button_twitter"></a><div class="p-t-40"></div>
                            <a class="a2a_button_google_plus"></a><div class="p-t-40"></div>
                            <a class="a2a_button_linkedin"></a>
                        </div>
                        <!--</div>-->
                    </div>
                </div>
                <div class="col-lg-10">
                    <!-- post -->
                    <div class="post post-single">
                        <h2 class="post-title">Supermercados de Chile</h2>
                        <div class="post-meta">
                            <span><i class="fa fa-user"></i> <a href="#!">Proyecto Nero</a></span>
                            <span><a href="#!"><i class="fa fa-comment-o"></i> Las oportunidades pequeñas son el principio de las grandes empresas.</a></span>
                        </div>
                        <div class="post-thumbnail">
                            <img src="img/gallery/supermarket.jpg" alt="mural-mapuche">
                        </div>
                        <h5>Servicios de Proyecto Nero</h5>
                        <p class="text-justify">Proyecto Nero también ofrece servicios de gestión de empaquetadores. Desde la creación de este nuevo servicio, varios locales del retail se han comunicado con nosotros para encargarnos la misión de empacar los productos de los clientes y organizar a los empaques para que asistan a trabajar a sus correspondientes turnos.</p>
                        <p class="text-justify">No cabe duda, que han depositado la confianza en nosotros por los ideales de justicia, igualdad y libre expresión que hacemos valer dentro de la organización. En el cual nos preocupamos de cada empaquetador para que pueda cumplir su labor sin ningun problema. Otro motivo de preferencia por parte de los supermercados son las buenas recomendaciones de otros locales del retail.</p>
                        <blockquote class="blockquote alert-info">
                            <p><i>"La oportunidad para el éxito reside en la persona, no en el trabajo". </i> <small class="pull-right">Zig Ziglar</small></p>
                        </blockquote>

                        <h5>Ventajas para los Supermercados</h5>
                        <p>
                            <ul>
                                <li type="disc">Proyecto Nero organiza y ofrece el mejor servicio de calendario compartido.</li>
                                <li type="disc">El supermercado puede ver los horarios actualizados de los empaques universitarios.</li>
                                <li type="disc">El jefe de caja puede agregar y visualizar las faltas de los empaquetadores.</li>
                                <li type="disc">Reportes mensuales o trimestrales.</li>
                                <li type="disc">Comunicación y constantes cambios para mejorar el servicio.</li>
                                <li type="disc">Se controla la hora de llegada de los empaques mediante un sistema de asistencia.</li>
                            </ul>
                        </p>
                        <blockquote class="blockquote alert-info">
                            <p><i>"No soy producto de mis circunstancias. Soy producto de mis decisiones".</i>  <small class="pull-right">Stephen Covey</small></p>
                        </blockquote>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- AddToAny BEGIN text-right -->
                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                <a class="a2a_button_facebook"></a>
                                <a class="a2a_button_twitter"></a>
                                <a class="a2a_button_google_plus"></a>
                                <a class="a2a_button_linkedin"></a>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="hidden-md-up p-t-25"></div>
                            <!--<div class="post-actions">-->
                            <div class="post-tags">
                                <a href="#">#supermercados</a>
                                <a href="#">#chile</a>
                                <a href="#">#retail</a>
                                <a href="#">#servicios</a>
                            </div>
                        </div>
                    </div>
                    <div class="post-related p-t-30">
                        <h6 class="subtitle">Más sobre nosotros</h6>
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-widget">
                                    <div class="card-img">
                                        <a href="{{ url('sobre-nosotros') }}"><img src="img/gallery/mural-mapuche.jpg" alt="mural-mapuche"></a>
                                    </div>
                                    <div class="card-block">
                                        <h4 class="card-title"><a href="{{ url('sobre-nosotros') }}">Conoce un poco más sobre Proyecto Nero</a></h4>
                                        <div class="card-meta"><span></span></div>
                                        <p class="text-justify">En este artículo se detallará quienes somos, el porqué nació Proyecto Nero y cuales son los ideales que intentamos inculcar a los empaques universitarios para hacer de este rubro un mejor trabajo.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-widget">
                                    <div class="card-img">
                                        <a href="{{ url('tomar-turnos-online') }}"><img src="img/gallery/perfil-proyecto-nero.jpg" alt="tomar-turnos"></a>
                                    </div>
                                    <div class="card-block">
                                        <h4 class="card-title"><a href="{{ url('tomar-turnos-online') }}">Tomar turnos online</a></h4>
                                        <div class="card-meta"><span></span></div>
                                        <p class="text-justify">Si aún tienes dudas de elegir a Proyecto Nero como plataforma para la toma de turnos online. Acá podrás leer las ventajas que tiene nuestro sistema y que pone a disposición a todos los empaques de supermercados.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-widget">
                                    <div class="card-img">
                                        <a href="{{ url('propineros-supermercados') }}"><img src="img/gallery/team.jpg" alt="empaquetador"></a>
                                    </div>
                                    <div class="card-block">
                                        <h4 class="card-title"><a href="{{ url('propineros-supermercados') }}">Empaques de supermercados</a></h4>
                                        <div class="card-meta"><span></span></div>
                                        <p class="text-justify">Acá responderemos algunas de estas preguntas: ¿Qué es un empaque universitario?, ¿Cuales son las características de las organizaciones independientes? y ¿Por qué es necesario unificar a los empaques?.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-widget">
                                    <div class="card-img">
                                        <a href="{{ url('supermercados-chile') }}"><img src="img/gallery/supermarket.jpg" alt="supermercados-chile"></a>
                                    </div>
                                    <div class="card-block">
                                        <h4 class="card-title"><a href="{{ url('supermercados-chile') }}">Supermercados de Chile</a></h4>
                                        <div class="card-meta"><span></span></div>
                                        <p class="text-justify">¿Eres un supermercado y estas buscando una organización que gestione a los empaques del local?, Te cuento algunas de nuestras cualidades que nos hacen ser tu mejor alternativa.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div id="disqus_thread"></div>
                </div>
            </div>
        </div>
    </section>
@endsection



@section('js')
    <!-- Botones compartir -->
    <script async src="https://static.addtoany.com/menu/page.js"></script>

    <!-- Disqus -->
    <script>
        /**
         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
        /*
         var disqus_config = function () {
         this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
         this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
         };
         */
        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = 'https://proyecto-nero.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
@endsection

