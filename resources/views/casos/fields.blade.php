<!-- Tipo Id Field -->
<div class="form-row" id="fields">
    <div class="form-group col-sm-6">
        <label for="tipo_id">Tipo de Caso:</label>
        <multiselect
            v-model="casoTipo"
            :options="casoTipos"
            :multiple="false"
            placeholder="Selecciona un tipo de caso"
            label="nombre"
            :disabled="puedeEditarElTipo"
            :preselect-first="false">
        </multiselect>
        <input type="hidden" name="tipo_id" :value="casoTipo ? casoTipo.id : ''">
    </div>

    <!-- Campos adicionales si el tipo de caso es familiar -->
    <div class="form-group col-sm-12" v-if="casoTipo?.id === CasoTipoFamiliar">
        <div class="form-row">
            <div class="form-group col-sm-6">
                <label for="tipo_juicio">Tipo de Juicio:</label>
                <multiselect
                    v-model="TipoJuicio"
                    :options="TiposJuicio"
                    :multiple="false"
                    placeholder="Selecciona un tipo de juicio"
                    label="nombre"
                    track-by="id"
                    :preselect-first="false">
                </multiselect>
                <input type="hidden" name="tipo_juicio_id" :value="TipoJuicio ? TipoJuicio.id : ''" v-if="TipoJuicio">
            </div>
            <div class="form-group col-sm-6">
                <label for="personas_demandantes">Personas Demandantes:</label>
                <multiselect
                    v-model="personasDemandantes"
                    :options="personas"
                    :multiple="true"
                    placeholder="Selecciona una persona demandante"
                    label="nombre_completo"
                    track-by="id"
                    :preselect-first="false">
                </multiselect>
                <input type="hidden" name="personas_demandantes" :value="JSON.stringify(personasDemandantes)">
            </div>
            <div class="form-group col-sm-6">
                <label for="personas_demandadas">Personas Demandadas:</label>
                <multiselect
                    v-model="personasDemandadas"
                    :options="personas"
                    :multiple="true"
                    placeholder="Selecciona una persona demandada"
                    label="nombre_completo"
                    track-by="id"
                    :preselect-first="false">
                </multiselect>
                <input type="hidden" name="personas_demandadas" :value="JSON.stringify(personasDemandadas)">
            </div>

            <div class="form-group col-sm-6" v-if="TipoJuicio">
                <label for="personas_demandadas">Etapa:</label>
                <multiselect
                    v-model="CasoJucioEtapa"
                    :options="etapasSegunJuicioSeleccionado"
                    :multiple="false"
                    placeholder="Selecciona una etapa"
                    label="nombre"
                    track-by="id"
                    :preselect-first="false">
                </multiselect>
                <input type="hidden" name="etapa_id" :value="CasoJucioEtapa ? CasoJucioEtapa.id : ''"
                       v-if="CasoJucioEtapa">
            </div>
        </div>
    </div>

    <div class="form-group col-sm-12" v-if="casoTipo?.id === CasoTipoPenal">
        <div class="form-row">
            <div class="form-group col-sm-6">
                <label for="tipo_id">No. Causa:</label>
                <input class="form-control" type="text" name="no_causa"
                       value="{{ isset($caso) ? $caso->penalDetalles->first()?->no_causa : '' }}">

            </div>
            <div class="form-group col-sm-6">
                <label for="tipo_id">No. Expediente:</label>
                <input
                    type="text"
                    class="form-control"
                    name="no_expediente"
                    value="{{ isset($caso) ? $caso->penalDetalles->first()?->no_expediente : '' }}">
            </div>
            <div class="form-group col-sm-6">
                <label for="tipo_id">Delito:</label>
                <multiselect
                    v-model="CasoPenalDelito"
                    :options="CasoPenalDelitos"
                    :multiple="false"
                    placeholder="Selecciona un delito"
                    label="nombre"
                    track-by="id"
                    :preselect-first="false">
                </multiselect>
                <input type="hidden" name="delito_id" :value="CasoPenalDelito ? CasoPenalDelito.id : ''"
                       v-if="CasoPenalDelito">
            </div>
            <div class="form-group col-sm-6">
                <label for="tipo_id">víctimas:</label>
                <multiselect
                    v-model="victimas"
                    :options="personas"
                    :multiple="true"
                    placeholder="Selecciona una víctima"
                    label="nombre_completo"
                    track-by="id"
                    :preselect-first="false">
                </multiselect>
                <input type="hidden" name="victimas" :value="JSON.stringify(victimas)">
            </div>
            <div class="form-group col-sm-6">
                <label for="tipo_id">Víctimarios:</label>
                <multiselect
                    v-model="victimarios"
                    :options="personas"
                    :multiple="true"
                    placeholder="Selecciona victimarios"
                    label="nombre_completo"
                    track-by="id"
                    :preselect-first="false">
                </multiselect>
                <input type="hidden" name="victimarios" :value="JSON.stringify(victimarios)">
            </div>

            <div class="form-group col-sm-6">
                <label for="tipo_id">Etapa:</label>
                <multiselect
                    v-model="CasoPenalEtapa"
                    :options="CasoPenalEtapas"
                    :multiple="false"
                    placeholder="Selecciona una etapa"
                    label="nombre"
                    track-by="id"
                    :preselect-first="false">
                </multiselect>
                <input type="hidden" name="etapa_id" :value="CasoPenalEtapa ? CasoPenalEtapa.id : ''"
                       v-if="CasoPenalEtapa">
            </div>
        </div>
    </div>


    <div class="form-group col-sm-12">
        <label for="personas_demandadas">Observaciones:</label>
        <Textarea
            v-model="observaciones"
            class="form-control"
            rows="3"
            placeholder="Observaciones"
            name="observaciones"
            required
        >
        </Textarea>
        <input type="hidden" name="observaciones" :value="observaciones">
    </div>

