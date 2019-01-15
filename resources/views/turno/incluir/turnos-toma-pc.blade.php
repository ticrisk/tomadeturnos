
@foreach($turnos as $turno)

@if($x == "")
    <?php
        $x = $turno->fecha;
        $fec_jue = date('Y-m-d', strtotime ('+5 day' , strtotime($turno->fecha)));
    ?>
    <div class="hidden-xs-down col-sm-2 col-md-2 col-lg-2"></div><!-- espacio -->
    <div class="col-3 col-sm-1 col-md-1 col-lg-1 text-center"><!-- Columna Dia col-3 col-sm-2 -->
    <label class="text-info">Lunes</label>
    <label class="text-dark">{{ date('d-m', strtotime($turno->fecha)) }}</label>
    <hr class="alert-dark">
@endif


@if($turno->fecha != $x && $turno->fecha != $fec_jue)
    <?php
        $x = $turno->fecha;
        $dia = date('N', strtotime($turno->fecha) );
        //$cont++;
    ?>
    </div>

    <div class="col-3 col-sm-1 col-md-1 col-lg-1 text-center"><!-- Columna Dia -->

    <label class="text-info">{{ $semana[$dia] }}</label>
    <label class="text-dark">{{ date('d-m', strtotime($turno->fecha)) }} </label>
    <hr class="alert-dark">

@elseif($turno->fecha != $x && $turno->fecha == $fec_jue)
    <?php
        $x = $turno->fecha;
        $dia = date('N', strtotime($turno->fecha) );
        //$cont++;
    ?>
    </div>
    <div class="col-3 col-sm-1 col-md-1 col-lg-1 text-center"><!-- Columna Dia -->

    <label class="text-info">{{ $semana[$dia] }}</label>
    <label class="text-dark">{{ date('d-m', strtotime($turno->fecha)) }}</label>
    <hr class="alert-dark">
@endif

                              <div  data-id="{{ $turno->id }}" class="fila"> <!-- inicio div id -->
                                  
                                <form id="form-{{ $turno->id }}">
                                
                                {{ csrf_field() }}

                                    <label class="font-italic">{{ $turno->inicio }}</label>
                                    <label class="font-italic">{{ $turno->termino }}</label>
                                    <label class="text-danger font-italic" >
                                        <span id="cupos-{{ $turno->id }}">{{ $turno->allTomados }} </span> - {{ $turno->cupos }}
                                    </label>

                                    <div class="font-italic" id="result-{{ $turno->id }}" class="text-center">-</div>

                                    <!-- Si no tengo turno tomado muestra en verde -->
                                    @if($turno->addEstado == 'Disponible')
                                    <div id="cambio-{{ $turno->id }}">
                                        <button type="button" id="update-{{ $turno->id }}" name="update-{{ $turno->id }}" class="btn btn-xs btn-success btn-update" onclick="tomar('{{$turno->id}}','{{$turno->planilla_id}}');"><i class="fa fa-check"></i></button>
                                    </div>

                                    <!-- Si no muestra turno en warning xq ya no quedan cupos -->
                                    @elseif($turno->addEstado == 'No Cupos')
                                    <div id="cambio-{{ $turno->id }}">
                                        <button type="button" id="no-cupos-{{ $turno->id }}" name="no-cupos-{{ $turno->id }}" class="btn btn-xs btn-warning" disabled="disabled" data-toggle="tooltip" title="No hay cupos"><i class="fa fa-lock"></i></button>
                                    </div>

                                    <!-- Si no muestra turno en rojo xq ya lo tengo tomado -->
                                    @elseif($turno->addEstado == 'Soltar')
                                    <div id="cambio-{{ $turno->id }}">
                                        <button type="button" id="delete-{{ $turno->id }}" name="delete-{{ $turno->id }}" class="btn btn-xs btn-danger btn-delete"  onclick="soltar('{{$turno->id}}','{{$turno->planilla_id}}');"><i class="fa fa-trash"></i></button>
                                    </div>

                                    <!-- Sino, muestra turno en rojo deshabilitado xq me lo asignaron y no lo puedo soltar -->
                                    @elseif($turno->addEstado == 'Asignado')
                                      <div id="cambio-{{ $turno->id }}">
                                          <button type="button" class="btn btn-xs btn-danger"  disabled="disabled" data-toggle="tooltip" title="Asignado"><i class="fa fa-cart-plus"></i></button>
                                    </div> 

                                    <!-- Sino, muestra turno en rojo deshabilitado xq lo tomé en la pre-toma y no lo puedo soltar -->
                                    @elseif($turno->addEstado == 'Pre-Toma')
                                      <div id="cambio-{{ $turno->id }}">
                                          <button type="button" class="btn btn-xs btn-danger"  disabled="disabled" data-toggle="tooltip" title="Pre-Toma"><i class="fa fa-check-square-o"></i></button>
                                      </div>

                                    @endif

                                  
                              </form>       
                                    <hr>
                              </div> <!-- fin div id -->

                        
                      @endforeach
                          </div><!-- cierro el ultimo div del dia -->