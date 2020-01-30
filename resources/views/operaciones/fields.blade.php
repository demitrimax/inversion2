@section('css')
<link href="{{asset('appzia/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">
<link href="{{asset('airdatepicker/dist/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('table_fixed_header/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->


@endsection

<!-- Empresa Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('empresa_id', 'Empresa:') !!}
    {!! Form::select('empresa_id', $empresas, null, ['class' => 'form-control', 'placeholder'=>'Seleccione una empresa', 'required']) !!}
</div>

<!-- Cuenta Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cuenta_id', 'Cuenta:') !!}
    {!! Form::select('cuenta_id', $cuental, null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo', 'Tipo:') !!}
    {!! Form::select('tipo', ['Salida'=>'CARGO', 'Entrada'=>'ABONO' ], null, ['class' => 'form-control', 'placeholder'=>'Seleccione', 'required']) !!}
</div>
@php
  $monto = null;
  if(isset($operaciones->monto)){
    $monto = round($operaciones->monto,2);
  }
@endphp
<!-- Monto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('monto', 'Monto:') !!}
    {!! Form::number('monto', $monto, ['class' => 'form-control', 'step'=>'0.01']) !!}
</div>

<!-- Proveedor Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('proveedor_id', 'Proveedor:') !!}
    {!! Form::select('proveedor_id', $proveedores, null, ['class' => 'form-control select2', 'style'=>'width: 100%;']) !!}
</div>

@php
$mostrarselector = "display:none;";
$misfacturas = null;
  if (isset($operaciones->tipo))
  {
    if ($operaciones->tipo  == 'Entrada')
    {
      $mostrarselector = "display:'block';";
      if($operaciones->facturas->count() > 0 ){
        $misfacturas = $operaciones->facturas;
      }
    }

  }
@endphp
<div id='variasfacturasinput' style="{{$mostrarselector}}">
  <div class="form-group col-sm-6">
      {!! Form::label('facturas', 'Seleccione una o varias Facturas:') !!} <button type="button" class="btn btn-sm btn-primary" data-toggle="popover" title="Varias Facturas" data-content="Puede seleccionar una o más facturas. El monto de la operación se tomará del monto de la suma de las facturas."><i class="fa fa-question"></i></button>
      {!! Form::select('facturas[]', $facturas, $misfacturas, ['class' => 'form-control select2 lasfacturas', 'multiple'=>'multiple', 'style'=>'width: 100%;']) !!}
  </div>
</div>
<!-- Numfactura Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numfactura', 'Factura Número:') !!}
    {!! Form::text('numfactura', null, ['class' => 'form-control maxlen', 'maxlength' => '20']) !!}
</div>

<!-- Clasifica Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subclasifica_id', 'Categoría:') !!}
    {!! Form::select('subclasifica_id', $subcategoriasAgrupadas, null, ['class' => 'form-control select2', 'style'=>'width: 100%;', 'required']) !!}
</div>



<!-- Metpago Field -->
<div class="form-group col-sm-6">
    {!! Form::label('metpago', 'Método de pago:') !!}
    {!! Form::select('metpago', $metpago, null, ['class' => 'form-control']) !!}
</div>

@php
//conversion de fecha
$fecha = null;

if(isset($operaciones->fecha)){
    $fecha = $operaciones->fecha->format('Y-m-d');
}

@endphp
<!-- Fecha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha', 'Fecha:') !!} <button type="button" class="btn btn-sm btn-primary" data-toggle="popover" title="Formato de Fecha" data-content="Escriba la fecha en formato yyyy-mm-dd o utilice el selector de fecha."><i class="fa fa-question"></i></button>
    {!! Form::text('fecha', $fecha, ['placeholder'=>'yyyy-mm-dd','class' => 'form-control datepicker-here','id'=>'fecha', 'id'=>'fcreacion', 'data-language'=>'es', 'data-date-format'=>'yyyy-mm-dd', 'required', 'pattern'=>'(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))' ]) !!}
</div>

<!-- Concepto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('concepto', 'Concepto:') !!}
    {!! Form::text('concepto', null, ['class' => 'form-control maxlen', 'maxlength'=>'50', 'required']) !!}
</div>

<div class="form-group col-sm-6">
    <label class="ckbox">
      {!! Form::hidden('inventariable', 0)!!}
        <input type="checkbox" name="inventariable" id="inventariable" value = "1"><span>Operación de Inventario</span>
    </label>
