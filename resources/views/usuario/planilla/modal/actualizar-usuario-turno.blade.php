                              			<!-- Trigger the modal with a button -->


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar Empaque del Turno</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        {!!Form::hidden('id',null, ['id'=>'id','class'=>'form-control'])!!}
        {!!Form::hidden('deseo',null, ['id'=>'deseo','class'=>'form-control'])!!}
        {!!Form::hidden('exDueno',null, ['id'=>'exDueno','class'=>'form-control'])!!}
        {!!Form::hidden('planilla_id',null, ['id'=>'planilla_id','class'=>'form-control'])!!}
        {!!Form::hidden('turno_id',null, ['id'=>'turno_id','class'=>'form-control'])!!}
        {!!Form::hidden('local_user_id',null, ['id'=>'local_user_id','class'=>'form-control'])!!}
        <div class="row">
          
          <div class="col-md-4">Coordinador</div>
          <div class="col-md-8">
          {!! Form::select('coordinador',['Si' => 'Si', 'No' => 'No'], null,['class'=>'form-control select-category','id'=>'coordinador']) !!}
          </div>
          <div class="col-md-4">Fijo</div>
          <div class="col-md-8">
          {!! Form::select('fijo',['Si' => 'Si', 'No' => 'No'], null,['class'=>'form-control select-category','id'=>'fijo']) !!}
          </div>
          <div class="col-md-4">Tipo</div>
          <div class="col-md-8">
          {!!Form::text('tipo',null, ['id'=>'tipo','class'=>'form-control', 'placeholder' => 'ID Turno Tomado', 'readonly'])!!}
          </div>
          <div class="col-md-4">Estado</div>
          <div class="col-md-8">
          {!!Form::text('estado',null, ['id'=>'estado','class'=>'form-control', 'placeholder' => 'ID Turno Tomado', 'readonly'])!!}
          </div>
        </div>

      </div>
      <div class="modal-footer">
        {!!link_to('#', $title='Actualizar', $attributes = ['id'=>'actualizar', 'class'=>'btn btn-success'], $secure = null)!!}
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div><!--fin ventana -->