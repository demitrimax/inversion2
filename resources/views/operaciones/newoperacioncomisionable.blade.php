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
          {!! Form::hidden('cuenta_id', $input['cuenta_id']) !!}
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

    @card(['title' => 'Datos de la Devolución', 'color'=>'warning', 'classid'=>'comision'])
    <div class="row">
        <!-- Tipo Field -->


                <div class="form-group col-sm-6">
                  {!! Form::label('categoria', 'Categoria:') !!}
                  {!! Form::select('categoria', $subcategoriasAgrupadasIng, null, ['id'=>'categoria', 'class'=> 'form-control select2', 'required'] )!!}
                </div>



              <div class="form-group col-sm-6">
                {!! Form::label('concepto_1', 'Concepto:') !!}
                {!! Form::text('concepto_1', null, ['class'=>'form-control']) !!}
             </div>


              <div class="form-group col-sm-6">
                {!! Form::label('monto_com', 'Monto Comisión:') !!}
                {!! Form::number('monto_com', null, ['class'=>'form-control', 'min'=>1,'max'=>$input['monto']*0.16, 'id'=>'monto_com' ])!!}
              </div>

              <div class="form-group col-sm-6">
                {!! Form::label('cuentadev', 'Cuenta deposito de Devolución:') !!}
                {!! Form::select('cuentadev', $cuentasporfuera, null, ['class'=>'form-control' ])!!}
              </div>

              <div class="form-group col-sm-6">
                {!! Form::label('monto_dev', 'Monto de la Devolución:') !!}
                <div class="input-group">
                <span class="input-group-addon d-none d-sm-block"><i class="fa fa-dollar"></i></span>
                 {!! Form::text('monto_dev', null, ['class'=>'form-control', 'min'=>1,'max'=>$input['monto']*0.87, 'id'=>'monto_dev', 'readonly' ])!!}
                 {!! Form::hidden('montodev', null, ['id'=>'montodev'])!!}
               </div>
              </div>


    </div>
    <div class="advertencia-saldocomision">
      @component('components.alertdismissbig')
        El monto de comisión es superior al 16%.
      @endcomponent

    @endcard
  </div>
    @card(['title' => 'Operaciones de la Devolución', 'color'=>'default'])
    <div class="row">
        <!-- Tipo Field -->
        <table class="table tabla-comision table-responsive table-responsive-xl" id="comision">
          <thead class="bg-purple text-white fixed">
            <tr>
              <th style="width:30%">Categoria</th>
              <th style="width:20%">Cuenta</th>
              <th style="width:30%;">Concepto</th>
              <th style="width:20%;" class="montoTitulo">Monto</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            <td class="PCantegoria">
                <div class="input-group P1Categoria">
                  {!! Form::select('categoria_2', $subcategoriasAgrupadas, null, ['id'=>'categoria', 'class'=> 'form-control select2', 'required'] )!!}

              </div>
            </td>
            <td class="PCuenta">
              <div class="input-group P1Cuenta">
               {!! Form::select('cuenta_2', $cuental, null, ['class'=>'form-control']) !!}

             </div>
            </td>
            <td class="PConcepto">
              <div class="input-group P1Concepto">
               {!! Form::text('concepto_2', null, ['class'=>'form-control']) !!}

             </div>
            </td>
            <td>

              <div class="input-group col-md-12">
                <span class="input-group-addon d-none d-sm-block"><i class="fa fa-dollar"></i></span>
                 {!! Form::number('monto_com2', null, ['class'=>'form-control', 'max'=>$input['monto']*0.16, 'id'=>'monto_com' ])!!}
              </div>
            </td>

            </tr>
          </tbody>
        </table>


    </div>
    @endcard
    <div class="card-footer tx-center bg-gray-300">
                  <button class="btn btn-info" type="submit">Registrar</button>
                  <a class="btn btn-secondary" href="url('operaciones')">Cancelar</a>
                </div>

  {!! Form::close() !!}

  @endcard

@endsection

@section('scripts')
<script src="{{asset('starlight/lib/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('starlight/lib/numeral.js/min/numeral.min.js')}}"></script>
<script>
  $('.advertencia-saldocomision').hide();

  $('#monto_com').on('change keyup', function(e) {
    var montoT = {!! $input['monto'] !!};
    var comision = parseFloat(e.target.value).toFixed(2);
    var mRestante = numeral(parseFloat(montoT).toFixed(2) - parseFloat(e.target.value).toFixed(2));

    //$('.montoTitulo').text('Monto Restante: '+mRestante.format('0,0.00'));
    $('#monto_dev').val(mRestante.format('0,0.00'));
    $('#montodev').val(mRestante.value());
    var porcentaje = parseFloat(comision / montoT).toFixed(2);
    $('.comision').text('Datos de la Comision: '+ parseInt(porcentaje*100) +'%');

    if(porcentaje > 0.16 ){
      //alert('porcentaje de la comisión supera el 16% : ' + porcentaje)
      $('.advertencia-saldocomision').show();
    }
    else {
        $('.advertencia-saldocomision').hide();
    }
  });

</script>
@endsection
