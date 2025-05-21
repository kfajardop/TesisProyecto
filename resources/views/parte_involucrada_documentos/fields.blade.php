<!-- Model Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('model_type', 'Model Type:') !!}
    {!! Form::text('model_type', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Model Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('model_id', 'Model Id:') !!}
    {!! Form::number('model_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Tipo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_id', 'Tipo Id:') !!}
    {!! Form::number('tipo_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Documento Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('documento_id', 'Documento Id:') !!}
    {!! Form::number('documento_id', null, ['class' => 'form-control', 'required']) !!}
</div>