@extends('layouts.global-nero')

@section('content')
<section>
        <div class="container">

            <h4 class="text-center">Falta <i class="fa fa-star text-warning pull-right" aria-hidden="true" data-toggle="tooltip" title="Opción Premium"></i></h4>
            <p class="m-b-25 text-center">Información de la falta</p>

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Usuario - Falta</h5>
                </div>
                <div class="card-block">

                    <b class="text-center">@include('incluir/mensajes')</b>

                          {!! Form::open(['route' => ['usuario.local.putActualizarFalta', $falta], 'method' => 'PUT'])!!}


                            {!! Form::hidden('local_user_id', $falta->local_user_id) !!}
                            {!! Form::hidden('local_id', $falta->Local_User->local_id) !!}

                            <div class="row form-group">
                                <label class="col-md-2 col-lg-2 control-label">Fecha</label>
                                <div class="col-md-4 col-lg-4">
                                    {!! Form::text('fecha', $falta->fecha,['class'=>'datetimepicker form-control','placeholder'=>'Fecha Obligatoria']) !!}
                                </div>
                                
                                <label class="col-md-2 col-lg-2 control-label">Tipo</label>
                                <div class="col-md-4 col-lg-4">
                                    {!! Form::select('tipo',[$falta->tipo => $falta->tipo,'Leve'=>'leve','Media'=>'Media','Grave'=>'Grave'],null, ['class'=>'form-control select-category']) !!}
                                </div>
                            </div>  

                            <div class="row form-group">
                                <label class="col-md-2 col-lg-2 control-label">Creado</label>
                                <div class="col-md-4 col-lg-4">
                                    {!! Form::text('created_at', $falta->created_at,['class'=>'form-control','readonly']) !!}
                                </div>
                                
                                <label class="col-md-2 col-lg-2 control-label">Actualizado</label>
                                <div class="col-md-4 col-lg-4">
                                    {!! Form::text('updated_at', $falta->updated_at,['class'=>'form-control','readonly']) !!}
                                </div>
                            </div>                             

                            <div class="row form-group">
                                <label class="col-lg-2 control-label">Descripción</label>
                                <div class="col-lg-10">
                                    {!! Form::textarea('descripcion', $falta->descripcion,['class'=>'form-control']) !!}
                                </div>
                            </div> 

                            
                            <div class="row form-group">
                              <div class="col-lg-12 text-center">
                                {!! Form::submit('Actualizar', ['class'=>'btn btn-sm btn-success']) !!}
                                <a href="{{ url('usuario/local/faltas/'.$falta->local_user_id) }}" class="btn btn-sm btn-primary">Volver</a>
                              </div>
                            </div>
                         
                          {!! Form::close() !!}





                </div>
            </div>
        </div>
</section>
@endsection



@section('js')
    <script src="{{ asset('plugins/jquery/moment/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('js/transition.js') }}"></script>
    <script src="{{ asset('js/collapse.js') }}"></script>

    <script src="{{ asset('plugins/jquery/bootstrap-daterangepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('plugins/jquery/bootstrap-daterangepicker/bootstrap-datetimepicker.min.css') }}" type="text/css" />

    <script type="text/javascript">

        $('.datetimepicker').datetimepicker({
            locale: 'es',
            format: 'YYYY-MM-DD HH:mm:ss',
            //daysOfWeekDisabled: [0],
        });
    </script>

@endsection


