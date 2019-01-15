@extends('layouts.global-externo')

<!--MetaTags html Basic-->
@section('title', '- Tarifa Mensual Para Tomar Turnos Online - Empaques Supermercados - Propineros Universitarios')
@section('description', 'Precio mensual para tomar turnos online. Ofrecemos una versión gratuita para las organizaciones independientes de empaques universitarios.')
@section('keywords', 'Tarifas, precio, Toma, Turnos, Empaques, Propineros, Supermercados, Plataforma, Gratis')

<!--MetaTags Facebook-->
@section('urlFB', 'https://www.proyectonero.cl/tarifas')
@section('typeFB', 'website')
@section('titleFB', 'Proyecto Nero - Tarifa Mensual Para Tomar Turnos OnLine')
@section('descriptionFB', 'Precio mensual para tomar turnos online. Ofrecemos una versión gratuita para las organizaciones independientes de empaques universitarios.')
@section('imageFB', 'https://www.proyectonero.cl/img/fb-nero.jpg')

<!--MetaTags Twitter-->
@section('titleTW', 'Proyecto Nero - Tarifa Mensual Para Tomar Turnos OnLine')
@section('descriptionTW', 'Precio mensual para tomar turnos online. Ofrecemos una versión gratuita para las organizaciones independientes de empaques universitarios.')
@section('imageTW', 'https://www.proyectonero.cl/img/fb-nero.jpg')

@section('content')

