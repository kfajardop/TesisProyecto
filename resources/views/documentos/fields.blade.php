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
        {!! Form::number('no_escritura', null, ['class' => 'form-control', 'required']) !!}
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
        <input type="hidden" name="documento_privado_tipo_id"
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
        <input type="hidden" name="acta_notarial_tipo_id"
               :value="actaNotarial ? actaNotarial.id : ''">
    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('persona_id', 'Comparecientes:') !!}
        <multiselect
            v-model="conparecientes"
            :options="personas"
            :multiple="true"
            placeholder="Selecciona un compadeciente"
            label="nombre_completo"
            :preselect-first="false"
        >
        </multiselect>
        <input type="hidden" name="comparecientes" :value="JSON.stringify(conparecientes)">

    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('intervinientes', 'Intervinientes:') !!}
        <multiselect
            v-model="intervinientes"
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
        {!! Form::label('fecha_escritura', 'Fecha Escritura:') !!}
        {!! Form::date('fecha_escritura', null, ['class' => 'form-control', 'required']) !!}
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
                documentoPublicoEscritura: null,

                documentoPrivadoContratos: @json(\App\Models\DoctoPrivadoContrato::all()),
                documentoPrivadoContrato: null,

                actaNotariales: @json(\App\Models\DoctoActaNotarial::class::all()),
                actaNotarial: null,

                documentoEstados: @json(\App\Models\DocumentoEstado::all()),
                documentoEstado: @json($documento->estado ?? null),

                personas: @json($personas ?? null),

                conparecientes: null,
                intervinientes: null,

                constDocumentoPublicoId: @json(\App\Models\DocumentoTipo::PUBLICO),
                constDocumentoPrivadoId: @json(\App\Models\DocumentoTipo::PRIVADO),
                constActaNotarialId: @json(\App\Models\DocumentoTipo::ACTA_NOTARIAL),

                observaciones: null,
            },
            computed: {},
        });
    </script>
@endpush
