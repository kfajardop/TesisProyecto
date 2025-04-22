<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'required', 'maxlength' => 55, 'maxlength' => 55]) !!}
</div>

<!-- Created-At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created-at', 'Created-At:') !!}
    {!! Form::text('created-at', null, ['class' => 'form-control','id'=>'created-at']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#created-at').datepicker()
    </script>
@endpush