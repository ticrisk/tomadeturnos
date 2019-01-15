@extends('layouts.global-externo')

@section('content')
<section>
    <div class="container">

        <h4 class="text-center">Postulaciones</h4>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Resultados</h5>
            </div>
            <div class="card-body">
                <b class="text-center">@include('incluir/mensajes')</b>

                        <div class="row hidden-md-down">
                            <label class="col-lg-2">Nombre</label>
                            <label class="col-lg-2">Rut</label>
                            <label class="col-lg-4">E-mail</label>
                            <label class="col-lg-2">Estado</label>
                            <label class="col-lg-2">Hora</label>
                        </div>
                        <hr class="hidden-md-down">

                            @foreach($resultados as $resultado)
                                <div class="row">
                                    <label class="col-6 hidden-lg-up">Nombre:</label>
                                    <div class="col-6 col-lg-2">{{ $resultado->User->nombre }} {{ $resultado->User->apellido }}</div>

                                    <label class="col-6 hidden-lg-up">Rut:</label>
                                    <div class="col-6 col-lg-2">{{ $resultado->User->rut }}</div>

                                    <label class="col-6 hidden-lg-up">E-mail:</label>
                                    <div class="col-6 col-lg-4">{{ $resultado->User->email }}</div>

                                    <label class="col-6 hidden-lg-up">Estado:</label>
                                    <div class="col-6 col-lg-2">{{ $resultado->estado }}</div>

                                    <label class="col-6 hidden-lg-up">Hora:</label>
                                    <div class="col-6 col-lg-2">{{ $resultado->postulacion }}</div>
                                </div>
                                <hr class="hidden-lg-up">
                            @endforeach

                        <div class="text-center">
                             {!! $resultados->render() !!}
                        </div>

                        <div class="p-t-35 hidden-md-down"></div>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <a href="{{ url('admin/local/'.$local.'/postulaciones') }}" class="btn btn-sm btn-primary">Postulaciones</a>
                            </div>
                        </div>

                        <div class="p-t-35"></div>
                        <div class="alert alert-danger" role="alert">
                            <strong>** </strong> Los que aparecen primeros en la lista son los ganadores según la cantidad de cupos que tiene la postulación.
                        </div>

                    </div>
                </div>
            </div>
</section>
@endsection



@section('js')


@endsection


