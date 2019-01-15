@extends('layouts.global-externo')

<!--MetaTags html Basic-->
@section('title', '- Registarme en la Plataforma Para la Toma de Turnos On-line')
@section('description', 'Registro de Usuario en Proyecto Nero - Registrate en nuestra plataforma web donde las organizaciones independiente de empaques universitarios pueden tomar turnos on-line para trabajar en sus respectivos supermercados.')
@section('keywords', 'Registro, Toma, Turnos, Empaques, Propineros, Supermercados, Chile')

<!--MetaTags Facebook-->
@section('urlFB', 'https://www.proyectonero.cl/registro')
@section('typeFB', 'website')
@section('titleFB', 'Registro Proyecto Nero - Plataforma Para Tomar Turnos On-line')
@section('descriptionFB', 'Proyecto Nero es un sitio web donde las organizaciones independiente de empaques universitarios pueden tomar turnos on-line para trabajar en sus respectivos supermercados.')
@section('imageFB', 'https://www.proyectonero.cl/img/fb-nero.jpg')

<!--MetaTags Twitter-->
@section('titleTW', 'Registro en Proyecto Nero plataforma para la Toma de Turnos On-line')
@section('descriptionTW', 'Proyecto Nero es un sitio web donde las organizaciones independiente de empaques universitarios pueden tomar turnos on-line para trabajar en sus respectivos supermercados.')
@section('imageTW', 'https://www.proyectonero.cl/img/fb-nero.jpg')


@section('content')
    <!-- main -->
    <section class="bg-image bg-image-sm" style="background-image: url('img/carousel/wall-registro.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-4 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fa fa-user-plus"></i> Crear cuenta</h4>
                        </div>
                        <div class="card-block">
                            <b class="text-center">@include('incluir/mensajes')</b>

                            {{--<form method="POST" action="{{ url('user.postRegistro') }}">--}}

                           {!! Form::open(['action' => 'UserController@postRegistro', 'method' => 'POST']) !!}


                            <div class="form-group input-icon-left m-b-10">
                                <i class="fa fa-address-card"></i>
                                {!! Form::text('rut', null, ['class'=>'form-control  form-control-secondary', 'required','placeholder'=>'Rut: 21547824-6']) !!}
                            </div>
                            <div class="form-group input-icon-left m-b-10">
                                <i class="fa fa-user"></i>
                                {!! Form::text('nombre', null, ['class'=>'form-control', 'required', 'placeholder'=>'Primer Nombre']) !!}
                            </div>
                            <div class="form-group input-icon-left m-b-10">
                                <i class="fa fa-user-o"></i>
                                {!! Form::text('apellido', null, ['class'=>'form-control form-control-secondary', 'required', 'placeholder'=>'Primer Apellido']) !!}
                            </div>

                            <div class="divider"><span>Enviaremos un email de confirmación</span></div>
                            <div class="form-group input-icon-left m-b-10">
                                <i class="fa fa-envelope"></i>
                                {!! Form::text('email', null, ['class'=>'form-control form-control-secondary','required', 'placeholder'=>'Email']) !!}
                            </div>
                            <div class="form-group input-icon-left m-b-10">
                                <i class="fa fa-envelope"></i>
                                {!! Form::text('email_confirmation', null, ['class'=>'form-control form-control-secondary','required', 'placeholder'=>'Repetir Email']) !!}
                            </div>

                            <div class="divider"><span>Seguridad</span></div>
                            <div class="form-group input-icon-left m-b-10">
                                <i class="fa fa-lock"></i>
                                {!! Form::password('password', ['class'=>'form-control form-control-secondary', 'required', 'placeholder'=>'Contraseña - 6 caracteres mínimo']) !!}
                            </div>
                            <div class="form-group input-icon-left m-b-10">
                                <i class="fa fa-unlock"></i>
                                {!! Form::password('password_confirmation', ['class'=>'form-control form-control-secondary', 'required', 'placeholder'=>'Contraseña - 6 caracteres mínimo']) !!}
                            </div>

                            <div class="divider"><span>Términos de Servicio</span></div>
                                {{--
                            <label class="custom-control custom-checkbox custom-checkbox-primary">
                                <input type="checkbox" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Aceptar <a href="#" data-toggle="modal" data-target="#terms">Términos de Servicio</a></span>
                            </label>
                            --}}
                            <button type="submit" class="btn btn-primary m-t-10 btn-block">Guardar</button>
                            {{-- </form> --}}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="terms">
            <div class="modal-dialog modal-top" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fa fa-file-text-o"></i> Terms of Service</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6>1. Morbi ut pharetra tellus</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lobortis justo vel lorem sagittis, eu bibendum ipsum accumsan. Donec congue eget elit ut posuere. Curabitur congue, enim a viverra ultrices, elit velit auctor neque, eget vehicula
                            augue purus et lectus. Mauris cursus ac ex in vehicula. Sed ut sagittis eros. Vivamus accumsan diam vitae lectus consectetur aliquet. Proin varius tempor ullamcorper. Quisque malesuada mollis arcu, in euismod nisi pharetra pellentesque.
                            Sed ullamcorper quis dui sed varius. Fusce efficitur augue purus, vitae mattis orci blandit ac. Integer suscipit arcu ac diam tincidunt, sed elementum augue lobortis.</p>
                        <p>Pellentesque finibus dui dui, sit amet scelerisque neque venenatis non. Nullam gravida nisi pretium malesuada luctus. Nunc porttitor ipsum a massa gravida congue. Vestibulum dapibus mauris sit amet volutpat faucibus. Nulla lacinia diam sed
                            ultricies venenatis. Ut ultricies, urna commodo aliquam molestie, lectus leo efficitur tellus, et aliquam magna magna id est. In euismod ac magna quis imperdiet.</p>
                        <p>Aliquam ornare elit neque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Morbi ut pharetra tellus. Vestibulum a dui nisl. Sed commodo sodales dolor, et malesuada nulla consectetur vitae. Quisque nec neque ac tellus auctor pellentesque
                            vel eleifend urna. Phasellus non urna id tellus fringilla hendrerit. Quisque vel mauris nisi. Mauris nec odio vitae sapien sodales lacinia. Interdum et malesuada fames ac ante ipsum primis in faucibus. Etiam sit amet nisi quis ex pretium
                            congue id id magna. Aenean dictum justo sit amet augue mollis ullamcorper. Aliquam mattis vel mauris et elementum. Morbi et risus quis nisl ullamcorper pulvinar eget et erat.</p>
                        <p>Ut viverra urna non orci interdum, in viverra urna pretium. Suspendisse potenti. Mauris et massa a enim lobortis facilisis. In hac habitasse platea dictumst. Ut varius erat vulputate libero sagittis, vitae feugiat nibh malesuada. Sed vel lacinia
                            urna. Curabitur eget dui nisi.</p>
                        <p>Vivamus orci felis, varius tempor lacus eu, scelerisque bibendum nunc. Vestibulum rutrum, enim quis maximus pretium, nisi est condimentum magna, venenatis dignissim magna nulla quis felis. Quisque id tellus nec mauris sagittis mattis non et
                            quam. Etiam posuere, tellus sed tincidunt egestas, tortor orci interdum risus, nec egestas dolor tortor non turpis. Curabitur in tellus laoreet, congue eros a, bibendum tortor. Nulla in facilisis libero, sit amet sagittis tellus. Aliquam
                            nec pulvinar velit, mattis pharetra urna. Donec et tincidunt libero. Duis at nisi in neque vulputate tempus. Curabitur et lobortis lacus. In sagittis egestas lorem, nec bibendum lacus maximus sed.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Accept</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /main -->
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
