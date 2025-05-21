<!-- No Escritura Field -->
<div class="col-sm-12">
    {!! Form::label('no_escritura', 'No Escritura:') !!}
    <p>{{ $documentoPublicoDetalle->no_escritura }}</p>
</div>

<!-- Fecha Escritura Field -->
<div class="col-sm-12">
    {!! Form::label('fecha_escritura', 'Fecha Escritura:') !!}
    <p>{{ $documentoPublicoDetalle->fecha_escritura }}</p>
</div>

<!-- Comentario Field -->
<div class="col-sm-12">
    {!! Form::label('comentario', 'Comentario:') !!}
    <p>{{ $documentoPublicoDetalle->comentario }}</p>
</div>

<!-- Documento Id Field -->
<div class="col-sm-12">
    {!! Form::label('documento_id', 'Documento Id:') !!}
    <p>{{ $documentoPublicoDetalle->documento_id }}</p>
</div>

<!-- Escritura Id Field -->
<div class="col-sm-12">
    {!! Form::label('escritura_id', 'Escritura Id:') !!}
    <p>{{ $documentoPublicoDetalle->escritura_id }}</p>
</div>

