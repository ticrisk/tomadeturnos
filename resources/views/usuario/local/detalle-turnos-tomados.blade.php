@extends('layouts.global-externo')

@section('content')
    <section>
        <div class="container">

            <h4 class="text-center">Turnos Tomados <i class="fa fa-star text-warning pull-right" aria-hidden="true" data-toggle="tooltip" title="Opción Premium"></i></h4>

            <p class="m-b-25 text-center">Muestra todos los turnos tomados por el empaque</p>

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Historial de Turnos</h5>
                </div>
                <div class="card-block">
                    <b class="text-center">@include('incluir/mensajes')</b>
                        <div class="row hidden-md-down">
                            <div class="col-lg-2"><b>Fecha</b></div>
                            <div class="col-lg-2"><b>Inicio</b></div>
                            <div class="col-lg-2"><b>Termino</b></div>
                            <div class="col-lg-2"><b>Estado</b></div>
                            <div class="col-lg-2"><b>Tipo</b></div>
                            <div class="col-lg-2"><b>Tomado El</b></div>
                        </div>
                    <hr class="hidden-md-down">
                    @foreach($turnos as $turno)
                        <div class="row">
                            <div class="col-6 col-md-6 hidden-lg-up text-md-right"><b>Fecha:</b></div>
                            <div class="col-6 col-md-6 col-lg-2">{{ $turno->Turno->fecha }}</div>

                            <div class="col-6 col-md-6 hidden-lg-up text-md-right"><b>Inicio:</b></div>
                            <div class="col-6 col-md-6 col-lg-2">{{ $turno->Turno->inicio }}</div>

                            <div class="col-6 col-md-6 hidden-lg-up text-md-right"><b>Termino:</b></div>
                            <div class="col-6 col-md-6 col-lg-2">{{ $turno->Turno->termino }}</div>

                            <div class="col-6 col-md-6 hidden-lg-up text-md-right"><b>Estado:</b></div>
                            <div class="col-6 col-md-6 col-lg-2">{{ $turno->estado }}</div>

                            <div class="col-6 col-md-6 hidden-lg-up text-md-right"><b>Tipo:</b></div>
                            <div class="col-6 col-md-6 col-lg-2">{{ $turno->tipo }}</div>

                            <div class="col-6 col-md-6 hidden-lg-up text-md-right"><b>Tomado el:</b></div>
                            <div class="col-6 col-md-6 col-lg-2">{{ $turno->created_at }}</div>
                        </div>
                        <hr class="hidden-lg-up">
                    @endforeach

                    <hr class="hidden-md-down">
                    <div class="text-center">
                        <a href="{{ url('usuario/local/detalle-cobro-mensual?local='.$request->local.'&fecha='.$request->fecha) }}" class="btn btn-primary  btn-sm "  data-toggle="tooltip" title="Volver">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



@section('js')


@endsection


