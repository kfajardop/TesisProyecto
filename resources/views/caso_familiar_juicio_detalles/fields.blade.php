<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Juicio Etapa Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('juicio_etapa_id', 'Juicio Etapa Id:') !!}
    {!! Form::number('juicio_etapa_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Caso Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('caso_id', 'Caso Id:') !!}
    {!! Form::number('caso_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Tipo Juicio Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_juicio_id', 'Tipo Juicio Id:') !!}
    {!! Form::number('tipo_juicio_id', null, ['class' => 'form-control', 'required']) !!}
</div>