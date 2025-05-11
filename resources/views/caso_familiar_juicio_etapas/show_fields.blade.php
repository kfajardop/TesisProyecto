<!-- Nombre Field -->
<div class="col-sm-12">
    {!! Form::label('nombre', 'Nombre:') !!}
    <p>{{ $casoFamiliarJuicioEtapa->nombre }}</p>
</div>

<!-- Tipo de Juicio Field -->
<div class="col-sm-12">
    {!! Form::label('tipo_juicio_id', 'Tipo de Juicio:') !!}
    <p>{{ $casoFamiliarJuicioEtapa->tipoJuicio->nombre ?? 'No definido' }}</p>
</div>


