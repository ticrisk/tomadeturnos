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

            <h3 class="text-center">Solicitar Demo</h3>

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Te enviaremos un e-mail</h5>
                </div>
                <div class="card-body">
                    <b class="text-center">@include('incluir/mensajes')</b>
                    {{--   {!! Form::open(['url' => 'HomeController@store', 'method' => 'POST']) !!} --}}
                    {!! Form::open(['action' => 'HomeController@postSolicitarDemo', 'method' => 'POST']) !!}


                    <div class="row form-group">
                        <label class="col-lg-2">Rut</label>
                        <div class="col-lg-4">
                            {!! Form::text('rut', null, ['class'=>'form-control','placeholder'=>'21685419-0', 'required']) !!}
                        </div>

                        <label class="col-lg-2"></label>
                        <div class="col-lg-4"></div>
                    </div>

                    <div class="row form-group">
                        <label class="col-lg-2">Nombre</label>
                        <div class="col-lg-4">
                            {!! Form::text('nombre', null, ['class'=>'form-control','placeholder'=>'Miguel', 'required']) !!}
                        </div>

                        <label class="col-lg-2">Apellido</label>
                        <div class="col-lg-4">
                            {!! Form::text('apellido', null, ['class'=>'form-control','placeholder'=>'Tapia', 'required']) !!}
                        </div>
                    </div>


                    <div class="row form-group">
                        <label class="col-lg-2">E-mail Habitual</label>
                        <div class="col-lg-4">
                            {!! Form::text('email', null, ['class'=>'form-control','placeholder'=>'E-mail Habitual', 'required']) !!}
                        </div>

                        <label class="col-lg-2">Repetir E-mail</label>
                        <div class="col-lg-4">
                            {!! Form::text('email_confirmation', null, ['class'=>'form-control','placeholder'=>'Repetir E-mail', 'required']) !!}
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-lg-2">Cadena</label>
                        <div class="col-lg-4">
                            {!! Form::select('cadena_id',$cadenas,null,['class'=>'form-control select-category','placeholder'=>'Selecciona una Cadena', 'required','id'=>'cadena_id']) !!}
                        </div>

                        <label class="col-lg-2">Nombre del Local</label>

                        <div class="col-lg-4">
                            {!! Form::text('nombreLocal', null, ['class'=>'form-control','placeholder'=>'San Ignacio', 'required']) !!}
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-lg-2">Cant. Empaques</label>
                        <div class="col-lg-4">
                            {!! Form::text('cantidad', null, ['class'=>'form-control','placeholder'=>'54']) !!}
                        </div>

                        <label class="col-lg-2">¿Cobras algo?  <br><small>Pago mensual, uniforme,<br class="hidden-md-down"> inscripción, etc.</small></label>
                        <div class="col-lg-4">
                            {!! Form::select('cobro',['No'=>'No','Si'=>'Si'],null, ['class'=>'form-control select-category']) !!}
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-lg-2">¿Qué versión deseas?</label>
                        <div class="col-lg-4">
                            {!! Form::select('version',['Free'=>'Free','Premium'=>'Premium'],null, ['class'=>'form-control select-category']) !!}
                        </div>

                        <label class="col-lg-2">¿Cómo nos conociste?</label>
                        <div class="col-lg-4">
                            {!! Form::select('encontraste',['Google'=>'Google','Noticias'=>'Noticias','Boca a Boca'=>'Boca a Boca','Redes Sociales'=>'Redes Sociales','Tarjeta de Presentación'=>'Tarjeta de Presentación','Otra'=>'Otra'],null, ['class'=>'form-control select-category']) !!}
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
                            {!! Form::submit('Solicitar', ['class'=>'btn btn-sm btn-success']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>



            </div>
        </div>
    </section>
@endsection



@section('js')
    <script>
        $(document).ready(function(){
            $(document).keydown(function(event) {
                if (event.ctrlKey==true && (event.which == '118' || event.which == '86')) {
                    //alert('thou. shalt. not. PASTE!');
                    event.preventDefault();
                }
            });
        });
    </script>

@endsection

