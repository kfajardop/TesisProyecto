<div class="card shadow-sm w-100">
    <!-- Encabezado -->
    <div class="card-header text-center font-weight-medium rounded-top"
         style="font-size: 20px; background-image: linear-gradient(to top, #a7c7d8, #b3cde0); color: #1c1c1c;">
        DETALLE DE LA ETAPA DE JUICIO
    </div>


    <div class="card-body px-3">
        <div class="row">

            <!-- Nombre -->
            <div class="col-md-6 mb-3 d-flex">
                <div class="d-flex align-items-center" style="width: 140px;">
                    <i class="fas fa-font text-secondary fa-lg mr-2" style="min-width: 25px;"></i>
                    <strong>{!! Form::label('nombre', 'Nombre:') !!}</strong>
                </div>
                <div>{{  $casoFamiliarJuicioEtapa->nombre }}</div>
            </div>

            <!-- Tipo de Juicio -->
            <div class="col-md-6 mb-3 d-flex">
                <div class="d-flex align-items-center" style="width: 140px;">
                    <i class="fas fa-gavel text-secondary fa-lg mr-2" style="min-width: 25px;"></i>
                    <strong>{!! Form::label('tipo_juicio_id', 'Tipo de Juicio:') !!}</strong>
                </div>
                <div>{{ $casoFamiliarJuicioEtapa->tipoJuicio->nombre ?? 'No definido' }}</div>
            </div>

        </div>
    </div>
</div>


