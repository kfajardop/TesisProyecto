<div class="form-row" id="fields">
    <!-- Primer Nombre Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('primer_nombre', 'Primer Nombre:') !!}
        {!! Form::text('primer_nombre', null, ['class' => 'form-control', 'required', 'maxlength' => 55, 'maxlength' => 55]) !!}
    </div>

    <!-- Segundo Nombre Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('segundo_nombre', 'Segundo Nombre:') !!}
        {!! Form::text('segundo_nombre', null, ['class' => 'form-control', 'maxlength' => 55, 'maxlength' => 55]) !!}
    </div>

    <!-- Primer Apellido Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('primer_apellido', 'Primer Apellido:') !!}
        {!! Form::text('primer_apellido', null, ['class' => 'form-control', 'required', 'maxlength' => 55, 'maxlength' => 55]) !!}
    </div>

    <!-- Segundo Apellido Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('segundo_apellido', 'Segundo Apellido:') !!}
        {!! Form::text('segundo_apellido', null, ['class' => 'form-control', 'maxlength' => 55, 'maxlength' => 55]) !!}
    </div>

    <!-- Dpi Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('dpi', 'Dpi:') !!}
        {!! Form::text('dpi', null, ['class' => 'form-control', 'maxlength' => 13, 'maxlength' => 13]) !!}
    </div>

    <!-- Telefono Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('telefono', 'Telefono:') !!}
        {!! Form::text('telefono', null, ['class' => 'form-control', 'maxlength' => 8, 'maxlength' => 8]) !!}
    </div>

    <!-- Direccion Id Field -->
{{--    <div class="form-group col-sm-6">--}}
{{--        {!! Form::label('direccion_id', 'Direccion Id:') !!}--}}
{{--        {!! Form::number('direccion_id', null, ['class' => 'form-control', 'required']) !!}--}}
{{--    </div>--}}

    <div class="form-group col-sm-6">
        <label for="tipo_id">Departamento:</label>
        <multiselect
            v-model="Departamento"
            :options="Departamentos"
            :multiple="false"
            placeholder="Selecciona un departamento"
            label="nombre"
            track-by="id"
            :preselect-first="false">
        </multiselect>
        <input type="hidden" name="departamento_id" :value="Departamento ? Departamento.id : ''" v-if="Departamento">
    </div>

    <div class="form-group col-sm-6" v-if="Departamento">
        <label for="tipo_id">Municipio:</label>
        <multiselect
            v-model="Municipio"
            :options="Departamento?.length > 0 ? Departamento.municipios : []"
            :multiple="false"
            placeholder="Selecciona un municipio"
            label="nombre"
            track-by="id"
            :preselect-first="false">
        </multiselect>
        <input type="hidden" name="municipio_id" :value="Municipio ? Municipio.id : ''" v-if="Municipio">
    </div>

    <div class="form-group col-sm-6"  v-if="Municipio">
        <label for="tipo_id">Dirección:</label>
        <input type="text" name="direccion" class="form-control"
               value="{{ isset($cliente) ? optional($cliente->direccion)->direccion : '' }}">

    </div>
</div>


@push('scripts')
    <script>
        const app = new Vue({
            el: '#fields',
            data: {
                Departamentos: @json(\App\Models\Departamento::with('municipios')->get()),
                Departamento: @json($cliente->direccion->municipio->departamento ?? null),

                Municipio: @json(isset($cliente) && $cliente->direccion && $cliente->direccion->municipio ? $cliente->direccion->municipio : null)

            },
        });
    </script>
@endpush
