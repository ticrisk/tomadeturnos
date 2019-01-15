@extends('layouts.global-nero')

@section('content')

<section>
    <div class="container">

        <h4 class="text-center">Local</h4>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Agregar Local</h5>
            </div>
            <div class="card-body">
                <b class="text-center">@include('incluir/mensajes')</b>

                    {!! Form::open(['action' => 'AdminController@postAgregarLocal', 'method' => 'POST'])!!}

                    <div class="form-group row">
                        <label class="col-lg-2">Nombre</label>
                        <div class="col-lg-4">
                            {!! Form::text('nombre', null,['class'=>'form-control','placeholder'=>'Nombre Obligatorio', 'required']) !!}
                        </div>

                        <label class="col-lg-2">Dirección</label>
                        <div class="col-lg-4">
                            {!! Form::text('direccion', null,['class'=>'form-control','placeholder'=>'Dirección']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                            <label class="col-lg-2 control-label">Código Vinculación</label>
                            <div class="col-lg-4">
                                {!! Form::text('codigo', null,['class'=>'form-control','placeholder'=>'Código 16 caracteres']) !!}
                            </div>

                            <label class="col-lg-2 control-label">Código Postulación</label>
                            <div class="col-lg-4">
                                {!! Form::text('codigoPostulacion', null,['class'=>'form-control','placeholder'=>'Código 16 caracteres']) !!}
                            </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2 control-label">Cuenta</label>
                        <div class="col-lg-4">
                            {!! Form::select('cuenta',['Premium'=>'Premium','Free'=>'Free'],null, ['class'=>'form-control select-category']) !!}
                        </div>

                        <label class="col-lg-2 control-label">Estado</label>
                        <div class="col-lg-4">
                            {!! Form::select('estado',['Activo'=>'Activo','Bloqueado'=>'Bloqueado'],null, ['class'=>'form-control select-category']) !!}
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-lg-2">Precio Mensual</label>
                        <div class="col-lg-4">
                            {!! Form::text('precioMensual', null, ['class'=>'form-control','placeholder'=>'2400', 'required']) !!}
                        </div>

                        <label class="col-lg-2">Responsable del Pago</label>
                        <div class="col-lg-4">
                            {!! Form::select('responsablePago', ['Encargado'=>'Encargado','Empaques'=>'Empaques'], null, ['class'=>'form-control select-category']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2">¿Visible?</label>
                        <div class="col-lg-4">
                            {!! Form::select('visible',['Si'=>'Si','No'=>'No'],null, ['class'=>'form-control select-category']) !!}
                        </div>

                        <label class="col-lg-2"></label>
                        <div class="col-lg-4">

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2 control-label">Pre-Toma</label>
                        <div class="col-lg-4">
                            {!! Form::select('preToma',['No'=>'No','Si'=>'Si'],null, ['class'=>'form-control select-category']) !!}
                        </div>

                        <label class="col-lg-2 control-label">Repechaje</label>
                        <div class="col-lg-4">
                            {!! Form::select('repechajeLocal',['Si'=>'Si','No'=>'No'],null, ['class'=>'form-control select-category']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2 control-label">Cambiar</label>
                        <div class="col-lg-4">
                            {!! Form::select('cambiar',['No'=>'No','Si'=>'Si'],null, ['class'=>'form-control select-category']) !!}
                        </div>

                        <label class="col-lg-2">Cambiar 1 Turno Por</label>
                        <div class="col-lg-4">
                            {!! Form::text('cambiarHasta', null, ['class'=>'form-control','placeholder'=>'4 turnos máximo', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2 control-label">Regalar a Cualquiera</label>
                        <div class="col-lg-4">
                            {!! Form::select('regalarLocal',['Si'=>'Si','No'=>'No'],null, ['class'=>'form-control select-category']) !!}
                        </div>

                        <label class="col-lg-2 control-label">Ceder a 1 Persona</label>
                        <div class="col-lg-4">
                            {!! Form::select('ceder',['No'=>'No','Si'=>'Si'],null, ['class'=>'form-control select-category']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2 control-label">Cadena</label>
                        <div class="col-lg-4">
                            {!! Form::select('cadena_id',$cadenas,null,['class'=>'form-control select-category','placeholder'=>'Selecciona una Cadena', 'required','id'=>'cadena_id']) !!}
                        </div>

                        <label class="col-lg-2 control-label">Organización</label>
                        <div class="col-lg-4">
                              {!! Form::select('organizacion_id',$organizaciones,null,['class'=>'form-control select-category','placeholder'=>'Selecciona una Organizacion', 'required','id'=>'organizacion_id']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2">¿Los empaques pueden <br>ver las planillas?</label>
                        <div class="col-lg-4">
                            {!! Form::select('planillaEmpaque',['No'=>'No','Si'=>'Si'],null, ['class'=>'form-control select-category']) !!}
                        </div>

                        <label class="col-lg-2">¿Los coordinadores pueden <br>ver las planillas?</label>
                        <div class="col-lg-4">
                            {!! Form::select('planillaCoordinador',['No'=>'No','Si'=>'Si'], null, ['class'=>'form-control select-category']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-12 text-center">
                            {!! Form::submit('Guardar', ['class'=>'btn btn-sm btn-success']) !!}
                            <a href="{{ url('admin/local/listado') }}" class="btn btn-sm btn-primary">Ir Locales</a>
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


