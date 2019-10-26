@card(['title'=>'Parámetros de la Plantilla', 'color'=>'success'])
<div class="row">
@php

  $parametros = array('cliente'=>null, 'rfc'=>null, 'domicilio'=>null, 'fecha'=>null, 'fpago'=>null, 'filainicio'=>null);

  if($facturara->plantilla_remision){
    foreach($facturara->plantilla_remision as $key=>$element)
    {
      $parametros[$key] = $element;
    }
  }

@endphp
    <!-- Nombre Field -->
    <div class="form-group">
        {!! Form::label('plantilla[cliente]', 'Celda Cliente:') !!}
        {!! Form::text('plantilla[cliente]', $parametros['cliente'], ['class' => 'form-control maxlen', 'maxlength'=>'3']) !!}
    </div>

    <!-- Nombre Field -->
    <div class="form-group">
        {!! Form::label('plantilla[rfc]', 'Celda RFC:') !!}
        {!! Form::text('plantilla[rfc]', $parametros['rfc'], ['class' => 'form-control maxlen', 'maxlength'=>'3']) !!}
    </div>

    <!-- Nombre Field -->
    <div class="form-group">
        {!! Form::label('plantilla[domicilio]', 'Celda Domicilio:') !!}
        {!! Form::text('plantilla[domicilio]', $parametros['domicilio'], ['class' => 'form-control maxlen', 'maxlength'=>'3']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('plantilla[fecha]', 'Celda Fecha:') !!}
        {!! Form::text('plantilla[fecha]', $parametros['fecha'], ['class' => 'form-control maxlen', 'maxlength'=>'3']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('plantilla[fpago]', 'Celda Forma de Pago:') !!}
        {!! Form::text('plantilla[fpago]', $parametros['fpago'], ['class' => 'form-control maxlen', 'maxlength'=>'3']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('plantilla[filainicio]', 'Celda de Inicio de Descripción:') !!}
        {!! Form::text('plantilla[filainicio]', $parametros['filainicio'], ['class' => 'form-control maxlen', 'maxlength'=>'3']) !!}
    </div>

  </div>

@endcard
