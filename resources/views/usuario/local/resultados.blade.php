@extends('layouts.global-externo')

@section('content')
<section>
        <div class="container">

            <h4 class="text-center">Postulación <i class="fa fa-star text-warning pull-right" aria-hidden="true" data-toggle="tooltip" title="Opción Premium"></i></h4>
            <p class="m-b-25 text-center">Resultado de la postulación</p>

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Resultado</h5>
                </div>
                <div class="card-block">

                        <b class="text-center">@include('incluir/mensajes')</b>

                        <div class="row hidden-md-down">
                            <div class="col-lg-3"><b>Nombre</b></div>
                            <div class="col-lg-2"><b>Rut</b></div>
                            <div class="col-lg-4"><b>E-mail</b></div>
                            <div class="col-lg-1"><b>Estado</b></div>
                            <div class="col-lg-2"><b>Hora</b></div>
                        </div>
                        <hr class="hidden-md-down">



                            @foreach($resultados as $resultado)
                                <div class="row">

                                        <label class="col-4 col-sm-6 col-md-6 hidden-lg-up">Nombre:</label>
                                        <div class="col-8 col-sm-6 col-md-6 col-lg-3">{{ $resultado->User->nombre }} {{ $resultado->User->apellido }}</div>

                                        <label class="col-4 col-sm-6 col-md-6 hidden-lg-up">Rut:</label>
                                        <div class="col-8 col-sm-6 col-md-6 col-lg-2">{{ $resultado->User->rut }}</div>

                                        <label class="col-4 col-sm-6 col-md-6 hidden-lg-up">E-mail:</label>
                                        <div class="col-8 col-sm-6 col-md-6 col-lg-4">{{ $resultado->User->email }}</div>

                                        <label class="col-4 col-sm-6 col-md-6 hidden-lg-up">Estado:</label>
                                        <div class="col-8 col-sm-6 col-md-6 col-lg-1">{{ $resultado->estado }}</div>

                                        <label class="col-4 col-sm-6 col-md-6 hidden-lg-up">Hora:</label>
                                        <div class="col-8 col-sm-6 col-md-6 col-lg-2">{{ $resultado->postulacion }}</div>


                                </div>
                                <hr class="hidden-lg-up">
                            @endforeach

                        <div class="text-center">
                            {!! $resultados->render() !!} {{-- --}}
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <a href="{{ url('usuario/local/'.$local.'/postulaciones') }}" class="btn btn-sm btn-primary">Postulaciones</a>
                            </div>
                        </div>

                        <div class="p-t-35"></div>
                        <div class="alert alert-info" role="alert">
                            <strong>** </strong> Los que aparecen primeros en la lista son los ganadores según la cantidad de cupos que tiene la postulación.
                        </div>
                </div>
            </div>
        </div>
</section>
@endsection



@section('js')


@endsection


