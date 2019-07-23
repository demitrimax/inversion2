<!-- Banco Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('banco_id', 'Banco:') !!}
    {!! Form::select('banco_id', $bancos, null, ['class' => 'form-control', 'required', 'placeholder'=>'Seleccione un banco']) !!}
</div>

<!-- Divisa Field -->
<div class="form-group col-sm-6">
    {!! Form::label('divisa', 'Moneda:') !!}
    {!! Form::select('divisa', $divisas, null, ['class' => 'form-control', 'required', 'placeholder'=>'Seleccione un tipo de moneda']) !!}
</div>

<!-- Numcuenta Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numcuenta', 'Número de cuenta:') !!}
    {!! Form::text('numcuenta', null, ['class' => 'form-control']) !!}
</div>

<!-- Clabeinterbancaria Field -->
<div class="form-group col-sm-6">
    {!! Form::label('clabeinterbancaria', 'Clabe interbancaria:') !!}
    {!! Form::text('clabeinterbancaria', null, ['class' => 'form-control']) !!}
</div>

<!-- Sucursal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sucursal', 'Sucursal:') !!}
    {!! Form::text('sucursal', null, ['class' => 'form-control']) !!}
</div>

<!-- Swift Field -->
<div class="form-group col-sm-6">
    {!! Form::label('swift', 'Swift:') !!}
    {!! Form::text('swift', null, ['class' => 'form-control']) !!}
</div>

<!-- Empresa Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('empresa_id', 'Empresa:') !!}
    {!! Form::select('empresa_id', $empresas, null, ['class' => 'form-control', 'required', 'placeholder'=>'Seleccione una empresa']) !!}
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('bcuentas.index') !!}" class="btn btn-secondary">Cancelar</a>
</div>
