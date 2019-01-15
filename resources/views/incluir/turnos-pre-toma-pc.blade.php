@foreach($turnos as $turno)

@if($x == "")
        <?php
        $x = $turno->fecha;
        $fec_jue = date('Y-m-d', strtotime ('+5 day' , strtotime($turno->fecha)));
        ?>

        <div class="col-3 col-sm-3 col-md-1 col-lg-1 text-center"><!-- Columna Dia -->
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
        <div class="col-3 col-sm-3 col-md-2 col-lg-2 text-center"><!-- Columna Dia -->

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
        <div class="col-3 col-sm-3 col-md-1 col-lg-1 text-center"><!-- Columna Dia -->

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

              <input type="button" value="Toma" id="update-{{ $turno->id }}" name="update-{{ $turno->id }}" class="btn btn-xs btn-success btn-update"  onclick="tomar('{{$turno->id}}')"/>
            </div>

            <!-- Sino, muestra turno en rojo deshabilitado xq lo tomé en la pre-toma y no lo puedo soltar -->
            @elseif($turno->addEstado == 'Toma')
              <div id="cambio-{{ $turno->id }}">
                  <input type="button" value="Toma" class="btn btn-xs btn-danger"  disabled="disabled"/>
              </div>


            <!-- Sino, muestra turno en rojo deshabilitado xq me lo asignaron y no lo puedo soltar -->
            @elseif($turno->addEstado == 'Asignado')
                <div id="cambio-{{ $turno->id }}">
                    <input type="button" value="Asig." class="btn btn-xs btn-danger"  disabled="disabled"/>
                </div>

            <!-- Si no muestra turno en rojo xq ya lo tengo tomado -->
            @elseif($turno->addEstado == 'Soltar')
                <div id="cambio-{{ $turno->id }}">
                    <input type="button" value="Soltar" id="delete-{{ $turno->id }}" name="delete-{{ $turno->id }}" class="btn btn-xs btn-danger btn-delete"  onclick="soltar('{{$turno->id}}')"/>
                                  </div>

            <!-- Sino muestra turno en warning xq ya no quedan cupos -->
            @elseif($turno->addEstado == 'No Cupos')
              <div id="cambio-{{ $turno->id }}">
                  <input type="button" value="Full" id="no-cupos-{{ $turno->id }}" name="no-cupos-{{ $turno->id }}" class="btn btn-xs btn-warning" disabled="disabled"/>
              </div>

                              @endif



      </form>

    </div> <!-- fin div id -->
    <hr class="alert-success">



@endforeach
  </div><!-- cierro el ultimo div del dia -->
