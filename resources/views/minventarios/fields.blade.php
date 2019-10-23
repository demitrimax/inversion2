<div class="row">
<div class="col-md-6">
  <!-- Concepto Field -->
  <div class="form-group">
      {!! Form::label('concepto', 'Concepto:') !!}
      {!! Form::text('concepto', null, ['class' => 'form-control']) !!}
  </div>

  <!-- Descripcion Field -->
  <div class="form-group">
      {!! Form::label('descripcion', 'Descripcion:') !!}
      {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
  </div>

  <!-- Marca Field -->
  <div class="form-group">
      {!! Form::label('marca', 'Marca:') !!}
      {!! Form::text('marca', null, ['class' => 'form-control']) !!}
  </div>

  <!-- Codigo Field -->
  <div class="form-group">
      {!! Form::label('codigo', 'Codigo o Número de Serie:') !!}
      {!! Form::text('codigo', null, ['class' => 'form-control']) !!}
  </div>

  <!-- Montocompra Field -->
  <div class="form-group">
      {!! Form::label('montocompra', 'Precio de compra:') !!}
      {!! Form::number('montocompra', null, ['class' => 'form-control', 'step'=>'0.01']) !!}
  </div>

  <!-- Resguardoa Field -->
  <div class="form-group">
      {!! Form::label('resguardoa', 'Resguardo a:') !!}
      {!! Form::text('resguardoa', null, ['class' => 'form-control']) !!}
  </div>


  <!-- Operacion Id Field -->
  <div class="form-group">
      {!! Form::label('operacion_id', 'Operacion Id:') !!}
      {!! Form::number('operacion_id', null, ['class' => 'form-control', 'readonly']) !!}
  </div>

  <!-- Submit Field -->
  <div class="form-group">
      {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
      <a href="{!! route('minventarios.index') !!}" class="btn btn-secondary">Cancelar</a>
  </div>
</div>

<div class="col-md-6">

<!-- Fileresguardo Field -->
<div class="form-group col-sm-12">
    {!! Form::label('fileresguardo', 'Comprobante Resguardo:') !!}
    {!! Form::file('fileresguardo', ['class' => 'form-control', 'accept'=>'application/pdf']) !!}
</div>
@if($minventario->fileresguardo)
<div class="col-sm-12">
  <embed src="{{url('minventario/resguardo/'.$minventario->id)}}" width="600" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
</div>
@endif

</div>
</div> <!-- Fin Row -->
