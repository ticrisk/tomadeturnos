{{-- VENTANA MODAL --}}

<div id="myModal" class="modal fade bs-example-modal-xs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Turno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div id='message-error' class="alert alert-danger danger" role='alert' style="display: none">
                    <strong id="error"></strong>
                </div>

                {!! Form::open(['id'=>'form']) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" id="id" name="id">
                <input type="hidden" id="fecha" name="fecha">
                <input type="hidden" id="planilla_id" name="planilla_id">
                {{-- @include('genero.form.genero') --}}
                {!!form::label('Inicio del Turno')!!}
                {!!form::text('inicio',null,['id'=>'inicio','class'=>'form-control','placeholder'=>'08:31'])!!}

                {!!form::label('Termino del Turno')!!}
                {!!form::text('termino',null,['id'=>'termino','class'=>'form-control','placeholder'=>'12:30'])!!}

                {!!form::label('Cupos del Turno')!!}
                {!!form::text('cupos',null,['id'=>'cupos','class'=>'form-control','placeholder'=>'4'])!!}

                {!!Form::close()!!}
            </div>

            <div class="modal-footer">
                {!!link_to('#', $title='Actualizar', $attributes = ['id'=>'actualizar', 'class'=>'btn btn-primary'])!!}
            </div>
        </div>
    </div>
</div>

