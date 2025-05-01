<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Fecha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha', 'Fecha:') !!}
    {!! Form::date('fecha', null, ['class' => 'form-control','id'=>'fecha']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha').datepicker()
    </script>
@endpush

<!-- Hora Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hora', 'Hora:') !!}
    {!! Form::time('hora', null, ['class' => 'form-control']) !!}
</div>

<!-- Prioridad Id Field -->
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('prioridad_id', 'Prioridad Id:') !!}--}}
{{--    {!! Form::number('prioridad_id', null, ['class' => 'form-control', 'required']) !!}--}}
{{--</div>--}}

<!-- Estado Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado_id', 'Estado:') !!}
    <select name="estado_id" class="form-control" required>
        <option value="">Seleccione un estado</option>
        @foreach (\App\Models\TareaEstado::all() as $estado)
            <option value="{{ $estado->id }}" {{ old('estado_id') == $estado->id ? 'selected' : '' }}>
                {{ $estado->nombre }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('prioridad_id', 'Prioridad:') !!}
    <select name="prioridad_id" class="form-control" required>
        <option value="">Seleccione una prioridad</option>
        @foreach (\App\Models\TareaPrioridad::all() as $prioridad)
            <option value="{{ $prioridad->id }}" {{ old('prioridad_id') == $prioridad->id ? 'selected' : '' }}>
                {{ $prioridad->nombre }}
            </option>
        @endforeach
    </select>
</div>


<!-- Descripcion Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('descripcion', 'Descripción:') !!}
    {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>
