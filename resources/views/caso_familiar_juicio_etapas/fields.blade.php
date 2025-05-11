<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Tipo Juicio Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_juicio_id', 'Tipo de Juicio:') !!}
    {!! Form::select('tipo_juicio_id', $tiposJuicio, null, ['class' => 'form-control', 'placeholder' => 'Seleccione un tipo']) !!}
</div>
