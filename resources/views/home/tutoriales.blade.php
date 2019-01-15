@extends('layouts.global-nero')

<!--MetaTags html Basic-->
@section('title', '- Tutoriales para la gestión de empaques en los supermercados de Chile')
@section('description', 'Vídeos tutoriales para la configuración de la toma de turnos, planilla, postulaciones, local, empaques del supermercado y mucho más.')
@section('keywords', 'Vídeos, Tutoriales, Toma, Turnos, Empaques, Propineros, Supermercados, Chile')

<!--MetaTags Facebook-->
@section('urlFB', 'https://www.proyectonero.cl/tutoriales')
@section('typeFB', 'website')
@section('titleFB', 'Tutoriales para la gestión de empaques en los supermercados de Chile')
@section('descriptionFB', 'Vídeos tutoriales para la configuración de la toma de turnos, planilla, postulaciones, local, empaques del supermercado y mucho más.')
@section('imageFB', 'https://www.proyectonero.cl/img/fb-nero.jpg')

<!--MetaTags Twitter-->
@section('titleTW', 'Tutoriales para la gestión de empaques en los supermercados de Chile')
@section('descriptionTW', 'Vídeos tutoriales para la configuración de la toma de turnos, planilla, postulaciones, local, empaques del supermercado y mucho más.')
@section('imageTW', 'https://www.proyectonero.cl/img/fb-nero.jpg')

@section('content')


    <section>
        <div class="container">
            <div class="heading">
                <i class="fa fa-youtube-play"></i>
                <h2>Tutoriales</h2>
                <p>Vídeos tutoriales para la configuración de la toma de turnos, planilla, postulaciones, local, empaques del supermercado y mucho más.</p>
            </div>
            <div class="row row-5">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card card-video">
                        <div class="card-img">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/TzVLinUxhYE"></iframe>
                            </div>
                            <div class="card-meta">
                                <span>6:11</span>
                            </div>
                        </div>
                        <div class="card-block">
                            <h4 class="card-title"><a href="#!">Toma de Turnos On-line</a></h4>
                            <div class="card-meta">
                                <span><i class="fa fa-clock-o"></i> 14 dic. 2016</span>
                                <span>Versión 4.1.2 </span>
                            </div>
                            <p class="text-justify">EL sistema de toma de turnos online consiste en que cada empaque se conecta a la hora que se abrirá la planilla para poder tomar turnos. El empaque tiene que apretar el boton que dice "Tomar" para asegurarse con unos de los cupos disponible.</p>
                            <p class="text-justify">Es recomendable realizar la toma de turnos online, ya que es transparente, justa, rápida, simple y disminuye considerablemente la pérdida de tiempo de los empaques y del encargado.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card card-video">
                        <div class="card-img">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/k8gL23kh-BM"></iframe>
                            </div>
                            <div class="card-meta">
                                <span>2:49</span>
                            </div>
                        </div>
                        <div class="card-block">
                            <h4 class="card-title"><a href="#!">Postulación Para Trabajar</a></h4>
                            <div class="card-meta">
                                <span><i class="fa fa-clock-o"></i> 13 jun. 2017</span>
                                <span>Versión 4.1.2 </span>
                            </div>
                            <p class="text-justify">Existen 3 tipos de postulaciones en la que puede participar una persona que desea trabajar como empaque. La primera es una postulación pública en la cual participan todos los registrados en la página.
                                La segunda es una privada donde participan las personas que tienen un código entregado por el encargado del local, el aspirante tiene que tomar el cupo disponible para ser empaque.
                                Por último, esta la postulación al azar donde también es una lista privada pero el aspirante no participa en la toma y la plataforma realiza el sorteo al azar.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card card-video">
                        <div class="card-img">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/UZEVT7dHYsI"></iframe>
                            </div>
                            <div class="card-meta">
                                <span>4:59</span>
                            </div>
                        </div>
                        <div class="card-block">
                            <h4 class="card-title"><a href="#!">Agregar Empaque</a></h4>
                            <div class="card-meta">
                                <span><i class="fa fa-clock-o"></i> 14 dic. 2016</span>
                                <span>Versión 4.1.2 </span>
                            </div>
                            <p class="text-justify">Existen dos formas de agregar empaques al local. Una es ingresando el rut de la persona registrada en la plataforma de Proyecto Nero y la otra forma es entregando un código al postulante, el cual
                                lo tiene que ingresar en la opción "Vincularme" y se asignará automáticamente al local con el rol de "Empaque".</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card card-video">
                        <div class="card-img">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/F_C7ZNRuanY"></iframe>
                            </div>
                            <div class="card-meta">
                                <span>5:11</span>
                            </div>
                        </div>
                        <div class="card-block">
                            <h4 class="card-title"><a href="#!">Configurar Planilla</a></h4>
                            <div class="card-meta">
                                <span><i class="fa fa-clock-o"></i> 14 dic. 2016</span>
                                <span>Versión 4.1.2 </span>
                            </div>
                            <p class="text-justify">En este vídeo se puede apreciar como configurar la planilla (Día y hora para la pre-toma, toma de turnos, repechaje, entre otras opciones) y la asignación de turnos para coordinadores. Pueden ver las distintas opciones de configuración desde <a href="tarifas"> <b><i>acá</i></b>.</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="text-center"><a href="videos.html" class="btn btn-primary btn-shadow btn-rounded btn-effect btn-lg m-t-20">Show More</a></div>-->
        </div>
    </section>
@endsection



@section('js')


@endsection


