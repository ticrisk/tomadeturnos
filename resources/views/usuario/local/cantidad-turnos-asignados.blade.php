@extends('layouts.global-nero')

@section('content')

    <section>
        <div class="container">

            <h4 class="text-center">Cantidad de Turnos Asignados <i class="fa fa-star text-warning pull-right" aria-hidden="true" data-toggle="tooltip" title="Opción Premium"></i></h4>
            <b class="text-center">@include('incluir/mensajes')</b>

            <div class="card card-info">
                <div class="card-header">
                    <h5 class="card-title">Buscar</h5>
                </div>
                <div class="card-body">
                    {!!  Form::open(array('route' => array('usuario.local.cantidad-turnos-asignados', $id),'method' => 'GET')) !!}
                    <div class="row form-inline">

                        <label class="col-6 col-lg-2"> Desde </label>
                        <div class="col-6 col-lg-3"> {!! Form::text('desde', null, ['class'=>'form-control', 'required', 'placeholder'=>'2018-12-15']) !!} </div>
                        <label class="col-6 col-lg-2"> Hasta </label>
                        <div class="col-6 col-lg-3"> {!! Form::text('hasta', null, ['class'=>'form-control', 'required', 'placeholder'=>'2018-12-31']) !!} </div>
                        <div class="p-t-80 hidden-lg-up"></div>
                        <div class="col-12 col-lg-2 text-center"> {!! Form::submit('Buscar', ['class'=>'btn btn-sm btn-success']) !!} </div>

                    </div>
                    {!! Form::close() !!}
                </div>
            </div>



            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Cant. turnos tomado por empaque</h5>
                </div>
                <div class="card-body">


                    <div class="row hidden-md-down text-center">
                        <label class="col-lg-2">Nombre</label>
                        <label class="col-lg-2">Rol</label>
                        <label class="col-lg-1">Total</label>
                        <label class="col-lg-1">Toma</label>
                        <label class="col-lg-1">Repechaje</label>
                        <label class="col-lg-1">Asignado</label>
                        <label class="col-lg-1">Pre-Toma</label>
                        <label class="col-lg-1">Cedido</label>
                        <label class="col-lg-1">Cambio</label>
                        <label class="col-lg-1">Regalo</label>

                    </div>
                    <hr  class="row hidden-md-down">
                    @foreach($usuarios as $usuario)

                        <div class="row form-group">
                            <label  class="col-6 hidden-lg-up">Nombre :</label>
                            <div class="col-6 col-lg-2 text-center"> {{ $usuario->nombre }} {{ $usuario->apellido }} </div>

                            <label  class="col-6 hidden-lg-up">Rol :</label>
                            <div class="col-6 col-lg-2 text-center"> {{ $usuario->rol }} </div>

                            <label  class="col-6 hidden-lg-up">Total :</label>
                            <div class="col-6 col-lg-1 text-center"> {{ $usuario->cantTurnos }} </div>

                            <label  class="col-6 hidden-lg-up">Toma :</label>
                            <div class="col-6 col-lg-1 text-center"> {{ $usuario->toma }} </div>

                            <label  class="col-6 hidden-lg-up"> Repechaje : </label>
                            <div class="col-6 col-lg-1 text-center"> {{ $usuario->repechaje }} </div>

                            <label  class="col-6 hidden-lg-up">Asignado :</label>
                            <div class="col-6 col-lg-1 text-center"> {{ $usuario->asignar }} </div>

                            <label  class="col-6 hidden-lg-up">Pre-Toma :</label>
                            <div class="col-6 col-lg-1 text-center"> {{ $usuario->pretoma }} </div>

                            <label  class="col-6 hidden-lg-up">Cedido:</label>
                            <div class="col-6 col-lg-1 text-center"> {{ $usuario->cedido }} </div>

                            <label  class="col-6 hidden-lg-up"> Cambio :</label>
                            <div class="col-6 col-lg-1 text-center"> {{ $usuario->cambio }} </div>

                            <label  class="col-6 hidden-lg-up">Regalo :</label>
                            <div class="col-6 col-lg-1 text-center"> {{ $usuario->regalo }} </div>

                        </div>

                        <hr>
                    @endforeach

                    <div class="row form-group">
                        <div class="col-12 hidden-sm-up d-flex">
                            {!! $usuarios->appends(Request::only(['desde','hasta']))->links('vendor.pagination.simple-bootstrap-4') !!}
                        </div>
                        <div class="col-md-12 hidden-xs-down d-flex">
                            {!! $usuarios->appends(Request::only(['desde','hasta']))->links('vendor.pagination.bootstrap-4') !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                             {!! Form::open(['route' => 'usuario.local.cant-turnos-tomados-fecha', 'method' => 'GET']) !!}

                            {!! Form::hidden('id', $id) !!}
                            {!! Form::hidden('desde', $desde) !!}
                            {!! Form::hidden('hasta', $hasta) !!}

                            <div class="row form-group">
                                <div class="col-md-12">{!! Form::submit('Imprimir', ['class'=>'btn btn-sm btn-info']) !!} |
                                    <a href="{{ url('usuario/local/'.$id.'/opciones') }}" class="btn btn-success  btn-sm"  data-toggle="tooltip" title="Opciones">Regresar</a></div>
                            </div>


                            {!! Form::close() !!}


                        </div>
                    </div>

                    <div class="p-t-35"></div>
                    <div class="alert alert-info" role="alert">
                        <strong>** </strong> El total es la suma de los turnos tomados, asignados, pre-toma, etc.<br>
                        <strong>** </strong> Los turnos que se muestran por defecto corresponde al mes actual.<br>
                        <strong>** </strong> Los turnos que se muestran son los turnos que tiene cada usuario en su cuenta. Si el empaque
                        regaló un turno, no se mostrará acá, ya que el turno regalado no aparecé en sus historial de turnos (opción "Mis Turnos").
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



@section('js')


@endsection