<section>
  <div class="container">

    <div class="heading">
      <i class="fa fa-dollar"></i>
      <h2>Tarifas</h2>
      <p>Infórmate sobra las diferencias y ventajas que tienen nuestras versiones gratuita, premium o web personalizada. Usa la que más se adecúe a las necesidades de tu local.</p>
    </div>


    <div class="row m-t-30">
      <div class="col-lg-3">
        <div class="card card-lg">
          <div class="card-img">
            <div class="p-3 mb-2 bg-info rounded-top"><br>
              <p class="h3 text-center text-dark font-italic">Free</p>
              <p class="text-center">
                <small class="h4 text-dark">$</small>
                <span class="h1 text-dark font-italic">0</span>
                <small class="h5 text-dark"> /clp</small>
              </p>
              <br><br>
            </div>
            <div class="badge bg-dark badge-xbox-one">Gratuita</div>
            <div class="card-likes">
              <i class="fa fa-heart text-white"></i>
            </div>
          </div>
          <div class="card-block">
            <h4 class="card-title m-b-10"><a href="#">Versión Gratuita</a></h4>
            <!--<div class="card-meta"><span>June 13, 2017</span></div>-->

            <ul>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> 100% Gratuita
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> 1 Mes gratis de Premium
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Toma de turnos (4 turnos máximo)
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Repechaje (10 turnos máximo)
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Elegir día y hora para tomar turnos
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Configurar los turnos y cupos por planilla
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Ver planillas (turnos tomados)
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Sin límites de empaques
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Capacitación inicial
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Administración básica por parte del encargado
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Administración de varios locales desde una misma cuenta
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Soporte 24/7
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Actualizaciones constante
              </li>
              <li class="m-b-10">
                 <i class="fa fa-close text-danger"></i> Máximo un encargado
              </li>
              <li class="m-b-10">
                <i class="fa fa-close text-danger"></i> Solo para organización sin fines de lucro
              </li>
            </ul>
            <hr>
            <center><a class="btn btn-primary" href="{{ url('solicitar-demo') }}" role="button">Contacto <i class="fa fa-envelope"></i></a></center>
          </div>

        </div>
      </div>

      <div class="col-lg-3">
        <div class="card card-lg">
          <div class="card-img">
            {{-- <a href="#"><img src="{{ url('img/costo-premium.png') }}" class="card-img-top" alt="version premium"></a>--}}
              <div class="p-3 mb-2 bg-warning rounded-top"><br>
                <p class="h3 text-center text-dark font-italic">Premium</p>
                <p class="text-center">
                  <small class="h4 text-dark">$</small>
                  <span class="h1 text-dark font-italic">600</span>
                  <small class="h5 text-dark"> /clp</small>
                </p>
                <br><br>
              </div>
            <div class="badge bg-dark badge-xbox-one">Premium</div>
            <div class="card-likes">
              <i class="fa fa-line-chart text-white"></i>
            </div>
          </div>
          <div class="card-block">
            <h4 class="card-title m-b-10"><a href="#">Versión Premium</a></h4>
            <!--<div class="card-meta"><span>June 13, 2017</span></div>-->
            <ul>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> 1 Mes de prueba gratis
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Pre-toma, toma y repechaje de turnos
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Regalar, cambiar y ceder turnos
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Elegir día y hora para tomar turnos
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Configurar los turnos y cupos por planilla
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Asignar la cantidad de turnos que puede tomar cada empaque
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Asignar turno semanal o fijo a coordinadores y empaques
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Eliminar turno tomado, toma completa o planilla
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Sin límites de empaques
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Asignación de roles: Empaque, coordinadores y encargados (Sin límites)
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Agregar, bloquear, castigar o eliminar empaques
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Gestión de faltas por empaque
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Estadísticas, noticias y alertas personalizadas
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Generar PDF de las toma de turnos, estadísticas y cantidad de turnos tomados.
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Generar postulaciones públicas, privadas o al azar.
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Otras características de gestión del local
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Todas las opciones son 100% configurable de acuerdo a los requerimientos del local
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Capacitación inicial
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Administración completa por parte del encargado
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Administración de varios locales desde una misma cuenta
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Soporte 24/7
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Actualizaciones constante
              </li>
              <li class="m-b-10">
                <i class="fa fa-close text-danger"></i> Valor desde $600 CLP
              </li>
              <li class="m-b-10">
                <i class="fa fa-close text-danger"></i> Pago Mensual por empaque solo si toma turnos, repechaje, pre-toma, asignados, cambios, regalos o cedidos.
              </li>
            </ul>
            <hr>
            <center><a class="btn btn-primary" href="{{ url('solicitar-demo') }}" role="button">Contacto <i class="fa fa-envelope"></i></a></center>
          </div>
        </div>
      </div>

      <div class="col-lg-3">
        <div class="card card-lg">
          <div class="card-img">
            <div class="p-3 mb-2 bg-success rounded-top"><br>
              <p class="h3 text-center text-dark font-italic">Web Propia</p>
              <p class="text-center">
                <small class="h4 text-dark">$</small>
                <span class="h1 text-dark font-italic">700</span>
                <small class="h5 text-dark"> /clp</small>
              </p>
              <br><br>
            </div>
            <div class="badge bg-dark badge-xbox-one">Web Propia</div>
            <div class="card-likes">
              <i class="fa fa-globe text-white"></i>
              <!--<a href="#"><i class="fa fa-globe"></i></a>-->
            </div>
          </div>
          <div class="card-block">
            <h4 class="card-title m-b-10"><a href="#">Web Personalizada</a></h4>
            <!--<div class="card-meta"><span>June 13, 2017</span></div>-->
            <ul>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> 1 mes de prueba gratis
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Versión Premium
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Dominio gratis ej: empaque.cl
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Externo a Proyecto Nero
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Capacitación inicial
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Administración completa por parte del encargado
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Administración de varios locales desde una misma cuenta
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Soporte 24/7
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Actualizaciones constante
              </li>
              <li class="m-b-10">
                <i class="fa fa-close text-danger"></i> Valor desde $700 CLP
              </li>
              <li class="m-b-10">
                <i class="fa fa-close text-danger"></i> Pago Mensual por empaque solo si toma turnos, repechaje, pre-toma, asignados, cambios, regalos o cedidos.
              </li>
            </ul>
            <hr>
            <center><a class="btn btn-primary" href="{{ url('solicitar-demo') }}" role="button">Contacto <i class="fa fa-envelope"></i></a></center>
          </div>
        </div>
      </div>

      <div class="col-lg-3">
        <div class="card card-lg">
          <div class="card-img">
            <div class="p-3 mb-2 bg-primary rounded-top"><br>
              <p class="h3 text-center text-dark font-italic">Supermercados</p>
              <p class="text-center">
                <small class="h4 text-dark">$</small>
                <span class="h1 text-dark font-italic">¿?</span>
                <small class="h5 text-dark"> /clp</small>
              </p>
              <br><br>
            </div>
            <div class="badge bg-dark badge-xbox-one">Supermercados</div>
            <div class="card-likes">
              <i class="fa fa-flag text-white"></i>
            </div>
          </div>
          <div class="card-block">
            <h4 class="card-title m-b-10"><a href="#">Gestión Nero</a></h4>
            <!--<div class="card-meta"><span>June 13, 2017</span></div>-->
            <ul>
              <li class="m-b-10">
                <i class="fa fa-question-circle text-success"></i> ¿Eres un supermercado y necesitas servicios de empaques universitarios?
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Contamos con propineros responsables
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Proyecto Nero trabaja bajos los ideales de igualdad, libre opinión, sin lucro ni abusos
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Experiencia en el rubro
              </li>

              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> El administrador del supermercado obtendrá una cuenta donde puede visualizar semanalmente la planilla de turnos
              </li>
              <li class="m-b-10">
                <i class="fa fa-check text-success"></i> Constante comunicación
              </li>
            </ul>
            <hr>
            <center><a class="btn btn-primary" href="{{ url('solicitar-demo') }}" role="button">Contacto <i class="fa fa-envelope"></i></a></center>
          </div>
        </div>
      </div>

    </div>

  </div>

</section>





@endsection



@section('js')

@endsection


