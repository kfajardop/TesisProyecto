@php use App\Models\CasoTipo; @endphp
    <!-- Tipo Id Field -->
<div class="col-sm-6">
    {!! Form::label('tipo_id', 'Tipo:') !!}
    <p>{{ $caso->tipo->nombre }}</p>
</div>

<!-- Estado Id Field -->
<div class="col-sm-6">
    {!! Form::label('estado_id', 'Estado:') !!}
    <p>{{ $caso->estado->nombre }}</p>
</div>

<!-- Usuario Id Field -->
<div class="col-sm-6">
    {!! Form::label('usuario_id', 'Usuario:') !!}
    <p>{{ $caso->user->name }}</p>
</div>

<hr style="border: 0.01px solid #c5c4c4; width: 98%">

@if($caso->tipo_id == CasoTipo::FAMILIAR)
    @php
        $demandantes = $caso->partesInvolucradas->filter(fn($p) => $p->tipo_id == \App\Models\ParteTipo::DEMANDANTE);
        $demandados = $caso->partesInvolucradas->filter(fn($p) => $p->tipo_id == \App\Models\ParteTipo::DEMANDADO);
    @endphp
    <div class="col-sm-6">
        {!! Form::label('usuario_id', 'Demandantes:') !!}
        <ul>
            @foreach($demandantes as $demandante)
                <li>{{ $demandante->modelable->nombre_completo }}</li>
            @endforeach
        </ul>
    </div>

    <div class="col-sm-6">
        {!! Form::label('usuario_id', 'Demandados:') !!}
        <ul>
            @foreach($demandados as $demandado)
                <li>{{ $demandado->modelable->nombre_completo }}</li>
            @endforeach
        </ul>
    </div>

    <div class="col-sm-6">
        {!! Form::label('usuario_id', 'Etapa:') !!}
        <p>{{ $caso->familiarJuicioDetalles()->first()->etapa->nombre }}</p>
    </div>

@endif

@if($caso->tipo_id == \App\Models\CasoTipo::PENAL)
    @php
        $victimas = $caso->partesInvolucradas->filter(fn($p) => $p->tipo_id == \App\Models\ParteTipo::VICTIMA);
        $victimarios = $caso->partesInvolucradas->filter(fn($p) => $p->tipo_id == \App\Models\ParteTipo::VICTIMARIO);
    @endphp
    <div class="col-sm-6">
        {!! Form::label('usuario_id', 'Victimas:') !!}
        <ul>
            @foreach($victimas as $victima)
                <li>{{ $victima->modelable->nombre_completo }}</li>
            @endforeach
        </ul>
    </div>

    <div class="col-sm-6">
        {!! Form::label('usuario_id', 'Demandados:') !!}
        <ul>
            @foreach($victimarios as $victimario)
                <li>{{ $victimario->modelable->nombre_completo }}</li>
            @endforeach
        </ul>
    </div>
    <div class="col-sm-6">
        {!! Form::label('usuario_id', 'Etapa:') !!}
        <p>{{ $caso->penalDetalles()->first()->etapa->nombre }}</p>
    </div>

    <div class="col-sm-6">
        {!! Form::label('usuario_id', 'No. Expediente:') !!}
        <p>{{ $caso->penalDetalles()->first()->no_expediente }}</p>
    </div>

    <div class="col-sm-6">
        {!! Form::label('usuario_id', 'No. Causa:') !!}
        <p>{{ $caso->penalDetalles()->first()->no_causa }}</p>
    </div>

@endif
