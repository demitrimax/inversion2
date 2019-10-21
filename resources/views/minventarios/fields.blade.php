<!-- Concepto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('concepto', 'Concepto:') !!}
    {!! Form::text('concepto', null, ['class' => 'form-control']) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Marca Field -->
<div class="form-group col-sm-6">
    {!! Form::label('marca', 'Marca:') !!}
    {!! Form::text('marca', null, ['class' => 'form-control']) !!}
</div>

<!-- Codigo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('codigo', 'Codigo:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control']) !!}
</div>

<!-- Montocompra Field -->
<div class="form-group col-sm-6">
    {!! Form::label('montocompra', 'Montocompra:') !!}
    {!! Form::number('montocompra', null, ['class' => 'form-control']) !!}
</div>

<!-- Resguardoa Field -->
<div class="form-group col-sm-6">
    {!! Form::label('resguardoa', 'Resguardoa:') !!}
    {!! Form::text('resguardoa', null, ['class' => 'form-control']) !!}
</div>

<!-- Fileresguardo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fileresguardo', 'Fileresguardo:') !!}
    {!! Form::text('fileresguardo', null, ['class' => 'form-control']) !!}
</div>

<!-- Operacion Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('operacion_id', 'Operacion Id:') !!}
    {!! Form::number('operacion_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('minventarios.index') !!}" class="btn btn-secondary">Cancelar</a>
</div>
