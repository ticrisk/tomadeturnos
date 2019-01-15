@extends('layouts.global-nero')

@section('content')

@include('usuario/planilla/modal/actualizar-usuario-turno')

<?php 
  $inicio='';
  $termino='';
?>

<section>
    <div class="container">

        <h4 class="text-center">Planilla <i class="fa fa-star text-warning pull-right" aria-hidden="true" data-toggle="tooltip" title="Opción Premium"></i></h4>
        <p class="m-b-25 text-center">Asignar empaque a un turno</p>

        <b class="text-center">@include('incluir/mensajes')</b>

        <div class="card card-info">
            <div class="card-header">
                <h5 class="card-title">Asignar</h5>
            </div>
            <div class="card-block">

                    {!! Form::open(['action' => 'UsuarioController@postAsignar', 'method' => 'POST']) !!}
                      {!! Form::hidden('planilla_id', $planilla->id) !!}
                            <div class="row form-group">
                                  <div class="col-lg-3">
                                      <select id="turno_id" name="turno_id" class="form-control select-category" required="required">
                                          <option value="">Seleccione un Turno</option>
                                          @foreach($list_turnos as $list_turno)
                                            <option value="{{ $list_turno->id }}">{{ $list_turno->fecha }} - {{ $list_turno->inicio }} - {{ $list_turno->termino }}</option>
                                            <!--<optgroup label="_________"></optgroup>-->
                                          @endforeach
                                      </select>
                                  </div>

                                  <div class="hidden-lg-up p-t-50"></div>
                                  <div class="col-lg-3">
                                        <select id="local_user_id" name="local_user_id" class="form-control select-category" required="required">
                                              <option value="">Seleccione un Empaque</option>
                                              @foreach($empaques as $empaque)
                                                <option value="{{ $empaque->id }}">{{ $empaque->nombre }} {{ $empaque->apellido }}</option>
                                              @endforeach
                                        </select>
                                  </div>

                                  <div class="hidden-lg-up p-t-50"></div>
                                  <div class="col-lg-2">
                                        {!! Form::select('coordinador',['No' => 'No', 'Si' => 'Si'], null,['class'=>'form-control select-category','placeholder'=>'¿Es Coordinador?', 'required']) !!}
                                  </div>

                                  <div class="hidden-lg-up p-t-50"></div>
                                  <div class="col-lg-2">
                                        {!! Form::select('fijo',['No' => 'No', 'Si' => 'Si'], null,['class'=>'form-control select-category','placeholder'=>'¿Turno Fijo?', 'required']) !!}
                                  </div>

                                  <div class="hidden-lg-up p-t-50"></div>
                                  <div class="col-lg-2 text-center">
                                        {!! Form::submit('Asignar', ['class'=>'btn btn-sm btn-success']) !!}
                                  </div>
                            </div>
                    {!! Form::close() !!}


            </div>
        </div>


        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Turnos</h5>
            </div>
            <div class="card-block">

                        <!--  ******* LUNES ****** -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="alert alert-danger" role="alert">
                                <p class="text-center"><b>Lunes <br> {{ $planilla->inicioPlanilla }} </b> </p>
                              </div>
                            </div>
                        </div>
              
                              

                        <!-- Turnos del día lunes -->
                        @foreach($lunes as $lun)
                                 
                              @if($lun->inicio != $inicio && $lun->inicio != $termino)
                                  <?php 
                                        $inicio=$lun->inicio; 
                                        $termino=$lun->termino; 
                                  ?>
                                  <hr class="alert-info">
                                  <b>{{ $inicio }} - {{ $termino }}</b> ({{ $lun->cupos }})
                                      <div class="row hidden-sm-down">
                                          <label class="col-md-4 col-lg-4"><i>Nombre</i></label>
                                          <label class="col-md-2 col-lg-2"><i>Coordinación</i></label>
                                          <label class="col-md-2 col-lg-2"><i>Fijo</i></label>
                                          <label class="col-md-2 col-lg-2"><i>Tipo</i></label>
                                          <label class="col-md-1 col-lg-1 text-center"><i>Editar</i></label>
                                          <label class="col-md-1 col-lg-1 text-center"><i>Borrar</i></label>
                                      </div>

                              @endif


                              <!-- Imprimir Usuario por turno -->
                              <div class="row" data-id="{{ $lun->id }}" >

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Nombre:</i></label>
                                        <div class="col-8 col-sm-8 col-md-4 col-lg-4">
                                            {{ $lun->nombre }} {{ $lun->apellido }}
                                        </div>

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Coordinador:</i></label>
                                        <div class="col-8 col-sm-8 col-md-2 col-lg-2">
                                            {{ $lun->coordinador }} 
                                        </div>

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Fijo:</i></label>
                                        <div class="col-8 col-sm-8 col-md-2 col-lg-2">
                                              {{ $lun->fijo }}
                                        </div>                                        

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Tipo:</i></label>
                                         <div class="col-8 col-sm-8 col-md-2 col-lg-2 ">
                                           {{ $lun->tipo }} 
                                        </div>

                                        <div class="col-12 col-sm-12 hidden-md-up text-center">
                                          <button disabled value="{{ $lun->id }}" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal" OnClick="mostrar(this);">Editar</button>  |
                                          
                                          <a href="#!" class="btn btn-xs btn-danger btn-delete">Borrar</a>
                                        </div>
                                        <div class="hidden-sm-down col-md-1 col-lg-1 text-center">
                                            <button disabled value="{{ $lun->id }}" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal" OnClick="mostrar(this);"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>   
                                        </div>
                                        
                                        <div class="hidden-sm-down col-md-1 col-lg-1 text-center">
                                          <a href="#!" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>

                              </div><!-- end row turnos personas -->
                              <div class="p-t-10"></div>

                        @endforeach  
                        <br>                              
                        <!--  ******* FIN LUNES ****** -->  


                        <!--  ******* MARTES ****** -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="alert alert-danger" role="alert">
                                <p class="text-center"><b>Martes <br> {{ $x = date('Y-m-d', strtotime ('+1 day' , strtotime($planilla->inicioPlanilla))) }} </b> </p>
                              </div>
                            </div>
                        </div>


                        <!-- Turnos del día martes -->
                        @foreach($martes as $mar)
                                 
                              @if($mar->inicio != $inicio && $mar->inicio != $termino)
                                  <?php 
                                        $inicio=$mar->inicio; 
                                        $termino=$mar->termino; 
                                  ?>
                                  <hr class="alert-info">
                                  <b>{{ $inicio }} - {{ $termino }}</b> ({{ $mar->cupos }})
                                  <div class="row hidden-sm-down">
                                    <label class="col-md-4 col-lg-4"><i>Nombre</i></label>
                                    <label class="col-md-2 col-lg-2"><i>Coordinación</i></label>
                                    <label class="col-md-2 col-lg-2"><i>Fijo</i></label>
                                    <label class="col-md-2 col-lg-2"><i>Tipo</i></label>
                                    <label class="col-md-1 col-lg-1 text-center"><i>Editar</i></label>
                                    <label class="col-md-1 col-lg-1 text-center"><i>Borrar</i></label>
                                  </div>  
                                  
                              @endif                                 

                              <!-- Imprimir Usuario por turno -->
                              <div class="row" data-id="{{ $mar->id }}" >

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Nombre:</i></label>
                                        <div class="col-8 col-sm-8 col-md-4 col-lg-4">
                                            {{ $mar->nombre }} {{ $mar->apellido }}
                                        </div>

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Coodinación:</i></label>
                                        <div class="col-8 col-sm-8 col-md-2 col-lg-2">
                                            {{ $mar->coordinador }} 
                                        </div>

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Fijo:</i></label>
                                        <div class="col-8 col-sm-8 col-md-2 col-lg-2">
                                              {{ $mar->fijo }}
                                        </div>

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Tipo:</i></label>
                                         <div class="col-8 col-sm-8 col-md-2 col-lg-2 ">
                                           {{ $mar->tipo }} 
                                        </div>

                                        <div class="col-12 col-sm-12 hidden-md-up text-center">
                                          <button disabled value="{{ $mar->id }}" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal" OnClick="mostrar(this);">Editar</button>  |
                                          
                                          <a href="#!" class="btn btn-xs btn-danger btn-delete">Borrar</a>
                                        </div>
                                        <div class="hidden-sm-down col-md-1 col-lg-1 text-center">
                                            <button disabled value="{{ $mar->id }}" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal" OnClick="mostrar(this);"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>   
                                        </div>
                                        
                                        <div class="hidden-sm-down col-md-1 col-lg-1 text-center">
                                          <a href="#!" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>

                              </div><!-- end row turnos personas -->
                              <div class="p-t-10"></div>
                        @endforeach    
                        <br>                            
                        <!--  ******* FIN MARTES ****** -->                                                   

                        <!--  ******* MIÉRCOLES ****** -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="alert alert-danger" role="alert">
                                <p class="text-center"><b>Miércoles <br> {{ $x = date('Y-m-d', strtotime ('+2 day' , strtotime($planilla->inicioPlanilla))) }} </b> </p>
                              </div>
                            </div>
                        </div>


                        <!-- Turnos del día miércoles -->
                        @foreach($miercoles as $mie)
           
                              @if($mie->inicio != $inicio && $mie->inicio != $termino)
                                  <?php 
                                        $inicio=$mie->inicio; 
                                        $termino=$mie->termino; 
                                  ?>
                                  <hr class="alert-info">
                                  <b>{{ $inicio }} - {{ $termino }}</b> ({{ $mie->cupos }})
                                  <div class="row hidden-sm-down">
                                      <label class="col-md-4 col-lg-4"><i>Nombre</i></label>
                                      <label class="col-md-2 col-lg-2"><i>Coordinación</i></label>
                                      <label class="col-md-2 col-lg-2"><i>Fijo</i></label>
                                      <label class="col-md-2 col-lg-2"><i>Tipo</i></label>
                                      <label class="col-md-1 col-lg-1 text-center"><i>Editar</i></label>
                                      <label class="col-md-1 col-lg-1 text-center"><i>Borrar</i></label>
                                  </div>

                              @endif

                              <!-- Imprimir Usuario por turno -->
                              <div class="row" data-id="{{ $mie->id }}" >

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Nombre:</i></label>
                                        <div class="col-8 col-sm-8 col-md-4 col-lg-4">
                                            {{ $mie->nombre }} {{ $mie->apellido }}
                                        </div>

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Coordinador:</i></label>
                                        <div class="col-8 col-sm-8 col-md-2 col-lg-2">
                                            {{ $mie->coordinador }} 
                                        </div>

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Fijo:</i></label>
                                        <div class="col-8 col-sm-8 col-md-2 col-lg-2">
                                              {{ $mie->fijo }}
                                        </div>

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Tipo:</i></label>
                                        <div class="col-8 col-sm-8 col-md-2 col-lg-2 ">
                                           {{ $mie->tipo }} 
                                        </div>

                                        <div class="col-12 col-sm-12 hidden-md-up text-center">
                                          <button disabled value="{{ $mie->id }}" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal" OnClick="mostrar(this);">Editar</button>  |
                                          
                                          <a href="#!" class="btn btn-xs btn-danger btn-delete">Borrar</a>
                                        </div>
                                        <div class="hidden-sm-down col-md-1 col-lg-1 text-center">
                                            <button disabled value="{{ $mie->id }}" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal" OnClick="mostrar(this);"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>   
                                        </div>
                                        
                                        <div class="hidden-sm-down col-md-1 col-lg-1 text-center">
                                          <a href="#!" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>

                              </div><!-- end row turnos personas -->
                              <div class="p-t-10"></div>
                        @endforeach        
                        <br>                        
                        <!--  ******* FIN MIÉRCOLES ****** --> 


                        <!--  ******* JUEVES ****** -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="alert alert-danger" role="alert">
                                <p class="text-center"><b>Jueves <br> {{ $x = date('Y-m-d', strtotime ('+3 day' , strtotime($planilla->inicioPlanilla))) }} </b> </p>
                              </div>
                            </div>
                        </div>
      
                   
                        <!-- Turnos del día jueves -->
                        @foreach($jueves as $jue)
                                 
                              @if($jue->inicio != $inicio && $jue->inicio != $termino)
                                  <?php 
                                        $inicio=$jue->inicio; 
                                        $termino=$jue->termino; 
                                  ?>
                                  <hr class="alert-info">
                                  <b>{{ $inicio }} - {{ $termino }}</b> ({{ $jue->cupos }})
                                  <div class="row hidden-sm-down">
                                      <label class="col-md-4 col-lg-4"><i>Nombre</i></label>
                                      <label class="col-md-2 col-lg-2"><i>Coordinación</i></label>
                                      <label class="col-md-2 col-lg-2"><i>Fijo</i></label>
                                      <label class="col-md-2 col-lg-2"><i>Tipo</i></label>
                                      <label class="col-md-1 col-lg-1 text-center"><i>Editar</i></label>
                                      <label class="col-md-1 col-lg-1 text-center"><i>Borrar</i></label>
                                  </div>

                    @endif

                              <!-- Imprimir Usuario por turno -->
                              <div class="row" data-id="{{ $jue->id }}" >


                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Nombre:</i></label>
                                        <div class="col-8 col-sm-8 col-md-4 col-lg-4">
                                            {{ $jue->nombre }} {{ $jue->apellido }}
                                        </div>

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Coordinador:</i></label>
                                        <div class="col-8 col-sm-8 col-md-2 col-lg-2">
                                            {{ $jue->coordinador }} 
                                        </div>

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Fijo:</i></label>
                                        <div class="col-8 col-sm-8 col-md-2 col-lg-2">
                                              {{ $jue->fijo }}
                                        </div>

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Fjo:</i></label>
                                        <div class="col-8 col-sm-8 col-md-2 col-lg-2 ">
                                           {{ $jue->tipo }} 
                                        </div>

                                        <div class="col-12 col-sm-12 hidden-md-up text-center">
                                          <button disabled value="{{ $jue->id }}" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal" OnClick="mostrar(this);">Editar</button>  |
                                          
                                          <a href="#!" class="btn btn-xs btn-danger btn-delete">Borrar</a>
                                        </div>
                                        <div class="hidden-sm-down col-md-1 col-lg-1 text-center">
                                            <button disabled value="{{ $jue->id }}" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal" OnClick="mostrar(this);"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>   
                                        </div>
                                        
                                        <div class="hidden-sm-down col-md-1 col-lg-1 text-center">
                                          <a href="#!" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>

                              </div><!-- end row turnos personas -->
                              <div class="p-t-10"></div>
                        @endforeach  
                        <br>                              
                        <!--  ******* FIN JUEVES ****** --> 


                        <!--  ******* VIERNES ****** -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="alert alert-danger" role="alert">
                                <p class="text-center"><b>Viernes <br> {{ $x = date('Y-m-d', strtotime ('+4 day' , strtotime($planilla->inicioPlanilla))) }} </b> </p>
                              </div>
                            </div>
                        </div>

                        <!-- Turnos del día viernes -->
                        @foreach($viernes as $vie)
                                 

                              @if($vie->inicio != $inicio && $vie->inicio != $termino)
                                  <?php 
                                        $inicio=$vie->inicio; 
                                        $termino=$vie->termino; 
                                  ?>
                                  <hr class="alert-info">
                                  <b>{{ $inicio }} - {{ $termino }}</b> ({{ $vie->cupos }})
                                  <div class="row hidden-sm-down">
                                      <label class="col-md-4 col-lg-4"><i>Nombre</i></label>
                                      <label class="col-md-2 col-lg-2"><i>Coordinación</i></label>
                                      <label class="col-md-2 col-lg-2"><i>Fijo</i></label>
                                      <label class="col-md-2 col-lg-2"><i>Tipo</i></label>
                                      <label class="col-md-1 col-lg-1 text-center"><i>Editar</i></label>
                                      <label class="col-md-1 col-lg-1 text-center"><i>Borrar</i></label>
                                  </div>

                    @endif

                              <!-- Imprimir Usuario por turno -->
                              <div class="row" data-id="{{ $vie->id }}" >

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Nombre:</i></label>
                                        <div class="col-8 col-sm-8 col-md-4 col-lg-4">
                                            {{ $vie->nombre }} {{ $vie->apellido }}
                                        </div>

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Coordinador:</i></label>
                                        <div class="col-8 col-sm-8 col-md-2 col-lg-2">
                                            {{ $vie->coordinador }} 
                                        </div>

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Fijo:</i></label>
                                        <div class="col-8 col-sm-8 col-md-2 col-lg-2">
                                              {{ $vie->fijo }}
                                        </div>

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Tipo:</i></label>
                                        <div class="col-8 col-sm-8 col-md-2 col-lg-2 ">
                                           {{ $vie->tipo }} 
                                        </div>

                                        <div class="col-12 col-sm-12 hidden-md-up text-center">
                                          <button disabled value="{{ $vie->id }}" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal" OnClick="mostrar(this);">Editar</button>  |
                                          
                                          <a href="#!" class="btn btn-xs btn-danger btn-delete">Borrar</a>
                                        </div>
                                        <div class="hidden-sm-down col-md-1 col-lg-1 text-center">
                                            <button disabled value="{{ $vie->id }}" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal" OnClick="mostrar(this);"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>   
                                        </div>
                                        
                                        <div class="hidden-sm-down col-md-1 col-lg-1 text-center">
                                          <a href="#!" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>

                              </div><!-- end row turnos personas -->
                              <div class="p-t-10"></div>
                        @endforeach  
                        <br>                              
                        <!--  ******* FIN VIERNES ****** -->

                        <!--  ******* SÁBADO ****** -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="alert alert-danger" role="alert">
                                <p class="text-center"><b>Sábado <br> {{ $x = date('Y-m-d', strtotime ('+5 day' , strtotime($planilla->inicioPlanilla))) }} </b> </p>
                              </div>
                            </div>
                        </div>


                        <!-- Turnos del día sábado -->
                        @foreach($sabado as $sab)
                                 
                              @if($sab->inicio != $inicio && $sab->inicio != $termino)
                                  <?php 
                                        $inicio=$sab->inicio; 
                                        $termino=$sab->termino; 
                                  ?>
                                  <hr class="alert-info">
                                  <b>{{ $inicio }} - {{ $termino }}</b> ({{ $sab->cupos }})
                                  <div class="row hidden-sm-down">
                                      <label class="col-md-4 col-lg-4"><i>Nombre</i></label>
                                      <label class="col-md-2 col-lg-2"><i>Coordinación</i></label>
                                      <label class="col-md-2 col-lg-2"><i>Fijo</i></label>
                                      <label class="col-md-2 col-lg-2"><i>Tipo</i></label>
                                      <label class="col-md-1 col-lg-1 text-center"><i>Editar</i></label>
                                      <label class="col-md-1 col-lg-1 text-center"><i>Borrar</i></label>
                                  </div>

                    @endif

                              <!-- Imprimir Usuario por turno -->
                              <div class="row" data-id="{{ $sab->id }}" >

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Nombre:</i></label>
                                        <div class="col-8 col-sm-8 col-md-4 col-lg-4">
                                            {{ $sab->nombre }} {{ $sab->apellido }}
                                        </div>

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Coordinador:</i></label>
                                        <div class="col-8 col-sm-8 col-md-2 col-lg-2">
                                            {{ $sab->coordinador }} 
                                        </div>

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Fijo:</i></label>
                                        <div class="col-8 col-sm-8 col-md-2 col-lg-2">
                                              {{ $sab->fijo }}
                                        </div>

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Tipo:</i></label>
                                        <div class="col-8 col-sm-8 col-md-2 col-lg-2 ">
                                           {{ $sab->tipo }} 
                                        </div>

                                        <div class="col-12 col-sm-12 hidden-md-up text-center">
                                          <button disabled value="{{ $sab->id }}" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal" OnClick="mostrar(this);">Editar</button>  |
                                          
                                          <a href="#!" class="btn btn-xs btn-danger btn-delete">Borrar</a>
                                        </div>
                                        <div class="hidden-sm-down col-md-1 col-lg-1 text-center">
                                            <button disabled value="{{ $sab->id }}" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal" OnClick="mostrar(this);"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>   
                                        </div>
                                        
                                        <div class="hidden-sm-down col-md-1 col-lg-1 text-center">
                                          <a href="#!" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>

                              </div><!-- end row turnos personas -->
                              <div class="p-t-10"></div>
                        @endforeach 
                        <br>                               
                        <!--  ******* FIN SÁBADO ****** -->                        


                        <!--  ******* DOMINGO ****** -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="alert alert-danger" role="alert">
                                <p class="text-center"><b>Domingo <br> {{ $planilla->finPlanilla }} </b> </p>
                              </div>
                            </div>
                        </div>

                        <!-- Turnos del día domingo -->
                        @foreach($domingo as $dom)
                                 
                              @if($dom->inicio != $inicio && $dom->inicio != $termino)
                                  <?php 
                                        $inicio=$dom->inicio; 
                                        $termino=$dom->termino; 
                                  ?>
                                  <hr class="alert-info">
                                  <b>{{ $inicio }} - {{ $termino }}</b> ({{ $dom->cupos }})
                                  <div class="row hidden-sm-down">
                                      <label class="col-md-4 col-lg-4"><i>Nombre</i></label>
                                      <label class="col-md-2 col-lg-2"><i>Coordinación</i></label>
                                      <label class="col-md-2 col-lg-2"><i>Fijo</i></label>
                                      <label class="col-md-2 col-lg-2"><i>Tipo</i></label>
                                      <label class="col-md-1 col-lg-1 text-center"><i>Editar</i></label>
                                      <label class="col-md-1 col-lg-1 text-center"><i>Borrar</i></label>
                                  </div>

                    @endif

                              <!-- Imprimir Usuario por turno -->
                              <div class="row" data-id="{{ $dom->id }}" >

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Nombre:</i></label>
                                        <div class="col-8 col-sm-8 col-md-4 col-lg-4">
                                            {{ $dom->nombre }} {{ $dom->apellido }}
                                        </div>

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Coordinador:</i></label>
                                        <div class="col-8 col-sm-8 col-md-2 col-lg-2">
                                            {{ $dom->coordinador }} 
                                        </div>

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Fijo:</i></label>
                                        <div class="col-8 col-sm-8 col-md-2 col-lg-2">
                                              {{ $dom->fijo }}
                                        </div>

                                        <label class="col-4 col-sm-4 hidden-md-up"><i>Tipo:</i></label>
                                        <div class="col-8 col-sm-8 col-md-2 col-lg-2 ">
                                           {{ $dom->tipo }} 
                                        </div>

                                        <div class="col-12 col-sm-12 hidden-md-up text-center">
                                          <button disabled value="{{ $dom->id }}" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal" OnClick="mostrar(this);">Editar</button>  |
                                          
                                          <a href="#!" class="btn btn-xs btn-danger btn-delete">Borrar</a>
                                        </div>
                                        <div class="hidden-sm-down col-md-1 col-lg-1 text-center">
                                            <button disabled value="{{ $dom->id }}" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal" OnClick="mostrar(this);"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>   
                                        </div>
                                        
                                        <div class="hidden-sm-down col-md-1 col-lg-1 text-center">
                                          <a href="#!" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>

                              </div><!-- end row turnos personas -->
                              <div class="p-t-10"></div>
                        @endforeach   
                        <br>                             
                        <!--  ******* FIN DOMINGO ****** -->  


                        <hr>
                        <div class="row">
                            <div class="col-md-12 text-center">
                              <a href="{{ url('usuario/planilla/'.$planilla->id.'/opciones') }}" class="btn btn-sm btn-primary">Regresar  </a>
                              
                            </div>
                        </div>

                        <div class="p-t-35"></div>
                        <div class="alert alert-info" role="alert">
                            <strong>** </strong> Los números que aparecen en parentesis al lado de cada hora de los
                            turnos son el máximo de cupos permitidos.
                            <br>
                            <strong>** </strong> No se puede agregar una persona a un turno donde el cupo máximo esta
                            lleno con otros empaques.
                        </div>
                            
                    </div><!-- Fin panel-body -->
                </div><!-- Fin panel panel-default -->
            </div><!-- Fin col-sm-12 contenedor del panel -->
