@extends('layouts.global-externo')

@section('content')

<section>
    <div class="container">

        <h4 class="text-center">Empaque</h4>
        <b class="text-center">@include('incluir/mensajes')</b>

        <div class="card card-info">
            <div class="card-header">
                <h5 class="card-title">Información</h5>
            </div>
            <div class="card-body">

                      <div class="row">
                          <div class="col-lg-1"> <b>ID :</b> {{ $usuario->id }} </div>
                          <div class="col-lg-2"> <b>Rut :</b> {{ $usuario->rut }} </div>
                          <div class="col-lg-4"> <b>Nombre :</b> {{ $usuario->nombre }} {{ $usuario->apellido }} </div>
                          <div class="col-lg-2"> <b>Rol :</b> {{ $usuario->rol }} </div>
                          <div class="col-lg-3"> <b>Estado :</b> {{ $usuario->estado }} </div>
                      </div>

            </div>
        </div>



                <div class="card card-primary">
                    <div class="card-header">
                        <h5 class="card-title">Agregar Local</h5>
                    </div>
                    <div class="card-body">
                          
                            <div class="row hidden-md-down">

                              <label class="col-lg-1"> ID </label>
                              <label class="col-lg-2"> Rol </label>
                              <label class="col-lg-2"> Estado </label>
                              <label class="col-lg-2"> Local </label>
                              <label class="col-lg-2"> Cadena </label>
                              <label class="col-lg-1"> Editar </label>
                              <label class="col-lg-2"> Desvincular </label>
                            </div>
                            <hr class="hidden-md-down">

                          @foreach($local_user as $locales_users)


                            <div class="row">

                              <label class="col-6 hidden-lg-up">ID:</label>
                              <div class="col-6 col-lg-1"> {{ $locales_users->id }} </div>

                              <label class="col-6 hidden-lg-up">Rol:</label>
                              <div class="col-6 col-md-2"> {{ $locales_users->rol }} </div>

                              <label class="col-6 hidden-lg-up">Estado:</label>
                              <div class="col-6 col-md-2"> {{ $locales_users->estado }} </div>

                              <label class="col-6 hidden-lg-up">Local:</label>
                              <div class="col-6 col-md-2"> {{ $locales_users->Local->nombre }} </div>

                              <label class="col-6 hidden-lg-up">Cadena:</label>
                              <div class="col-6 col-md-2"> {{ $locales_users->Local->Cadena->nombre }} </div>


                              <label class="col-6 hidden-lg-up">Editar:</label>
                              <div class="col-6 col-md-1 ">
                                <a href="{{ url('admin/usuario/'.$locales_users->id.'/editar') }}" class="btn btn-success  btn-sm"  data-toggle="tooltip" title="Asignar"><i class="fa fa-flag" aria-hidden="true"></i></a>
                              </div>

                              <div class="hidden-lg-up p-t-45"></div>
                              <label class="col-6 hidden-lg-up">Desvincular:</label>
                              <div class="col-6 col-md-2 ">
                              {!! Form::open(['route' => ['admin.destroy', $locales_users->id], 'method' => 'DELETE']) !!}
                                  <!--<button type="submit">Eliminar</button>-->
                                  <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Eliminar" onclick="return confirm('¿Esta seguro que desea Desvincular este Usuario?')"><i class="fa fa-trash"></i></button>
                                {!! Form::close() !!}

                              </div>
                            

                  
                            </div>

                            <hr>
                          @endforeach  

       
                          <div class="col-lg-12 text-center">
                              <a href="{{ url('admin/usuario/listado') }}" class="btn btn-sm btn-primary">Volver</a>
                          </div>

                    </div>
                </div>
    </div>
</section>
@endsection



@section('js')


@endsection


