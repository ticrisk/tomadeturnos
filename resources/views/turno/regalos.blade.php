@extends('layouts.global-nero')

@section('content')
<section>
    <div class="container">

        <h5 class="text-center">Regalos</h5>
        <!--<p class="m-b-25 text-center">Listado de mis faltas</p>-->



        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Tomar Turnos</h5>
            </div>
            <div class="card-body">

                <b class="text-center">@include('incluir/mensajes')</b>

                            <div class="row hidden-md-down">

                                <div class="col-lg-1"><b>Día</b></div>
                                <div class="col-lg-2"><b>Fecha</b></div>
                                <div class="col-lg-1"><b>Inicio</b></div>
                                <div class="col-lg-2"><b>Termino</b></div>
                                <div class="col-lg-2"><b>¿Coordinación?</b></div>
                                <div class="col-lg-2"><b>Dueño</b></div>

                                <div class="col-md-2 col-lg-2 text-center"><b>Tomar</b></div>
                            </div>
                            <hr class="hidden-md-down">

                            @foreach($turnos as $turno)

                                    {!! Form::open(['action' => 'TurnoController@postRegalos', 'method' => 'POST']) !!}

                                    <div class="row">
                                            {!! form::hidden('id', $turno->id) !!}
                                            <label class="col-6 col-sm-6 col-md-6 hidden-lg-up">Día</label>
                                            <div class="col-6 col-sm-6 col-md-6 col-lg-1">
                                                <?php
                                                $dia = date('N', strtotime($turno->fecha) ); ?>
                                                {{ $turno->diaSemana }}
                                            </div>

                                            <label class="col-6 col-sm-6 col-md-6 hidden-lg-up">Fecha</label>
                                            <div class="col-6 col-sm-6 col-md-6 col-lg-2">
                                                {{ $turno->fecha }}
                                            </div>

                                            <label class="col-6 col-sm-6 col-md-6 hidden-lg-up">Inicio</label>
                                            <div class="col-6 col-sm-6 col-md-6 col-lg-1">
                                                {{ $turno->inicio }}
                                            </div>

                                            <label class="col-6 col-sm-6 col-md-6 hidden-lg-up font-italic">Termino</label>
                                            <div class="col-6 col-sm-6 col-md-6 col-lg-2">
                                                {{ $turno->termino }}
                                            </div>

                                            <label class="col-6 col-sm-6 col-md-6 hidden-lg-up">¿Coordinación?</label>
                                            <div class="col-6 col-sm-6 col-md-6 col-lg-2">
                                                {{ $turno->coordinador }}
                                            </div>

                                            <label class="col-6 col-sm-6 col-md-6 hidden-lg-up">Dueño</label>
                                            <div class="col-6 col-sm-6 col-md-6 col-lg-2">
                                                {{ $turno->nombre }} {{ $turno->apellido }}
                                            </div>

                                            <div class="col-xs-12 col-sm-12  col-md-12 col-lg-2 text-center">
                                                {!! Form::submit('Tomar', ['class'=>'btn btn-sm btn-success']) !!}
                                            </div>
                                    </div> <!-- end row -->
                                    {!! Form::close() !!}
                                <hr>

                            @endforeach

                    </div>
                </div>
            </div>
</section>
@endsection



@section('js')


@endsection