@extends('layouts.global-externo')

@section('content')
<section>
        <div class="container">

            <h4 class="text-center">Configuración</h4>
            <p class="m-b-25 text-center">Configuraciones del local</p>

            <!-- informativo si es que existe para todos los encargados -->

            @if($existe == 'Si')
                <div class="alert alert-danger" role="alert">
                    <h6><b>Mensaje privado</b></h6>
                    <b>{{ $informativo->titulo }}</b>
                    <p>{!! $informativo->descripcion !!}</p>
                    <i class="fa fa-clock-o" aria-hidden="true"></i> <i>{{ date('d-m-Y', strtotime($informativo->updated_at)) }}</i>
                </div>
            @endif
            <!-- Fin del informativo -->



            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Opciones - {{ $local->Local->nombre }}</h5>
                </div>
                <div class="card-block">
                    <b class="text-center">@include('incluir/mensajes')</b>
                        <div class="row hidden-sm-down text-center">
                            <div class="col-md-2 col-lg-2"><b>Crear Planilla</b></div>
                            <div class="col-md-2 col-lg-2"><b>Planillas</b></div>
                            <div class="col-md-2 col-lg-2"><b>Empaques</b></div>
                            <div class="col-md-2 col-lg-2"><b>Local</b></div>
                            <div class="col-md-2 col-lg-2"><b>Rendimiento</b></div>
                            <div class="col-md-2 col-lg-2"><b></b></div>
                        </div>
                        <hr class="hidden-sm-down">

                        <div class="row  text-center">

                            <div class="hidden-md-up p-t-45"></div>
                            <label class="col-6 col-sm-6 hidden-md-up control-label">Crear Planilla:</label>
                            <div class="col-6 col-sm-6 col-md-2 col-lg-2">
                            {!! Form::open(['route' => ['usuario.planilla.postCopiarPlanilla', $local->local_id], 'method' => 'POST'])  !!}

                            <!-- Code para poner un icono dentro de un button->submit -->
                                {!!
                                    Form::button('<i class="fa fa-plus" aria-hidden="true"></i>', array(
                                            'type' => 'submit',
                                            'class'=> 'btn btn-success btn-sm',
                                            'onclick'=>'return confirm("¿Deseas Crear Una Nueva Planilla?")'
                                    ))
                                !!}

                                {!! Form::close()  !!}
                            </div>

                            <div class="hidden-md-up p-t-45"></div>
                            <label class="col-6 col-sm-6 hidden-md-up control-label">Planillas:</label>
                            <div class="col-6 col-sm-6 col-md-2 col-lg-2">
                                <a href="{{ url('usuario/local/'.$local->local_id.'/ver-planillas') }}" class="btn btn-info  btn-sm" data-toggle="tooltip" title="Planillas"> <i class="fa fa-list" aria-hidden="true"></i> </a>
                            </div>

                            <div class="hidden-md-up p-t-45"></div>
                            <label class="col-6 col-sm-6 hidden-md-up control-label">Empaques:</label>
                            <div class="col-6 col-sm-6 col-md-2 col-lg-2">
                                <a href="{{ url('usuario/local/'.$local->local_id.'/empaques') }}" class="btn btn-warning  btn-sm"  data-toggle="tooltip" title="Empaques"><i class="fa fa-users" aria-hidden="true"></i></a>
                            </div>

                            <div class="hidden-md-up p-t-45"></div>
                            <label class="col-6 col-sm-6 hidden-md-up control-label">Local:</label>
                            <div class="col-6 col-sm-6 col-md-2 col-lg-2">
                                <a href="{{ url('usuario/local/'.$local->local_id.'/editar') }}" class="btn btn-primary  btn-sm"  data-toggle="tooltip" title="Editar Local"><i class="fa fa-flag" aria-hidden="true"></i></a>
                            </div>

                            <div class="hidden-md-up p-t-45"></div>
                            <label class="col-6 col-sm-6 hidden-md-up control-label">Rendimiento:</label>
                            <div class="col-6 col-sm-6 col-md-2 col-lg-2">
                                <a href="{{ url('usuario/local/'.$local->local_id.'/rendimiento') }}" class="btn btn-danger  btn-xs"  data-toggle="tooltip" title="Rendimiento"><i class="fa fa-bar-chart" aria-hidden="true"></i></a>
                            </div>

                            <div class="hidden-md-up p-t-45"></div>
                            <label class="col-6 col-sm-6 hidden-md-up control-label"></label>
                            <div class="col-6 col-sm-6 col-md-2 col-lg-2">
                            </div>

                        </div>

                        <div class="p-t-35"></div>
                        <div class="row hidden-sm-down text-center">
                            <div class="col-md-2 col-lg-2"><b>Turnos</b></div>
                            <div class="col-md-2 col-lg-2"><b>Pagos Encargado</b></div>
                            <div class="col-md-2 col-lg-2"><b>Noticias</b></div>
                            <div class="col-md-2 col-lg-2"><b>Postulaciones</b></div>
                            <div class="col-md-2 col-lg-2"><b></b></div>
                            <div class="col-md-2 col-lg-2"><b></b></div>
                        </div>
                        <hr >



                        <div class="row  text-center">

                            <label class="col-6 col-sm-6 hidden-md-up control-label">Turnos:</label>
                            <div class="col-6 col-sm-6 col-md-2 col-lg-2">
                                <a href="{{ url('usuario/local/'.$local->local_id.'/cantidad-turnos-asignados') }}" class="btn btn-primary  btn-xs" disabled data-toggle="tooltip" title="Cant. Turnos Asignados"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></a>
                            </div>

                            <div class="hidden-md-up p-t-45"></div>
                            <label class="col-6 col-sm-6 hidden-md-up control-label">Pago Encargado:</label>
                            <div class="col-6 col-sm-6 col-md-2 col-lg-2">
                                <a href="{{ url('usuario/local/'.$local->local_id.'/pago-encargado') }}" class="btn btn-danger  btn-sm"  data-toggle="tooltip" title="Pago Mensual Encargado"><i class="fa fa-credit-card" aria-hidden="true"></i></a>
                            </div>

                            <div class="hidden-md-up p-t-45"></div>
                            <label class="col-6 col-sm-6 hidden-md-up control-label">Noticias:</label>
                            <div class="col-6 col-sm-6 col-md-2 col-lg-2">
                                <a href="{{ url('noticia/noticia-local/'.$local->local_id) }}" class="btn btn-info  btn-sm"  data-toggle="tooltip" title="Noticias"><i class="fa fa-book" aria-hidden="true"></i></a>
                            </div>

                            <div class="hidden-md-up p-t-45"></div>
                            <label class="col-6 col-sm-6 hidden-md-up control-label">Postulaciones:</label>
                            <div class="col-6 col-sm-6 col-md-2 col-lg-2">
                                <a href="{{ url('usuario/local/'.$local->local_id.'/postulaciones') }}" class="btn btn-inverse  btn-sm"  data-toggle="tooltip" title="Postulaciones"><i class="fa fa-graduation-cap" aria-hidden="true"></i></a>
                            </div>

                            <label class="col-6 col-sm-6 hidden-md-up control-label"></label>
                            <div class="col-6 col-sm-6 col-md-2 col-lg-2">
                            </div>

                            <label class="col-6 col-sm-6 hidden-md-up control-label"></label>
                            <div class="col-6 col-sm-6 col-md-2 col-lg-2">
                            </div>

                        </div>

                        <hr>
                        <div class="text-center">
                            <a href="{{ url('usuario/mis-locales') }}" class="btn btn-primary  btn-sm "  data-toggle="tooltip" title="Volver">Volver</a>
                        </div>




                    </div>
                </div>
            </div>
</section>
@endsection



@section('js')


@endsection


