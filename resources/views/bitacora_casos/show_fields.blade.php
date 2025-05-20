<!-- Descripcion Field -->
<div class="col-sm-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    <p>{{ $bitacoraCaso->descripcion }}</p>
</div>

<!-- Usuario Id Field -->
<div class="col-sm-12">
    {!! Form::label('usuario_id', 'Usuario Id:') !!}
    <p>{{ $bitacoraCaso->usuario_id }}</p>
</div>

<!-- Caso Id Field -->
<div class="col-sm-12">
    {!! Form::label('caso_id', 'Caso Id:') !!}
    <p>{{ $bitacoraCaso->caso_id }}</p>
</div>

