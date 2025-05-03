<!-- Nombre Field -->
<div class="col-sm-12 mb-3">
    <span class="font-weight-bold mr-2">
        <i class="fas fa-tasks text-primary mr-1"></i> Nombre:
    </span>
    <span>{{ $tarea->nombre }}</span>
</div>

<!-- Fecha Field -->
<div class="col-sm-12 mb-3">
    <span class="font-weight-bold mr-2">
        <i class="far fa-calendar-alt text-primary mr-1"></i> Fecha:
    </span>
    <span>{{ \Carbon\Carbon::parse($tarea->fecha)->format('d/m/Y') }}</span>
</div>

<!-- Hora Field -->
<div class="col-sm-12 mb-3">
    <span class="font-weight-bold mr-2">
        <i class="far fa-clock text-primary mr-1"></i> Hora:
    </span>
    <span>{{ \Carbon\Carbon::parse($tarea->hora)->format('H:i') }}</span>
</div>

<!-- Descripcion Field -->
<div class="col-sm-12 mb-3">
    <span class="font-weight-bold mr-2">
        <i class="fas fa-align-left text-primary mr-1"></i> Descripción:
    </span>
    <span>{{ $tarea->descripcion }}</span>
</div>

<!-- Prioridad Id Field -->
<div class="col-sm-12 mb-3">
    <span class="font-weight-bold mr-2">
        <i class="fas fa-flag text-primary mr-1"></i> Prioridad: </span>
    <span>{{ $tarea->prioridad->nombre}}</span>
</div>

<!-- Estado Id Field -->
<div class="col-sm-12 mb-3">
    <span class="font-weight-bold mr-2">
        <i class="fas fa-info-circle text-primary mr-1"></i> Estado:
    </span>
    <span>{{ $tarea->estado->nombre }}</span>
</div>

