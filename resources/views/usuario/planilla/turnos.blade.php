@extends('layouts.global-externo')

@section('content')
<section>
        <div class="container">

            <h4 class="text-center">Planilla</h4>
            <p class="m-b-25 text-center">Ver turnos tomados</p>

            <div class="card card-info">
                <div class="card-header">
                    <h5 class="card-title">Ver más en estadísticas</h5>
                </div>
                <div class="card-block">

                                  <div class="row form-group">
                                      <div class="col-lg-4">
                                          <!-- Total de cupos de todos los turnos de la planilla -->
                                          <b>Total Turnos :</b> {{ $cantTurnos }}
                                      </div>

                                      <div class="col-lg-4">
                                          <b>Turnos Sobra :</b> {{ $cantTurnosSobra }}
                                      </div>

                                      <div class="col-lg-4">
                                          <b>Turno Error :</b> {{ $cantErrores }}
                                      </div>
                                </div>


                </div>
            </div>




            <b class="text-center">@include('incluir/mensajes')</b>

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Turnos Tomados</h5>
                </div>
                <div class="card-block">


                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <b>Lunes <br> {{ $planilla->inicioPlanilla }} </b>
                            <hr class="alert-danger">

                            <div class="row">
                                <!-- Turnos del día lunes -->
                                @foreach($lun as $lunes)
                                    <div class="col-md-12">
                                        <!-- Imprimir Hora y Termino del Turno -->
                                        <b>{{ $lunes->inicio }} - {{ $lunes->termino }}</b> ({{ $lunes->cupos }})
                                        <!-- Imprimir Usuario por turno -->
                                        @foreach($lunes->empaques as $empaque)
                                            <div class="col-md-12">
                                                @if($empaque['rol'] == 'Coordinador')
                                                    <b><i> {{ $empaque['nombre'] }} </i></b>
                                                @else
                                                    {{ $empaque['nombre'] }}
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <b>Martes <br> {{ date('d-m-Y', strtotime ('+1 day' , strtotime($planilla->inicioPlanilla))) }} </b>
                            <hr class="alert-danger">

                            <div class="row">
                                <!-- Turnos del día martes -->
                                @foreach($mar as $martes)
                                    <div class="col-md-12">
                                        <!-- Imprimir Hora y Termino del Turno -->
                                        <b>{{ $martes->inicio }} - {{ $martes->termino }}</b> ({{ $martes->cupos }})

                                        <!-- Imprimir Usuario por turno -->
                                        @foreach($martes->empaques as $empaque)
                                            <div class="col-md-12">
                                                @if($empaque['rol'] == 'Coordinador')
                                                    <b><i> {{ $empaque['nombre'] }} </i></b>
                                                @else
                                                    {{ $empaque['nombre'] }}
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <b>Miércoles <br> {{ date('d-m-Y', strtotime ('+2 day' , strtotime($planilla->inicioPlanilla))) }} </b>
                            <hr class="alert-danger">

                            <div class="row">
                                <!-- Turnos del día miercoles -->
                                @foreach($mie as $miercoles)
                                    <div class="col-md-12">
                                        <!-- Imprimir Hora y Termino del Turno -->
                                        <b>{{ $miercoles->inicio }} - {{ $miercoles->termino }}</b> ({{ $miercoles->cupos }})

                                        <!-- Imprimir Usuario por turno -->
                                        @foreach($miercoles->empaques as $empaque)
                                            <div class="col-md-12">
                                                @if($empaque['rol'] == 'Coordinador')
                                                    <b><i> {{ $empaque['nombre'] }} </i></b>
                                                @else
                                                    {{ $empaque['nombre'] }}
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <b>Jueves <br> {{ date('d-m-Y', strtotime ('+3 day' , strtotime($planilla->inicioPlanilla))) }} </b>
                            <hr class="alert-danger">

                            <div class="row">
                                <!-- Turnos del día jueves -->
                                @foreach($jue as $jueves)
                                    <div class="col-md-12">
                                        <!-- Imprimir Hora y Termino del Turno -->
                                        <b>{{ $jueves->inicio }} - {{ $jueves->termino }}</b> ({{ $jueves->cupos }})

                                        <!-- Imprimir Usuario por turno -->
                                        @foreach($jueves->empaques as $empaque)
                                            <div class="col-md-12">
                                                @if($empaque['rol'] == 'Coordinador')
                                                    <b><i> {{ $empaque['nombre'] }} </i></b>
                                                @else
                                                    {{ $empaque['nombre'] }}
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <b>Viernes <br> {{ date('d-m-Y', strtotime ('+4 day' , strtotime($planilla->inicioPlanilla))) }} </b>
                            <hr class="alert-danger">

                            <div class="row">
                                <!-- Turnos del día viernes -->
                                @foreach($vie as $viernes)
                                    <div class="col-md-12">
                                        <!-- Imprimir Hora y Termino del Turno -->
                                        <b>{{ $viernes->inicio }} - {{ $viernes->termino }}</b> ({{ $viernes->cupos }})

                                        <!-- Imprimir Usuario por turno -->
                                        @foreach($viernes->empaques as $empaque)
                                            <div class="col-md-12">
                                                @if($empaque['rol'] == 'Coordinador')
                                                    <b><i> {{ $empaque['nombre'] }} </i></b>
                                                @else
                                                    {{ $empaque['nombre'] }}
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <b>Sábado <br> {{ date('d-m-Y', strtotime ('+5 day' , strtotime($planilla->inicioPlanilla))) }} </b>
                            <hr class="alert-danger">

                            <div class="row">
                                <!-- Turnos del día sábado -->
                                @foreach($sab as $sabado)
                                    <div class="col-md-12">
                                        <!-- Imprimir Hora y Termino del Turno -->
                                        <b>{{ $sabado->inicio }} - {{ $sabado->termino }}</b> ({{ $sabado->cupos }})

                                        <!-- Imprimir Usuario por turno -->
                                        @foreach($sabado->empaques as $empaque)
                                            <div class="col-md-12">
                                                @if($empaque['rol'] == 'Coordinador')
                                                    <b><i> {{ $empaque['nombre'] }} </i></b>
                                                @else
                                                    {{ $empaque['nombre'] }}
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <b>Domingo <br> {{ date('d-m-Y', strtotime ('+6 day' , strtotime($planilla->inicioPlanilla))) }} </b>
                            <hr class="alert-danger">

                            <div class="row">
                                <!-- Turnos del día domingo -->
                                @foreach($dom as $domingo)
                                    <div class="col-md-12">
                                        <!-- Imprimir Hora y Termino del Turno -->
                                        <b>{{ $domingo->inicio }} - {{ $domingo->termino }}</b> ({{ $domingo->cupos }})

                                        <!-- Imprimir Usuario por turno -->
                                        @foreach($domingo->empaques as $empaque)
                                            <div class="col-md-12">
                                                @if($empaque['rol'] == 'Coordinador')
                                                    <b><i> {{ $empaque['nombre'] }} </i></b>
                                                @else
                                                    {{ $empaque['nombre'] }}
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                        </div>
                        <div class="col-md-6"></div>

                    </div>
                            
                            <div class="row">
                                <div class="col-md-12 text-center">
                                  <a href="{{ url('usuario/planilla/'.$planilla->id.'/opciones') }}" class="btn btn-sm btn-success">Regresar  </a>
                                  <a href="{{ url('usuario/planilla/'.$planilla->id.'/disponible') }}" class="btn btn-sm btn-primary">Disponible</a>
                                </div>
                            </div>

                         

                            <div class="p-t-35"></div>
                            <div class="alert alert-info" role="alert">
                                <strong>** </strong> Las personas que estan en negrita son coordinadores.
                                <br>
                                <strong>** </strong> "Turno Sobra" es la cantidad de turnos que no han sido tomados.
                                <br>
                                <strong>** </strong> Los números que aparecen en parentesis al lado de cada hora de los
                                turnos son el máximo de cupos permitidos.
                                <br>
                                <strong>** </strong> "Turno Error" indican que se excedió la cantidad permitida de empaques
                                que van asisitir al turno en la Planilla. <br>Ej: Si un turno permite solo 4 empaques y por
                                error del sistema tomarón 5 (que es difícil que suceda) la página muestra un mensaje de
                                alerta. Cabe destacar que el primero en la lista es el dueño del turno.
                            </div>

              </div>
            </div>

        </div>
</section>
@endsection



@section('js')


@endsection


