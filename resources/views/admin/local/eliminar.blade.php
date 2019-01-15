@extends('layouts.global-nero')

@section('content')
<section>
    <div class="container">

        <h4 class="text-center">Local</h4>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">ELiminar Local</h5>
            </div>
            <div class="card-body">
                <b class="text-center">@include('incluir/mensajes')</b>
                          {!! Form::open(['route' => ['admin.local.deleteEliminarLocal', $local], 'method' => 'DELETE'])!!}

                            <div class="row form-group">
                                <label class="col-lg-2">Nombre</label>
                                <div class="col-lg-10">
                                    {!! Form::text('nombre', $local->nombre,['class'=>'form-control','placeholder'=>'Nombre Obligatorio', 'required', 'readonly']) !!}
                                </div>
                            </div>
                            
                            <div class="row form-group">
                              <div class="col-lg-12 text-center">
                                {!! Form::submit('Eliminar', ['class'=>'btn btn-sm btn-danger']) !!}
                                <a href="{{ url('admin/local/'.$local->id.'/editar') }}" class="btn btn-sm btn-primary">Volver</a>
                              </div>
                            </div>
                         
                          {!! Form::close() !!}



                        <div class="p-t-35"></div>
                        <div class="alert alert-danger" role="alert">
                            <strong>** </strong> Si elimina este Local se eliminaran en cascada los empaques asignados, planillas, turnos tomados, faltas y todo lo relacionado con el local.
                        </div>
            </div>
        </div>
    </div>
</section>

@endsection



@section('js')


@endsection


