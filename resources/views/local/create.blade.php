@extends('layouts.global-nero')

@section('content')


        <div class="bg-light lter b-b wrapper-md">
          <h1 class="m-n font-thin h3">Locales</h1>
        </div>
        <div class="wrapper-md" ng-controller="FormDemoCtrl">

              <div class="row">
               
                <div class="col-sm-12">
                  <div class="panel panel-default">
                    <div class="panel-heading font-bold">Agregar Local</div>
                    <div class="panel-body">
                                                
                          
                          <div class="bs-example form-horizontal">
                          {!! Form::open(['route' => 'local.store', 'method' => 'POST'])!!}

                            <b class="text-center">@include('incluir/mensajes')</b>

                                   

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nombre</label>
                                <div class="col-lg-4">
                                    {!! Form::text('nombre', null,['class'=>'form-control','placeholder'=>'Nombre Obligatorio', 'required']) !!}
                                </div>

                                <label class="col-lg-2 control-label">Código</label>
                                <div class="col-lg-4">
                                    {!! Form::text('codigo', null,['class'=>'form-control','placeholder'=>'Codigo 16 caracteres']) !!}
                                </div>
                            </div>  

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Dirección</label>
                                <div class="col-lg-10">
                                    {!! Form::text('direccion', null,['class'=>'form-control','placeholder'=>'Dirección']) !!}
                                </div>
                            </div> 

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Cuenta</label>
                                <div class="col-lg-4">
                                    {!! Form::select('cuenta',['Premium'=>'Premium','Free'=>'Free'],null, ['class'=>'form-control select-category']) !!}
                                </div>

                                <label class="col-lg-2 control-label">Estado</label>
                                <div class="col-lg-4">
                                    {!! Form::select('estado',['Activo'=>'Activo','Bloqueado'=>'Bloqueado'],null, ['class'=>'form-control select-category']) !!}
                                </div>
                            </div>         

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Intercambiar</label>
                                <div class="col-lg-4">
                                    {!! Form::select('intercambiar',['No'=>'No','Si'=>'Si'],null, ['class'=>'form-control select-category']) !!}
                                </div>

                                <label class="col-lg-2 control-label">Regalar Local</label>
                                <div class="col-lg-4">
                                    {!! Form::select('regalarLocal',['Si'=>'Si','No'=>'No'],null, ['class'=>'form-control select-category']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Regalar Organización</label>
                                <div class="col-lg-4">
                                    {!! Form::select('regalarOrganizacion',['No'=>'No','Si'=>'Si'],null, ['class'=>'form-control select-category']) !!}
                                </div>

                                <label class="col-lg-2 control-label">Pre-Toma</label>
                                <div class="col-lg-4">
                                    {!! Form::select('preToma',['No'=>'No','Si'=>'Si'],null, ['class'=>'form-control select-category']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Repechaje Local</label>
                                <div class="col-lg-4">
                                    {!! Form::select('repechajeLocal',['Si'=>'Si','No'=>'No'],null, ['class'=>'form-control select-category']) !!}
                                </div>

                                <label class="col-lg-2 control-label">Repechaje Organización</label>
                                <div class="col-lg-4">
                                    {!! Form::select('repechajeOrganizacion',['No'=>'No','Si'=>'Si'], null, ['class'=>'form-control select-category']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Cadena</label>
                                <div class="col-lg-4">
                                    {!! Form::select('cadena_id',$cadenas,null,['class'=>'form-control select-category','placeholder'=>'Selecciona una Cadena', 'required','id'=>'cadena_id']) !!}
                                </div>

                                <label class="col-lg-2 control-label">Organización</label>
                                <div class="col-lg-4">
                                      {!! Form::select('organizacion_id',$organizaciones,null,['class'=>'form-control select-category','placeholder'=>'Selecciona una Organizacion', 'required','id'=>'organizacion_id']) !!}
                                </div>
                            </div>    

 
                                                                                        
                            
                            <div class="form-group">
                              <div class="col-lg-12 text-center">
                                {!! Form::submit('Guardar', ['class'=>'btn btn-sm btn-success']) !!}
                                <a href="{{ url('local') }}" class="btn btn-sm btn-primary">Ir Locales</a>
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


