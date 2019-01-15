@extends('layouts.global-externo')

@section('content')
<section>
    <div class="container">

        <h4 class="text-center">Organzación</h4>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Listado Organización</h5>
            </div>
            <div class="card-body">
                <b class="text-center">@include('incluir/mensajes')</b>

                        <div class="row hidden-sm-down">
                            <label class="col-md-1">ID</label>
                            <label class="col-md-9">Nombre</label>
                            <label class="col-md-1 text-center">Editar</label>
                            <label class="col-md-1 text-center">Borrar</label>
                        </div>
                        <hr class="hidden-sm-down">
                          @foreach($organizacion as $organizaciones)

                            <div class="row form-group">
                                <label class="col-6 hidden-md-up text-right">ID:</label>
                                  <div class="col-6 col-md-1">
                                    {{ $organizaciones->id }}
                                  </div>

                                  <label class="col-6 hidden-md-up text-right">Nombre:</label>
                                  <div class="col-6 col-md-9">
                                    {{ $organizaciones->nombre }}
                                  </div>
                                  <div class="col-6 col-md-1 text-center">
                                    <a href="{{ url('organizacion/'.$organizaciones->id.'/edit') }}" class="btn btn-info  btn-sm"  data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                  </div>
                                  <div class="col-6 col-md-1 text-center">
                                    <a href="{{ url('organizacion/'.$organizaciones->id) }}" class="btn btn-danger  btn-sm"  data-toggle="tooltip" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                  </div>
                            </div>
                            <hr>
                          @endforeach              
                          

                    </div>
                  </div>
                </div>
</section>
@endsection



@section('js')


@endsection


