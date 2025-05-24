<!-- Fecha Field -->
<div class="col-sm-6">
    {!! Form::label('fecha', 'Fecha:') !!}
    <p>{{ $audiencia->fecha }}</p>
</div>

<!-- Hora Field -->
<div class="col-sm-6">
    {!! Form::label('hora', 'Hora:') !!}
    <p>{{ $audiencia->hora }}</p>
</div>

<!-- Lugar Field -->
<div class="col-sm-6">
    {!! Form::label('lugar', 'Lugar:') !!}
    <p>{{ $audiencia->lugar }}</p>
</div>

<!-- Caso Id Field -->
<div class="col-sm-6">
    {!! Form::label('caso_id', 'Caso:') !!}
    <p>{{ $audiencia->caso->nombre_caso }}</p>
</div>

<div class="col-sm-6">
    {!! Form::label('participantes', 'Participantes:') !!}
    <ul>
        @foreach($audiencia->participantes() as $persona)
            <li>{{ $persona->nombre_completo }}</li>
        @endforeach
    </ul>
</div>
