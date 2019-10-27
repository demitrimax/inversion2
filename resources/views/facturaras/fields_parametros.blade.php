@card(['title'=>'Parámetros de la Plantilla', 'color'=>'success'])
<div class="row">
@php

  $parametros = array('cliente'=>null,
                        'rfc'=>null,
                        'domicilio'=>null,
                        'fecha'=>null,
                        'fpago'=>null,
                        'filainicio'=>null,
                        'colunidad'=>null,
                        'colcantidad'=>null,
                        'colclave'=>null,
                        'coldescripcion'=>null,
                        'colpunitario'=>null,
                        'colimporte'=>null,
                        'celdasubtotal'=>null,
                        'celdaiva'=>null,
                        'celdatotal'=>null,
                        'celdamontoletra'=>null,
                        'maximoproductos'=>null);

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
        {!! Form::label('plantilla[filainicio]', 'Fila de Inicio de Descripción:') !!}
        {!! Form::text('plantilla[filainicio]', $parametros['filainicio'], ['class' => 'form-control maxlen', 'maxlength'=>'3']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('plantilla[colunidad]', 'Col de Unidad:') !!}
        {!! Form::text('plantilla[colunidad]', $parametros['colunidad'], ['class' => 'form-control maxlen', 'maxlength'=>'3']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('plantilla[colcantidad]', 'Col de Cantidad:') !!}
        {!! Form::text('plantilla[colcantidad]', $parametros['colcantidad'], ['class' => 'form-control maxlen', 'maxlength'=>'3']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('plantilla[colclave]', 'Col de Clave del producto:') !!}
        {!! Form::text('plantilla[colclave]', $parametros['colclave'], ['class' => 'form-control maxlen', 'maxlength'=>'3']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('plantilla[coldescripcion]', 'Col Descripción:') !!}
        {!! Form::text('plantilla[coldescripcion]', $parametros['coldescripcion'], ['class' => 'form-control maxlen', 'maxlength'=>'3']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('plantilla[colpunitario]', 'Col de Precio Unitario:') !!}
        {!! Form::text('plantilla[colpunitario]', $parametros['colpunitario'], ['class' => 'form-control maxlen', 'maxlength'=>'3']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('plantilla[colimporte]', 'Col de Importe:') !!}
        {!! Form::text('plantilla[colimporte]', $parametros['colimporte'], ['class' => 'form-control maxlen', 'maxlength'=>'3']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('plantilla[celdasubtotal]', 'Celda Subtotal:') !!}
        {!! Form::text('plantilla[celdasubtotal]', $parametros['celdasubtotal'], ['class' => 'form-control maxlen', 'maxlength'=>'3']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('plantilla[celdaiva]', 'Celda IVA:') !!}
        {!! Form::text('plantilla[celdaiva]', $parametros['celdaiva'], ['class' => 'form-control maxlen', 'maxlength'=>'3']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('plantilla[celdatotal]', 'Celda Total:') !!}
        {!! Form::text('plantilla[celdatotal]', $parametros['celdatotal'], ['class' => 'form-control maxlen', 'maxlength'=>'3']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('plantilla[celdamontoletra]', 'Celda Monto en Letra:') !!}
        {!! Form::text('plantilla[celdamontoletra]', $parametros['celdamontoletra'], ['class' => 'form-control maxlen', 'maxlength'=>'3']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('plantilla[maximoproductos]', 'Maximo numero productos:') !!}
        {!! Form::text('plantilla[maximoproductos]', $parametros['maximoproductos'], ['class' => 'form-control maxlen', 'maxlength'=>'3']) !!}
    </div>

  </div>

@endcard
