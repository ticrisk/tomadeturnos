@extends('layouts.global-externo')

@section('content')

<section>
    <div class="container">

        <h4 class="text-center">Planillas</h4>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Listado planillas del local</h5>
            </div>
            <div class="card-body">
                <b class="text-center">@include('incluir/mensajes')</b>
                          
                            <div class="row hidden-sm-down">
                              <label class="col-md-2 ">ID</label>
                              <label class="col-md-2">Comienza</label>
                              <label class="col-md-2">Termina</label>
                              <label class="col-md-2">Inicio Toma</label>
                              <label class="col-md-2">Fin Toma</label>
                              <label class="col-md-1 ">Estado</label>
                              <label class="col-md-1 text-center">Editar</label>
                            </div>
                            <hr class="hidden-sm-down">

                          @foreach($planillas as $planilla)


                          <div class="row form-group">
                            <label class="col-6 col-sm-6 hidden-md-up">ID :</label>
                            <div class="col-6 col-sm-6 col-md-2"> {{ $planilla->id }} </div>

                            <label class="col-6 col-sm-6 hidden-md-up"> Inicio Uso : </label>
                            <div class="col-6 col-sm-6 col-md-2"> {{ $planilla->inicioPlanilla }} </div>

                            <label class="col-6 col-sm-6 hidden-md-up">Fin Uso :</label>
                            <div class="col-6 col-sm-6 col-md-2"> {{ $planilla->finPlanilla }} </div>

                            <label class="col-6 col-sm-6 hidden-md-up">Inicio Toma :</label>
                            <div class="col-6 col-sm-6 col-md-2"> {{ $planilla->inicioToma }} </div>

                            <label class="col-6 col-sm-6 hidden-md-up">Fin Toma :</label>
                            <div class="col-6 col-sm-6 col-md-2"> {{ $planilla->finToma }} </div>

                            <label class="col-6 col-sm-6 hidden-md-up">Estado :</label>
                            <div class="col-6 col-sm-6 col-md-1 text-md-center">
                                @if($planilla->estado == 'Activa')
                                    <i class="fa fa-circle text-success" aria-hidden="true" data-toggle="tooltip" title="Activa"></i>
                                    @else
                                    <i class="fa fa-circle text-danger" aria-hidden="true" data-toggle="tooltip" title="Eliminada"></i>
                                @endif
                            </div>

                            <label class="col-6 col-sm-6 hidden-md-up">Editar:</label>
                            <div class="col-6 col-sm-6 col-md-1 text-md-center">
                             <a href="{{ url('admin/planilla/'.$planilla->id.'/opciones') }}" class="btn btn-primary  btn-sm"  data-toggle="tooltip" title="Opciones"><i class="fa fa-cog" aria-hidden="true"></i></a>
                            </div>
                          </div>  

                          

                          <hr class="hidden-md-up">

                          @endforeach

                            <div class="row form-group">
                                <div class="col-12 hidden-sm-up d-flex">
                                    {!! $planillas->links('vendor.pagination.simple-bootstrap-4') !!}
                                </div>
                                <div class="col-md-12 hidden-xs-down d-flex">
                                    {!! $planillas->links('vendor.pagination.bootstrap-4') !!}
                                </div>
                            </div>


                            <div class="row">
                            	<div class="col-md-12 text-center">
                            		<a href="{{ url('admin/local/'.$local.'/opciones') }}" class="btn btn-info  btn-sm"  data-toggle="tooltip" title="Opciones">Regresar</a>
                            	</div>
                            </div>
            </div>
        </div>
    </div>
</section>
@endsection



@section('js')


@endsection


