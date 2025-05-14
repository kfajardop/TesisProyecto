<!-- No Causa Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_causa', 'No Causa:') !!}
    {!! Form::text('no_causa', null, ['class' => 'form-control', 'required', 'maxlength' => 10, 'maxlength' => 10]) !!}
</div>

<!-- No Expediente Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_expediente', 'No Expediente:') !!}
    {!! Form::text('no_expediente', null, ['class' => 'form-control', 'required', 'maxlength' => 45, 'maxlength' => 45]) !!}
</div>

<!-- Caso Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('caso_id', 'Caso Id:') !!}
    {!! Form::number('caso_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Delito Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('delito_id', 'Delito Id:') !!}
    {!! Form::number('delito_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Etapa Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('etapa_id', 'Etapa Id:') !!}
    {!! Form::number('etapa_id', null, ['class' => 'form-control', 'required']) !!}
</div>