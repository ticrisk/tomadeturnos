@extends('layouts.global-externo')

@section('content')
    <section>
        <div class="container">

            <h5 class="text-center">Ceder Turno</h5>
            <p class="m-b-25 text-center">Opción para ceder un turno de tu propiedad a otra persona.</p>

            <b class="text-center">@include('incluir/mensajes')</b>

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Ceder turnos</h5>
                </div>
                <div class="card-body">
                    {!! Form::open(['action' => 'TurnoController@postCeder', 'method' => 'POST']) !!}
                    <div class="row form-group">
                        <div class="col-lg-5">
                            <select id="turno_id" name="turno_id" class="form-control select-category" required="required">
                                <option value="">Seleccione un Turno</option>
                                @foreach($list_turnos as $list_turno)
                                    <option value="{{ $list_turno->id }}">{{ $list_turno->fecha }} - {{ $list_turno->inicio }} a {{ $list_turno->termino }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="hidden-lg-up p-t-50"></div>
                        <div class="col-lg-4">
                            <select id="local_user_id" name="local_user_id" class="form-control select-category" required="required">
                                <option value="">Seleccione un Empaque</option>
                                @foreach($empaques as $empaque)
                                    <option value="{{ $empaque->id }}">{{ $empaque->nombre }} {{ $empaque->apellido }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="hidden-lg-up p-t-50"></div>
                        <div class="col-lg-3 text-center">
                            {!! Form::submit('Ceder', ['class'=>'btn btn-sm btn-success']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

            <div class="card card-info">
                <div class="card-header">
                    <h5 class="card-title">Turnos que estoy cediendo</h5>
                </div>
                <div class="card-block">
                    @foreach($list_cediendo as $list)
                    {!! Form::open(['action' => 'TurnoController@postCancelarCediendo', 'method' => 'POST']) !!}
                    {!! Form::hidden('id', $list->id) !!}
                    <div class="row form-group text-center">
                        <div class="col-lg-9">
                            <p>Estás ofreciendo a <b>{{ $list->nombre }} {{ $list->apellido }}</b> tu turno del
                                <b>{{ $list->fecha }}</b> de <b>{{ $list->inicio }}</b> a <b>{{ $list->termino }}</b> hrs.</p>
                        </div>

                        <div class="hidden-lg-up p-t-50"></div>
                        <div class="col-lg-3 text-center">
                            {!! Form::submit('Cancelar', ['class'=>'btn btn-sm btn-danger']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <hr>
                    @endforeach()
                </div>
            </div>


            <div class="card card-warning">
                <div class="card-header">
                    <h5 class="card-title">Turnos que me ofrecen</h5>
                </div>
                <div class="card-block">

                    @foreach($list_ofrecen as $list)

                        <div class="row form-group text-center">

                            <div class="col-12 col-md-8">
                                <p><b>{{ $list->nombre }} {{ $list->apellido }}</b> te está ofreciendo el turno del
                                <b>{{ $list->fecha }}</b> de <b>{{ $list->inicio }}</b> a <b>{{ $list->termino }}</b> hrs.</p>
                            </div>

                            <div class="hidden-md-up p-t-50"></div>
                            <div class="col-6 col-md-2 text-center">
                                {!! Form::open(['action' => 'TurnoController@postCancelarCediendo', 'method' => 'POST']) !!}
                                    {!! Form::hidden('id', $list->id) !!}
                                    {!! Form::submit('Rechazar', ['class'=>'btn btn-sm btn-danger']) !!}
                                {!! Form::close() !!}
                            </div>

                            <div class="hidden-md-up p-t-50"></div>
                            <div class="col-6 col-md-2 text-center">
                                {!! Form::open(['action' => 'TurnoController@postAceptarCediendo', 'method' => 'POST']) !!}
                                {!! Form::hidden('id', $list->id) !!}
                                {!! Form::submit('Lo quiero', ['class'=>'btn btn-sm btn-success']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>

                        <hr>
                    @endforeach()


                </div>
            </div>
        </div>
    </section>
@endsection



@section('js')
@endsection