</div>

@push('scripts')
    <script>
        const app = new Vue({
            el: '#fields',
            data: {
                casoTipos: @json(\App\Models\CasoTipo::all()),
                casoTipo: @json(old('tipo_id') ? \App\Models\CasoTipo::find(old('tipo_id')) : ($caso->tipo ?? null)),

                TiposJuicio: @json(\App\Models\CasoFamiliarJuicioTipo::all()),
                TipoJuicio: @json(old('tipo_id')? \App\Models\CasoFamiliarJuicioTipo::find(old('tipo_id')): ($caso->familiarJuicioDetalles()->first()->tipoJuicio ?? null)),

                CasoJucioEtapas: @json(\App\Models\CasoFamiliarJuicioEtapa::all()),
                CasoJucioEtapa: @json(old('etapa_id') ? \App\Models\CasoFamiliarJuicioEtapa::find(old('etapa_id')) : ($caso?->familiarJuicioDetalles()->first()?->etapa ?? null)),

                CasoTipoFamiliar: @json(\App\Models\CasoTipo::FAMILIAR),
                CasoTipoPenal: @json(\App\Models\CasoTipo::PENAL),

                CasoPenalEtapas: @json(\App\Models\CasoPenalEtapa::all()),
                CasoPenalEtapa: @json(old('etapa_id') ? \App\Models\CasoPenalEtapa::find(old('etapa_id')) : ($caso?->penalDetalles()->first()?->etapa ?? null)),

                CasoPenalDelitos: @json(\App\Models\CasoPenalDelito::all()),
                CasoPenalDelito: @json(old('delito_id') ? \App\Models\CasoPenalDelito::find(old('delito_id')) : ($caso?->penalDetalles()->first()?->delito ?? null)),

                personas: @json($personas),
                personasDemandantes: @json(old('personas_demandantes') ? json_decode(old('personas_demandantes'), true) : ($caso->personasDemandantes() ?? [])),
                personasDemandadas: @json(old('personas_demandadas') ? json_decode(old('personas_demandadas'), true) : ($caso->personasDemandadas() ?? [])),

                victimas: @json($caso->victimas() ?? []),
                victimarios: @json($caso->victimarios() ?? []),

                observaciones: @json(old('observaciones')),
                puedeEditarElTipo: @json(!$caso->id ? false : true),
            },
            computed: {
                etapasSegunJuicioSeleccionado() {
                    if (this.TipoJuicio) {
                        return this.CasoJucioEtapas.filter(etapa => etapa.tipo_juicio_id === this.TipoJuicio.id);
                    }
                    return [];
                },
            },
        });
    </script>
@endpush
