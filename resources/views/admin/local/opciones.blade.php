@extends('layouts.global-nero')

@section('content')
<section>
  <div class="container">

    <h4 class="text-center">Opciones</h4>
    <b class="text-center">@include('incluir/mensajes')</b>

    <div class="card card-info">
      <div class="card-header">
        <h5 class="card-title">Información</h5>
      </div>
      <div class="card-body">


                      <div class="row">
                        <div class="col-md-3"> <b>ID Local:</b>  {{ $local->id }} </div>
                        <div class="col-md-3"> <b>Cadena:</b> {{ $local->Cadena->nombre }}</div>
                        <div class="col-md-3"> <b>Local:</b> {{ $local->nombre }}</div>
                        <div class="col-md-3"> <b>Cuenta:</b> {{ $local->cuenta }}</div>
                      </div>
      </div>
    </div>





    <div class="card card-primary">
      <div class="card-header">
        <h5 class="card-title">Opciones</h5>
      </div>
      <div class="card-body">

                            <div class="row text-center hidden-sm-down">
                                  <label class="col-md-2 col-lg-2">Local</label>
                                  <label class="col-md-2 col-lg-2">Empaques</label>
                                  <label class="col-md-2 col-lg-2">Planillas</label>
                                  <label class="col-md-2 col-lg-2">Crear Planilla</label>
                                  <label class="col-md-2 col-lg-2">Turnos</label>
                                  <label class="col-md-2 col-lg-2"></label>
                            </div>
                            <hr class="hidden-sm-down">
                            
                            <div class="row form-group text-center">

                              <label class="col-6 hidden-md-up">Editar :</label>
                              <div class="col-6 col-md-2">
                                    <a href="{{ url('admin/local/'.$local->id.'/editar') }}" class="btn btn-primary btn-xs"  data-toggle="tooltip" title="Editar Local"><i class="fa fa-flag" aria-hidden="true"></i></a>
                              </div>

                              <div class="p-t-40 hidden-md-up"></div>
                              <label class="col-6 hidden-md-up">Empaques :</label>
                              <div class="col-6 col-md-2">
                                <a href="{{ url('admin/local/'.$local->id.'/empaques') }}" class="btn btn-warning btn-xs"  data-toggle="tooltip" title="Empaques"><i class="fa fa-users" aria-hidden="true"></i></a>
                              </div>

                              <div class="p-t-40 hidden-md-up"></div>
                              <label class="col-6 hidden-md-up">Planillas :</label>
                              <div class="col-6 col-md-2">
                                  <a href="{{ url('admin/planilla/local/'.$local->id) }}" class="btn btn-info  btn-xs"  data-toggle="tooltip" title="Planillas"><i class="fa fa-list" aria-hidden="true"></i></a>
                              </div>

                              <div class="p-t-40 hidden-md-up"></div>
                              <label class="col-6 hidden-md-up">Crear Planilla :</label>
                              <div class="col-6 col-md-2">
                              {!! Form::open(['route' => ['admin.planilla.postCopiarPlanilla', $local->id], 'method' => 'POST'])  !!}

                              <!-- Code para poner un icono dentro de un button->submit -->
                                {!!
                                  Form::button('<i class="fa fa-plus" aria-hidden="true"></i>', array(
                                          'type' => 'submit',
                                          'class'=> 'btn btn-success  btn-xs',
                                          'onclick'=>'return confirm("¿Deseas Crear Una Nueva Planilla?")'
                                  ))
                                !!}

                                {!! Form::close()  !!}
                              </div>

                              <div class="p-t-40 hidden-md-up"></div>
                              <label class="col-6 hidden-md-up">Turnos :</label>
                              <div class="col-6 col-md-2">
                                <a href="{{ url('admin/local/'.$local->id.'/cantidad-turnos-asignados') }}" class="btn btn-primary  btn-xs" disabled data-toggle="tooltip" title="Cant. Turnos Asignados"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></a>
                              </div>

                              <div class="p-t-40 hidden-md-up"></div>
                              <label class="col-6 hidden-md-up"></label>
                              <div class="col-6 col-md-2">

                              </div>
                            </div>


                            <div class="p-t-35"></div>
                            <div class="row text-center hidden-sm-down">
                                  <label class="col-md-2 col-lg-2">Pagos Enc.</label>
                                  <label class="col-md-2 col-lg-2">Noticias</label>
                                  <label class="col-md-2 col-lg-2">Postulaciones</label>
                                  <label class="col-md-2 col-lg-2">Rendimiento</label>
                                  <label class="col-md-2 col-lg-2"></label>
                                  <label class="col-md-2 col-lg-2"></label>
                            </div>
                            <hr class="hidden-sm-down">

                              <div class="row form-group text-center">

                                  <label class="col-6 hidden-md-up">Pagos Enc. :</label>
                                  <div class="col-6 col-md-2">
                                      <a href="{{ url('admin/local/'.$local->id.'/pago-encargado') }}" class="btn btn-danger btn-xs"  data-toggle="tooltip" title="Pagos de los Encargados"><i class="fa fa-credit-card" aria-hidden="true"></i></a>
                                  </div>

                                  <div class="p-t-40 hidden-md-up"></div>
                                  <label class="col-6 hidden-md-up">Noticias :</label>
                                  <div class="col-6 col-md-2">
                                      <a href="{{ url('noticia/listado-local/'.$local->id) }}" class="btn btn-info btn-xs"  data-toggle="tooltip" title="Noticias"><i class="fa fa-book" aria-hidden="true"></i></a>
                                  </div>

                                  <div class="p-t-40 hidden-md-up"></div>
                                  <label class="col-6 hidden-md-up">Postulaciones :</label>
                                  <div class="col-6 col-md-2">
                                      <a href="{{ url('admin/local/'.$local->id.'/postulaciones') }}" class="btn btn-inverse  btn-xs"  data-toggle="tooltip" title="Postulaciones"><i class="fa fa-graduation-cap" aria-hidden="true"></i></a>
                                  </div>

                                  <div class="p-t-40 hidden-md-up"></div>
                                  <label class="col-6 hidden-md-up">Rendimiento :</label>
                                  <div class="col-6 col-md-2">
                                      <a href="{{ url('admin/local/'.$local->id.'/rendimiento') }}" class="btn btn-danger  btn-xs"  data-toggle="tooltip" title="Rendimiento"><i class="fa fa-bar-chart" aria-hidden="true"></i></a>
                                  </div>

                                  <label class="col-6 hidden-md-up"></label>
                                  <div class="col-6 col-md-2"></div>

                                  <label class="col-6 hidden-md-up"></label>
                                  <div class="col-6 col-md-2"></div>
                              </div>

                            <hr>
                            <div class="row">
                              <div class="col-lg-12 text-center">
                                <a href="{{ url('admin/local/listado') }}" class="btn btn-sm btn-primary">Volver</a>
                              </div>
                            </div>                           
                           

                    </div>
                  </div>
                </div>
</section>
@endsection



@section('js')


@endsection


