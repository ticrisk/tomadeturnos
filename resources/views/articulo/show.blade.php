@extends('layouts.global-externo')

<!--MetaTags html Basic-->
@section('title', '- '.$art->titulo.' - Noticias Empaques Propineros Supermercados')
@section('description', $art->descripcion)
@section('keywords', 'Artículo, Noticia, Empaques, Propineros, Supermercado, Chile')

<!--MetaTags Facebook-->
@section('urlFB', 'https://www.proyectonero.cl/blog/'.$art->link)
@section('typeFB', 'website')
@section('titleFB', $art->titulo)
@section('descriptionFB', $art->descripcion)
@section('imageFB', 'https://www.proyectonero.cl/img/articulos/'.$art->imgDescripcion)

<!--MetaTags Twitter-->
@section('titleTW', $art->titulo)
@section('descriptionTW', $art->descripcion)
@section('imageTW', 'https://www.proyectonero.cl/img/articulos/'.$art->imgDescripcion)

@section('content')
  <section>
    <div class="container">
      <div class="row">
        <div class="col-lg-9">
          <!-- post -->
          <div class="post post-single">
            <h2 class="post-title text-center">{{ $art->titulo }}</h2>
            <div class="post-meta text-center">
              <span><i class="fa fa-calendar"></i> {{ date('d-m-Y', strtotime($art->updated_at)) }}</span>
              <span><a href="#"><i class="fa fa-book"></i> Artículo</a></span>
              <span><a href="#"> <i class="fa fa-pencil"></i> Nero</a></span>
            </div>
            <div class="post-thumbnail">
              <img src="{{ asset('img/articulos/'.$art->portada) }}" alt="{{ $art->titulo }}">
            </div>
            <h5>{{ $art->titulo }}</h5>
            <p>{!! $art->texto !!}</p>
            <blockquote class="blockquote alert-info">
              <p class="text-primary">“En <a href="http://www.ticrisk.com" target="_blank"><i><u>TicRisk.com</u></i></a> te podemos ayudar a tener tu propio sitio web”.</p>
            </blockquote>
            <p>{!! $art->texto2 !!}</p>

            <!--<div class="line line-lg b-b b-light"></div>-->
            <div class="text-muted text-center">
              <div class="fb-like" data-href="https://www.proyectonero.cl/blog/{{ $art->link }}" data-layout="button" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>
              <div class="fb-share-button" data-href="https://www.proyectonero.cl/blog/{{ $art->link }}" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Compartir</a></div>

            </div>



            <!--Caja de comentarios -->
            <div id="disqus_thread"></div>


          </div>
        </div>

        <!-- sidebar -->
        <div class="col-lg-3">
          <div class="sidebar">

            <!-- widget post  -->
            <div class="widget widget-post">
              <h5 class="widget-title">Otros Artículos</h5>
              @foreach($ultimos as $ultimo)
                <a href="{{ $ultimo->link }}"><img src="../img/articulos/{{ $ultimo->imgDescripcion }}" alt="img"></a>
                <h4><a href="{{ $ultimo->link }}">{{ $ultimo->titulo }}</a></h4>
                <span><i class="fa fa-calendar"></i> {{ date('d-m-Y', strtotime($ultimo->updated_at)) }}</span>
                <hr>
              @endforeach
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>


@endsection



@section('js')
<!-- Script de Facebook -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.8&appId=164988353976260";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- Fin Script de Facebook -->

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


