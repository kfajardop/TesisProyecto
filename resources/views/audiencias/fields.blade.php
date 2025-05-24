<div class="form-row" id="fields">
<!-- Fecha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha', 'Fecha:') !!}
    <input type="date" name="fecha" class="form-control" value="{{ isset($audiencia) && $audiencia->fecha ? $audiencia->fecha->format('Y-m-d') : '' }}">
</div>

<!-- Hora Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hora', 'Hora:') !!}
    {!! Form::time('hora', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Lugar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lugar', 'Lugar:') !!}
    {!! Form::text('lugar', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Caso Id Field -->
    <div class="form-group col-sm-6">
        <label for="tipo_id">Caso:</label>
        <multiselect
            v-model="caso"
            :options="casos"
            :multiple="false"
            placeholder="Selecciona victimarios"
            label="nombre_caso"
            track-by="id"
            :preselect-first="false">
        </multiselect>
        <input type="hidden" name="caso_id" :value="caso ? caso.id : ''" v-if="caso">
    </div>

    <div class="form-group col-sm-6">
        <label for="tipo_id">Participantes:</label>
        <multiselect
            v-model="participantes"
            :options="personas"
            :multiple="true"
            placeholder="Selecciona un participante"
            label="nombre_completo"
            track-by="id"
            :preselect-first="false">
        </multiselect>
        <input type="hidden" name="participantes" :value="JSON.stringify(participantes)">
    </div>

</div>


@push('scripts')
    <script>
        const app = new Vue({
            el: '#fields',
            data: {
                personas: @json($personas),
                participantes: @json($audiencia->participantes() ?? []),

                casos: @json(\App\Models\Caso::all()),
                caso: @json($audiencia->caso ?? null),

            },
            computed: {

            },
        });
    </script>
@endpush
