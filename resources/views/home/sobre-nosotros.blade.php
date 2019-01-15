@extends('layouts.global-nero')

<!--MetaTags html Basic-->
@section('title', '- ¿Quiénes somos, qué buscamos y por qué surgió?  - Empaques Supermercados - Propineros Universitarios')
@section('description', '¿Quiénes somos, qué buscamos y por qué surgió?. Proyecto Nero permite a las organizaciones independiente de empaques universitarios pueden tomar turnos on-line para trabajar en sus respectivos supermercados.')
@section('keywords', 'nosotros, misión, visión, ideales, Empaques, Propineros, Supermercados, Chile')

<!--MetaTags Facebook-->
@section('urlFB', 'https://www.proyectonero.cl/sobre-nosotros')
@section('typeFB', 'website')
@section('titleFB', '¿Quiénes somos, qué buscamos y por qué surgió? - Plataforma Para Tomar Turnos On-line')
@section('descriptionFB', '¿Quiénes somos, qué buscamos y por qué surgió?. Proyecto Nero permite a las organizaciones independiente de empaques universitarios pueden tomar turnos on-line para trabajar en sus respectivos supermercados.')
@section('imageFB', 'https://www.proyectonero.cl/img/fb-nero.jpg')

<!--MetaTags Twitter-->
@section('titleTW', 'Proyecto Nero - Plataforma Para Tomar Turnos On-line')
@section('descriptionTW', '¿Quiénes somos, qué buscamos y por qué surgió?. Proyecto Nero permite a las organizaciones independiente de empaques universitarios pueden tomar turnos on-line para trabajar en sus respectivos supermercados.')
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
                        <h2 class="post-title">Conoce un poco más sobre Proyecto Nero</h2>
                        <div class="post-meta">
                            <span><i class="fa fa-user"></i> <a href="#!">Proyecto Nero</a></span>
                            <span><a href="#!"><i class="fa fa-comment-o"></i> Seamos como los mapuches, rebeldes e indomables.</a></span>
                        </div>
                        <div class="post-thumbnail">
                            <img src="img/gallery/mural-mapuche.jpg" alt="mural-mapuche">
                        </div>
                        <h5>¿Quiénes somos?</h5>
                        <p class="text-justify">Somos una organización sin fines de lucro que presta servicios a los empaques universitarios para que puedan tomar turnos on-line y de esta manera asistir a trabajar en los días y horas convenientes para cada empaque, así evitando a las organizaciones independientes reservar sus turnos mediante facebook, e-mail o presencial.</p>
                        <p class="text-justify">Proyecto Nero facilita una mayor rápidez, transparencia, eficiencia y mayor organización en la toma de turnos semanal entre los empaques de los supermercados.</p>
                        <blockquote class="blockquote alert-info">
                            <p><i>"Si eres neutral en situaciones de injusticias, has elegido el lado del opresor".</i> <small class="pull-right">Desmond Tutu</small></p>
                        </blockquote>

                        <h5>¿Qué buscamos?</h5>
                        <p class="text-justify">Buscamos la confianza y seguridad de los jóvenes al hacer uso de las herramientas que proporciona este sitio web, facilitando los tiempos en la toma de turnos de una manera precisa, clara y organizada a los empaques.
                           <br>Buscamos el despertar de los propineros para que no sean manipulados sicológicamente por empresas que buscan interés económico a costa de la necesidad de los jóvenes estudiantes por trabajar.</p>
                        <p class="text-justify">Ayudar a las organizaciones independientes a ser autónomas y prestar el servicio que Proyecto Nero ofrece en la toma de turnos on-line como también la administración de ésta.
                            <br>Proyecto Nero no se involucra en las decisiones de las organizaciones independientes pero si recomienda seguir una serieS de normas para que exista un orden acorde al supermercado y así conservar el trabajo de empaque.</p>
                        <blockquote class="blockquote alert-info">
                            <p><i>"Cuando la dictadura es un hecho, la revolución es un derecho".</i> <small class="pull-right">Iósif Stalin</small></p>
                        </blockquote>

                        <h5>¿Por qué surgió?</h5>
                        <p class="text-justify">Proyecto Nero nació bajo los ideales de acabar con las empresas que lucran cobrando una cuota mensual excesiva por uso de sus respectivos sitios web. Además de eso, los empaques se ven obligados a comprar semestralmente las poleras y polerones que exigen dichas empresas capitalistas que abusan de las propinas de los empaques universitarios.</p>
                        <p class="text-justify">Por otra parte, no entregan ninguna garantía de trabajo fijo ya que no les importa "despedir" a los empaques porque tienen una lista extensa de personas que quieren trabajar en el mismo rubro. Es por esto, que Proyecto Nero se hace presente entregando las herramientas necesarias que le permitan liberarse del yugo de los empresarios que corta la libertad de expresión y el incentivo de superación de los estudiantes universitarios.</p>
                        <blockquote class="blockquote alert-info">
                            <p><i>"Si no somos nosotros, ¿entonces quién?. Si no es ahora, ¿entonces cuándo?".</i>  <small class="pull-right">Prem Rawat Maharaji</small></p>
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
                                <a href="#">#proyecto-nero</a>
                                <a href="#">#misión</a>
                                <a href="#">#visión</a>
                                <a href="#">#no+lucro</a>
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
