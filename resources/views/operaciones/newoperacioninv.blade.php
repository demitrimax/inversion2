@extends('layouts.appv2')

@section('title',config('app.name').' | Alta de Operaciones' )

@section('content')

  @card(['title' => 'Registro de Operación con Inventario', 'color'=>'primary'])
  {!! Form::open(['route' => 'operacion.inventario.save']) !!}

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
          {!! Form::number('monto_op', $request->input('monto'), ['id'=>'monto_op','class' => 'form-control', 'required', 'step'=>'0.01', 'max'=>$saldofinal, 'min'=>0]) !!}
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

    @card(['title' => 'Registro de Equipo/Material Inventariable', 'color'=>'warning'])
    <div class="row">
      <table class="table tabla-minventario table-responsive table-responsive-xl" id="minventario">
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
                {!! Form::text('concepto_2[]', null, ['id'=>'concepto_2', 'class'=> 'form-control maxlen', 'required', 'style'=>'width: 100%;', 'maxlength'=>'50'] )!!}

            </div>
          </td>
          <td class="PCodigo">
            <div class="input-group P1Codigo">
             {!! Form::text('codigo_2[]', null, ['class'=>'form-control maxlen', 'maxlength'=>'30', 'required']) !!}

           </div>
          </td>
          <td class="PMarca">
            <div class="input-group P1Marca">
             {!! Form::text('marca_2[]', null, ['class'=>'form-control maxlen', 'maxlength'=>'30', 'required']) !!}

           </div>
          </td>
          <td class="PModelo">
            <div class="input-group P1Modelo">
             {!! Form::text('modelo_2[]', null, ['class'=>'form-control maxlen', 'maxlength'=>'30', 'required']) !!}

           </div>
          </td>
          <td>
            <div class="input-group col-md-12">
              <span class="input-group-addon d-none d-sm-block"><i class="fa fa-dollar"></i></span>
               {!! Form::number('monto_2[]', null, ['class'=>'form-control montoE', 'id'=>'monto_2[]', 'step'=>'0.01', 'required' ])!!}
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

    <div class="advertencia-monto_operacion">
      @component('components.alertdismissbig')
        El monto de las equipos/materiales es superior al monto de la compra.
      @endcomponent
    </div>

              <div class="card-footer tx-center bg-gray-300">
                    <button class="btn btn-info" type="submit">Registrar</button>
                    <a class="btn btn-secondary" href="url('operaciones')">Cancelar</a>
                </div>

  {!! Form::close() !!}

  @endcard

@endsection

@section('css')

<link href="{{asset('appzia/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">
<link href="{{asset('airdatepicker/dist/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('scripts')
<script src="{{asset('appzia/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}" type="text/javascript"></script>
<script src="{{asset('starlight/lib/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('starlight/lib/numeral.js/min/numeral.min.js')}}"></script>
<script src="{{asset('airdatepicker/dist/js/datepicker.min.js')}}"></script>
<script src="{{asset('airdatepicker/dist/js/i18n/datepicker.es.js')}}"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();
});
  $('.maxlen').maxlength();

  $('.advertencia-monto_operacion').hide();

  $('#monto_com').on('change keyup', function(e) {
    var montoT = {!! $request->input('monto') !!};
    var comision = parseFloat(e.target.value).toFixed(2);
    var mRestante = numeral(parseFloat(montoT).toFixed(2) - parseFloat(e.target.value).toFixed(2));

    //$('.montoTitulo').text('Monto Restante: '+mRestante.format('0,0.00'));
    $('#monto_dev').val(mRestante.format('0,0.00'));
    $('#montodev').val(mRestante.value());
    var porcentaje = parseFloat(comision / montoT).toFixed(2);
    $('.comision').text('Datos de la Devolución (Comisión: '+ parseInt(porcentaje*100) +'%)');

    //$('.secoperaciones').text('Operaciones de la Devolución (Restante:'+mRestante.format('0,0.00')+' )')

    if(porcentaje > 0.16 ){
      //alert('porcentaje de la comisión supera el 16% : ' + porcentaje)
      $('.advertencia-saldocomision').show();
    }
    else {
        $('.advertencia-saldocomision').hide();
    }
  });

  function SumarTodosLosMontos() {
    var ItemMonto = $('.montoE');
    var ArraySumaMonto = [];
    //console.log(ItemMonto.length);
    for (var i=0; i < ItemMonto.length; i++  )
    {
          ArraySumaMonto.push(Number($(ItemMonto[i]).val()));
          console.log($(ItemMonto[i]).val());
    }
      //console.log('ArraySumaMonto',ArraySumaMonto);
      function sumaArrayMontos(total, numero)
      {
        return total + numero;
      }

        var SumaTotalMontoA = ArraySumaMonto.reduce(sumaArrayMontos);
        //console.log('SumaTotalMonto',SumaTotalMonto);
        SumaTotalMonto = numeral(SumaTotalMontoA);
        //console.log(SumaTotalMontoA);
        var montoRestante = $('#montodev').val();
        var totalRestante = numeral(montoRestante - SumaTotalMontoA);

        $('.secoperaciones').text('Operaciones de la Devolución (Restante:'+totalRestante.format('0,0.00')+' )')
}

  var IdRow = 0;
  $('#btnagregarotro').click(function() {
    //$(this).removeClass("btn-warning");
      IdRow = IdRow+1;
      var newRow =
      '<tr id="r'+IdRow+'">'+
      '<td class="PConcepto">'+
          '<div class="input-group P1Concento">'+
            '{!! Form::text("concepto_2[]", null, ["id"=>"concepto_2[]", "class"=> "form-control maxlen", "required", "maxlength"=>"50"] )!!}'+

        '</div>'+
      '</td>'+
      '<td class="PCodigo">'+
        '<div class="input-group P1Codigo">'+
        ' {!! Form::text("codigo_2[]", null, ["class"=>"form-control maxlen", "maxlength"=>"30", "required"]) !!}'+

       '</div>'+
      '</td>'+
      '<td class="PMarca">'+
        '<div class="input-group P1Marca">'+
         '{!! Form::text("marca_2[]", null, ["class"=>"form-control maxlen", "maxlength"=>"30", "required"]) !!}'+

       '</div>'+
      '</td>'+
      '<td class="PModelo">'+
        '<div class="input-group P1Modelo">'+
         '{!! Form::text("modelo_2[]", null, ["class"=>"form-control maxlen", "maxlength"=>"30"]) !!}'+

       '</div>'+
    '  </td>'+
      '<td>'+
        '<div class="input-group col-md-12">'+
          '<span class="input-group-addon d-none d-sm-block"><i class="fa fa-dollar"></i></span>'+
           '{!! Form::number("monto_2[]", null, ["class"=>"form-control montoE", "id"=>"monto_2[]", "step"=>"0.01" ])!!}'+
           '<span class="input-group-btn">'+
             '<button type="button" class="btn btn-danger btn QuitarConcepto" id="quitarconcepto"><i class="fa fa-times"></i></button>'+
           '</span>'+
        '</div>'+
      '</td>'+
      '</tr>';
    $(newRow).appendTo($('#minventario tbody'));
    $('.select2').select2();
    $('.maxlen').maxlength();

  }) ;

  $('#minventario').on('click', 'button.QuitarConcepto', function() {
    console.log("prueba");
    $(this).parent().parent().parent().parent().remove();
    //SumarTodosLosMontos();
  });
</script>
@endsection
