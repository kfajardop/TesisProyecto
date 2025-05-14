<!-- Direccion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('direccion', 'Direccion:') !!}
    {!! Form::text('direccion', null, ['class' => 'form-control', 'required', 'maxlength' => 55, 'maxlength' => 55]) !!}
</div>

<!-- Municipio Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('municipio_id', 'Municipio Id:') !!}
    {!! Form::number('municipio_id', null, ['class' => 'form-control', 'required']) !!}
</div>