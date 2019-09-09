@extends('layouts.appv2')

@section('title',config('app.name').' | Alta de Operaciones' )

@section('content')

  @card(['title' => 'Registro de Operación'])
  {!! Form::open(['route' => 'operacion.store']) !!}

  <div class="row">
  <!-- Tipo Field -->

      @php
        $saldofinal = abs($empresa->saldofinal);
      @endphp

      <div class="form-group col-sm-6">
          {!! Form::label('cuenta_id', 'Cuenta:') !!}
          {!! Form::select('cuenta_id', $cuental, null, ['class' => 'form-control', 'required', 'placeholder'=>'Seleccione']) !!}
      </div>


      <div class="form-group col-sm-6">
          {!! Form::hidden('empresa_id', $empresa->id) !!}
          {!! Form::hidden('maxmonto',$saldofinal) !!}
          {!! Form::label('tipo', 'Tipo:') !!}
          {!! Form::select('tipo', ['Salida'=>'CARGO','Entrada'=>'ABONO'], null, ['class' => 'form-control', 'required', 'placeholder'=>'Seleccione']) !!}
      </div>

      <!-- Monto Field -->
      <div class="form-group col-sm-6">
          {!! Form::label('monto_op', 'Monto:') !!}
          {!! Form::number('monto_op', null, ['class' => 'form-control', 'required', 'step'=>'0.01', 'max'=>$saldofinal, 'min'=>0]) !!}
      </div>

      <div class="form-group col-sm-6">
          {!! Form::label('metpago', 'Método de Pago:') !!}
          {!! Form::select('metpago', $metpago, null, ['class' => 'form-control', 'required']) !!}
      </div>

        <div id='variasfacturasinput' class="form-group col-sm-6" style="display:none;">
            {!! Form::label('facturas', 'Seleccione una o varias Facturas:') !!} <button type="button" class="btn btn-sm btn-primary" data-toggle="popover" title="Varias Facturas" data-content="Puede seleccionar una o más facturas. El monto de la operación se tomará del monto de la suma de las facturas."><i class="fa fa-question"></i></button>
            {!! Form::select('facturas[]', $facturas, null, ['class' => 'form-control select2', 'multiple'=>'multiple', 'style'=>'width: 100%;']) !!}
        </div>

      <div class="form-group col-sm-6">
          {!! Form::label('fecha', 'Fecha: (yyyy-mm-dd)') !!}
          {!! Form::text('fecha', null, ['placeholder'=>'yyyy-mm-dd','class' => 'form-control datepicker-input', 'required', 'data-language'=>'es', 'data-date-format'=>'yyyy-mm-dd', 'pattern'=>'(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))' ]) !!}
      </div>

      <div class="form-group col-sm-6">
          {!! Form::label('proveedor_id', 'Proveedor:') !!}
          {!! Form::select('proveedor_id', $proveedores, null, ['class' => 'form-control', 'required']) !!}
      </div>

      <div class="form-group col-sm-6">
          {!! Form::label('numfactura', '# de Factura:') !!}
          {!! Form::text('numfactura', null, ['class' => 'form-control maxlen', 'required', 'maxlength'=>'20']) !!}
      </div>

      <div class="form-group col-sm-6">
          {!! Form::label('subclasifica_id', 'Categoría:') !!}
          {!! Form::select('subclasifica_id', $subcategoriasAgrupadas,null, ['class' => 'form-control select2', 'required', 'placeholder'=>'Seleccione', 'style'=>'width: 100%;']) !!}
      </div>

      <div class="form-group col-sm-6">
          <label class="ckbox">
            {!! Form::hidden('inventariable', 0)!!}
              <input type="checkbox" name="inventariable" id="inventariable"><span>Operación de Inventario</span>
          </label>
      </div>

      <div class="form-group col-sm-12">
          {!! Form::label('concepto', 'Concepto:') !!}
          {!! Form::text('concepto', null, ['class' => 'form-control maxlen', 'required', 'maxlength'=>'50']) !!}
      </div>

      <div class="form-group col-sm-12">
          {!! Form::label('comentario', 'Comentario:') !!}
          {!! Form::textarea('comentario', null, ['class' => 'form-control']) !!}
      </div>
    </div>


  {!! Form::close() !!}

  @endcard

@endsection
