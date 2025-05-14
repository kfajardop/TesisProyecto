<!-- Primer Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('primer_nombre', 'Primer Nombre:') !!}
    {!! Form::text('primer_nombre', null, ['class' => 'form-control', 'required', 'maxlength' => 55, 'maxlength' => 55]) !!}
</div>

<!-- Segundo Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('segundo_nombre', 'Segundo Nombre:') !!}
    {!! Form::text('segundo_nombre', null, ['class' => 'form-control', 'maxlength' => 55, 'maxlength' => 55]) !!}
</div>

<!-- Primer Apellido Field -->
<div class="form-group col-sm-6">
    {!! Form::label('primer_apellido', 'Primer Apellido:') !!}
    {!! Form::text('primer_apellido', null, ['class' => 'form-control', 'required', 'maxlength' => 55, 'maxlength' => 55]) !!}
</div>

<!-- Segundo Apellido Field -->
<div class="form-group col-sm-6">
    {!! Form::label('segundo_apellido', 'Segundo Apellido:') !!}
    {!! Form::text('segundo_apellido', null, ['class' => 'form-control', 'maxlength' => 55, 'maxlength' => 55]) !!}
</div>

<!-- Dpi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dpi', 'Dpi:') !!}
    {!! Form::text('dpi', null, ['class' => 'form-control', 'maxlength' => 13, 'maxlength' => 13]) !!}
</div>

<!-- Telefono Field -->
<div class="form-group col-sm-6">
    {!! Form::label('telefono', 'Telefono:') !!}
    {!! Form::text('telefono', null, ['class' => 'form-control', 'maxlength' => 8, 'maxlength' => 8]) !!}
</div>

<!-- Direccion Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('direccion_id', 'Direccion Id:') !!}
    {!! Form::number('direccion_id', null, ['class' => 'form-control', 'required']) !!}
</div>