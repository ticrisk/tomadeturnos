@extends('layouts.global-nero')

<!--MetaTags html Basic-->
@section('title', '- Alianza del Rubro de Empaques de Supermercados')
@section('description', 'Aliados que apoyan y colaboran la gestión de Proyecto Nero para poder seguir realizando las toma de turnos.')
@section('keywords', 'Colaboradores, servicios, Toma, Turnos, Empaques, Propineros, Supermercados, Chile')

<!--MetaTags Facebook-->
@section('urlFB', 'https://www.proyectonero.cl/alianzas')
@section('typeFB', 'website')
@section('titleFB', '- Alianza del Rubro de Empaques de Supermercados')
@section('descriptionFB', 'Aliados que apoyan y colaboran la gestión de Proyecto Nero para poder seguir realizando las toma de turnos.')
@section('imageFB', 'https://www.proyectonero.cl/img/fb-nero.jpg')

<!--MetaTags Twitter-->
@section('titleTW', '- Alianza del Rubro de Empaques de Supermercados')
@section('descriptionTW', 'Aliados que apoyan y colaboran la gestión de Proyecto Nero para poder seguir realizando las toma de turnos')
@section('imageTW', 'https://www.proyectonero.cl/img/fb-nero.jpg')

@section('content')

<section>
    <div class="container">
        <div class="heading">
            <i class="fa fa-home"></i>
            <h2>Alianzas</h2>
            <p>Aliados que apoyan y colaboran la gestión de Proyecto Nero para seguir brindando el mejor de los servicios a todos los propineros de Chile.</p>
        </div>
        <div class="row row-5 text-center">
            <div class="col-12 col-sm-6 col-md-4">
                <figure class="figure">
                    <a href="https://www.facebook.com/Lo-que-callamos-los-empaques-1550926968495524/" target="_blank"><img src="img/fb-nero.jpg" alt="Lo que callamos los empaques"  class="rounded-circle" id="img" onmouseover="img.src='img/facebook200x200.png'" onmouseout="img.src='img/fb-nero.jpg';"></a>
                </figure>
                <div class="p-t-30"></div>
                <a href="https://www.facebook.com/Lo-que-callamos-los-empaques-1550926968495524/" target="_blank"><h4><b>Lo que callamos los empaques</b></h4></a>
                <p>FanPage relacionado con el rubro de empaque de supermercados. Apoya las buenas relaciones laborales en un ambiente de justicia y transparencia. Sube imágenes divertidas e injusticias que se realizan a los empaques en diferentes supermercados. </p>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <figure class="figure">
                    <a href="http://www.ticrisk.com" target="_blank"><img src="img/logo-ticrisk.png" alt="TicRisk.com"  class="rounded-circle" id="img2" onmouseover="img2.src='img/point200x200.png'" onmouseout="img2.src='img/logo-ticrisk.png';"></a>
                </figure>
                <div class="p-t-30"></div>
                <a href="http://www.ticrisk.com" target="_blank"><h4><b>TicRisk</b></h4></a>
                <p>Empresa consultora especializada en la tecnología de la información; dedicada al desarrollo de software, web, seguridad TI, inteligencia de negocio, emprendimiento e innovación. Especialmente en sistemas de calendarización de toma de turnos.</p>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <figure class="figure">
                    <a href="https://www.facebook.com/esdeempaquees/" target="_blank"><img src="img/fb-nero.jpg" alt="Es de Empaques"  class="rounded-circle" id="img3" onmouseover="img3.src='img/facebook200x200.png'" onmouseout="img3.src='img/fb-nero.jpg';"></a>
                </figure>
                <div class="p-t-30"></div>
                <a href="https://www.facebook.com/esdeempaquees/" target="_blank"><h4><b>Es de Empaques</b></h4></a>
                <p>Otro FanPage dedicado al gran labor que cumple los empaques de supermercados. Básicamente sube imágenes graciosas sobre el día a día de los empaques o anécdotas que pasan en los supermercados. Cabe recalcar, que fue el primer FanPage en apoyar a Proyecto Nero en sus inicios.  </p>
            </div>
        </div>
        <!--<div class="text-center"><a href="videos.html" class="btn btn-primary btn-shadow btn-rounded btn-effect btn-lg m-t-20">Show More</a></div>-->
    </div>
</section>

@endsection



@section('js')


@endsection


