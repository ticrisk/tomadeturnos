@extends('layouts.global-nero')

@section('content')
    <section>
        <div class="container-fluid">
            <h4 class="text-center">Rendimiento</h4>

            <div class="text-center"><b>@include('incluir.mensajes')</b></div>

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Horario de tomas</h5>
                </div>
                <div class="card-body">

                    <div class="row justify-content-center text-center">
                        <div class="col-lg-1 hidden-md-down"><i><b>Lunes</b></i><hr></div>
                        <div class="col-lg-1 hidden-md-down"><i><b>Martes</b> <br></i><hr></div>
                        <div class="col-lg-1 hidden-md-down"><i><b>Miércoles</b></i><hr></div>
                        <div class="col-lg-1 hidden-md-down"><i><b>Jueves</b></i><hr></div>
                        <div class="col-lg-1 hidden-md-down"><i><b>Viernes</b></i><hr></div>
                        <div class="col-lg-1 hidden-md-down"><i><b>Sábado</b></i><hr></div>
                        <div class="col-lg-1 hidden-md-down"><i><b>Domingo</b></i><hr></div>
                    </div>



                    <div class="row justify-content-center">
                        <div class="col-6 col-sm-6 hidden-lg-up text-center"><h5><b class="text-primary">Lunes</b></h5><hr></div>
                        <div class="col-6 col-sm-6 hidden-lg-up text-center"><h5><b class="text-primary">Martes</b></h5><hr></div>
                        <div class="col-6 col-sm-6 col-lg-1">
                            @foreach($monday as $turno)
                                <div class="border border-primary rounded text-center p-t-15">
                                    <small><b>{{ $turno['local'] }}</b></small><hr>
                                    <small><b>{{ $turno['cadena'] }}</b></small><hr>
                                    <small><b>{{ $turno['inicio'] }}</b></small><hr>
                                    <small><b>{{ $turno['tipo'] }}</b></small><hr>
                                    <h4 class="text-primary" title="cupos">{{ $turno['cantEmpaques'] }}</h4>
                                </div>
                                <div class="p-t-15"></div>
                            @endforeach
                        </div>


                        <div class="col-6 col-sm-6 col-lg-1">
                            @foreach($tuesday as $turno)
                                <div class="border border-primary rounded text-center p-t-15">
                                    <small><b>{{ $turno['local'] }}</b></small><hr>
                                    <small><b>{{ $turno['cadena'] }}</b></small><hr>
                                    <small><b>{{ $turno['inicio'] }}</b></small><hr>
                                    <small><b>{{ $turno['tipo'] }}</b></small><hr>
                                    <h4 class="text-primary" title="cupos">{{ $turno['cantEmpaques'] }}</h4>
                                </div>
                                <div class="p-t-15"></div>
                            @endforeach
                        </div>

                        <div class="col-6 col-sm-6 hidden-lg-up p-t-30 text-center"><h5><b class="text-primary">Miércoles</b></h5><hr></div>
                        <div class="col-6 col-sm-6 hidden-lg-up p-t-30 text-center"><h5><b class="text-primary">Jueves</b></h5><hr></div>

                        <div class="col-6 col-sm-6 col-lg-1">
                            @foreach($wednesday as $turno)
                                <div class="border border-primary rounded text-center p-t-15">
                                    <small><b>{{ $turno['local'] }}</b></small><hr>
                                    <small><b>{{ $turno['cadena'] }}</b></small><hr>
                                    <small><b>{{ $turno['inicio'] }}</b></small><hr>
                                    <small><b>{{ $turno['tipo'] }}</b></small><hr>
                                    <h4 class="text-primary" title="cupos">{{ $turno['cantEmpaques'] }}</h4>
                                </div>
                                <div class="p-t-15"></div>
                            @endforeach
                        </div>

                        <div class="col-6 col-sm-6 col-lg-1">
                            @foreach($thursday as $turno)
                                <div class="border border-primary rounded text-center p-t-15">
                                    <small><b>{{ $turno['local'] }}</b></small><hr>
                                    <small><b>{{ $turno['cadena'] }}</b></small><hr>
                                    <small><b>{{ $turno['inicio'] }}</b></small><hr>
                                    <small><b>{{ $turno['tipo'] }}</b></small><hr>
                                    <h4 class="text-primary" title="cupos">{{ $turno['cantEmpaques'] }}</h4>
                                </div>
                                <div class="p-t-15"></div>
                            @endforeach
                        </div>

                        <div class="col-6 col-sm-6 hidden-lg-up p-t-30 text-center"><h5><b class="text-primary">Viernes</b></h5><hr></div>
                        <div class="col-6 col-sm-6 hidden-lg-up p-t-30 text-center"><h5><b class="text-primary">Sábado</b></h5><hr></div>

                        <div class="col-6 col-sm-6 col-lg-1">
                            @foreach($friday as $turno)
                                <div class="border border-primary rounded text-center p-t-15">
                                    <small><b>{{ $turno['local'] }}</b></small><hr>
                                    <small><b>{{ $turno['cadena'] }}</b></small><hr>
                                    <small><b>{{ $turno['inicio'] }}</b></small><hr>
                                    <small><b>{{ $turno['tipo'] }}</b></small><hr>
                                    <h4 class="text-primary" title="cupos">{{ $turno['cantEmpaques'] }}</h4>
                                </div>
                                <div class="p-t-15"></div>
                            @endforeach
                        </div>

                        <div class="col-6 col-sm-6 col-lg-1">
                            @foreach($saturday as $turno)
                                <div class="border border-primary rounded text-center p-t-15">
                                    <small><b>{{ $turno['local'] }}</b></small><hr>
                                    <small><b>{{ $turno['cadena'] }}</b></small><hr>
                                    <small><b>{{ $turno['inicio'] }}</b></small><hr>
                                    <small><b>{{ $turno['tipo'] }}</b></small><hr>
                                    <h4 class="text-primary" title="cupos">{{ $turno['cantEmpaques'] }}</h4>
                                </div>
                                <div class="p-t-15"></div>
                            @endforeach
                        </div>

                        <div class="col-6 col-sm-6 hidden-lg-up p-t-30 text-center"><h5><b class="text-primary">Domingo</b></h5><hr></div>
                        <div class="col-6 col-sm-6 hidden-lg-up p-t-30 text-center"></div>

                        <div class="col-6 col-sm-6 col-lg-1">
                            @foreach($sunday as $turno)
                                <div class="border border-primary rounded text-center p-t-15">
                                    <small><b>{{ $turno['local'] }}</b></small><hr>
                                    <small><b>{{ $turno['cadena'] }}</b></small><hr>
                                    <small><b>{{ $turno['inicio'] }}</b></small><hr>
                                    <small><b>{{ $turno['tipo'] }}</b></small><hr>
                                    <h4 class="text-primary" title="cupos">{{ $turno['cantEmpaques'] }}</h4>
                                </div>
                                <div class="p-t-15"></div>
                            @endforeach
                        </div>
                        <div class="col-6 col-sm-6 hidden-lg-up"></div>
                    </div>




                    <hr>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a href="{{ url('admin/local/'.$id.'/opciones') }}" class="btn btn-sm btn-primary">Regresar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('js')

@endsection


