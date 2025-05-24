<!-- Fecha Field -->
<div class="col-sm-12">
    {!! Form::label('fecha', 'Fecha:') !!}
    <p>{{ $audiencia->fecha }}</p>
</div>

<!-- Hora Field -->
<div class="col-sm-12">
    {!! Form::label('hora', 'Hora:') !!}
    <p>{{ $audiencia->hora }}</p>
</div>

<!-- Lugar Field -->
<div class="col-sm-12">
    {!! Form::label('lugar', 'Lugar:') !!}
    <p>{{ $audiencia->lugar }}</p>
</div>

<!-- Caso Id Field -->
<div class="col-sm-12">
    {!! Form::label('caso_id', 'Caso Id:') !!}
    <p>{{ $audiencia->caso_id }}</p>
</div>

