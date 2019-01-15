@extends('layouts.global-externo')

<!--MetaTags html Basic-->
@section('title', '- Contacto - Página Para Tomar Turnos - Empaques Supermercados - Propineros Universitarios')
@section('description', 'Contacto de Proyecto Nero. Nuestro sitio web donde las organizaciones independiente de empaques universitarios pueden tomar turnos on-line para trabajar en sus respectivos supermercados.')
@section('keywords', 'Contacto, precio, Toma, Turnos, Empaques, Propineros, Supermercados, Chile')

<!--MetaTags Facebook-->
@section('urlFB', 'https://www.proyectonero.cl/contacto')
@section('typeFB', 'website')
@section('titleFB', 'Contacto Proyecto Nero - Plataforma Para Tomar Turnos On-line')
@section('descriptionFB', 'Contacto Proyecto Nero. Nuestro sitio web donde las organizaciones independiente de empaques universitarios pueden tomar turnos on-line para trabajar en sus respectivos supermercados.')
@section('imageFB', 'https://www.proyectonero.cl/img/fb-nero.jpg')

<!--MetaTags Twitter-->
@section('titleTW', 'Contacto Proyecto Nero - Plataforma Para Tomar Turnos On-line')
@section('descriptionTW', 'Contacto Proyecto Nero. Nuestro sitio web donde las organizaciones independiente de empaques universitarios pueden tomar turnos on-line para trabajar en sus respectivos supermercados.')
@section('imageTW', 'https://www.proyectonero.cl/img/fb-nero.jpg')

@section('content')
<section>
    <div class="container">

        <h3 class="text-center">Contacto</h3>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Enviar E-mail</h5>
            </div>
            <div class="card-body">
                <b class="text-center">@include('incluir/mensajes')</b>
                {{--   {!! Form::open(['url' => 'HomeController@store', 'method' => 'POST']) !!} --}}
                {!! Form::open(['action' => 'HomeController@store', 'method' => 'POST']) !!}



                <div class="row form-group">
                                <label class="col-lg-2">Nombre</label>
                                <div class="col-lg-10">
                                    {!! Form::text('nombre', null, ['class'=>'form-control','placeholder'=>'Nombre Obligatorio', 'required']) !!}
                                </div>
                            </div>  

                            <div class="row form-group">
                                <label class="col-lg-2">E-mail</label>
                                <div class="col-lg-10">
                                    {!! Form::text('email', null, ['class'=>'form-control','placeholder'=>'E-mail Obligatorio', 'required']) !!}
                                </div>
                            </div>  

                            <div class="row form-group">
                                <label class="col-lg-2">Cant. Empaques</label>
                                <div class="col-lg-10">
                                    {!! Form::text('cantidad', null, ['class'=>'form-control','placeholder'=>'Cant. de Empaques']) !!}
                                </div>
                            </div>                              


                            <div class="row form-group">
                                <label class="col-lg-2">Mensaje</label>
                                <div class="col-lg-10">
                                    {!! Form::textarea('mensaje', null, ['class'=>'form-control', 'placeholder'=>'Mensaje Obligatorio','required']) !!}
                                </div>
                            </div>  

                            <div class="row form-group">
                              <div class="col-lg-12">
                                    <center>{!! Recaptcha::render() !!}</center>
                              </div>
                            </div>

                            <div class="row form-group">
                              <div class="col-lg-12 text-center">
                                {!! Form::submit('Enviar', ['class'=>'btn btn-sm btn-success']) !!}
                              </div>
                            </div>
                         
                          {!! Form::close() !!}

                          </div>                          
                          
                           
                        
                    </div>
                  </div>
</section>
@endsection



@section('js')


@endsection

