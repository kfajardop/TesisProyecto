<!-- Nombre Field -->
<div class="col-sm-12">
    {!! Form::label('nombre', 'Nombre:') !!}
    <p>{{ $tarea->nombre }}</p>
</div>

<!-- Fecha Field -->
<div class="col-sm-12">
    {!! Form::label('fecha', 'Fecha:') !!}
    <p>{{ $tarea->fecha }}</p>
</div>

<!-- Hora Field -->
<div class="col-sm-12">
    {!! Form::label('hora', 'Hora:') !!}
    <p>{{ $tarea->hora }}</p>
</div>

<!-- Descripcion Field -->
<div class="col-sm-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    <p>{{ $tarea->descripcion }}</p>
</div>

<!-- Prioridad Id Field -->
<div class="col-sm-12">
    {!! Form::label('prioridad_id', 'Prioridad Id:') !!}
    <p>{{ $tarea->prioridad_id }}</p>
</div>

<!-- Estado Id Field -->
<div class="col-sm-12">
    {!! Form::label('estado_id', 'Estado Id:') !!}
    <p>{{ $tarea->estado_id }}</p>
</div>

