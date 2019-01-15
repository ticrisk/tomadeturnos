@extends('layouts.global-nero')

@section('content')
    <section>
        <div class="container">

            <h4 class="text-center">Pagos</h4>
            <b class="text-center">@include('incluir/mensajes')</b>

            <div class="card card-info">
                <div class="card-header">
                    <h5 class="card-title">Información Extra</h5>
                </div>
                <div class="card-body">

                {{-- --}}
                    <div class="row">
                        <div class="col-md-3"> <b>Nombre:</b>  {{ $local->User->nombre }} {{ $local->User->apellido }}</div>
                        <div class="col-md-3"> <b>Cadena:</b> {{ $local->Local->Cadena->nombre }}</div>
                        <div class="col-md-3"> <b>Local:</b> {{ $local->Local->nombre }}</div>
                        <div class="col-md-3"> <b>Estado:</b> {{ $local->Local->estado }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4"> <b>Deuda total:</b>  {{ '$'.$deudaTotal }}</div>
                        <div class="col-md-4"> <b>Deuda de este mes:</b>  {{ '$'.$deudaDelMes }}</div>
                        <div class="col-md-4"> <b>Total deuda pendientes:</b>  {{ '$'.$deudaBoletas }}</div>
                    </div>


                </div>
            </div>





            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Pagos</h5>
                </div>
                <div class="card-body">

                    <div class="row hidden-md-down">
                        <label class="col-lg-2">Fecha Pago</label>
                        <label class="col-lg-2">Válido Desde</label>
                        <label class="col-lg-2">Válido Hasta</label>
                        <label class="col-lg-2">Estado</label>
                        <label class="col-lg-2">Valor</label>
                        <label class="col-lg-1">Editar</label>
                        <label class="col-lg-1">Detalle</label>
                    </div>
                    <hr class="hidden-md-down">

                    @foreach($pagos as $pago)


                        <div class="row">

                            <label class="col-6 hidden-lg-up">Fecha Pago:</label>
                            <div class="col-6 col-lg-2"> {{ $pago->fechaPago }} </div>

                            <label class="col-6 hidden-lg-up">Válido Desde:</label>
                            <div class="col-6 col-lg-2"> {{ $pago->pagoDesde }} </div>

                            <label class="col-6 hidden-lg-up">Válido Hasta:</label>
                            <div class="col-6 col-lg-2"> {{ $pago->pagoHasta }} </div>

                            <label class="col-6 hidden-lg-up">Estado:</label>
                            <div class="col-6 col-lg-2"> {{ $pago->estado }} </div>

                            <label class="col-6 hidden-lg-up">Valor:</label>
                            <div class="col-6 col-lg-2"> {{ $pago->pagoTotal }} </div>

                            <label class="col-6 hidden-lg-up">Editar:</label>
                            <div class="col-6 col-lg-1">
                                <a href="{{ url('admin/local/editar-pago/'.$pago->id) }}" class="btn btn-warning btn-xs"  data-toggle="tooltip" title="Editar"><i class="fa fa-pencil"></i></a>
                            </div>

                            <label class="col-6 hidden-lg-up">Detalle:</label>
                            <div class="col-6 col-lg-1">
                                <a href="{{ url('admin/local/detalle-pago/'.$pago->id) }}" class="btn btn-success btn-xs"  data-toggle="tooltip" title="Detalle"><i class="fa fa-search"></i></a>
                            </div>

                        </div>
                        <hr>


                    @endforeach


                    <div class="row form-group">
                        <div class="col-md-12">
                            {!! $pagos->links('vendor.pagination.simple-bootstrap-4') !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <a href="{{ url('admin/local/agregar-pago/'.$local->id) }}" class="btn btn-sm btn-success">Agregar</a>
                            <a href="{{ url('admin/local/'.$local->local_id.'/empaques') }}" class="btn btn-sm btn-primary">Volver</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection



@section('js')


@endsection


