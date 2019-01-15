@extends('layouts.global-nero')

@section('content')
    <section>
        <div class="container">

            <h4 class="text-center">Detalle Cobro Mensual  <i class="fa fa-star text-warning pull-right" aria-hidden="true" data-toggle="tooltip" title="Opción Premium"></i></h4>
            <p class="m-b-25 text-center">Detalle del total que debe pagar el encargado en el mes</p>

            <b class="text-center">@include('incluir/mensajes')</b>

            <div class="card card-info">
                <div class="card-header">
                    <h5 class="card-title">Total a Pagar</h5>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-4"><b>Cant. Usuarios que tomaron turnos:</b> {{ $cantUserTakeTurn }}</div>
                        <span class="col-md-5"><b>Precio por Empaque:</b> {{ number_format($precio,0, '.', '') }}</span>
                        <span class="col-md-3"><b>Total a Pagar:</b> {{ $total = $precio * $cantUserTakeTurn }}</span>
                    </div>
                </div>
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Personas que tomaron turnos</h5>
                </div>
                <div class="card-block">
                    <div class="row  hidden-sm-down">
                        <div class="col-md-2"><b>Rut</b></div>
                        <div class="col-md-5"><b>Nombre Completo</b></div>
                        <div class="col-md-3"><b>Estado</b></div>
                        <div class="col-md-2 text-center"><b>Detalle</b></div>
                    </div>
                    <hr class="hidden-sm-down">
                    @foreach($infoUsers as $infoUser)
                    <div class="row p-t-5">
                        <div class="col-6 col-sm-6 hidden-md-up text-sm-right"><b>Rut:</b></div>
                        <div class="col-6 col-sm-6 col-md-2">{{ $infoUser->rut }}</div>

                        <div class="col-6 col-sm-6 hidden-md-up text-sm-right"><b>Nombre:</b></div>
                        <div class="col-6 col-sm-6 col-md-5">{{ $infoUser->nombre }} {{ $infoUser->apellido }}</div>

                        <div class="col-6 col-sm-6 hidden-md-up text-sm-right"><b>Estado:</b></div>
                        <div class="col-6 col-sm-6 col-md-3">{{ $infoUser->estado }}</div>

                        <div class="col-12 col-sm-12 col-md-2 text-center">
                            <div class="hidden-md-up p-t-30"></div>
                            {{-- <div class="col-sm-2"><a href="" class="btn btn-info btn-xs"  data-toggle="tooltip" title="Ver Turnos"><i class="fa fa-calendar" aria-hidden="true"></i></a></div> --}}
                            {!! Form::open(['route' => 'usuario.local.detalle-turnos-tomados', 'method' => 'GET']) !!}
                                {!! Form::hidden('local', $local) !!}
                                {!! Form::hidden('user', $infoUser->idUserLocal) !!}
                                {!! Form::hidden('fecha', $fecha) !!}
                                {!! Form::submit('Ver', ['class'=>'btn btn-sm btn-info']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <hr class="hidden-md-up">
                    @endforeach

                    <hr class="hidden-sm-down">
                    <div class="text-center">
                        <a href="{{ url('usuario/local/'.$local.'/pago-encargado') }}" class="btn btn-primary  btn-sm "  data-toggle="tooltip" title="Volver">Volver</a>
                    </div>

                    <div class="p-t-35"></div>
                    <div class="alert alert-danger" role="alert">
                        <strong>** Cant. Usuarios que tomaron turnos:</strong>  Es la cantidad exacta de los empaques del local que tomaron
                        turnos, ya sea toma de turnos, repechaje, pre-toma, regalos, cambios y asignados. Contando de igual forma si el empaque regaló
                        el turno o quedó desvinculadodel local. Tener en considereación que se toma en cuenta el día en que el empaque <b>tomó</b> el turno y no la fecha
                        en que corresponde el turno. Ej: yo tomé un turno el 28 de Febrero del 2018, y el turno que tomé es para el día 07 de Marzo del 2018.
                        Por ende, entra en la boleta de Febrero ya que fue el día en que se tomó el turno.
                        <br><br>
                        <strong>** Precio por Empaque:</strong>  Es el precio actual que se esta cobrando por empaque que utiliza la pag.
                        <br><br>
                        <strong>** </strong> El cobro que se realiza corresponde desde el primer al último día del mes.
                        <br><br>
                        <strong>** </strong> El primer día de cada mes, se enviará un email indicando la cifra exacta de cuanto se debe pagar por la utilización
                        del mes anterior y se podrá pagar entre los primeros 7 días del mes. Al octavo día se <b>bloqueará</b> el local. Ej: Se envia un email de cobranza
                        el 01 de Marzo del 2018 con la boleta del mes de Febrero. Se podrá pagar hasta el 07 de Marzo, si no se paga, el día 08 de Marzo se
                        bloqueará el local.
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



@section('js')


@endsection


