@extends('layouts.global-externo')


@section('title', '- Supermercados Asociados - Empaques Universitarios - Propineros')
@section('description', 'Supermercados asociados que utilizan semanalmente la plataforma de Proyecto Nero para la toma de turno online.')
@section('keywords', 'Supermercados, Toma, Turnos, Empaques, Propineros, Organizaciones, Empresas')

<!--MetaTags Facebook-->
@section('urlFB', 'https://www.proyectonero.cl/local')
@section('typeFB', 'website')
@section('titleFB', 'Proyecto Nero - Supermercados Asociados')
@section('descriptionFB', 'Supermercados asociados que utilizan semanalmente la plataforma de Proyecto Nero para la toma de turno online.')
@section('imageFB', 'https://www.proyectonero.cl/img/fb-nero.jpg')

<!--MetaTags Twitter-->
@section('titleTW', 'Proyecto Nero - Supermercados Asociados')
@section('descriptionTW', 'Supermercados asociados que utilizan semanalmente la plataforma de Proyecto Nero para la toma de turno online.')
@section('imageTW', 'https://www.proyectonero.cl/img/fb-nero.jpg')


@section('content')

<section>
  <div class="container">

    <h5 class="text-center">Locales</h5>
      <p class="m-b-25 text-center">Listado de locales </p>

    <div class="card card-primary">
      <div class="card-header">
        <h5 class="card-title">Locales Asociados</h5>
      </div>
      <div class="card-body">
        <b class="text-center">@include('incluir/mensajes')</b>
                          
                            <div class="row hidden-sm-down">
                              
                              <label class="col-md-2 col-lg-2">Cadena</label>
                              <label class="col-md-2 col-lg-2">Nombre</label>
                              <label class="col-md-2 col-lg-2">Estado</label>
                              <label class="col-md-2 col-lg-2">Organización</label>
                              <label class="col-md-4 col-lg-4">Dirección</label>
                            </div>
                            <hr class="hidden-sm-down">

                          @foreach($locales as $local)

                            <div class="row">
                              
                              <label class="col-6 hidden-md-up">Cadena</label>
                              <div class="col-6 col-md-2 col-lg-2"> {{ $local->Cadena->nombre }} </div>

                              <label class="col-6 hidden-md-up">Local</label>
                              <div class="col-6 col-md-2 col-lg-2"> {{ $local->nombre }} </div>

                              <label class="col-6 hidden-md-up">Estado</label>
                              <div class="col-6 col-md-2 col-lg-2"> {{ $local->estado }} </div>

                              <label class="col-6 hidden-md-up">Organización</label>
                              <div class="col-6 col-md-2 col-lg-2"> {{ $local->Organizacion->nombre }} </div>

                              <label class="col-6 hidden-md-up">Dirección</label>
                              <div class="col-6 col-md-4 col-lg-4"> {{ $local->direccion }} </div>

                            </div>
                            <hr>
                          @endforeach              
                          
                          
                    </div>
                  </div>
                </div>
</section>
@endsection



@section('js')


@endsection


