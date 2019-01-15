@extends('layouts.global-nero')

<?php

  $semana = array("","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo");
?>

@section('content')

<section>
    <div class="container"><!-- -fluid -->

        <h5 class="text-center">Repechaje Local</h5>

      <!-- informativo si es que existe para todos los encargados -->
          @if($noEsHora == 0)
             @if($existe == 'Si')
                      <div class="alert alert-danger" role="alert">
                        <h6><b>Mensaje Importante</b></h6>
                        <b>{{ $informativo->titulo }}</b>
                        <p>{{ $informativo->descripcion }}</p>
                        <i class="fa fa-clock-o" aria-hidden="true"></i> <i>{{ date('d-m-Y', strtotime($informativo->updated_at)) }}</i>
                      </div>
            @endif      
          @endif
      <!-- Fin del informativo -->

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Tomar turnos</h5>
            </div>
            <div class="card-body">
                       
                      <b class="text-center">@include('incluir/mensajes')</b>

                    @if($noEsHora == 0)

                    <h3 class="text-center"><strong><i>No es hora para el repechaje</i></strong></h3>
                    <p class="text-center">
                        <span><b>Inicio de la Toma:</b> {{ $planilla->inicioRepechaje }}</span><br>
                        <span><b>Termino de la Toma:</b> {{ $planilla->finRepechaje }}</span><br>
                        <span><b>Cupos:</b> {{ $user->cuposRepechaje }} </span>
                    </p>
                     
                    @else
 
                      
                      <div class="row hidden-sm-down">
                        
                        <label class="col-md-2 col-lg-2">Día</label>
                        <label class="col-md-2 col-lg-2">Fecha</label>
                        <label class="col-md-2 col-lg-2">Inicio</label>
                        <label class="col-md-2 col-lg-2">Termino</label>
                        <label class="col-md-1 col-lg-1">Cupos</label>
                        <label class="col-md-1 col-lg-1"></label>
                        <label class="col-md-2 col-lg-2 text-center">Tomar</label>
                      </div>
                      <hr class="hidden-sm-down">


                      @foreach($turnos as $turno)

                      <div  data-id="{{ $turno['id'] }}" class="fila"> <!-- inicio div id -->
                          <form id="form-{{ $turno['id'] }}">
                                
                                {{ csrf_field() }}
                                <div class="row">
                                    <label class="col-6 col-sm-6 hidden-md-up">Día</label>
                                    <div class="col-6 col-sm-6 col-md-2 col-lg-2">
                                      <?php 
                                      $dia = date('N', strtotime($turno['fecha']) ); ?>
                                      {{ $semana[$dia] }}
                                    </div>   


                                    <label class="col-6 col-sm-6 hidden-md-up">Fecha</label>
                                    <div class="col-6 col-sm-6 col-md-2 col-lg-2">
                                        {{ $turno['fecha'] }}
                                    </div> 

                                    <label class="col-6 col-sm-6 hidden-md-up">Inicio</label>
                                    <div class="col-6 col-sm-6 col-md-2 col-lg-2">
                                      {{ $turno['inicio'] }}
                                    </div> 

                                    <label class="col-6 col-sm-6 hidden-md-up">Termino</label>
                                    <div class="col-6 col-sm-6 col-md-2 col-lg-2">
                                      {{ $turno['termino'] }} 
                                    </div>

                                    <label class="col-6 col-sm-6 hidden-md-up">Cupos</label>
                                    <div class="col-6 col-sm-6 col-md-1 col-lg-1">
                                      <span id="cupos-{{ $turno['id'] }}"> {{ $turno['cuposTomados'] }} </span> - {{ $turno['cupos'] }}
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-1 col-lg-1">
                                      <div id="result-{{ $turno['id'] }}" class="text-center">-</div>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-2 col-lg-2 text-center">
                                        <div id="cambio-{{ $turno['id'] }}">
                                            <input type="button" value="Tomar" id="update-{{ $turno['id'] }}" name="update-{{ $turno['id'] }}" class="btn btn-sm btn-success btn-update"  onclick="tomar('{{$turno['id']}}')"/>
                                        </div>
                                    </div>
                                </div> <!-- end row -->
                          </form>
                      </div> <!-- fin div id -->
                          <div class="hidden-sm-down p-t-35"></div>
                          <hr class="hidden-md-up">

                      @endforeach
                    @endif
            </div>
        </div>


      @if($noEsHora == 0)
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h5 class="card-title">Noticia Local</h5>
                        </div>
                        <div class="card-body">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                              <b>{{ $noticia->titulo }}</b>

                            <p> <i class="fa fa-comment" aria-hidden="true"></i>
                                {{ $noticia->descripcion }}
                            </p>

                            <i class="fa fa-clock-o" aria-hidden="true"></i> <i>{{ $noticia->updated_at }}</i>

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h5 class="card-title">Noticia Nero</h5>
                        </div>
                        <div class="card-body">

                            <i class="fa fa-user" aria-hidden="true"></i>
                                 <b>{{ $noticiaAdmin->titulo }}</b>

                            <p> <i class="fa fa-bullhorn" aria-hidden="true"></i>
                                {{ $noticiaAdmin->descripcion }}
                            </p>

                            <i class="fa fa-map-marker" aria-hidden="true"></i> <i>{{ $noticiaAdmin->updated_at }}</i>


                        </div>
                    </div>
                </div>                  
               
            </div><!-- end row panel noticia --> 
        @endif             
      </div><!-- end div container -->
