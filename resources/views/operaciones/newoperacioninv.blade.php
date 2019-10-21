@extends('layouts.appv2')

@section('title',config('app.name').' | Alta de Operaciones' )

@section('content')

  @card(['title' => 'Registro de Operación con Inventario', 'color'=>'primary'])
  {!! Form::open(['route' => 'operacion.store']) !!}

  <div class="row">
  <!-- Tipo Field -->

      @php
        $saldofinal = abs($empresa->saldofinal);
      @endphp

      <div class="form-group col-sm-6">
          {!! Form::label('cuenta_id', 'Cuenta:') !!}
          {!! Form::select('cuenta_id', $cuental, $request->input('cuenta_id'), ['class' => 'form-control', 'required', 'placeholder'=>'Seleccione']) !!}
      </div>


      <div class="form-group col-sm-6">
          {!! Form::hidden('empresa_id', $empresa->id) !!}
          {!! Form::hidden('maxmonto',$saldofinal) !!}
          {!! Form::label('tipo', 'Tipo:') !!}
          {!! Form::select('tipo', ['Salida'=>'CARGO','Entrada'=>'ABONO'], $request->input('tipo'), ['class' => 'form-control', 'required', 'placeholder'=>'Seleccione']) !!}
      </div>

      <!-- Monto Field -->
      <div class="form-group col-sm-6">
          {!! Form::label('monto_op', 'Monto:') !!}
          {!! Form::number('monto_op', $request->input('monto'), ['class' => 'form-control', 'required', 'step'=>'0.01', 'max'=>$saldofinal, 'min'=>0]) !!}
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
          {!! Form::text('fecha', $request->input('fecha'), ['placeholder'=>'yyyy-mm-dd','class' => 'form-control datepicker-input', 'required', 'data-language'=>'es', 'data-date-format'=>'yyyy-mm-dd', 'pattern'=>'(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))' ]) !!}
      </div>

      <div class="form-group col-sm-6">
          {!! Form::label('proveedor_id', 'Proveedor:') !!}
          {!! Form::select('proveedor_id', $proveedores, $request->input('proveedor_id'), ['class' => 'form-control', 'required']) !!}
      </div>

      <div class="form-group col-sm-6">
          {!! Form::label('numfactura', '# de Factura:') !!}
          {!! Form::text('numfactura', $request->input('numfactura'), ['class' => 'form-control maxlen', 'required', 'maxlength'=>'20']) !!}
      </div>

      <div class="form-group col-sm-6">
          {!! Form::label('subclasifica_id', 'Categoría:') !!}
          {!! Form::select('subclasifica_id', $subcategoriasAgrupadas, $request->subclasifica_id, ['class' => 'form-control select2', 'required', 'placeholder'=>'Seleccione', 'style'=>'width: 100%;']) !!}
      </div>

      <div class="form-group col-sm-12">
          {!! Form::label('concepto', 'Concepto:') !!}
          {!! Form::text('concepto', $request->input('concepto'), ['class' => 'form-control maxlen', 'required', 'maxlength'=>'50']) !!}
      </div>

      <div class="form-group col-sm-12">
          {!! Form::label('comentario', 'Comentario:') !!}
          {!! Form::textarea('comentario', $request->input('comentario'), ['class' => 'form-control']) !!}
      </div>
    </div>

    @card(['title' => 'Registro de Equipo Inventariable', 'color'=>'warning'])
    <div class="row">
      <table class="table tabla-minventario table-responsive table-responsive-xl" id="gastosdevolucion">
        <thead class="bg-primary text-white fixed">
          <tr>
            <th style="width:20%">Concepto</th>
            <th style="width:20%">Código o N/S</th>
            <th style="width:20%">Marca</th>
            <th style="width:20%;">Modelo</th>
            <th style="width:20%;" class="montoTitulo">Monto</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <td class="PConcepto">
              <div class="input-group P1Concepto">
                {!! Form::text('concepto_2[]', null, ['id'=>'concepto_2', 'class'=> 'form-control', 'required', 'style'=>'width: 100%;'] )!!}

            </div>
          </td>
          <td class="PCodigo">
            <div class="input-group P1Codigo">
             {!! Form::text('codigo_2[]', null, ['class'=>'form-control']) !!}

           </div>
          </td>
          <td class="PMarca">
            <div class="input-group P1Marca">
             {!! Form::text('marca_2[]', null, ['class'=>'form-control']) !!}

           </div>
          </td>
          <td class="PModelo">
            <div class="input-group P1Modelo">
             {!! Form::text('modelo_2[]', null, ['class'=>'form-control']) !!}

           </div>
          </td>
          <td>
            <div class="input-group col-md-12">
              <span class="input-group-addon d-none d-sm-block"><i class="fa fa-dollar"></i></span>
               {!! Form::number('monto_2[]', null, ['class'=>'form-control monto', 'id'=>'monto_2[]', 'step'=>'0.01' ])!!}
               <span class="input-group-btn">
                 <button type="button" class="btn btn-warning btn" id ="btnagregarotro"><i class="fa fa-plus"></i></button>
               </span>
            </div>
          </td>
          </tr>

        </tbody>
      </table>

    </div>
    @endcard


  {!! Form::close() !!}

  @endcard

@endsection

@section('scripts')
<script src="{{asset('starlight/lib/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('starlight/lib/numeral.js/min/numeral.min.js')}}"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();
});
  $('.maxlen').maxlength();


</script>
@endsection
