<!-- Primer Nombre Field -->
<div class="col-sm-4">
    {!! Form::label('primer_nombre', 'Primer Nombre:') !!}
    <p>{{ $cliente->primer_nombre }}</p>
</div>

<!-- Segundo Nombre Field -->
<div class="col-sm-4">
    {!! Form::label('segundo_nombre', 'Segundo Nombre:') !!}
    <p>{{ $cliente->segundo_nombre }}</p>
</div>

<!-- Primer Apellido Field -->
<div class="col-sm-4">
    {!! Form::label('primer_apellido', 'Primer Apellido:') !!}
    <p>{{ $cliente->primer_apellido }}</p>
</div>

<!-- Segundo Apellido Field -->
<div class="col-sm-4">
    {!! Form::label('segundo_apellido', 'Segundo Apellido:') !!}
    <p>{{ $cliente->segundo_apellido }}</p>
</div>

<!-- Dpi Field -->
<div class="col-sm-4">
    {!! Form::label('dpi', 'Dpi:') !!}
    <p>{{ $cliente->dpi }}</p>
</div>

<!-- Telefono Field -->
<div class="col-sm-4">
    {!! Form::label('telefono', 'Telefono:') !!}
    <p>{{ $cliente->telefono }}</p>
</div>

<!-- Direccion Id Field -->
<div class="col-sm-4">
    {!! Form::label('direccion_id', 'Departamento:') !!}
    <p>{{ $cliente->direccion->municipio->departamento->nombre }}</p>
</div>

<div class="col-sm-4">
    {!! Form::label('direccion_id', 'Municipio:') !!}
    <p>{{ $cliente->direccion->municipio->nombre }}</p>
</div>

<div class="col-sm-4">
    {!! Form::label('direccion_id', 'Dirección:') !!}
    <p>{{ $cliente->direccion->direccion }}</p>
</div>

