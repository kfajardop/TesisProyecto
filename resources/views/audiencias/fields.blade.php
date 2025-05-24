<!-- Fecha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha', 'Fecha:') !!}
    {!! Form::text('fecha', null, ['class' => 'form-control','id'=>'fecha']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha').datepicker()
    </script>
@endpush

<!-- Hora Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hora', 'Hora:') !!}
    {!! Form::text('hora', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Lugar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lugar', 'Lugar:') !!}
    {!! Form::text('lugar', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Caso Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('caso_id', 'Caso Id:') !!}
    {!! Form::number('caso_id', null, ['class' => 'form-control', 'required']) !!}
</div>