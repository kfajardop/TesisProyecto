<!-- Descripcion Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'required', 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>

<!-- Usuario Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('usuario_id', 'Usuario Id:') !!}
    {!! Form::number('usuario_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Caso Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('caso_id', 'Caso Id:') !!}
    {!! Form::number('caso_id', null, ['class' => 'form-control', 'required']) !!}
</div>