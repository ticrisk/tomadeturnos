@extends('layouts.global-nero')

@section('content')
    <section>
        <div class="container">

            <h4 class="text-center">Pagos</h4>
            <b class="text-center">@include('incluir/mensajes')</b>

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Editar Pago</h5>
                </div>
                <div class="card-body">
                    {!! Form::open(['action' => 'AdminController@putEditarPago', 'method' => 'PUT', 'files'=> true])!!}

                    {{ csrf_field() }}
                    {!! Form::hidden('id', $pago->id) !!}
                    {{-- {!! Form::hidden('local_user_id', $pago->local_user_id) !!} --}}

                    <div class="form-group row">
                        <label class="col-lg-2">Fecha Pago</label>
                        <div class="col-lg-4">
                            {!! Form::text('fechaPago', $pago->fechaPago,['class'=>'form-control']) !!}
                        </div>

                        <label class="col-lg-2 control-label">Estado</label>
                        <div class="col-lg-4">
                            {!! Form::select('estado',[$pago->estado => $pago->estado,'Aceptado'=>'Aceptado','Pendiente'=>'Pendiente','Rechazado'=>'Rechazado'],null, ['class'=>'form-control select-category']) !!}
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-lg-2 control-label">Pago Desde</label>
                        <div class="col-lg-4">
                            {!! Form::text('pagoDesde', $pago->pagoDesde,['class'=>'form-control']) !!}
                        </div>

                        <label class="col-lg-2 control-label">Pago Hasta</label>
                        <div class="col-lg-4">
                            {!! Form::text('pagoHasta', $pago->pagoHasta,['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2">Total Pago</label>
                        <div class="col-lg-4">
                            {!! Form::text('pagoTotal', $pago->pagoTotal,['class'=>'form-control']) !!}
                        </div>
                        <label class="col-lg-2 control-label">Tipo de Pago</label>
                        <div class="col-lg-4">
                            {!! Form::select('tipoPago',[$pago->tipoPago => $pago->tipoPago,'Transferencia'=>'Transferencia','Depósito'=>'Depósito','Efectivo'=>'Efectivo','Pago Online'=>'Pago Online','Pagado por otra Persona'=>'Pagado por otra Persona','Costo Cero'=>'Costo Cero'],null, ['class'=>'form-control select-category']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2">Paga</label>
                        <div class="col-lg-4">
                            {!! Form::text('paga', $pago->paga,['class'=>'form-control','readonly']) !!}
                        </div>
                        <label class="col-lg-2">Pagado Por</label>
                        <div class="col-lg-4">
                            {!! Form::select('local_user_id',[$pago->local_user_id => $pago->Local_User->User->fullname] + $encargados,null,['class'=>'form-control select-category', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2">Ver Comprobante</label>
                        <div class="col-lg-4">
                            @if($pago->comprobante != null)
                                <u><a href="{{ url('img/pagos/'.$pago->comprobante) }}" class="" target="_blank">Ver Imagen</a></u>
                            @else
                                {!! Form::text('verComprobante', 'No hay comprobante',['class'=>'form-control','readonly']) !!}
                            @endif
                        </div>
                        <label class="col-lg-2 control-label">Subir Comprobante</label>
                        <div class="col-lg-4">
                            {!! Form::file('comprobante',['id'=>'comprobante']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2">Información Extra</label>
                        <div class="col-lg-10">
                            {!! Form::textarea('informacionExtra', $pago->informacionExtra,['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2">Creado</label>
                        <div class="col-lg-4">
                            {!! Form::text('created_at', $pago->created_at,['class'=>'form-control','readonly']) !!}
                        </div>
                        <label class="col-lg-2 control-label">Actualizado</label>
                        <div class="col-lg-4">
                            {!! Form::text('updated_at', $pago->updated_at,['class'=>'form-control','readonly']) !!}
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-6 col-md-6 text-right">
                            {!! Form::submit('Actualizar', ['class'=>'btn btn-sm btn-success']) !!}
                        </div>
                        <div class="col-6 col-md-6 text-left">
                            <a href="{{ url('admin/local/listado-pagos/'.$pago->local_user_id) }}" class="btn btn-sm btn-primary">Volver</a>
                        </div>
                    </div>
                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </section>
@endsection



@section('js')


@endsection