</div>
@php
$micomision = null;
$comisionable = "";
if(isset($operaciones->comisionable))
{
  if($operaciones->comisionable == 1){
    $comisionable = "checked";
    $micomision = $operaciones->monto;
  }
}
@endphp
<div class="form-group col-sm-6">
    <label class="ckbox">
      {!! Form::hidden('comisionable', 0)!!}
        <input type="checkbox" name="comisionable" id="comisionable" value = "1" {!! $comisionable !!}><span>Operación Comisionable</span>
    </label>
</div>

<div id="comision">
    <!-- Concepto Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('monto_comision', 'Monto de la Comisión:') !!}
        {!! Form::number('monto_comision', $micomision, ['class' => 'form-control maxlen', 'maxlength'=>'50', 'id'=>'monto_comision', 'step'=>'0.01']) !!}
    </div>
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <strong class="d-block d-sm-inline-block-force">Comisión!</strong> Al crear una operación comisionable, el monto de la comisión es lo que se toma como monto de la operación, el monto solo para efectos visuales.
          </div>

</div>


<!-- Comentario Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('comentario', 'Comentario:') !!}
    {!! Form::textarea('comentario', null, ['class' => 'form-control']) !!}
</div>




<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('operaciones.index') !!}" class="btn btn-secondary">Cancelar</a>
</div>

@section('scripts')
<script src="{{asset('appzia/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}" type="text/javascript"></script>
<script src="{{asset('airdatepicker/dist/js/datepicker.min.js')}}"></script>
<script src="{{asset('airdatepicker/dist/js/i18n/datepicker.es.js')}}"></script>
<script src="{{asset('table_fixed_header/vendor/select2/select2.min.js')}}"></script>
<script>
     //Bootstrap-MaxLength
        $('.maxlen').maxlength();

        $('#comision').hide();

        $(function () {
          $('[data-toggle="popover"]').popover()
        })
        $(document).ready(function() {
            $('.select2').select2();
            @if(isset($operaciones->comisionable) && $operaciones->comisionable == 1)
            $('#comision').show();
            @endif
        });
        $('#comisionable').on('click', function(e) {

          if($(e.target).prop("checked") == true){
              $('#comision').show('slow');
              $('#monto_comision').prop('required', true);
            }
            else {
                $('#comision').hide('slow');
                $('#monto_comision').removeProp('required');
                $('#monto_comision').removeAttr('required');
                $('#monto_comision').val('');
            }
        });

        $("#tipo").on('change', function() {
          variasfacturas = document.getElementById('variasfacturasinput');
          monto = document.getElementById('monto');
          numfactura = document.getElementById('numfactura');
          if ($(this).val() == 'Entrada'){
              //alert('Abono');
              variasfacturas.style.display ='block';
              numfactura.value = '(VARIAS FACTURAS)';
              $('.select2').select2();
              //monto.setAttribute('readonly', 'true');
          } else {
              //alert('Cargo');
              var maxmonto = $('#maxmonto').val();
              $('#monto_op').attr('max', maxmonto);
              //monto.attr('readonly', false);
              variasfacturas.style.display ='none';
              numfactura.value = '';
              monto.setAttribute('readonly', 'false');
              monto.removeAttribute("readonly");
          }
        });


        $('#empresa_id').on('change', function(e) {
          //console.log(e);
          var empresaid = e.target.value;
          //ajax
          $.get('{{url('getCuentasempresa')}}/' + empresaid, function(data) {
            //exito al obtener los datos
            console.log(data);
            $('#cuenta_id').empty();
            $.each(data, function(index, cuentas) {
              console.log(cuentas);
              $('#cuenta_id').append('<option value ="' + cuentas.id + '">'+cuentas.nombre+'</option>' );
            });

          });
        });

        $('.lasfacturas').on('select2:select', function(e) { DatosdeFactura(e); });
        $('.lasfacturas').on('select2:unselect', function(e) { DatosdeFactura(e); });
        function DatosdeFactura(objeto)
        {

          var facturas = $('.lasfacturas').select2('data');
          //console.log(facturas);
          var montosfac = Number(0);
          $.each(facturas, function (index, factura) {
            //console.log('Factura id: '+factura.id);
            $.get('{{url('getdetalle/facturas')}}/' + factura.id, function(data) {
              //console.log('Inicio: '+montosfac);
              //montosfac = parseFloat(parseFloat(montosfac).toFixed(2) + parseFloat(data.monto).toFixed(2));
              montosfac += Number(parseFloat(data.monto).toFixed(2));
              //console.log('Final: '+montosfac);
              $('#monto').val(parseFloat(montosfac).toFixed(2));
            });

          });

        }
</script>

@endsection
