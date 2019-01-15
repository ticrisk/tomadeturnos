@extends('layouts.global-nero')

@section('content')

  <!-- content 
  <div id="content" class="app-content" role="main">
    <div class="app-content-body ">
        -->

        <div class="bg-light lter b-b wrapper-md">
          <h1 class="m-n font-thin h3">Local</h1>
        </div>
        <div class="wrapper-md" ng-controller="FormDemoCtrl">

              <div class="row">
               
                <div class="col-sm-12">
                  <div class="panel panel-default">
                    <div class="panel-heading font-bold">Editar Local</div>
                    <div class="panel-body">
                                                
                          
                          <div class="bs-example form-horizontal">
                          {!! Form::open(['route' => ['local.update', $local], 'method' => 'PUT'])!!}

                            <b class="text-center">@include('incluir/mensajes')</b>

                                   

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Nombre</label>
                                <div class="col-lg-3">
                                    {!! Form::text('nombre', $local->nombre,['class'=>'form-control','placeholder'=>'Nombre Obligatorio', 'required']) !!}
                                </div>

                                <label class="col-lg-3 control-label">Dirección</label>
                                <div class="col-lg-3">
                                    {!! Form::text('direccion', $local->direccion,['class'=>'form-control','placeholder'=>'Dirección']) !!}
                                </div>

                            </div>  

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Código Vincular</label>
                                <div class="col-lg-3">
                                    {!! Form::text('codigo', $local->codigo,['class'=>'form-control','placeholder'=>'Codigo 16 caracteres']) !!}
                                </div>

                                <label class="col-lg-3 control-label">Código Postulación</label>
                                <div class="col-lg-3">
                                    {!! Form::text('codigoPostulacion', $local->codigoPostulacion,['class'=>'form-control','placeholder'=>'Codigo 16 caracteres']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Cuenta</label>
                                <div class="col-lg-3">
                                    {!! Form::select('cuenta',[$local->cuenta => $local->cuenta,'Premium'=>'Premium','Free'=>'Free'],null, ['class'=>'form-control select-category']) !!}
                                </div>

                                <label class="col-lg-3 control-label">Estado</label>
                                <div class="col-lg-3">
                                    {!! Form::select('estado',[$local->estado => $local->estado,'Activo'=>'Activo','Bloqueado'=>'Bloqueado'],null, ['class'=>'form-control select-category']) !!}
                                </div>
                            </div>

                              <div class="form-group">
                                <label class="col-lg-3 control-label">Pre-Toma</label>
                                <div class="col-lg-3">
                                  {!! Form::select('preToma',[$local->preToma => $local->preToma,'No'=>'No','Si'=>'Si'],null, ['class'=>'form-control select-category']) !!}
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-lg-3 control-label">Intercambiar</label>
                                <div class="col-lg-3">
                                    {!! Form::select('intercambiar',[$local->intercambiar => $local->intercambiar,'No'=>'No','Si'=>'Si'],null, ['class'=>'form-control select-category']) !!}
                                </div>

                                <label class="col-lg-3 control-label">Ceder</label>
                                <div class="col-lg-3">
                                    {!! Form::select('ceder',[$local->ceder => $local->ceder,'No'=>'No','Si'=>'Si'],null, ['class'=>'form-control select-category']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Regalar Local</label>
                                <div class="col-lg-3">
                                    {!! Form::select('regalarLocal',[$local->regalarLocal => $local->regalarLocal,'Si'=>'Si','No'=>'No'],null, ['class'=>'form-control select-category']) !!}
                                </div>
                                <label class="col-lg-3 control-label">Regalar Organización</label>
                                <div class="col-lg-3">
                                    {!! Form::select('regalarOrganizacion',[$local->regalarOrganizacion => $local->regalarOrganizacion,'No'=>'No','Si'=>'Si'],null, ['class'=>'form-control select-category']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Repechaje Local</label>
                                <div class="col-lg-3">
                                    {!! Form::select('repechajeLocal',[$local->repechajeLocal => $local->repechajeLocal,'Si'=>'Si','No'=>'No'],null, ['class'=>'form-control select-category']) !!}
                                </div>

                                <label class="col-lg-3 control-label">Repechaje Organización</label>
                                <div class="col-lg-3">
                                    {!! Form::select('repechajeOrganizacion',[$local->repechajeOrganizacion => $local->repechajeOrganiacion,'No'=>'No','Si'=>'Si'], null, ['class'=>'form-control select-category']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Cadena</label>
                                <div class="col-lg-3">
                                    {!! Form::select('cadena_id',$cadenas,$local->cadena_id,['class'=>'form-control select-category','placeholder'=>'Selecciona una Cadena', 'required','id'=>'cadena_id']) !!}
                                </div>

                                <label class="col-lg-3 control-label">Organización</label>
                                <div class="col-lg-3">
                                      {!! Form::select('organizacion_id',$organizaciones,$local->organizacion_id,['class'=>'form-control select-category','placeholder'=>'Selecciona una Organizacion', 'required','id'=>'organizacion_id']) !!}
                                </div>
                            </div>    

 
                                                                                        
                            
                            <div class="form-group">
                              <div class="col-lg-12 text-center">
                                {!! Form::submit('Guardar', ['class'=>'btn btn-sm btn-success']) !!}
                                <a href="{{ url('local/'.$local->id.'/opciones') }}" class="btn btn-sm btn-primary">Volver</a>
                              </div>
                            </div>
                         
                          {!! Form::close() !!}

                          </div>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>

<!--

    </div>
</div>

-->



@endsection



@section('js')


@endsection


