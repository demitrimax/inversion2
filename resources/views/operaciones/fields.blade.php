@section('css')
<link href="{{asset('appzia/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">
<link href="{{asset('airdatepicker/dist/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('table_fixed_header/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->


@endsection

<!-- Empresa Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('empresa_id', 'Empresa:') !!}
    {!! Form::select('empresa_id', $empresas, null, ['class' => 'form-control']) !!}
</div>

<!-- Cuenta Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cuenta_id', 'Cuenta:') !!}
    {!! Form::select('cuenta_id', $cuental, null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo', 'Tipo:') !!}
    {!! Form::select('tipo', ['Salida'=>'CARGO', 'Entrada'=>'ABONO' ], null, ['class' => 'form-control']) !!}
</div>

<!-- Monto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('monto', 'Monto:') !!}
    {!! Form::number('monto', null, ['class' => 'form-control', 'step'=>'0.01']) !!}
</div>

<!-- Proveedor Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('proveedor_id', 'Proveedor:') !!}
    {!! Form::select('proveedor_id', $proveedores, null, ['class' => 'form-control']) !!}
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

        $(function () {
          $('[data-toggle="popover"]').popover()
        })
        $(document).ready(function() {
            $('.select2').select2();
        });
        
        $("#tipo").on('change', function() {
          if ($(this).val() == 'Entrada'){
              //alert('Abono');
              //$('#monto').attr('max', null);
              $('#monto_op').removeAttr( 'max' )
          } else {
              //alert('Cargo');
              var maxmonto = $('#maxmonto').val();
              $('#monto_op').attr('max', maxmonto);
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
</script>

@endsection
