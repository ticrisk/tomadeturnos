<section>
    <div class="container">
        <div id="accordion-collapsed" class="accordion accordion-collapsed accordion-icon" role="tablist">
            <div class="card">
                <div class="card-header" role="tab" id="headingOne">
                    <h5>
                        <a class="collapsed" data-toggle="collapse" href="#collapsedOne" aria-expanded="false" aria-controls="collapsedOne">
                            Lunes
                        </a>
                    </h5>
                </div>
                <div id="collapsedOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion-collapsed">
                    <div class="card-body">
                        <label class="text-center text-primary"><i>Lunes</i></label><hr>
                        @foreach($turnos as $turno)
                            @if(date('D', strtotime($turno->fecha)) == 'Mon')
                                <div class="col-12 col-sm-12 hidden-md-up text-center">
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
                                            @elseif($turno->addEstado == 'Toma')
                                                <div id="cambio-{{ $turno->id }}">
                                                    <button type="button" class="btn btn-xs btn-danger"  disabled="disabled" data-toggle="tooltip" title="Toma"><i class="fa fa-check-square-o"></i></button>
                                                </div>
                                            @endif
                                        </form>
                                        <hr>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" role="tab" id="headingTwo">
                    <h5>
                        <a class="collapsed" data-toggle="collapse" href="#collapsedTwo" aria-expanded="false" aria-controls="collapsedTwo">
                            Martes y Miércoles
                        </a>
                    </h5>
                </div>
                <div id="collapsedTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion-collapsed">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 col-sm-6 hidden-md-up text-center">
                                <label class="text-center text-primary"><i>Martes</i></label><hr>
                                <div class="row">
                                    @foreach($turnos as $turno)
                                        @if(date('D', strtotime($turno->fecha)) == 'Tue')
                                            <div class="col-12 col-sm-12 hidden-md-up text-center">
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
                                                        @elseif($turno->addEstado == 'Toma')
                                                            <div id="cambio-{{ $turno->id }}">
                                                                <button type="button" class="btn btn-xs btn-danger"  disabled="disabled" data-toggle="tooltip" title="Toma"><i class="fa fa-check-square-o"></i></button>
                                                            </div>
                                                        @endif
                                                    </form>
                                                    <hr>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-6 col-sm-6 hidden-md-up text-center">
                                <label class="text-center text-primary"><i>Miércoles</i></label><hr>
                                <div class="row">
                                    @foreach($turnos as $turno)
                                        @if(date('D', strtotime($turno->fecha)) == 'Wed')
                                            <div class="col-12 col-sm-12 hidden-md-up text-center">
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
                                                        @elseif($turno->addEstado == 'Toma')
                                                            <div id="cambio-{{ $turno->id }}">
                                                                <button type="button" class="btn btn-xs btn-danger"  disabled="disabled" data-toggle="tooltip" title="Toma"><i class="fa fa-check-square-o"></i></button>
                                                            </div>
                                                        @endif
                                                    </form>
                                                    <hr>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" role="tab" id="headingThree">
                    <h5>
                        <a class="collapsed" data-toggle="collapse" href="#collapsedThree" aria-expanded="false" aria-controls="collapsedThree">
                            Jueves y Viernes
                        </a>
                    </h5>
                </div>
                <div id="collapsedThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion-collapsed">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 col-sm-6 hidden-md-up text-center">
                                <label class="text-center text-primary"><i>Jueves</i></label><hr>
                                <div class="row">
                                    @foreach($turnos as $turno)
                                        @if(date('D', strtotime($turno->fecha)) == 'Thu')
                                            <div class="col-12 col-sm-12 hidden-md-up text-center">
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
                                                        @elseif($turno->addEstado == 'Toma')
                                                            <div id="cambio-{{ $turno->id }}">
                                                                <button type="button" class="btn btn-xs btn-danger"  disabled="disabled" data-toggle="tooltip" title="Toma"><i class="fa fa-check-square-o"></i></button>
                                                            </div>
                                                        @endif
                                                    </form>
                                                    <hr>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-6 col-sm-6 hidden-md-up text-center">
                                <label class="text-center text-primary"><i>Viernes</i></label><hr>
                                <div class="row">
                                    @foreach($turnos as $turno)
                                        @if(date('D', strtotime($turno->fecha)) == 'Fri')
                                            <div class="col-12 col-sm-12 hidden-md-up text-center">
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
                                                        @elseif($turno->addEstado == 'Toma')
                                                            <div id="cambio-{{ $turno->id }}">
                                                                <button type="button" class="btn btn-xs btn-danger"  disabled="disabled" data-toggle="tooltip" title="Toma"><i class="fa fa-check-square-o"></i></button>
                                                            </div>
                                                        @endif
                                                    </form>
                                                    <hr>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" role="tab" id="headingFour">
                    <h5>
                        <a class="collapsed" data-toggle="collapse" href="#collapsedFour" aria-expanded="false" aria-controls="collapsedFour">
                            Sábado y Domingo
                        </a>
                    </h5>
                </div>
                <div id="collapsedFour" class="collapse" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion-collapsed">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 col-sm-6 hidden-md-up text-center">
                                <label class="text-center text-primary"><i>Sábado</i></label><hr>
                                <div class="row">
                                    @foreach($turnos as $turno)
                                        @if(date('D', strtotime($turno->fecha)) == 'Sat')
                                            <div class="col-12 col-sm-12 hidden-md-up text-center">
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
                                                        @elseif($turno->addEstado == 'Toma')
                                                            <div id="cambio-{{ $turno->id }}">
                                                                <button type="button" class="btn btn-xs btn-danger"  disabled="disabled" data-toggle="tooltip" title="Toma"><i class="fa fa-check-square-o"></i></button>
                                                            </div>
                                                        @endif
                                                    </form>
                                                    <hr>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-6 col-sm-6 hidden-md-up text-center">
                                <label class="text-center text-primary"><i>Domingo</i></label><hr>
                                <div class="row">
                                    @foreach($turnos as $turno)
                                        @if(date('D', strtotime($turno->fecha)) == 'Sun')
                                            <div class="col-12 col-sm-12 hidden-md-up text-center">
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
                                                        @elseif($turno->addEstado == 'Toma')
                                                            <div id="cambio-{{ $turno->id }}">
                                                                <button type="button" class="btn btn-xs btn-danger"  disabled="disabled" data-toggle="tooltip" title="Toma"><i class="fa fa-check-square-o"></i></button>
                                                            </div>
                                                        @endif
                                                    </form>
                                                    <hr>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>