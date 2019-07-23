<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'required', 'maxlength'=>'50']) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('descripcion', 'Descripción:') !!}
    {!! Form::textarea('descripcion', null, ['class' => 'form-control']) !!}
</div>
@php
  $fechaini = null;
  if(isset($cproyectos->finicio)){
    $fechaini = $cproyectos->finicio->format('Y-m-d');
  }

@endphp
<!-- Finicio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('finicio', 'Fecha de inicio:') !!}
    {!! Form::date('finicio', $fechaini, ['class' => 'form-control','id'=>'finicio']) !!}
</div>


<!-- Clasificacion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('clasificacion', 'Clasificación:') !!}
    {!! Form::select('clasificacion', $clasificacion,null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('cproyectos.index') !!}" class="btn btn-secondary">Cancelar</a>
</div>
