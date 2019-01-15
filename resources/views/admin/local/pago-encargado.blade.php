@extends('layouts.global-nero')

@section('content')
    <section>
        <div class="container">

            <h4 class="text-center">Pagos del Encargado</h4>
            <p class="m-b-25 text-center">Pagos mensuales realizados por el encargado</p>

            <b class="text-center">@include('incluir/mensajes')</b>

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Ingrese Año y Mes</h5>
                </div>
                <div class="card-block">

                    {!! Form::open(['route' => 'admin.local.detalle-cobro-mensual', 'method' => 'GET']) !!}

                    {!! Form::hidden('local', $local->id) !!}
                    <div class="row">

                        <label class="col-12 col-sm-4 col-lg-2 control-label">Fecha Año-Mes</label>
                        <div class="col-12 col-sm-4 col-lg-4">
                            {!! Form::text('fecha', null, ['class'=>'datetimepicker form-control','placeholder'=>'2018-02']) !!}
                        </div>
                        <div class="hidden-lg-up p-t-55"></div>
                        <div class="col-12 col-sm-4 col-lg-6">{!! Form::submit('Calcular', ['class'=>'btn btn-sm btn-success']) !!}</div>

                    </div>
                    {!! Form::close() !!}

                    <hr>
                    <div class="row hidden-md-down">
                        <div class="col-lg-2"><b>Estado</b></div>
                        <div class="col-lg-2"><b>Pago Desde</b></div>
                        <div class="col-lg-2"><b>Pago Hasta</b></div>
                        <div class="col-lg-2"><b>Tipo de Pago</b></div>
                        <div class="col-lg-2"><b>Total Pago</b></div>
                        <div class="col-lg-2"><b>Pago Por</b></div>
                    </div>
                    <hr class="hidden-md-down">
                    @foreach($pagos as $pago)
                        <div class="row">
                            <label class="col-6 hidden-lg-up control-label">Estado:</label>
                            <div class="col-6 col-lg-2">{{ $pago->estado }}</div>

                            <label class="col-6 hidden-lg-up control-label">Pago Desde:</label>
                            <div class="col-6 col-lg-2">{{ $pago->pagoDesde }}</div>

                            <label class="col-6 hidden-lg-up control-label">Pago Hasta:</label>
                            <div class="col-6 col-lg-2">{{ $pago->pagoHasta }}</div>

                            <label class="col-6 hidden-lg-up control-label">Tipo de Pago:</label>
                            <div class="col-6 col-lg-2">{{ $pago->tipoPago }}</div>

                            <label class="col-6 hidden-lg-up control-label">Total:</label>
                            <div class="col-6 col-lg-2">{{ '$'. $pago->pagoTotal }}</div>

                            <label class="col-6 hidden-lg-up control-label">Pagado Por:</label>
                            <div class="col-6 col-lg-2">{{ $pago->Local_User->User->nombre }} {{ $pago->Local_User->User->apellido }}</div>
                        </div>
                        <hr class="hidden-lg-up">
                    @endforeach

                    <div class="row form-group">
                        <div class="col-lg-12 text-center p-t-45">
                            {!! $pagos->links('vendor.pagination.simple-bootstrap-4') !!}
                        </div>
                    </div>

                    <hr>
                    <div class="row form-group">
                        <div class="col-lg-12 text-center">

                            <a href="{{ url('admin/local/'.$local->id.'/opciones') }}" class="btn btn-sm btn-primary">Volver</a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
@endsection



@section('js')


@endsection


