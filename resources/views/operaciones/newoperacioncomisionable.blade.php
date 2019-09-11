@extends('layouts.appv2')

@section('title',config('app.name').' | Alta de Operación Comisionable' )

@section('content')

  @component('components.alertdismiss')
    @slot('strong')
    Operación Comisionable!
    @endslot
    Esta operación requiere más detalles para poder ser guardada.
  @endcomponent

  @card(['title' => 'Registro de Operación Comisionable', 'color'=>'info'])
  {!! Form::open(['route' => 'operacion.store']) !!}

  <div class="row">
  <!-- Tipo Field -->

      @php
        $saldofinal = abs($empresa->saldofinal);
      @endphp

      <div class="form-group col-sm-6">
          {!! Form::label('cuenta_id', 'Cuenta:') !!}
          {!! Form::select('cuenta_id', $cuental, $input['cuenta_id'], ['class' => 'form-control', 'required', 'placeholder'=>'Seleccione', 'disabled']) !!}
      </div>


      <div class="form-group col-sm-6">
          {!! Form::hidden('empresa_id', $empresa->id) !!}
          {!! Form::hidden('maxmonto',$saldofinal) !!}
          {!! Form::label('tipo', 'Tipo:') !!}
          {!! Form::select('tipo', ['Salida'=>'CARGO','Entrada'=>'ABONO'], $input['tipo'], ['class' => 'form-control', 'required', 'placeholder'=>'Seleccione', 'disabled']) !!}
          {!! Form::hidden('tipo', $input['tipo'])!!}
      </div>

      <!-- Monto Field -->
      <div class="form-group col-sm-6">
          {!! Form::label('monto', 'Monto:') !!}
          {!! Form::number('monto', $input['monto'], ['class' => 'form-control', 'required', 'step'=>'0.01', 'max'=>$saldofinal, 'min'=>0, 'readonly']) !!}
      </div>

      <div class="form-group col-sm-6">
          {!! Form::label('metpago', 'Método de Pago:') !!}
          {!! Form::select('metpago', $metpago, null, ['class' => 'form-control', 'required', 'disabled']) !!}
      </div>

        <div id='variasfacturasinput' class="form-group col-sm-6" style="display:none;">
            {!! Form::label('facturas', 'Seleccione una o varias Facturas:') !!} <button type="button" class="btn btn-sm btn-primary" data-toggle="popover" title="Varias Facturas" data-content="Puede seleccionar una o más facturas. El monto de la operación se tomará del monto de la suma de las facturas."><i class="fa fa-question"></i></button>
            {!! Form::select('facturas[]', $facturas, null, ['class' => 'form-control select2', 'multiple'=>'multiple', 'style'=>'width: 100%;']) !!}
        </div>

      <div class="form-group col-sm-6">
          {!! Form::label('fecha', 'Fecha: (yyyy-mm-dd)') !!}
          {!! Form::text('fecha', $input['fecha'], ['placeholder'=>'yyyy-mm-dd','class' => 'form-control datepicker-input', 'required', 'data-language'=>'es', 'data-date-format'=>'yyyy-mm-dd', 'pattern'=>'(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))', 'readonly' ]) !!}
      </div>

      <div class="form-group col-sm-6">
          {!! Form::label('proveedor_id', 'Proveedor:') !!}
          {!! Form::select('proveedor_id', $proveedores, $input['proveedor_id'], ['class' => 'form-control', 'required', 'disabled']) !!}
      </div>

      <div class="form-group col-sm-6">
          {!! Form::label('numfactura', '# de Factura:') !!}
          {!! Form::text('numfactura', $input['numfactura'], ['class' => 'form-control maxlen', 'required', 'maxlength'=>'20', 'readonly']) !!}
      </div>

      <div class="form-group col-sm-6">
          {!! Form::label('subclasifica_id', 'Categoría:') !!}
          {!! Form::select('subclasifica_id', $subcategoriasAgrupadas, $input['subclasifica_id'], ['class' => 'form-control select2', 'required', 'placeholder'=>'Seleccione', 'style'=>'width: 100%;', 'disabled']) !!}
      </div>


      <div class="form-group col-sm-12">
          {!! Form::label('concepto', 'Concepto:') !!}
          {!! Form::text('concepto', $input['concepto'], ['class' => 'form-control maxlen', 'required', 'maxlength'=>'50']) !!}
      </div>

      <div class="form-group col-sm-12">
          {!! Form::label('comentario', 'Comentario:') !!}
          {!! Form::textarea('comentario', $input['comentario'], ['class' => 'form-control']) !!}
      </div>
    </div>

    @card(['title' => 'Datos de la Comisión', 'color'=>'warning'])
    <div class="row">
        <!-- Tipo Field -->
        <table class="table tabla-comision table-responsive table-responsive-xl" id="comision">
          <thead class="bg-info text-white fixed">
            <tr>
              <th style="width:40%">Categoria</th>
              <th style="width:40%;">Concepto</th>
              <th style="width:20%;">Monto</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            <td class="NCantegoria">
                <div class="input-group N1Categoria">
                  {!! Form::select('categoria', $subcategoriasAgrupadas, null, ['id'=>'categoria', 'class'=> 'form-control select2', 'required'] )!!}

              </div>
            </td>
            <td class="NConcepto">
              <div class="input-group N1Concepto">
               {!! Form::text('concepto', null, ['class'=>'form-control']) !!}

             </div>
            </td>
            <td>
              <div class="input-group col-md-12">
                 {!! Form::number('monto', null, ['class'=>'form-control'])!!}
              </div>
            </td>

            </tr>
          </tbody>
        </table>


    </div>
    @endcard
    <div class="card-footer tx-center bg-gray-300">
                  <a class="btn btn-info" href="">Registrar</a>
                  <a class="btn btn-secondary" href="">Cancel</a>
                </div>

  {!! Form::close() !!}

  @endcard

@endsection
