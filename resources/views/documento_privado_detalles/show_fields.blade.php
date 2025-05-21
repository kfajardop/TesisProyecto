<!-- Fecha Field -->
<div class="col-sm-12">
    {!! Form::label('fecha', 'Fecha:') !!}
    <p>{{ $documentoPrivadoDetalle->fecha }}</p>
</div>

<!-- Comentario Field -->
<div class="col-sm-12">
    {!! Form::label('comentario', 'Comentario:') !!}
    <p>{{ $documentoPrivadoDetalle->comentario }}</p>
</div>

<!-- Documento Id Field -->
<div class="col-sm-12">
    {!! Form::label('documento_id', 'Documento Id:') !!}
    <p>{{ $documentoPrivadoDetalle->documento_id }}</p>
</div>

<!-- Contrato Id Field -->
<div class="col-sm-12">
    {!! Form::label('contrato_id', 'Contrato Id:') !!}
    <p>{{ $documentoPrivadoDetalle->contrato_id }}</p>
</div>

