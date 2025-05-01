<!-- Nombre Field -->
<div class="col-sm-12">
    {!! Form::label('nombre', 'Nombre:') !!}
    <p>{{ $contacto->nombre }}</p>
</div>

<!-- Telefono Field -->
<div class="col-sm-12">
    {!! Form::label('telefono', 'Teléfono:') !!}
    <p>{{ $contacto->telefono }}</p>
</div>

<!-- Comentario Field -->
<div class="col-sm-12">
    {!! Form::label('comentario', 'Comentario:') !!}
    <p>{{ $contacto->comentario }}</p>
</div>

