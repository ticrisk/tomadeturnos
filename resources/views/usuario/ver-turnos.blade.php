@extends('layouts.global-externo')

@section('content')

    <section>
        <div class="container">

            <h4 class="text-center">Turnos <i class="fa fa-star text-warning pull-right" aria-hidden="true" data-toggle="tooltip" title="Opción Premium"></i></h4>
            <b class="text-center">@include('incluir/mensajes')</b>

            <div class="card card-info">
                <div class="card-header">
                    <h5 class="card-title">Buscar</h5>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-1"> <b>ID :</b> {{ $usuario->id }} </div>
                        <div class="col-lg-2"> <b>Rut :</b> {{ $usuario->User->rut }} </div>
                        <div class="col-lg-4"> <b>Nombre :</b> {{ $usuario->User->nombre }} {{ $usuario->User->apellido }} </div>
                        <div class="col-lg-2"> <b>Rol :</b> {{ $usuario->rol }} </div>
                        <div class="col-lg-3"> <b>Estado :</b> {{ $usuario->estado }} </div>
                    </div>
                    <hr>
                    {{--

                        {{ Form::open(array('route' => array('admin.usuario.turnos', 52))) }}
                        {!! Form::open(['action' => 'AdminController@postBuscarTurnos', 'method' => 'POST']) !!}
                        {!! Form::open(['route' => 'admin.usuario.ver-turnos', 'method' => 'GET']) !!}
                    --}}

                    {!!  Form::open(array('route' => array('usuario.ver-turnos', $usuario->id),'method' => 'GET')) !!}
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
                    <h5 class="card-title">Listado de Turnos</h5>
                </div>
                <div class="card-body">
                    <div class="row  hidden-md-down">
                        <label class="col-lg-2">Fecha</label>
                        <label class="col-lg-1">Inicio</label>
                        <label class="col-lg-1">Termino</label>
                        <label class="col-lg-2">Estado</label>
                        <label class="col-lg-3">Tipo</label>
                        <label class="col-lg-1">Fijo</label>
                        <label class="col-lg-2">Coordinador</label>
                    </div>
                    <hr class="hidden-lg-down">

                    @foreach($turnos as $turno)
                        <div class="row">
                            <label class="col-6 col-md-6 hidden-lg-up">Fecha:</label>
                            <div class="col-6 col-md-6 col-lg-2">{{ date('d-m-Y', strtotime($turno->Turno->fecha)) }} </div>

                            <label class="col-6 col-md-6 hidden-lg-up">Inicio:</label>
                            <div class="col-6 col-md-6 col-lg-1">{{ date('H:i', strtotime($turno->Turno->inicio)) }} </div>

                            <label class="col-6 col-md-6 hidden-lg-up">Termino:</label>
                            <div class="col-6 col-md-6 col-lg-1">{{ date('H:i', strtotime($turno->Turno->termino)) }} </div>

                            <label class="col-6 col-md-6 hidden-lg-up">Estado:</label>
                            <div class="col-6 col-md-6 col-lg-2">{{ $turno->estado }} </div>

                            <label class="col-6 col-md-6 hidden-lg-up">Tipo:</label>
                            <div class="col-6 col-md-6 col-lg-3">{{ $turno->tipo }} </div>

                            <label class="col-6 col-md-6 hidden-lg-up">Fijo:</label>
                            <div class="col-6 col-md-6 col-lg-1">{{ $turno->fijo }} </div>

                            <label class="col-6 col-md-6 hidden-lg-up">Coordinador:</label>
                            <div class="col-6 col-md-6 col-lg-2">{{ $turno->coordinador }} </div>
                        </div>
                        <hr class="hidden-lg-up">
                    @endforeach

                    <hr class="hidden-md-down">
                    <div class="col-lg-12 text-center">
                        <a href="{{ url('usuario/local/'.$usuario->local_id.'/empaques') }}" class="btn btn-sm btn-primary">Volver</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection



@section('js')


@endsection


