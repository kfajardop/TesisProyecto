<div class="card shadow-sm w-100">
    <!-- Encabezado -->
    <div class="card-header bg-gradient-primary text-white font-weight-medium rounded-top text-center"
         style="font-size: 20px;"> DETALLE DE LA TAREA
    </div>

    <div class="card-body">
        <div class="row">

            <!-- Nombre -->
            <div class="col-md-6 mb-3 d-flex">
                <div class="d-flex align-items-center" style="width: 140px;">
                    <i class="fas fa-font text-secondary fa-lg mr-2" style="min-width: 25px;"></i>
                    <strong>{!! Form::label('nombre', 'Nombre:') !!}</strong>
                </div>
                <div>{{ $tarea->nombre }}</div>
            </div>

            <!-- Fecha -->
            <div class="col-md-6 mb-3 d-flex">
                <div class="d-flex align-items-center" style="width: 140px;">
                    <i class="fas fa-calendar-alt text-secondary fa-lg mr-2" style="min-width: 25px;"></i>
                    <strong>{!! Form::label('fecha', 'Fecha:') !!}</strong>
                </div>
                <div>{{ \Carbon\Carbon::parse($tarea->fecha)->format('d/m/Y') }}</div>
            </div>

            <!-- Hora -->
            <div class="col-md-6 mb-3 d-flex">
                <div class="d-flex align-items-center" style="width: 140px;">
                    <i class="far fa-clock text-secondary fa-lg mr-2" style="min-width: 25px;"></i>
                    <strong>{!! Form::label('hora', 'Hora:') !!}</strong>
                </div>
                <div>{{ \Carbon\Carbon::parse($tarea->hora)->format('H:i') }}</div>
            </div>

            <!-- Prioridad -->
            <div class="col-md-6 mb-3 d-flex">
                <div class="d-flex align-items-center" style="width: 140px;">
                    <i class="fas fa-flag text-secondary fa-lg mr-2" style="min-width: 25px;"></i>
                    <strong>{!! Form::label('prioridad_id', 'Prioridad:') !!}</strong>
                </div>
                <div>{{ $tarea->prioridad->nombre }}</div>
            </div>

            <!-- Estado -->
            <div class="col-md-6 mb-3 d-flex">
                <div class="d-flex align-items-center" style="width: 140px;">
                    <i class="fas fa-info-circle text-secondary fa-lg mr-2" style="min-width: 25px;"></i>
                    <strong>{!! Form::label('estado_id', 'Estado:') !!}</strong>
                </div>
                <div>{{ $tarea->estado->nombre }}</div>
            </div>

            <!-- Descripción (alineada, sin sangría y bien presentada) -->
            <div class="col-12 mt-3">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-align-left text-secondary fa-lg mr-2" style="min-width: 25px;"></i>
                    <strong class="m-0" style="display: inline;">{!! Form::label('descripcion', 'Descripción') !!}</strong>
                </div>
                <div style="text-align: justify; text-indent: 0;">
                    {!! nl2br(e(ltrim($tarea->descripcion))) !!}
                </div>
            </div>




        </div>
    </div>
</div>
