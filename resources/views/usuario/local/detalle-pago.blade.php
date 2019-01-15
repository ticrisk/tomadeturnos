@extends('layouts.global-nero')

@section('content')
    <section>
        <div class="container">

            <h4 class="text-center">Pagos</h4>
            <b class="text-center">@include('incluir/mensajes')</b>

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Detalle Pago</h5>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-lg-2">Fecha Pago</label>
                        <div class="col-lg-4">
                            {!! Form::text('fechaPago', $pago->fechaPago,['class'=>'form-control','readonly']) !!}
                        </div>

                        <label class="col-lg-2 control-label">Estado</label>
                        <div class="col-lg-4">
                            {!! Form::text('estado', $pago->estado,['class'=>'form-control','readonly']) !!}
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-lg-2 control-label">Pago Desde</label>
                        <div class="col-lg-4">
                            {!! Form::text('pagoDesde', $pago->pagoDesde,['class'=>'form-control','readonly']) !!}
                        </div>

                        <label class="col-lg-2 control-label">Pago Hasta</label>
                        <div class="col-lg-4">
                            {!! Form::text('pagoHasta', $pago->pagoHasta,['class'=>'form-control','readonly']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2">Total Pago</label>
                        <div class="col-lg-4">
                            {!! Form::text('pagoTotal', $pago->pagoTotal,['class'=>'form-control','readonly']) !!}
                        </div>
                        <label class="col-lg-2 control-label">Tipo de Pago</label>
                        <div class="col-lg-4">
                            {!! Form::text('tipoPago', $pago->tipoPago,['class'=>'form-control','readonly']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2">Comprobante</label>
                        <div class="col-lg-4">
                            @if($pago->comprobante != null)
                                <u><a href="{{ url('img/pagos/'.$pago->comprobante) }}" class="" target="_blank">Ver Imagen</a></u>
                            @else
                                {!! Form::text('comprobante', 'No hay comprobante',['class'=>'form-control','readonly']) !!}
                            @endif
                        </div>
                        <label class="col-lg-2 control-label"></label>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2">Información Extra</label>
                        <div class="col-lg-10">
                            {!! Form::textarea('informacionExtra', $pago->informacionExtra,['class'=>'form-control','readonly']) !!}
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
                        <div class="col-12 col-md-12 text-center">
                            <a href="{{ url('usuario/'.$pago->local_user_id.'/listado-pagos') }}" class="btn btn-sm btn-primary">Volver</a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
@endsection



@section('js')


@endsection


