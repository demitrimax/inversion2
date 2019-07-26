<!-- Monto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('monto', 'Monto:') !!}
    {!! Form::number('monto', null, ['class' => 'form-control']) !!}
</div>

<!-- Empresa Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('empresa_id', 'Empresa:') !!}
    {!! Form::select('empresa_id', $empresas, null, ['class' => 'form-control']) !!}
</div>

<!-- Cuenta Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cuenta_id', 'Cuenta:') !!}
    {!! Form::select('cuenta_id', $cuental, null, ['class' => 'form-control']) !!}
</div>

<!-- Proveedor Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('proveedor_id', 'Proveedor:') !!}
    {!! Form::select('proveedor_id', $proveedores, null, ['class' => 'form-control']) !!}
</div>

<!-- Numfactura Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numfactura', 'Factura Número:') !!}
    {!! Form::text('numfactura', null, ['class' => 'form-control']) !!}
</div>

<!-- Clasifica Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('clasifica_id', 'Categoría:') !!}
    {!! Form::select('clasifica_id', $categorias, null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo', 'Tipo:') !!}
    {!! Form::select('tipo', ['Salida'=>'CARGO', 'Entrada'=>'ABONO' ], null, ['class' => 'form-control']) !!}
</div>

<!-- Metpago Field -->
<div class="form-group col-sm-6">
    {!! Form::label('metpago', 'Método de pago:') !!}
    {!! Form::select('metpago', $metpago, null, ['class' => 'form-control']) !!}
</div>

<!-- Concepto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('concepto', 'Concepto:') !!}
    {!! Form::text('concepto', null, ['class' => 'form-control']) !!}
</div>

<!-- Comentario Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('comentario', 'Comentario:') !!}
    {!! Form::textarea('comentario', null, ['class' => 'form-control']) !!}
</div>

@php
//conversion de fecha
$fecha = null;

if(isset($operaciones->fecha)){
    $fecha = $operaciones->fecha->format('Y-m-d');
}

@endphp
<!-- Fecha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha', 'Fecha:') !!}
    {!! Form::date('fecha', $fecha, ['class' => 'form-control','id'=>'fecha']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('operaciones.index') !!}" class="btn btn-default">Cancelar</a>
</div>
