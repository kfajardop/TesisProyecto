<div class="form-row" id="fields">
    <!-- Tipo Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('tipo_id', 'Tipo:') !!}
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

    <div class="form-group col-sm-12" v-if="documentoTipo?.id === constDocumentoPublicoId">
        <div class="form-row">
            <!-- Estado Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('estado_id', 'Documento Público Tipo:') !!}
                <multiselect
                    v-model="documentopublicoTipo"
                    :options="documentoPublicoTipos"
                    :multiple="false"
                    placeholder="Selecciona un tipo de documento público"
                    label="nombre"
                    :preselect-first="false"
                >
                </multiselect>
                <input type="hidden" name="documento_publico_tipo_id" :value="documentoPublicoTipo ? documentoPublicoTipo.id : ''">
            </div>

            <!-- Estado Id Field -->
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

            <div class="form-group col-sm-6">
                {!! Form::label('persona_id', 'Comparecientes:') !!}
                <multiselect
                    v-model="conpareciente"
                    :options="personas"
                    :multiple="true"
                    placeholder="Selecciona un compadeciente"
                    label="nombre_completo"
                    :preselect-first="false"
                >
                </multiselect>
                <input type="hidden" name="persona_id" :value="conpareciente ? conpareciente.map(p => p.id).join(',') : ''">
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
                <input type="hidden" name="intervinientes" :value="intervinientes ? intervinientes.map(p => p.id).join(',') : ''">
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('no_escritura', 'No. Escritura:') !!}
                {!! Form::number('no_escritura', null, ['class' => 'form-control', 'required']) !!}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('fecha_escritura', 'Fecha Escritura:') !!}
                {!! Form::date('fecha_escritura', null, ['class' => 'form-control', 'required']) !!}
            </div>
        </div>
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

                documentoPublicoTipos: @json(\App\Models\DoctoPublicoEscritura::all()),
                documentopublicoTipo: null,

                documentoEstados: @json(\App\Models\DocumentoEstado::all()),
                documentoEstado: @json($documento->estado ?? null),

                personas: @json($personas ?? null),

                conpareciente: null,
                intervinientes: null,

                constDocumentoPublicoId: @json(\App\Models\DocumentoTipo::PUBLICO),

                observaciones: null,
            },
            computed: {},
        });
    </script>
@endpush
