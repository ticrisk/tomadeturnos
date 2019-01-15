@extends('layouts.global-externo')

@section('content')
    <section>
        <div class="container">
            <h4 class="text-center">Planilla</h4>

            <div class="text-center"><b>@include('incluir.mensajes')</b></div>
            <div id="message-update" class="alert alert-success alert-dismissible text-center" role="alert" style="display:none">
                <strong> Se Actualizó Correctamente</strong>
            </div>
            {{-- @include('incluir.messages') --}}

            <div class="card card-info">
                <div class="card-header">
                    <h5 class="card-title">Agregar Turnos</h5>
                </div>
                <div class="card-body">
                    {!! Form::open(['action' => 'AdminController@postAgregarTurno', 'method' => 'POST']) !!}
                    {!! Form::hidden('planilla_id', $planilla->id) !!}
                    <div class="form-group row">
                        <label for="exampleInputFile2" class="col-md-3 control-label">Días</label>
                        <div class="col-md-3 col-lg-1">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="dia[mon]" class="form-check-input" type="checkbox" id="inlineCheckbox1" value="lunes"> Lunes
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-1">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="dia[tue]" class="form-check-input" type="checkbox" id="inlineCheckbox2" value="martes"> Martes
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-1">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="dia[wed]" class="form-check-input" type="checkbox" id="inlineCheckbox3" value="miercoles"> Miércoles
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-1">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="dia[thu]" class="form-check-input" type="checkbox" id="inlineCheckbox4" value="jueves"> Jueves
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-1">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="dia[fri]" class="form-check-input" type="checkbox" id="inlineCheckbox5" value="viernes"> Viernes
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-1">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="dia[sat]" class="form-check-input" type="checkbox" id="inlineCheckbox6" value="sabado"> Sábado
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-1">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="dia[sun]" class="form-check-input" type="checkbox" id="inlineCheckbox7" value="domingo"> Domingo
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-3 form-group">
                            {!! Form::text('inicio', null, ['class'=>'form-control', 'placeholder' => '08:31', 'required']) !!}
                        </div>
                        <div class="col-md-3 form-group">
                            {!! Form::text('termino', null, ['class'=>'form-control', 'placeholder' => '12:30', 'required']) !!}
                        </div>
                        <div class="col-md-3 form-group">
                            {!! Form::text('cupos', null, ['class'=>'form-control', 'placeholder' => '4', 'required']) !!}
                        </div>


                        <div class="hidden-lg-up p-t-50"></div>
                        <div class="col-md-3 text-center">
                            {!! Form::submit('Agregar', ['class'=>'btn btn-sm btn-success']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <div class="row">
                        <div class="col-md-12">
                            <small class="text-danger">* Al turno de inicio debes agregar un minuto de más para que se realice las validaciones de hora.</small>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Editar Turnos</h5>
                </div>
                <div class="card-body">

                    <div class="row justify-content-center text-center">
                        <div class="col-lg-1 hidden-md-down"><i><b>Lunes</b> <br> {{ date('d-m-Y', strtotime($planilla->inicioPlanilla)) }} </i><hr></div>
                        <div class="col-lg-1 hidden-md-down"><i><b>Martes</b> <br> {{ date('d-m-Y', strtotime ('+1 day' , strtotime($planilla->inicioPlanilla))) }} </i><hr></div>
                        <div class="col-lg-1 hidden-md-down"><i><b>Miércoles</b> <br> {{ date('d-m-Y', strtotime ('+2 day' , strtotime($planilla->inicioPlanilla))) }} </i><hr></div>
                        <div class="col-lg-1 hidden-md-down"><i><b>Jueves</b> <br> {{ date('d-m-Y', strtotime ('+3 day' , strtotime($planilla->inicioPlanilla))) }} </i><hr></div>
                        <div class="col-lg-1 hidden-md-down"><i><b>Viernes</b> <br> {{ date('d-m-Y', strtotime ('+4 day' , strtotime($planilla->inicioPlanilla))) }} </i><hr></div>
                        <div class="col-lg-1 hidden-md-down"><i><b>Sábado</b> <br> {{ date('d-m-Y', strtotime ('+5 day' , strtotime($planilla->inicioPlanilla))) }} </i><hr></div>
                        <div class="col-lg-1 hidden-md-down"><i><b>Domingo</b> <br> {{ date('d-m-Y', strtotime($planilla->finPlanilla)) }} </i><hr></div>
                    </div>
                    <div id="list-turn"></div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                           <a href="{{ url('admin/planilla/'.$planilla->id.'/opciones') }}" class="btn btn-sm btn-primary">Regresar  </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('incluir.mdl-editar-turno')
    </section>
@endsection

@section('js')
    <!-- plugins js
    <script src="plugins/notify/notify.min.js" charset="utf-8"></script> -->
    <script type="text/javascript">

        $(document).ready(function(){
            listTurn();
        });

        var listTurn = function()
        {
            var id = {!! $planilla->id !!}
            $.ajax({
                type:'get',
                url:"{{url('admin/planilla')}}/"+id+"/listTurn",
                success: function(data){
                    //alert(data);
                    $('#list-turn').empty().html(data);
                }
            });
        }

        var Mostrar = function(id)
        {
            //alert(id);
            var route = "{{url('admin/planilla')}}/"+id+"/infoTurno";
            $.get(route, function(data){
                //alert(data.inicio);
                $("#id").val(data.id);
                $("#fecha").val(data.fecha);
                $("#inicio").val(data.inicio);
                $("#termino").val(data.termino);
                $("#cupos").val(data.cupos);
                $("#planilla_id").val(data.planilla_id);
            });
        }

        $("#actualizar").click(function()
        {
            var id = $("#id").val();
            var fecha = $("#fecha").val();
            var inicio = $("#inicio").val();
            var termino = $("#termino").val();
            var cupos = $("#cupos").val();
            var planilla_id = $("#planilla_id").val();
            var route = "{{url('admin/planilla')}}/"+id+"/updateTurno";
            var token = $("#token").val();

            $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: 'PUT',
                dataType: 'json',
                data: {fecha: fecha, inicio: inicio, termino: termino, cupos: cupos, planilla_id: planilla_id},
                success: function(data){

                    if (data.success == 'true')
                    {
                        listTurn();
                        $("#myModal").modal('toggle');
                        $("#message-update").fadeIn().fadeOut(2000);
                    }
                },
                error:function(data)
                {
                    $("#error").html(" - La hora de inicio debe ser menor a la hora de termino. <br> - La cantidad de cupos debe ser menor a 250.");
                    //$("#error").html(data.responseJSON.name);
                    $("#message-error").fadeIn();
                    if (data.status == 422) {
                        console.clear();
                    }
                }
            });
        });


        var Eliminar = function(id)
        {
            var route = "{{url('admin/planilla')}}/"+id+"/deleteTurno";
            var token = $("#token").val();

            $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: 'DELETE',
                dataType: 'json',
                data: {id: id},
                success: function(data){

                    if (data.message == 'eliminado')
                    {
                        $("#box-"+id).fadeOut(2000);
                        $("#space-"+id).fadeOut(2000);
                    }
                },
                error:function(data)
                {
                    $('#msg-'+id).fadeIn();
                    $("#msg-"+id).fadeOut(3000);
                    if (data.status == 422) {
                        console.clear();
                    }
                }
            });
        }

        //CUANDO CIERRAS LA VENTANA MODAL
        $("#myModal").on("hidden.bs.modal", function () {
            $("#message-error").fadeOut()
        });

    </script>
@endsection


