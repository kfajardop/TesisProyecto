<!-- Titulo Field -->
<div class="col-sm-12">
    {!! Form::label('titulo', 'Titulo:') !!}
    <p>{{ $bitacoraDocumento->titulo }}</p>
</div>

<!-- Descripcion Field -->
<div class="col-sm-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    <p>{{ $bitacoraDocumento->descripcion }}</p>
</div>

<!-- Usuario Id Field -->
<div class="col-sm-12">
    {!! Form::label('usuario_id', 'Usuario Id:') !!}
    <p>{{ $bitacoraDocumento->usuario_id }}</p>
</div>

<!-- Documento Id Field -->
<div class="col-sm-12">
    {!! Form::label('documento_id', 'Documento Id:') !!}
    <p>{{ $bitacoraDocumento->documento_id }}</p>
</div>

