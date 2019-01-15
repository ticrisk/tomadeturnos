@extends('layouts.global-externo')

<?php
$x = "";
$fec_jue = "";
$semana = array("","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo");
?>

@section('content')
    <section>
        <div class="container"><!-- -fluid -->

            <h5 class="text-center">Toma de Turnos</h5>
            <div class="hidden-md-up text-center m-b-15"><b><u><a href="{{ url('turno/toma-por-dia/'.$planilla->local_id) }}">Vista por día</a></u></b> - <b><u><a href="{{ url('turno/toma/'.$planilla->local_id) }}">Vista Normal</a></u></b></div>

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
        </div>

        <!-- Fin del informativo -->
        <div class="container hidden-sm-down">
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Tomar turnos</h5>
                </div>
                <div class="card-body">
                    <h3 class="text-center"><strong><i>Esta vista es solo para dispositivos pequeños</i></strong></h3>
                    <div class="text-center"><b><u><a href="{{ url('turno/toma/'.$planilla->local_id) }}">Ir a Vista Normal</a></u></b></div>
                </div>
            </div>
        </div>
        <div class="container-fluid hidden-md-up">
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Tomar turnos</h5>
                </div>
                <div class="card-body">

                    <b class="text-center">@include('incluir/mensajes')</b>

                    @if($noEsHora == 0)

                        <h3 class="text-center"><strong><i>No es hora para la toma de turnos</i></strong></h3>
                        <p class="text-center">
                            <span><b>Inicio de la Toma:</b> {{ $planilla->inicioToma }}</span><br>
                            <span><b>Termino de la Toma:</b> {{ $planilla->finToma }}</span><br>
                            <span><b>Cupos:</b> {{ $user->cuposToma }} </span><br>
                            {{--<div class="hidden-md-up text-center"><b><u><a href="{{ url('turno/toma-por-dia/'.$planilla->local_id) }}">Vista por día</a></u></b> - <b><u><a href="{{ url('turno/toma/'.$planilla->local_id) }}">Vista Normal</a></u></b></div> --}}
                        </p>
                        <hr>
                        <div class="text-center"><b>Simbología</b></div><hr>
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3 p-t-15"><button type="button" class="btn btn-xs btn-success"><i class="fa fa-check"></i></button> Tomar Turno</div>
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3 p-t-15"><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button> Borrar Turno</div>
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3 p-t-15"><button type="button" class="btn btn-xs btn-warning" disabled="disabled"><i class="fa fa-lock"></i></button> No quedan Cupos</div>
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3 p-t-15"><button type="button" class="btn btn-xs btn-warning" disabled="disabled"><i class="fa fa-clock-o"></i></button> Tope de Horario</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3 p-t-15"><button type="button" class="btn btn-xs btn-info" disabled="disabled"><i class="fa fa-warning"></i></button> Máximo de Turnos Permitidos</div>
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3 p-t-15"><button type="button" class="btn btn-xs btn-danger" disabled="disabled"><i class="fa fa-cart-plus"></i></button> Turno Asignado</div>
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3 p-t-15"><button type="button" class="btn btn-xs btn-danger" disabled="disabled"><i class="fa fa-check-square-o"></i></button> Pre-Toma</div>
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3 p-t-15"><button type="button" class="btn btn-xs btn-warning" disabled="disabled"><i class="fa fa-hourglass-3"></i></button> Finalizó la Toma</div>
                        </div>
                    @else
                        <div class="row"> @include('turno/incluir/turnos-toma-2x4') </div>
                    @endif

                </div>
            </div>
        </div>
        <div class="container">
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
        </div>

        {{--
        {!! Form::open(['route' => ['turno.postToma', ':Turno_ID'], 'method' => 'POST', 'id'=>'form-update'])!!}
        {!! Form::close() !!}

        {!! Form::open(['route' => ['turno.deleteTurnoTomado', ':Turno_ID'], 'method' => 'DELETE', 'id'=>'form-delete'])!!}
        {!! Form::close() !!}
        --}}
    </section>
@endsection



