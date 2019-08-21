<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!} <span class="text-danger">*</span>
    {!! Form::text('nombre', null, ['class' => 'form-control maxlen', 'required', 'maxlength'=>'150']) !!}
</div>

<!-- Rfc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rfc', 'RFC:') !!} <span class="text-danger">*</span>
    {!! Form::text('rfc', null, ['class' => 'form-control', 'required', 'maxlength'=>'13']) !!}
</div>

<!-- Direccion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('direccion', 'Dirección:') !!}
    {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
</div>

<!-- Direccion Field -->
<div class="form-group col-sm-6">
    {!! Form::hidden('altaproveedor', 0) !!}
    {!! Form::checkbox('altaproveedor', null, 0) !!}
    {!! Form::label('proveedor', 'Alta como proveedor:') !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('facturaras.index') !!}" class="btn btn-secondary">Cancelar</a>
</div>
