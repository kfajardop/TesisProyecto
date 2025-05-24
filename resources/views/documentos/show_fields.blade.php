<!-- Tipo Documento -->
<div class="col-sm-6">
    {!! Form::label('tipo_id', 'Tipo:') !!}
    <p>{{ $documento->tipo->nombre }}</p>
</div>

<!-- Estado del Documento -->
<div class="col-sm-6">
    {!! Form::label('estado_id', 'Estado:') !!}
    <p>{{ $documento->estado->nombre }}</p>
</div>

<!-- Usuario Creador -->
<div class="col-sm-6">
    {!! Form::label('usuario_id', 'Usuario Crea:') !!}
    <p>{{ $documento->usuario->name }}</p>
</div>

<!-- Mostrar campos según el tipo de documento -->
@if ($documento->tipo_id === \App\Models\DocumentoTipo::PUBLICO)
    <!-- Tipo Escritura -->
    <div class="col-sm-6">
        {!! Form::label('tipo_escritura_id', 'Tipo Escritura:') !!}
        <p>{{ optional($documento->doctoPublicoDetalles->first()->escritura)->nombre }}</p>
    </div>

    <!-- Número de Escritura -->
    <div class="col-sm-6">
        {!! Form::label('no_escritura', 'No. Escritura:') !!}
        <p>{{ $documento->no_escritura }}</p>
    </div>
@endif

@if ($documento->tipo_id === \App\Models\DocumentoTipo::PRIVADO)
    <!-- Tipo Contrato -->
    <div class="col-sm-6">
        {!! Form::label('contrato_id', 'Tipo Contrato:') !!}
        <p>{{ optional($documento->doctoPrivadoDetalles->first()->contrato)->nombre }}</p>
    </div>
@endif

@if ($documento->tipo_id === \App\Models\DocumentoTipo::ACTA_NOTARIAL)
    <!-- Tipo Acta Notarial -->
    <div class="col-sm-6">
        {!! Form::label('notarial_id', 'Tipo Acta Notarial:') !!}
        <p>{{ optional($documento->doctoActaDetalles->first()->notarial)->nombre }}</p>
    </div>
@endif

<!-- Comparecientes -->
<div class="col-sm-6">
    {!! Form::label('comparecientes', 'Comparecientes:') !!}
    <ul>
        @foreach($documento->comparecientes() as $persona)
            <li>{{ $persona->nombre_completo }}</li>
        @endforeach
    </ul>
</div>

<!-- Intervinientes -->
<div class="col-sm-6">
    {!! Form::label('intervinientes', 'Intervinientes:') !!}
    <ul>
        @foreach($documento->intervinientes() as $persona)
            <li>{{ $persona->nombre_completo }}</li>
        @endforeach
    </ul>
</div>

<!-- Fecha Documento -->
<div class="col-sm-6">
    {!! Form::label('fecha_documento', 'Fecha Documento:') !!}
    <p>{{ $documento->fecha_documento->format('d/m/Y') }}</p>
</div>

<hr style="border: 0.01px solid #c5c4c4; width: 98%">

<x-bitacora-documentos-time-line :documento-id="$documento->id" />
