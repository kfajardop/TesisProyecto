<!-- Fecha Field -->
<div class="col-sm-12">
    {!! Form::label('fecha', 'Fecha:') !!}
    <p>{{ $documentoActaDetalle->fecha }}</p>
</div>

<!-- Comentario Field -->
<div class="col-sm-12">
    {!! Form::label('comentario', 'Comentario:') !!}
    <p>{{ $documentoActaDetalle->comentario }}</p>
</div>

<!-- Documento Id Field -->
<div class="col-sm-12">
    {!! Form::label('documento_id', 'Documento Id:') !!}
    <p>{{ $documentoActaDetalle->documento_id }}</p>
</div>

<!-- Notarial Id Field -->
<div class="col-sm-12">
    {!! Form::label('notarial_id', 'Notarial Id:') !!}
    <p>{{ $documentoActaDetalle->notarial_id }}</p>
</div>

