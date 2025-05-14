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
                <input type="hidden" name="etapa_id" :value="CasoJucioEtapa ? CasoJucioEtapa.id : ''" v-if="CasoJucioEtapa">
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
        >
        </Textarea>
        <input type="hidden" name="observaciones" :value="observaciones">
    </div>

    <!-- Hidden inputs para enviar los valores seleccionados al backend -->




    <!-- Como personasDemandantes y personasDemandadas son múltiples, los enviamos como arrays -->





</div>

@push('scripts')
    <script>
        const app = new Vue({
            el: '#fields',
            data: {
                casoTipos: @json(\App\Models\CasoTipo::all()),
                casoTipo: null,
                TiposJuicio: @json(\App\Models\CasoFamiliarJuicioTipo::all()),
                TipoJuicio: null,

                CasoJucioEtapas: @json(\App\Models\CasoFamiliarJuicioEtapa::all()),
                CasoJucioEtapa: null,

                CasoTipoFamiliar: @json(\App\Models\CasoTipo::FAMILIAR),
                CasoTipoPenal: @json(\App\Models\CasoTipo::PENAL),

                personas: @json($personas),
                personasDemandantes: null,
                personasDemandadas: null,

                observaciones: null,
            },
            computed: {
                etapasSegunJuicioSeleccionado() {
                    if (this.TipoJuicio) {
                        return this.CasoJucioEtapas.filter(etapa => etapa.tipo_juicio_id === this.TipoJuicio.id);
                    }
                    return [];
                },
            },

            mounted() {
                console.log(this.personas);
            },
        });
    </script>
@endpush
