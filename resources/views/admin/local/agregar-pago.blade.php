@extends('layouts.global-externo')

@section('content')
    <section>
        <div class="container">

            <h4 class="text-center">Pagos</h4>
            <b class="text-center">@include('incluir/mensajes')</b>

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Agregar Pago</h5>
                </div>
                <div class="card-body">

                    {!! Form::open(['action' => 'AdminController@postAgregarPago', 'method' => 'POST', 'files'=> true])!!}

                    {{ csrf_field() }}

                    {!! Form::hidden('local_user_id', $usuario->id) !!}


                    <div class="form-group row">
                        <label class="col-lg-2">Fecha Pago</label>
                        <div class="col-lg-4">
                            {!! Form::text('fechaPago', null,['class'=>'form-control','placeholder'=>'2018-12-23', 'required']) !!}
                        </div>

                        <label class="col-lg-2 control-label">Estado</label>
                        <div class="col-lg-4">
                            {!! Form::select('estado',['Aceptado'=>'Aceptado','Pendiente'=>'Pendiente','Rechazado'=>'Rechazado'],null, ['class'=>'form-control select-category']) !!}
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-lg-2 control-label">Pago Desde</label>
                        <div class="col-lg-4">
                            {!! Form::text('pagoDesde', null,['class'=>'form-control','placeholder'=>'2018-12-01']) !!}
                        </div>

                        <label class="col-lg-2 control-label">Pago Hasta</label>
                        <div class="col-lg-4">
                            {!! Form::text('pagoHasta', null,['class'=>'form-control','placeholder'=>'2018-12-31']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2">Total Pago</label>
                        <div class="col-lg-4">
                            {!! Form::text('pagoTotal', number_format($usuario->Local->precioMensual,0, '.', ''),['class'=>'form-control','placeholder'=>'1200']) !!}
                        </div>
                        <label class="col-lg-2 control-label">Tipo de Pago</label>
                        <div class="col-lg-4">
                            {!! Form::select('tipoPago',['Transferencia'=>'Transferencia','Depósito'=>'Depósito','Efectivo'=>'Efectivo','Pago Online'=>'Pago Online','Pagado por otra Persona'=>'Pagado por otra Persona','Costo Cero'=>'Costo Cero'],null, ['class'=>'form-control select-category']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2 control-label">Paga</label>
                        <div class="col-lg-4">
                            {!! Form::select('paga',[$responsable => $responsable],null, ['class'=>'form-control select-category']) !!}
                        </div>
                        <label class="col-lg-2">Comprobante</label>
                        <div class="col-lg-4">
                            {!! Form::file('comprobante',['id'=>'comprobante']) !!}
                        </div>
                        <label class="col-lg-2 control-label"></label>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2">Información Extra</label>
                        <div class="col-lg-10">
                            {!! Form::textarea('informacionExtra', null,['class'=>'form-control','placeholder'=>'Info Extra']) !!}
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-lg-12 text-center">
                            {!! Form::submit('Guardar', ['class'=>'btn btn-xs btn-success']) !!}
                            <a href="{{ url('admin/local/listado-pagos/'.$usuario->id) }}" class="btn btn-xs btn-primary">Pagos</a>
                            <a href="{{ url('admin/local/'.$usuario->local_id.'/empaques') }}" class="btn btn-xs btn-info">Empaques</a>
                        </div>
                    </div>

                    {!! Form::close() !!}

                    <div class="row">
                        <div class="col-lg-12 text-center">
                            {{--
                            <a href="{{ url('admin/local/'.$local->local_id.'/empaques') }}" class="btn btn-sm btn-primary">Volver</a>
                            <a href="{{ url('admin/local/agregar-pago/'.$local->id) }}" class="btn btn-sm btn-success">Agregar</a>
                            --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection



@section('js')


@endsection


