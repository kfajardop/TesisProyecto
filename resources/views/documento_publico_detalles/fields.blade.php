<!-- No Escritura Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_escritura', 'No Escritura:') !!}
    {!! Form::text('no_escritura', null, ['class' => 'form-control', 'required', 'maxlength' => 20, 'maxlength' => 20]) !!}
</div>

<!-- Fecha Escritura Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_escritura', 'Fecha Escritura:') !!}
    {!! Form::text('fecha_escritura', null, ['class' => 'form-control','id'=>'fecha_escritura']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha_escritura').datepicker()
    </script>
@endpush

<!-- Comentario Field -->
<div class="form-group col-sm-6">
    {!! Form::label('comentario', 'Comentario:') !!}
    {!! Form::text('comentario', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Documento Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('documento_id', 'Documento Id:') !!}
    {!! Form::number('documento_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Escritura Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('escritura_id', 'Escritura Id:') !!}
    {!! Form::number('escritura_id', null, ['class' => 'form-control', 'required']) !!}
</div>