</section>
@endsection



@section('js')
  <script type="text/javascript">

  function tomar(i){
    var id = i; 

    //alert(id);
      $(document).ready(function(){
          
          //var form = $('#form-update');
          var url = '{{ asset("/") }}'+id+'/postRepechaje';

          var data = $("#form-"+id).serialize();


                $.post(url, data, function(result){
                    //$("#result-"+id).html(result.message);
                    //alert(result.x);
                    /**/
                    $.each(result.arrayCupos, function(index){
                      //El span donde se muestra los cupos disponibles
                      $("#cupos-"+result.arrayCupos[index].id).html(result.arrayCupos[index].cupos);
                      //$("#cambio-"+result.arrayCupos[index].id).html('');
                      /**/

                      if (result.arrayCupos[index].estado == 'No Cupos'){
                        //Cambio el boton según estado (disponible, )
                        $("#cambio-"+result.arrayCupos[index].id).html('');
                        $("#cambio-"+result.arrayCupos[index].id).html('<input type="button" value="No Cupos"  class="btn btn-sm btn-warning" disabled="disabled"/>'); 

                      }else if(result.arrayCupos[index].estado == 'Disponible'){
                        $("#cambio-"+result.arrayCupos[index].id).html('');
                        $("#cambio-"+result.arrayCupos[index].id).html('<input type="button" value="Tomar" id="update-'+result.arrayCupos[index].id+'" name="update-'+result.arrayCupos[index].id+'" class="btn btn-sm btn-success btn-update"  onclick="tomar('+result.arrayCupos[index].id+')"/>'); 

                      }else if(result.arrayCupos[index].estado == 'ok-Tomado'){
                        $("#cambio-"+result.arrayCupos[index].id).html('');
                        $("#cambio-"+result.arrayCupos[index].id).html('<input type="button" value="Soltar" id="delete-'+result.arrayCupos[index].id+'" name="delete-'+result.arrayCupos[index].id+'" class="btn btn-sm btn-danger btn-delete"  onclick="soltar('+result.arrayCupos[index].id+')"/>'); 
                      }
                      
                    })//end-each
                    
                    /**/
                    if(result.message == 'ok-Tomado'){
                      $('#update-'+id).remove();
                      $("#cambio-"+id).html('');
                      $("#cambio-"+id).html('<input type="button" value="Soltar" id="delete-'+id+'" name="delete-'+id+'" class="btn btn-sm btn-danger btn-delete"  onclick="soltar('+id+')"/>'); 
                    }else if(result.message == 'Tope'){
                      $("#cambio-"+id).html('');
                      $("#cambio-"+id).html('<input type="button" value="Tope"  class="btn btn-sm btn-warning" disabled="disabled"/>'); 
                    }else if(result.message == 'Ya es mío'){
                      $("#cambio-"+id).html('');
                      $("#cambio-"+id).html('<input type="button" value="Ya es mío" id="delete-'+id+'" name="delete-'+id+'" class="btn btn-sm btn-danger btn-delete" disabled="disabled" />'); 
                    }else if(result.message == 'Max. Turno'){
                        $("#cambio-"+id).html('');
                        $("#cambio-"+id).html('<input type="button" value="Límite"  class="btn btn-xs btn-info" disabled="disabled"/>');
                    }else if(result.message == 'Fuera de Hora'){
                      $("#cambio-"+id).html('');
                      $("#cambio-"+id).html('<input type="button" value="Fin Toma"  class="btn btn-sm btn-warning" disabled="disabled"/>'); 

                    }
                }).fail(function() {
              
                  $("#result-"+id).html("Error");
                });

      });
  }

  function soltar(i){
    var id = i; 

    //alert(id);
      $(document).ready(function(){
          
          //var form = $('#form-update');
          var url = '{{ asset("/") }}'+id+'/deleteRepechajeTomado';

          var data = $("#form-"+id).serialize();


                $.post(url, data, function(result){
   
                    $.each(result.arrayCupos, function(index){
                      //El span donde se muestra los cupos disponibles
                      $("#cupos-"+result.arrayCupos[index].id).html(result.arrayCupos[index].cupos);
                      //$("#cambio-"+result.arrayCupos[index].id).html('');
                      /**/

                      
                      if(result.arrayCupos[index].estado == 'Disponible'){
                        $("#cambio-"+result.arrayCupos[index].id).html('');
                        $("#cambio-"+result.arrayCupos[index].id).html('<input type="button" value="Tomar" id="update-'+result.arrayCupos[index].id+'" name="update-'+result.arrayCupos[index].id+'" class="btn btn-sm btn-success btn-update"  onclick="tomar('+result.arrayCupos[index].id+')"/>'); 

                      }else if (result.arrayCupos[index].estado == 'No Cupos'){
                        //Cambio el boton según estado (disponible, )
                        $("#cambio-"+result.arrayCupos[index].id).html('');
                        $("#cambio-"+result.arrayCupos[index].id).html('<input type="button" value="No Cupos"  class="btn btn-sm btn-warning" disabled="disabled"/>'); 

                      }else if(result.arrayCupos[index].estado == 'ok-Tomado'){
                        $("#cambio-"+result.arrayCupos[index].id).html('');
                        $("#cambio-"+result.arrayCupos[index].id).html('<input type="button" value="Soltar" id="delete-'+result.arrayCupos[index].id+'" name="delete-'+result.arrayCupos[index].id+'" class="btn btn-sm btn-danger btn-delete"  onclick="soltar('+result.arrayCupos[index].id+')"/>'); 
                     }
                      
                    })//end-each
                    
                    /**/
                    if(result.message == 'Soltar'){
                      $('#update-'+id).remove();
                      $("#cambio-"+id).html('');
                      $("#cambio-"+id).html('<input type="button" value="Tomar" id="update-'+id+'" name="update-'+id+'" class="btn btn-sm btn-success btn-update"  onclick="tomar('+id+')"/>'); 
                    }else if(result.message == 'Fuera de Hora'){
                      $("#result-"+id).html("Fin Toma");
                      //$("#cambio-"+id).html('');
                      //$("#cambio-"+id).html('<input type="button" value="Fin Toma"  class="btn btn-sm btn-warning" disabled="disabled"/>'); 

                    }
                }).fail(function() {
              
                  $("#result-"+id).html("Error");
                });

      });
  }  

  </script>

@endsection