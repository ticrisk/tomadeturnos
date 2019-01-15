@extends('layouts.global-externo')

@section('content')

<section>
        <div class="container">

            <h5 class="text-center">Mi Perfil</h5>
            <p class="m-b-25 text-center">Modificar Datos</p>


            <div class="row">

                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5 class="card-title">Editar</h5>
                        </div>
                        <div class="card-block">
                            <b class="text-center">@include('incluir/mensajes')</b>
                            {!! Form::open(['route' => ['user.update', $usuario], 'method' => 'PUT', 'files'=>true]) !!}

                                <div class="row form-group">
                                    <div class="col-lg-12 text-center">
                                        <figure class="figure">
                                            <img src="{{ asset('img/user/'.$usuario->avatar) }}" alt="foto perfil" class="rounded-circle">
                                        </figure>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputId" class="col-sm-2 col-form-label">ID</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('id', $usuario->id, ['class'=>'form-control', 'id'=>'inputId', 'readonly']) !!}
                                    </div>
                                    <label for="inputRut" class="col-sm-2 col-form-label">Rut</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('rut', $usuario->rut, ['class'=>'form-control', 'id'=>'inputRut', 'readonly']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('email', $usuario->email, ['class'=>'form-control', 'id'=>'inputEmail', 'placeholder'=>'E-mail Obligatorio', 'required']) !!}
                                    </div>
                                    <label for="inputUltimaConexion" class="col-sm-2 col-form-label">Última Conexión</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('ultimaConexion', $usuario->ultimaConexion, ['class'=>'form-control', 'id'=>'inputUltimaConexion', 'readonly']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputNombre" class="col-sm-2 col-form-label">Nombre</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('nombre', $usuario->nombre, ['class'=>'form-control', 'id'=>'inputNombre', 'placeholder'=>'Nombre Obligatorio', 'required']) !!}
                                    </div>
                                    <label for="inputApellido" class="col-sm-2 col-form-label">Apellido</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('apellido', $usuario->apellido, ['class'=>'form-control', 'id'=>'inputApellido', 'placeholder'=>'Apellido Obligatorio', 'required']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputRedSocial" class="col-sm-2 col-form-label">Red Social</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('redSocial', $usuario->redSocial, ['class'=>'form-control', 'id'=>'inputRedSocial', 'placeholder'=>'Link Red Social']) !!}
                                    </div>
                                    <label for="inputCelular" class="col-sm-2 col-form-label">Celular</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('celular', $usuario->celular, ['class'=>'form-control', 'id'=>'inputCelular', 'placeholder'=>'Celular']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputGenero" class="col-sm-2 col-form-label">Genero</label>
                                    <div class="col-sm-4">
                                        {!! Form::select('genero',[$usuario->genero => $usuario->genero,'Masculino'=>'Masculino','Femenino'=>'Femenino'],null, ['class'=>'form-control select-category', 'id'=>'inputGenero']) !!}
                                    </div>
                                    <label for="inputHijos" class="col-sm-2 col-form-label">Hijos</label>
                                    <div class="col-sm-4">
                                        {!! Form::select('hijos',[$usuario->hijos => $usuario->hijos,'Si'=>'Si','No'=>'No'],null, ['class'=>'form-control select-category', 'id'=>'inputHijos']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="region" class="col-sm-2 col-form-label">Región</label>
                                    <div class="col-sm-4">
                                        {!! Form::select('region',$regiones,null,['class'=>'form-control select-category','placeholder'=>'Selecciona una Región','id'=>'region']) !!}
                                    </div>
                                    <label for="comuna_id" class="col-sm-2 col-form-label">Comuna</label>
                                    <div class="col-sm-4">
                                        {!! Form::select('comuna_id',$comunas,$usuario->comuna_id,['class'=>'form-control select-category','placeholder'=>'Selecciona una Comuna','id'=>'comuna_id']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputDireccion" class="col-sm-2 col-form-label">Dirección</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('direccion', $usuario->direccion, ['class'=>'form-control', 'id'=>'inputDireccion', 'placeholder'=>'Dirección']) !!}
                                    </div>
                                    <label for="avatar" class="col-sm-2 col-form-label">Foto</label>
                                    <div class="col-sm-4">
                                        {!! Form::file('avatar',['id'=>'avatar']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="universidad_id" class="col-sm-2 col-form-label">Universidad</label>
                                    <div class="col-sm-4">
                                        {!! Form::select('universidad_id',$universidades,$usuario->universidad_id,['class'=>'form-control select-category','placeholder'=>'Selecciona una Universidad','id'=>'universidad_id']) !!}
                                    </div>
                                    <label for="carrera_id" class="col-sm-2 col-form-label">Carrera</label>
                                    <div class="col-sm-4">
                                        {!! Form::select('carrera_id',$carreras,$usuario->carrera_id,['class'=>'form-control select-category','placeholder'=>'Selecciona una Carrera','id'=>'carrera_id']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputRol" class="col-sm-2 col-form-label">Rol</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('rol', $usuario->rol, ['class'=>'form-control', 'id'=>'inputRol', 'readonly']) !!}
                                    </div>
                                    <label for="inputEstado" class="col-sm-2 col-form-label">Estado</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('estado', $usuario->estado, ['class'=>'form-control', 'id'=>'inputEstado', 'readonly']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputCreated" class="col-sm-2 col-form-label">Fecha de Registro</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('created_at', $usuario->created_at, ['class'=>'form-control', 'id'=>'inputCreated', 'readonly']) !!}
                                    </div>
                                    <label for="inputUpdated" class="col-sm-2 col-form-label">Ult. Actualización</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('updated_at', $usuario->updated_at, ['class'=>'form-control', 'id'=>'inputUpdated', 'readonly']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-4">
                                        {!! Form::password('password', ['class'=>'form-control', 'id'=>'inputPassword', 'placeholder'=>'Nueva Password']) !!}
                                    </div>
                                    <label for="inputPassword2" class="col-sm-2 col-form-label">Repetir Password</label>
                                    <div class="col-sm-4">
                                        {!! Form::password('password_confirmation', ['class'=>'form-control', 'id'=>'inputPassword2', 'placeholder'=>'Confirmar Nueva Password']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 text-center">
                                        {!! Form::submit('Guardar', ['class'=>'btn btn-sm btn-info center-block']) !!}
                                    </div>
                                </div>

                            {!! Form::close() !!}

                            <div class="alert alert-info" role="alert">
                                <strong>** </strong> Rellenar todos los datos te ayudarán a conseguir trabajo más facilmente.
                                <br>
                                <strong>** </strong> Te recomendamos poner un e-mail que ocupes frecuentemente porque nos contáctamos por ese medio.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

@endsection

@section('js')
    {!! Html::script('js/dropdown.js') !!}


    <script>
        $("#avatar").change(function () {
            var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Formatos de imagenes permitidos : "+fileExtension.join(', '));
            }
        });
    </script>



    <script type="text/javascript">
        $('#avatar').bind('change', function () {
            var peso = this.files[0].size;
            //alert(peso);
            if (peso > 1048576)//1048576 -> 1MB | 2097152 bytes -> 2MB
            {
                document.getElementById("avatar").value = "";//elimina el archivo adjuntadp
                alert('Error - archivo avatar supera los 1 MB permitidos');
                //$("#avatar").remove();//empty y remove no funcionan
                //location.reload(true);//si recargo la pag , pierdo los datos
            }
            // else {
            //    alert('archivo Correcto - NO supera los 2mb' + peso);
            //}

        });
    </script>
@endsection


