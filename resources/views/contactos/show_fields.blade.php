<div class="card shadow-sm w-100">
    <!-- Encabezado -->
    <div class="card-header bg-gradient-primary text-white font-weight-medium rounded-top text-center"
         style="font-size: 20px;">DETALLE DEL CONTACTO
    </div>

    <div class="card-body px-3">
        <div class="row">

            <!-- Nombre -->
            <div class="col-md-6 mb-3 d-flex">
                <div class="d-flex align-items-center" style="width: 140px;">
                    <i class="fas fa-font text-secondary fa-lg mr-2" style="min-width: 25px;"></i>
                    <strong>{!! Form::label('nombre', 'Nombre:') !!}</strong>
                </div>
                <div>{{ $contacto->nombre }}</div>
            </div>

            <!-- Teléfono -->
            <div class="col-md-6 mb-3 d-flex">
                <div class="d-flex align-items-center" style="width: 140px;">
                    <i class="fas fa-phone text-secondary fa-lg mr-2" style="min-width: 25px;"></i>
                    <strong>{!! Form::label('telefono', 'Teléfono:') !!}</strong>
                </div>
                <div>{{ $contacto->telefono }}</div>
            </div>

            <!-- Comentario -->
            <div class="col-12 mt-3">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-comment text-secondary fa-lg mr-2" style="min-width: 25px;"></i>
                    <strong class="m-0">{!! Form::label('comentario', 'Comentario') !!}</strong>
                </div>
                <div style="text-align: justify;">
                    {!! nl2br(e(ltrim($contacto->comentario))) !!}
                </div>
            </div>

        </div>
    </div>
</div>