</section>



{!! Form::open(['route' => ['usuario.planilla.deleteUsuarioTurno', ':Turno_ID'], 'method' => 'DELETE', 'id'=>'form-delete'])!!}
{!! Form::close() !!}


@endsection



@section('js')
 <script type="text/javascript">
    $(document).ready(function(){
      //Boton eliminar
        $('.btn-delete').click(function(e){

          e.preventDefault();

          var row = $(this).closest('.row'); //.fila
          var id = row.data('id');
          var form = $('#form-delete');
          var url = form.attr('action').replace(':Turno_ID', id);
          var data = form.serialize();
          
          row.fadeOut();
     
          $.post(url, data, function(result){
              //alert(result.message);
              //alert(result);
          }).fail(function() {
              
              //var texto = 'error';
              //$('#msg-'+id).html('<p>'+ texto +'</p>');
              row.fadeIn();
              //$('#msg-'+id).html('<p>'+ "" +'</p>').delay(8000).hide(600);//esto no funciona
          });
        });

    });

    function mostrar(btn){
      //alert(btn.value);
      var route = "{{ asset('/usuario/planilla/turnoUser/') }}"+btn.value+"";
      $.get(route, function(res){
        //alert(res.tipo);
        $("#id").val(res.id);
        $("#coordinador").val(res.coordinador);
        $("#fijo").val(res.fijo);
        $("#tipo").val(res.tipo);
        $("#estado").val(res.estado);
        //hidden
        $("#deseo").val(res.deseo);
        $("#exDueno").val(res.exDueno);
        $("#planilla_id").val(res.planilla_id);
        $("#turno_id").val(res.turno_id);
        $("#local_user_id").val(res.local_user_id);
      });
      
    }

  $("#actualizar").click(function(){
    var id = $("#id").val();
    var coordinador = $("#coordinador").val();
    var fijo = $("#fijo").val();
    var tipo = $("#tipo").val();
    var estado = $("#estado").val();
    var deseo = $("#deseo").val();
    var exDueno = $("#exDueno").val();
    var planilla_id = $("#planilla_id").val();
    var turno_id = $("#turno_id").val();
    var local_user_id = $("#local_user_id").val();

    //alert(local_user_id);
    var route = "{{ asset('/usuario/') }}"+id+"/putTurnoUser";
    var token = $("#token").val();

    $.ajax({
      url: route,
      headers: {'X-CSRF-TOKEN': token},
      type: 'PUT',
      dataType: 'json',
      data: {info: id,coordinador,fijo,tipo,estado,deseo,exDueno,planilla_id,turno_id,local_user_id},//genre:
      /**/
      success: function(){
        //Carga();
        //$("#myModal").modal('toggle');
        location.reload();
        //$("#msj-success").fadeIn();
      }
      
    });   

  });    


  </script>

@endsection


