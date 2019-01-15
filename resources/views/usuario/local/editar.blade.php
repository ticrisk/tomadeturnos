@extends('layouts.global-nero')

@section('content')
<section>
        <div class="container">

            <h4 class="text-center">Local <i class="fa fa-star text-warning pull-right" aria-hidden="true" data-toggle="tooltip" title="Opción Premium"></i></h4>

            <p class="m-b-25 text-center">Editar Características del local</p>

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Local - {{ $local->nombre }} </h5>
                </div>
                <div class="card-block">
                    <b class="text-center">@include('incluir/mensajes')</b>
                    {!! Form::open(['route' => ['usuario.local.putActualizarLocal', $local], 'method' => 'PUT'])!!}


                            <div class="row form-group">
                                    <label class="col-12 col-lg-2" for="nombre">Nombre:</label>
                                    <div class="col-12 col-lg-4">
                                        {!! Form::text('nombre', $local->nombre,['class'=>'form-control','placeholder'=>'Nombre Obligatorio', 'readonly']) !!}
                                    </div>

                                    <label class="col-12 col-lg-2" for="cadena_id2">Cadena:</label>
                                    <div class="col-12 col-lg-4">
                                        {!! Form::text('cadena_id2', $local->Cadena->nombre,['class'=>'form-control', 'readonly']) !!}
                                        {!! Form::hidden('cadena_id', $local->cadena_id) !!}
                                    </div>
                            </div>

                            <div class="row form-group">
                                        <label class="col-12 col-lg-2">Organización</label>
                                        <div class="col-12 col-lg-4">
                                            {!! Form::text('organizacion_id2', $local->Organizacion->nombre,['class'=>'form-control', 'readonly']) !!}
                                            {!! Form::hidden('organizacion_id', $local->organizacion_id) !!}
                                        </div>

                                        <label class="col-12 col-lg-2">Dirección</label>
                                        <div class="col-12 col-lg-4">
                                            {!! Form::text('direccion', $local->direccion,['class'=>'form-control', 'readonly']) !!}
                                        </div>
                            </div>

                            <div class="row form-group">
                                        <label class="col-12 col-lg-2">Cuenta</label>
                                        <div class="col-12 col-lg-4">
                                            {!! Form::text('cuenta', $local->cuenta,['class'=>'form-control', 'readonly']) !!}
                                        </div>

                                        <label class="col-12 col-lg-2">Estado</label>
                                        <div class="col-12 col-lg-4">
                                            {!! Form::text('estado', $local->estado,['class'=>'form-control', 'readonly']) !!}
                                        </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-12 col-lg-2">Precio Mensual</label>
                                <div class="col-12 col-lg-4">
                                    {!! Form::text('precioMensual', $local->precioMensual,['class'=>'form-control', 'readonly']) !!}
                                </div>

                                <label class="col-12 col-lg-2">Responsable del Pago</label>
                                <div class="col-12 col-lg-4">
                                    {!! Form::text('responsablePago', $local->responsablePago,['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-12 col-lg-2">¿Visible?</label>
                                <div class="col-12 col-lg-4">
                                    {!! Form::text('visible', $local->visible,['class'=>'form-control', 'readonly']) !!}
                                </div>

                                <label class="col-12  col-lg-2"></label>
                                <div class="col-12  col-lg-4">

                                </div>
                            </div>


                            <div class="row form-group">
                                <label class="col-12 col-lg-2">Repechaje</label>
                                <div class="col-12  col-lg-4">
                                    {!! Form::select('repechajeLocal',[$local->repechajeLocal => $local->repechajeLocal,'Si'=>'Si','No'=>'No'],null, ['class'=>'form-control select-category']) !!}
                                </div>

                                <label class="col-12  col-lg-2">Pre-Toma</label>
                                <div class="col-12  col-lg-4">
                                    {!! Form::select('preToma',[$local->preToma => $local->preToma,'No'=>'No','Si'=>'Si'],null, ['class'=>'form-control select-category']) !!}
                                </div>
                            </div>


                            <div class="row form-group">
                                <label class="col-12  col-lg-2">Regalar a Cualquiera</label>
                                <div class="col-12  col-lg-4">
                                    {!! Form::select('regalarLocal',[$local->regalarLocal => $local->regalarLocal,'Si'=>'Si','No'=>'No'],null, ['class'=>'form-control select-category']) !!}
                                </div>

                                <label class="col-12  col-lg-2">Ceder a una Persona</label>
                                <div class="col-12  col-lg-4">
                                    {!! Form::select('ceder',[$local->ceder => $local->ceder,'No'=>'No','Si'=>'Si'],null, ['class'=>'form-control select-category']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-12 col-lg-2">Cambiar</label>
                                <div class="col-12  col-lg-4">
                                    {!! Form::select('cambiar',[$local->cambiar => $local->cambiar,'No'=>'No','Si'=>'Si'],null, ['class'=>'form-control select-category']) !!}
                                </div>

                                <label class="col-12  col-lg-2">Cambiar 1 turno por</label>
                                <div class="col-12  col-lg-4">
                                    {!! Form::text('cambiarHasta', $local->cambiarHasta,['class'=>'form-control','placeholder'=>'4 turnos máximo']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-12 col-lg-2">Código Vinculación</label>
                                <div class="col-12 col-lg-4">
                                    {!! Form::text('codigo', $local->codigo,['class'=>'form-control','placeholder'=>'Codigo 16 caracteres']) !!}
                                </div>

                                <label class="col-12 col-lg-2">Código Postulación</label>
                                <div class="col-12 col-lg-4">
                                    {!! Form::text('codigoPostulacion', $local->codigoPostulacion,['class'=>'form-control','placeholder'=>'Codigo 16 caracteres']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                  <label class="col-12 col-lg-2">¿Los empaques <br>pueden ver las planillas?</label>
                                  <div class="col-12 col-lg-4">
                                      {!! Form::select('planillaEmpaque',[$local->planillaEmpaque => $local->planillaEmpaque,'Si'=>'Si','No'=>'No'],null, ['class'=>'form-control select-category']) !!}
                                  </div>

                                  <label class="col-12  col-lg-2">¿Los coordinadores <br> pueden ver  las planillas?</label>
                                  <div class="col-12 col-lg-4">
                                      {!! Form::select('planillaCoordinador',[$local->planillaCoordinador => $local->planillaCoordinador,'Si'=>'Si','No'=>'No'],null, ['class'=>'form-control select-category']) !!}
                                  </div>
                            </div>



                            <div class="row form-group">
                              <div class="col-lg-12 text-center">
                                {!! Form::submit('Guardar', ['class'=>'btn btn-sm btn-success']) !!}
                                <a href="{{ url('usuario/local/'.$local->id.'/opciones') }}" class="btn btn-sm btn-primary">Volver</a>
                              </div>
                            </div>
                         
                          {!! Form::close() !!}

                            <div class="alert alert-warning text-danger" role="alert">
                                <p>** Todas estas configuraciones sólo sirve para locales Premium.</p>
                                <p>** Por motivos de seguridad las opciones "Vincular por código" y "Postulaciones" estan desactivadas. Solicite
                                    al administrador que habilite estas opciones. Puede ver si estan disponible si la opción "Visible" es "Si".</p>

                            </div>

                </div>
            </div>
        </div>
</section>
@endsection



@section('js')


@endsection


