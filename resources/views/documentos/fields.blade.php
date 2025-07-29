<div class="form-row" id="fields">
    <!-- Tipo Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('tipo_id', 'Tipo Documento:') !!}
        <multiselect
            v-model="documentoTipo"
            :options="documentoTipos"
            :multiple="false"
            placeholder="Selecciona un tipo de documento"
            label="nombre"
            :preselect-first="false"
            {{ isset($documento) && $documento->tipo ? 'disabled' : '' }}
        >
        </multiselect>
        <input type="hidden" name="tipo_id" :value="documentoTipo ? documentoTipo.id : ''">
    </div>

    <div class="form-group col-sm-6" v-if="documentoTipo?.id === constDocumentoPublicoId">
        {!! Form::label('estado_id', 'Tipo Escritura:') !!}
        <multiselect
            v-model="documentoPublicoEscritura"
            :options="documentoPublicoEscrituras"
            :multiple="false"
            placeholder="Selecciona un tipo de documento público"
            label="nombre"
            :preselect-first="false"
        >
        </multiselect>
        <input type="hidden" name="tipo_escritura_id"
               :value="documentoPublicoEscritura ? documentoPublicoEscritura.id : ''">
    </div>

    <div class="form-group col-sm-6" v-if="documentoTipo?.id === constDocumentoPublicoId">
        {!! Form::label('no_escritura', 'No. Escritura:') !!}
{{--        {!! Form::number('no_escritura', null, ['class' => 'form-control', 'required', 'value' => $documento->id]) !!}--}}
        <input type="number" value="{{ isset($documento) && $documento->doctoPublicoDetalles()->first() ? $documento->doctoPublicoDetalles()->first()->no_escritura : '' }}"
               name="no_escritura" class="form-control" >
    </div>

    <div class="form-group col-sm-6" v-if="documentoTipo?.id === constDocumentoPrivadoId">
        {!! Form::label('estado_id', 'Tipo Contrato:') !!}
        <multiselect
            v-model="documentoPrivadoContrato"
            :options="documentoPrivadoContratos"
            :multiple="false"
            placeholder="Selecciona un tipo de documento privado"
            label="nombre"
            :preselect-first="false"
        >
        </multiselect>
        <input type="hidden" name="contrato_id"
               :value="documentoPrivadoContrato ? documentoPrivadoContrato.id : ''">
    </div>

   <div class="form-group col-sm-6" v-if="documentoTipo?.id === constActaNotarialId">
        {!! Form::label('estado_id', 'Tipo Acta Notarial:') !!}
        <multiselect
            v-model="actaNotarial"
            :options="actaNotariales"
            :multiple="false"
            placeholder="Selecciona un tipo de acta notarial"
            label="nombre"
            :preselect-first="false"
        >
        </multiselect>
        <input type="hidden" name="notarial_id"
               :value="actaNotarial ? actaNotarial.id : ''">
    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('persona_id', 'Comparecientes:') !!}
        <multiselect
            v-model="conparecientes"
            :options="personas"
            :multiple="true"
            placeholder="Selecciona un compadeciente"
            track-by="id"
            label="nombre_completo"
        >
        </multiselect>
        <input type="hidden" name="comparecientes" :value="JSON.stringify(conparecientes)">

    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('intervinientes', 'Intervinientes:') !!}
        <multiselect
            v-model="intervinientes"
            track-by="id"
            :options="personas"
            :multiple="true"
            placeholder="Selecciona un interviniente"
            label="nombre_completo"
            :preselect-first="false"
        >
        </multiselect>
        <input type="hidden" name="intervinientes" :value="JSON.stringify(intervinientes)">
    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('fecha_documento', 'Fecha Documento:') !!}
        <input type="date" class="form-control"
               value="{{ isset($documento) && $documento->fecha_documento ? $documento->fecha_documento->format('Y-m-d') : '' }}"
               name="fecha_documento">

    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('estado_id', 'Estado:') !!}
        <multiselect
            v-model="documentoEstado"
            :options="documentoEstados"
            :multiple="false"
            placeholder="Selecciona un estado"
            label="nombre"
            :preselect-first="false"
        >
        </multiselect>
        <input type="hidden" name="estado_id" :value="documentoEstado ? documentoEstado.id : ''">
    </div>

    <div class="form-group col-sm-12">
        {!! Form::label('usuario_id', 'Observaciones:') !!}
        {!! Form::textArea('observaciones', null, ['class' => 'form-control', 'required']) !!}
    </div>
</div>

@push('scripts')
    <script>
        const app = new Vue({
            el: '#fields',
            data: {
                documentoTipos: @json(\App\Models\DocumentoTipo::all()),
                documentoTipo: @json($documento->tipo ?? null),

                documentoPublicoEscrituras: @json(\App\Models\DoctoPublicoEscritura::all()),
                documentoPublicoEscritura: @json($documento?->doctoPublicoDetalles()?->first()?->escritura ?? null),

                documentoPrivadoContratos: @json(\App\Models\DoctoPrivadoContrato::all()),
                documentoPrivadoContrato: @json($documento?->doctoPrivadoDetalles()?->first()?->contrato ?? null),

                actaNotariales: @json(\App\Models\DoctoActaNotarial::class::all()),
                actaNotarial: @json($documento?->doctoActaDetalles()?->first()?->notarial ?? null),

                documentoEstados: @json(\App\Models\DocumentoEstado::all()),
                documentoEstado: @json($documento->estado ?? null),

                personas: @json($personas ?? null),

                conparecientes: @json($documento->comparecientes() ?? null),
                intervinientes: @json($documento->intervinientes() ?? null),

                constDocumentoPublicoId: @json(\App\Models\DocumentoTipo::PUBLICO),
                constDocumentoPrivadoId: @json(\App\Models\DocumentoTipo::PRIVADO),
                constActaNotarialId: @json(\App\Models\DocumentoTipo::ACTA_NOTARIAL),

                observaciones: null,
            },
            computed: {},
        });
    </script>
@endpush