@section('js')
    <script type="text/javascript">

        function tomar(i,p){
            var id = i;
            var pla = p;

            $(document).ready(function(){

                $("#cambio-"+id).html('<i class="fa fa-spinner"></i>');
                var url = '{{ asset("/") }}'+id+'/'+pla+'/postToma';
                var data = $("#form-"+id).serialize();

                $.post(url, data, function(result){

                    $.each(result.arrayCupos, function(index){
                        //El span donde se muestra los cupos disponibles
                        $("#cupos-"+result.arrayCupos[index].id).html(result.arrayCupos[index].cupos);

                        if (result.arrayCupos[index].estado == 'No Cupos')
                        {
                            //Cambio el boton según estado (disponible, )
                            $("#cambio-"+result.arrayCupos[index].id).html('');
                            $("#cambio-"+result.arrayCupos[index].id).html('<button type="button" class="btn btn-xs btn-warning" disabled="disabled" data-toggle="tooltip" title="No hay cupos"><i class="fa fa-lock"></i></button>');

                        }else if(result.arrayCupos[index].estado == 'Disponible'){
                            $("#cambio-"+result.arrayCupos[index].id).html('');
                            $("#cambio-"+result.arrayCupos[index].id).html('<button type="button" id="update-'+result.arrayCupos[index].id+'" name="update-'+result.arrayCupos[index].id+'" class="btn btn-xs btn-success btn-update"  onclick="tomar('+result.arrayCupos[index].id+','+pla+');"  data-toggle="tooltip" title="Tomar"><i class="fa fa-check"></i></button>');


                        }else if(result.arrayCupos[index].estado == 'ok-Tomado'){
                            $("#cambio-"+result.arrayCupos[index].id).html('');
                            $("#cambio-"+result.arrayCupos[index].id).html('<button type="button" id="delete-'+result.arrayCupos[index].id+'" name="delete-'+result.arrayCupos[index].id+'" class="btn btn-xs btn-danger btn-delete"  onclick="soltar('+result.arrayCupos[index].id+','+pla+');" data-toggle="tooltip" title="Soltar"><i class="fa fa-trash"></i></button>');

                        }else if(result.arrayCupos[index].estado == 'Asignado'){
                            $("#cambio-"+result.arrayCupos[index].id).html('');
                            $("#cambio-"+result.arrayCupos[index].id).html('<button type="button" class="btn btn-xs btn-danger" disabled="disabled" data-toggle="tooltip" title="Asignado"><i class="fa fa-cart-plus"></i></button>');

                        }else if(result.arrayCupos[index].estado == 'Pre-Toma'){
                            $("#cambio-"+result.arrayCupos[index].id).html('');
                            $("#cambio-"+result.arrayCupos[index].id).html('<button type="button" class="btn btn-xs btn-danger" disabled="disabled" data-toggle="tooltip" title="Pre-Toma"><i class="fa fa-check-square-o"></i></button>');

                        }


                    })//end-each


                    if(result.message == 'ok-Tomado'){
                        $('#update-'+id).remove();
                        $("#cambio-"+id).html('');
                        $("#cambio-"+id).html('<button type="button" id="delete-'+id+'" name="delete-'+id+'" class="btn btn-xs btn-danger btn-delete"  onclick="soltar('+id+','+pla+');"  data-toggle="tooltip" title="Soltar"><i class="fa fa-trash"></i></button>');
                    }else if(result.message == 'Tope'){
                        $("#cambio-"+id).html('');
                        $("#cambio-"+id).html('<button type="button" class="btn btn-xs btn-warning" disabled="disabled" data-toggle="tooltip" title="Tope de hora"><i class="fa fa-clock-o"></i></button>');
                    }else if(result.message == 'Ya es mío'){
                        $("#cambio-"+id).html('');
                        $("#cambio-"+id).html('<button type="button" id="delete-'+id+'" name="delete-'+id+'" class="btn btn-xs btn-danger btn-delete"  onclick="soltar('+id+')"  data-toggle="tooltip" title="Soltar"><i class="fa fa-trash"></i></button>');
                    }else if(result.message == 'Max. Turno'){
                        $("#cambio-"+id).html('');
                        $("#cambio-"+id).html('<button type="button" class="btn btn-xs btn-info" disabled="disabled" data-toggle="tooltip" title="Máximo de turnos permitidos"><i class="fa fa-warning"></i></button>');
                    }else if(result.message == 'Fuera de Hora'){
                        //$("#result-"+id).html("Toma terminó");
                        $("#cambio-"+id).html('');
                        $("#cambio-"+id).html('<button type="button" class="btn btn-xs btn-warning" disabled="disabled" data-toggle="tooltip" title="La toma ya finalizó"><i class="fa fa-hourglass-3"></i></button>');

                    }
                }).fail(function() {

                    $("#result-"+id).html("Error");
                });

            });

        }

        function soltar(i,p){
            var id = i;
            var pla = p;

            //alert(id);
            $(document).ready(function(){

                $("#cambio-"+id).html('<i class="fa fa-spinner"></i>');
                var url = '{{ asset("/") }}'+id+'/deleteTurnoTomado';
                var data = $("#form-"+id).serialize();


                $.post(url, data, function(result){

                    $.each(result.arrayCupos, function(index){
                        //El span donde se muestra los cupos disponibles
                        $("#cupos-"+result.arrayCupos[index].id).html(result.arrayCupos[index].cupos);

                        if(result.arrayCupos[index].estado == 'Disponible'){
                            $("#cambio-"+result.arrayCupos[index].id).html('');
                            $("#cambio-"+result.arrayCupos[index].id).html('<button type="button" id="update-'+result.arrayCupos[index].id+'" name="update-'+result.arrayCupos[index].id+'" class="btn btn-xs btn-success btn-update"  onclick="tomar('+result.arrayCupos[index].id+','+pla+');"  data-toggle="tooltip" title="Tomar"><i class="fa fa-check"></i></button');

                        }else if (result.arrayCupos[index].estado == 'No Cupos') {
                            //Cambio el boton según estado (disponible, )
                            $("#cambio-"+result.arrayCupos[index].id).html('');
                            $("#cambio-"+result.arrayCupos[index].id).html('<button type="button" class="btn btn-xs btn-warning" disabled="disabled"  data-toggle="tooltip" title="No hay cupos"><i class="fa fa-lock"></i></button>');

                        }else if(result.arrayCupos[index].estado == 'ok-Tomado'){
                            $("#cambio-"+result.arrayCupos[index].id).html('');
                            $("#cambio-"+result.arrayCupos[index].id).html('<button type="button" id="delete-'+result.arrayCupos[index].id+'" name="delete-'+result.arrayCupos[index].id+'" class="btn btn-xs btn-danger btn-delete"  onclick="soltar('+result.arrayCupos[index].id+','+pla+');"  data-toggle="tooltip" title="Soltar"><i class="fa fa-trash"></i></button>');
                        }else if(result.arrayCupos[index].estado == 'Asignado'){
                            $("#cambio-"+result.arrayCupos[index].id).html('');
                            $("#cambio-"+result.arrayCupos[index].id).html('<button type="button" class="btn btn-xs btn-danger" disabled="disabled"  data-toggle="tooltip" title="Asignado"><i class="fa fa-cart-plus"></i></button>');

                        }else if(result.arrayCupos[index].estado == 'Pre-Toma'){
                            $("#cambio-"+result.arrayCupos[index].id).html('');
                            $("#cambio-"+result.arrayCupos[index].id).html('<button type="button" class="btn btn-xs btn-danger" disabled="disabled"  data-toggle="tooltip" title="Pre-Toma"><i class="fa fa-check-square-o"></i></button>');

                        }

                    })//end-each

                    /**/
                    if(result.message == 'Soltar'){
                        $('#update-'+id).remove();
                        $("#cambio-"+id).html('');
                        $("#cambio-"+id).html('<button type="button" id="update-'+id+'" name="update-'+id+'" class="btn btn-xs btn-success btn-update"  onclick="tomar('+id+','+pla+');"  data-toggle="tooltip" title="Tomar"><i class="fa fa-check"></i></button>');
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

        /*

         ---------------------------------------------------------------------------------------------
         ---------------------------------------------------------------------------------------------
         ---------------------------------------------------------------------------------------------
         ---------------------------------------------------------------------------------------------
         ---------------------------------------------------------------------------------------------

         */





    </script>



@endsection