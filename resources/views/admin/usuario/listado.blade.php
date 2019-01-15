@extends('layouts.global-externo')

@section('content')

<section>
  <div class="container">

    <h4 class="text-center">Empaques</h4>
    <b class="text-center">@include('incluir/mensajes')</b>

                <div class="card card-info">
                  <div class="card-header">
                    <h5 class="card-title">Buscar Empaque</h5>
                  </div>
                  <div class="card-body">

                          {!! Form::open(['route' => 'admin.usuario.listado', 'method' => 'GET']) !!}

                          <div class="row form-group">
                          
                                <div class="col-12 col-lg-10">
                                    {!! Form::text('nombre', null, ['class'=>'form-control','placeholder'=>'ID - Rut - Nombre - Apellido', 'required']) !!}
                                </div>

                                <div class="hidden-lg-up p-t-50"></div>
                                <div class="col-12 col-lg-2 text-center">
                                  {!! Form::submit('Buscar', ['class'=>'btn btn-sm btn-info']) !!}
                                </div>
                          </div>

                          {!! Form::close() !!}
                  </div>

                </div>




                <div class="card card-primary">
                  <div class="card-header">
                    <h5 class="card-title">Últimos Registrados</h5>
                  </div>
                  <div class="card-body">

                            <div class="row hidden-md-down">

                              <label class="col-lg-1">ID</label>
                              <label class="col-lg-2">Rut</label>
                              <label class="col-lg-2">Nombre</label>
                              <label class="col-lg-2">Apellido</label>
                              <label class="col-lg-2 text-center">Asignar</label>
                              <label class="col-lg-2 text-center">Locales</label>
                              <label class="col-lg-1 text-center">Datos</label>
                            </div>
                            <hr class="hidden-md-down">

                          @foreach($usuario as $usuarios)


                            <div class="row">
                              <label class="col-6 col-m-6 hidden-lg-up">ID:</label>
                              <div class="col-6 col-md-6 col-lg-1"> {{ $usuarios->id }} </div>

                              <label class="col-6 col-md-6 hidden-lg-up">Rut:</label>
                              <div class="col-6 col-md-6 col-lg-2"> {{ $usuarios->rut }} </div>

                              <label class="col-6 col-md-6 hidden-lg-up">Nombre:</label>
                              <div class="col-6 col-md-6 col-lg-2"> {{ $usuarios->nombre }} </div>

                              <label class="col-6 col-md-6 hidden-lg-up">Apellido:</label>
                              <div class="col-6 col-md-6 col-lg-2"> {{ $usuarios->apellido }} </div>

                              <div class="hidden-lg-up p-t-40"></div>
                              <label class="col-6 col-md-6 hidden-lg-up">Asignar:</label>
                              <div class="col-6 col-md-6 col-lg-2 text-center">
                                <a href="{{ url('admin/usuario/'.$usuarios->id.'/asignar') }}" class="btn btn-success  btn-sm"  data-toggle="tooltip" title="Asignar"><i class="fa fa-flag" aria-hidden="true"></i></a>
                              </div>

                              <div class="hidden-lg-up p-t-40"></div>
                              <label class="col-6 col-md-6 hidden-lg-up">Locales:</label>
                              <div class="col-6 col-md-6 col-lg-2 text-center">
                                <a href="{{ url('admin/usuario/'.$usuarios->id.'/locales') }}" class="btn btn-primary  btn-sm"  data-toggle="tooltip" title="Ver Locales"><i class="fa fa-home" aria-hidden="true"></i></a>
                              </div>

                              <div class="hidden-lg-up p-t-40"></div>
                              <label class="col-6 col-md-6 hidden-lg-up">Perfil:</label>
                              <div class="col-6 col-md-6 col-lg-1 text-center">
                                <a href="{{ url('admin/usuario/'.$usuarios->id.'/perfil') }}" class="btn btn-info  btn-sm"  data-toggle="tooltip" title="Perfil"><i class="fa fa-user" aria-hidden="true"></i></a>
                              </div>
                            </div>

                            <hr class="hidden-lg-up">
                            <div class="hidden-md-down p-t-15"></div>

                          @endforeach  


                            <div class="text-center">
                              {!! $usuario->appends(Request::only(['nombre']))->links('vendor.pagination.simple-bootstrap-4') !!}
                            </div>            
                          

                    </div>
                </div>
    </div>
</section>


@endsection



@section('js')


@endsection


