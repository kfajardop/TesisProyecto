<!-- Nombre Field -->
<div class="col-sm-12">
    {!! Form::label('nombre', 'Nombre:') !!}
    <p>{{ $casoFamiliarJuicioDetalle->nombre }}</p>
</div>

<!-- Juicio Etapa Id Field -->
<div class="col-sm-12">
    {!! Form::label('juicio_etapa_id', 'Juicio Etapa Id:') !!}
    <p>{{ $casoFamiliarJuicioDetalle->juicio_etapa_id }}</p>
</div>

<!-- Caso Id Field -->
<div class="col-sm-12">
    {!! Form::label('caso_id', 'Caso Id:') !!}
    <p>{{ $casoFamiliarJuicioDetalle->caso_id }}</p>
</div>

<!-- Tipo Juicio Id Field -->
<div class="col-sm-12">
    {!! Form::label('tipo_juicio_id', 'Tipo Juicio Id:') !!}
    <p>{{ $casoFamiliarJuicioDetalle->tipo_juicio_id }}</p>
</div>

