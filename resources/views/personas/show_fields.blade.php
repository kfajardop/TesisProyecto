<!-- Primer Nombre Field -->
<div class="col-sm-12">
    {!! Form::label('primer_nombre', 'Primer Nombre:') !!}
    <p>{{ $persona->primer_nombre }}</p>
</div>

<!-- Segundo Nombre Field -->
<div class="col-sm-12">
    {!! Form::label('segundo_nombre', 'Segundo Nombre:') !!}
    <p>{{ $persona->segundo_nombre }}</p>
</div>

<!-- Primer Apellido Field -->
<div class="col-sm-12">
    {!! Form::label('primer_apellido', 'Primer Apellido:') !!}
    <p>{{ $persona->primer_apellido }}</p>
</div>

<!-- Segundo Apellido Field -->
<div class="col-sm-12">
    {!! Form::label('segundo_apellido', 'Segundo Apellido:') !!}
    <p>{{ $persona->segundo_apellido }}</p>
</div>

