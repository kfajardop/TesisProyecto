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

<!-- Notarial Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('notarial_id', 'Notarial Id:') !!}
    {!! Form::number('notarial_id', null, ['class' => 'form-control', 'required']) !!}
</div>