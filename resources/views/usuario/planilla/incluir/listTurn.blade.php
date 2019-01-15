
<div class="row justify-content-center">
    <div class="col-6 col-sm-6 hidden-lg-up text-center"><h5><b class="text-primary">Lunes</b></h5><hr></div>
    <div class="col-6 col-sm-6 hidden-lg-up text-center"><h5><b class="text-primary">Martes</b></h5><hr></div>
    <div class="col-6 col-sm-6 col-lg-1">
        @foreach($monday as $turno)
            <div class="border border-primary rounded text-center p-t-15" id="box-{{ $turno['id'] }}">
                <b>{{ $turno['inicio'] }}</b> <br>
                <b>{{ $turno['termino'] }}</b> <br>
                <h4 class="text-primary" title="cupos">{{ $turno['cupos'] }}</h4>
                <div class="p-t-10"></div>
                <div id="msg-{{ $turno['id'] }}" style="display: none"><b class="text-danger">Error</b></div>
                <a href="#" OnClick='Mostrar( {{ $turno['id'] }} );' data-toggle='modal' data-target='#myModal' class='btn btn-xs btn-success'><i class="fa fa-pencil" aria-hidden="true"></i></a>
                <div class="p-t-15"></div>
                <a href="#!" OnClick='Eliminar( {{ $turno['id'] }} );' class='btn btn-xs btn-danger'><i class="fa fa-trash" aria-hidden="true"></i></a>
                <div class="p-t-15"></div>
            </div>
            <div class="p-t-15" id="space-{{ $turno['id'] }}"></div>
        @endforeach
    </div>


    <div class="col-6 col-sm-6 col-lg-1">
        @foreach($tuesday as $turno)
            <div class="border border-primary rounded text-center p-t-15" id="box-{{ $turno['id'] }}">
                <b>{{ $turno['inicio'] }}</b> <br>
                <b>{{ $turno['termino'] }}</b> <br>
                <h4 class="text-primary" title="cupos">{{ $turno['cupos'] }}</h4>
                <div class="p-t-10"></div>
                <div id="msg-{{ $turno['id'] }}" style="display: none"><b class="text-danger">Error</b></div>
                <a href="#" OnClick='Mostrar( {{ $turno['id'] }} );' data-toggle='modal' data-target='#myModal' class='btn btn-xs btn-success'><i class="fa fa-pencil" aria-hidden="true"></i></a>
                <div class="p-t-15"></div>
                <a href="#!" OnClick='Eliminar( {{ $turno['id'] }} );' class='btn btn-xs btn-danger'><i class="fa fa-trash" aria-hidden="true"></i></a>
                <div class="p-t-15"></div>
            </div>
            <div class="p-t-15" id="space-{{ $turno['id'] }}"></div>
        @endforeach
    </div>

    <div class="col-6 col-sm-6 hidden-lg-up p-t-30 text-center"><h5><b class="text-primary">Miércoles</b></h5><hr></div>
    <div class="col-6 col-sm-6 hidden-lg-up p-t-30 text-center"><h5><b class="text-primary">Jueves</b></h5><hr></div>

    <div class="col-6 col-sm-6 col-lg-1">
        @foreach($wednesday as $turno)
            <div class="border border-primary rounded text-center p-t-15" id="box-{{ $turno['id'] }}">
                <b>{{ $turno['inicio'] }}</b> <br>
                <b>{{ $turno['termino'] }}</b> <br>
                <h4 class="text-primary" title="cupos">{{ $turno['cupos'] }}</h4>
                <div class="p-t-10"></div>
                <div id="msg-{{ $turno['id'] }}" style="display: none"><b class="text-danger">Error</b></div>
                <a href="#" OnClick='Mostrar( {{ $turno['id'] }} );' data-toggle='modal' data-target='#myModal' class='btn btn-xs btn-success'><i class="fa fa-pencil" aria-hidden="true"></i></a>
                <div class="p-t-15"></div>
                <a href="#!" OnClick='Eliminar( {{ $turno['id'] }} );' class='btn btn-xs btn-danger'><i class="fa fa-trash" aria-hidden="true"></i></a>
                <div class="p-t-15"></div>
            </div>
            <div class="p-t-15" id="space-{{ $turno['id'] }}"></div>
        @endforeach
    </div>

    <div class="col-6 col-sm-6 col-lg-1">
        @foreach($thursday as $turno)
            <div class="border border-primary rounded text-center p-t-15" id="box-{{ $turno['id'] }}">
                <b>{{ $turno['inicio'] }}</b> <br>
                <b>{{ $turno['termino'] }}</b> <br>
                <h4 class="text-primary" title="cupos">{{ $turno['cupos'] }}</h4>
                <div class="p-t-10"></div>
                <div id="msg-{{ $turno['id'] }}" style="display: none"><b class="text-danger">Error</b></div>
                <a href="#" OnClick='Mostrar( {{ $turno['id'] }} );' data-toggle='modal' data-target='#myModal' class='btn btn-xs btn-success'><i class="fa fa-pencil" aria-hidden="true"></i></a>
                <div class="p-t-15"></div>
                <a href="#!" OnClick='Eliminar( {{ $turno['id'] }} );' class='btn btn-xs btn-danger'><i class="fa fa-trash" aria-hidden="true"></i></a>
                <div class="p-t-15"></div>
            </div>
            <div class="p-t-15" id="space-{{ $turno['id'] }}"></div>
        @endforeach
    </div>

    <div class="col-6 col-sm-6 hidden-lg-up p-t-30 text-center"><h5><b class="text-primary">Viernes</b></h5><hr></div>
    <div class="col-6 col-sm-6 hidden-lg-up p-t-30 text-center"><h5><b class="text-primary">Sábado</b></h5><hr></div>

    <div class="col-6 col-sm-6 col-lg-1">
        @foreach($friday as $turno)
            <div class="border border-primary rounded text-center p-t-15" id="box-{{ $turno['id'] }}">
                <b>{{ $turno['inicio'] }}</b> <br>
                <b>{{ $turno['termino'] }}</b> <br>
                <h4 class="text-primary" title="cupos">{{ $turno['cupos'] }}</h4>
                <div class="p-t-10"></div>
                <div id="msg-{{ $turno['id'] }}" style="display: none"><b class="text-danger">Error</b></div>
                <a href="#" OnClick='Mostrar( {{ $turno['id'] }} );' data-toggle='modal' data-target='#myModal' class='btn btn-xs btn-success'><i class="fa fa-pencil" aria-hidden="true"></i></a>
                <div class="p-t-15"></div>
                <a href="#!" OnClick='Eliminar( {{ $turno['id'] }} );' class='btn btn-xs btn-danger'><i class="fa fa-trash" aria-hidden="true"></i></a>
                <div class="p-t-15"></div>
            </div>
            <div class="p-t-15" id="space-{{ $turno['id'] }}"></div>
        @endforeach
    </div>

    <div class="col-6 col-sm-6 col-lg-1">
        @foreach($saturday as $turno)
            <div class="border border-primary rounded text-center p-t-15" id="box-{{ $turno['id'] }}">
                <b>{{ $turno['inicio'] }}</b> <br>
                <b>{{ $turno['termino'] }}</b> <br>
                <h4 class="text-primary" title="cupos">{{ $turno['cupos'] }}</h4>
                <div class="p-t-10"></div>
                <div id="msg-{{ $turno['id'] }}" style="display: none"><b class="text-danger">Error</b></div>
                <a href="#" OnClick='Mostrar( {{ $turno['id'] }} );' data-toggle='modal' data-target='#myModal' class='btn btn-xs btn-success'><i class="fa fa-pencil" aria-hidden="true"></i></a>
                <div class="p-t-15"></div>
                <a href="#!" OnClick='Eliminar( {{ $turno['id'] }} );' class='btn btn-xs btn-danger'><i class="fa fa-trash" aria-hidden="true"></i></a>
                <div class="p-t-15"></div>
            </div>
            <div class="p-t-15" id="space-{{ $turno['id'] }}"></div>
        @endforeach
    </div>

    <div class="col-6 col-sm-6 hidden-lg-up p-t-30 text-center"><h5><b class="text-primary">Domingo</b></h5><hr></div>
    <div class="col-6 col-sm-6 hidden-lg-up p-t-30 text-center"></div>

    <div class="col-6 col-sm-6 col-lg-1">
        @foreach($sunday as $turno)
            <div class="border border-primary rounded text-center p-t-15" id="box-{{ $turno['id'] }}">
                <b>{{ $turno['inicio'] }}</b> <br>
                <b>{{ $turno['termino'] }}</b> <br>
                <h4 class="text-primary" title="cupos">{{ $turno['cupos'] }}</h4>
                <div class="p-t-10"></div>
                <div id="msg-{{ $turno['id'] }}" style="display: none"><b class="text-danger">Error</b></div>
                <a href="#" OnClick='Mostrar( {{ $turno['id'] }} );' data-toggle='modal' data-target='#myModal' class='btn btn-xs btn-success'><i class="fa fa-pencil" aria-hidden="true"></i></a>
                <div class="p-t-15"></div>
                <a href="#!" OnClick='Eliminar( {{ $turno['id'] }} );' class='btn btn-xs btn-danger'><i class="fa fa-trash" aria-hidden="true"></i></a>
                <div class="p-t-15"></div>
            </div>
            <div class="p-t-15" id="space-{{ $turno['id'] }}"></div>
        @endforeach
    </div>
    <div class="col-6 col-sm-6 hidden-lg-up"></div>

</div>
