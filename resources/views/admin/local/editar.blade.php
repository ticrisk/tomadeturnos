@extends('layouts.global-externo')

@section('content')
<section>
    <div class="container">

        <h4 class="text-center">Local</h4>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Editar Local</h5>
            </div>
            <div class="card-body">
                <b class="text-center">@include('incluir/mensajes')</b>

                          {!! Form::open(['route' => ['admin.local.putActualizarLocal', $local], 'method' => 'PUT'])!!}

                            {{ csrf_field() }}
                            <div class="row form-group">
                                <label class="col-lg-3">Nombre</label>
                                <div class="col-lg-3">
                                    {!! Form::text('nombre', $local->nombre,['class'=>'form-control','placeholder'=>'Nombre Obligatorio', 'required']) !!}
                                </div>

                                <label class="col-lg-3">Dirección</label>
                                <div class="col-lg-3">
                                    {!! Form::text('direccion', $local->direccion,['class'=>'form-control','placeholder'=>'Dirección']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-lg-3">Código Vinculación</label>
                                <div class="col-lg-3">
                                    {!! Form::text('codigo', $local->codigo,['class'=>'form-control','placeholder'=>'Codigo 16 caracteres']) !!}
                                </div>

                                <label class="col-lg-3">Código Postulación</label>
                                <div class="col-lg-3">
                                    {!! Form::text('codigoPostulacion', $local->codigoPostulacion,['class'=>'form-control','placeholder'=>'Codigo 16 caracteres']) !!}
                                </div>
                            </div> 

                            <div class="row form-group">
                                <label class="col-lg-3">Cuenta</label>
                                <div class="col-lg-3">
                                    {!! Form::select('cuenta',[$local->cuenta => $local->cuenta,'Premium'=>'Premium','Free'=>'Free'],null, ['class'=>'form-control select-category']) !!}
                                </div>

                                <label class="col-lg-3">Estado</label>
                                <div class="col-lg-3">
                                    {!! Form::select('estado',[$local->estado => $local->estado,'Activo'=>'Activo','Bloqueado'=>'Bloqueado'],null, ['class'=>'form-control select-category']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-lg-3">Precio Mensual</label>
                                <div class="col-lg-3">
                                    {!! Form::text('precioMensual', $local->precioMensual,['class'=>'form-control','placeholder'=>'2400', 'required']) !!}
                                </div>

                                <label class="col-lg-3">Responsable del Pago</label>
                                <div class="col-lg-3">
                                    {!! Form::select('responsablePago',[$local->responsablePago => $local->responsablePago,'Encargado'=>'Encargado','Empaques'=>'Empaques'],null, ['class'=>'form-control select-category']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                  <label class="col-lg-3">¿Visible?</label>
                                  <div class="col-lg-3">
                                      {!! Form::select('visible',[$local->visible => $local->visible,'No'=>'No','Si'=>'Si'],null, ['class'=>'form-control select-category']) !!}
                                  </div>

                                  <label class="col-lg-3"></label>
                                  <div class="col-lg-3">

                                  </div>
                             </div>

                            <div class="row form-group">
                                <label class="col-lg-3">Pre-Toma</label>
                                <div class="col-lg-3">
                                    {!! Form::select('preToma',[$local->preToma => $local->preToma,'No'=>'No','Si'=>'Si'],null, ['class'=>'form-control select-category']) !!}
                                </div>

                                <label class="col-lg-3">Repechaje</label>
                                <div class="col-lg-3">
                                    {!! Form::select('repechajeLocal',[$local->repechajeLocal => $local->repechajeLocal,'Si'=>'Si','No'=>'No'],null, ['class'=>'form-control select-category']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-lg-3">Cambiar</label>
                                <div class="col-lg-3">
                                    {!! Form::select('cambiar',[$local->cambiar => $local->cambiar,'No'=>'No','Si'=>'Si'],null, ['class'=>'form-control select-category']) !!}
                                </div>

                                <label class="col-lg-3">Cambiar 1 Turno Por</label>
                                <div class="col-lg-3">
                                    {!! Form::text('cambiarHasta', $local->cambiarHasta,['class'=>'form-control','placeholder'=>'4 turnos máximo']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-lg-3">Regalar a Cualquiera</label>
                                <div class="col-lg-3">
                                    {!! Form::select('regalarLocal',[$local->regalarLocal => $local->regalarLocal,'Si'=>'Si','No'=>'No'],null, ['class'=>'form-control select-category']) !!}
                                </div>

                                <label class="col-lg-3">Ceder a 1 Persona</label>
                                <div class="col-lg-3">
                                    {!! Form::select('ceder',[$local->ceder => $local->ceder,'No'=>'No','Si'=>'Si'],null, ['class'=>'form-control select-category']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-lg-3">Cadena</label>
                                <div class="col-lg-3">
                                    {!! Form::select('cadena_id',$cadenas,$local->cadena_id,['class'=>'form-control select-category','placeholder'=>'Selecciona una Cadena', 'required','id'=>'cadena_id']) !!}
                                </div>

                                <label class="col-lg-3">Organización</label>
                                <div class="col-lg-3">
                                      {!! Form::select('organizacion_id',$organizaciones,$local->organizacion_id,['class'=>'form-control select-category','placeholder'=>'Selecciona una Organizacion', 'required','id'=>'organizacion_id']) !!}
                                </div>
                            </div>

                          <div class="row form-group">
                              <label class="col-lg-3">¿Los empaques pueden ver <br>las planillas?</label>
                              <div class="col-lg-3">
                                  {!! Form::select('planillaEmpaque',[$local->planillaEmpaque => $local->planillaEmpaque,'Si'=>'Si','No'=>'No'],null, ['class'=>'form-control select-category']) !!}
                              </div>

                              <label class="col-lg-3">¿Los coordinadores pueden ver <br>las planillas?</label>
                              <div class="col-lg-3">
                                  {!! Form::select('planillaCoordinador',[$local->planillaCoordinador => $local->planillaCoordinador,'Si'=>'Si','No'=>'No'],null, ['class'=>'form-control select-category']) !!}
                              </div>
                          </div>




                              <div class="row form-group">
                              <div class="col-lg-12 text-center">
                                {!! Form::submit('Guardar', ['class'=>'btn btn-sm btn-success']) !!}
                                <a href="{{ url('admin/local/'.$local->id.'/opciones') }}" class="btn btn-sm btn-primary">Volver</a>
                                <a href="{{ url('admin/local/'.$local->id.'/eliminar') }}" class="btn btn-sm btn-danger">Borrar</a>
                              </div>
                            </div>
                         
                          {!! Form::close() !!}


                                <div class="p-t-35"></div>
                                <div class="alert alert-danger" role="alert">
                                    <strong>** </strong> El cambio de Responsable de Pago, Cuenta y Precio Menual <b>NO</b> debe hacerse entre el 01 al 08-m-Y 08:10:00 de cada mes (Crontab). Esta validación se hace debido a que como se cobra a fin de mes, se debe generar la boleta por la cual ocuparón la pag.
                                </div>
                          </div>
                    </div>
                  </div>
</section>
@endsection



@section('js')


@endsection


