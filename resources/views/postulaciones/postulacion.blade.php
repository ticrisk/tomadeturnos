@extends('layouts.global-nero')

@section('content')

    <section>
        <div class="container">

            <h3 class="text-center">Postulación</h3>
            <p class="m-b-25 text-center">¡Apúrate!, Antes que se acaben</p>


            <div class="row">

                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5 class="card-title">Postulación {{ $postulacion->id }} <br> {{ $postulacion->Local->Cadena->nombre }} - {{ $postulacion->Local->nombre }}</h5>
                        </div>
                        <div class="card-body text-center">
                            <form id="form-{{ $postulacion->id }}">

                                {{ csrf_field() }}

                                <b>Inicio :</b> {{ $postulacion->inicio }}
                                <br>
                                <b>Termino :</b> {{ $postulacion->termino }}
                                <br>
                                <b>Tipo :</b> {{ $postulacion->activarLista }}
                                <br>
                                <br>
                                <p class="text-center">{{ $postulacion->descripcion }}</p>
                                <hr>

                                <b>Cupos Tomados : </b> <span id="cupos-{{ $postulacion->id }}"> {{ $postulacion->cuposTomados }} </span>  de {{ $postulacion->cupos }}
                                <br>
                                <div id="result-{{ $postulacion->id }}" class="text-center">-</div>


                                <!-- Si no tengo turno tomado muestra en verde -->
                                @if($postulacion->addEstado == 'ok')
                                    <div id="cambio-{{ $postulacion->id }}">
                                        <input type="button" value="Tomar Cupo" id="update-{{ $postulacion->id }}" name="update-{{ $postulacion->id }}" class="btn btn-sm btn-success btn-update"  onclick="tomar('{{$postulacion->id}}');"/>
                                    </div>
                                    <!-- Si no muestra turno en warning xq ya no quedan cupos -->
                                @elseif($postulacion->addEstado == 'no-cupos')
                                    <div id="cambio-{{ $postulacion->id }}">
                                        <input type="button" value="No Cupos" id="no-cupos-{{ $postulacion->id }}" name="no-cupos-{{ $postulacion->id }}" class="btn btn-sm btn-warning" disabled="disabled"/>
                                    </div>
                                    <!-- azar no permite tomar cupo -->
                                @elseif($postulacion->addEstado == 'azar')
                                    <div id="cambio-{{ $postulacion->id }}">
                                        <input type="button" value="Sorteo Automático" id="azar-{{ $postulacion->id }}" name="azar-{{ $postulacion->id }}" class="btn btn-sm btn-warning" disabled="disabled"/>
                                    </div>
                                    <!-- Si muestra "mio" es porque ya tomé el cupo -->
                                @else
                                    <div id="cambio-{{ $postulacion->id }}">
                                        <input type="button" value="¡El Cupo es Mío!" id="mio-{{ $postulacion->id }}" name="mio-{{ $postulacion->id }}" class="btn btn-sm btn-success" disabled="disabled"/>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection




@section('js')
    <script type="text/javascript">

        function tomar(i){
            var id = i;



            $(document).ready(function(){

                var url = '{{ asset("/") }}'+id+'/postPostulacion';


                var data = $("#form-"+id).serialize();
                //alert(data);

                $.post(url, data, function(result){
                    //$("#result-"+id).html(result.message);
                    //alert(result.xxx);
                    $("#cupos-"+id).html(result.cuposTomados);

                    if(result.estado == 'ok'){
                        $('#update-'+id).remove();
                        $("#cambio-"+id).html('');
                        $("#cambio-"+id).html('<input type="button" value="¡Ganaste el Cupo!" disabled class="btn btn-sm btn-success"/>');
                    }else if(result.estado == 'no-cupos'){
                        $('#update-'+id).remove();
                        $("#cambio-"+id).html('');
                        $("#cambio-"+id).html('<input type="button" value="¡No Quedan Cupos!" disabled class="btn btn-sm btn-warning"/>');
                    }else if(result.estado == 'privada'){
                        $('#update-'+id).remove();
                        $("#cambio-"+id).html('');
                        $("#cambio-"+id).html('<input type="button" value="Es una Lista Privada" disabled class="btn btn-sm btn-danger"/>');
                    }else if(result.estado == 'mio'){
                        $('#update-'+id).remove();
                        $("#cambio-"+id).html('');
                        $("#cambio-"+id).html('<input type="button" value="¡El Cupo es Mío!" disabled class="btn btn-sm btn-success"/>');
                    }else if(result.estado == 'finalizo'){
                        $('#update-'+id).remove();
                        $("#cambio-"+id).html('');
                        $("#cambio-"+id).html('<input type="button" value="¡Finalizó la Postulación!" disabled class="btn btn-sm btn-primary"/>');
                    }else if(result.estado == 'azar'){
                        $('#update-'+id).remove();
                        $("#cambio-"+id).html('');
                        $("#cambio-"+id).html('<input type="button" value="Sorteo Automático" disabled class="btn btn-sm btn-danger"/>');
                    }

                }).fail(function() {

                    $("#result-"+id).html("Error");
                });

            });

        }

    </script>

@endsection