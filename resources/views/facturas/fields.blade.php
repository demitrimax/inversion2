@section('css')
<link href="{{asset('appzia/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">
<link href="{{asset('airdatepicker/dist/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('table_fixed_header/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->


@endsection
<!-- Numfactura Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numfactura', 'Número de factura:') !!}
    {!! Form::text('numfactura', null, ['class' => 'form-control maxlen', 'required', 'maxlength'=>'20']) !!}
</div>

<!-- Fecha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha', 'Fecha:') !!}<button type="button" class="btn btn-sm btn-primary" data-toggle="popover" title="Formato de Fecha" data-content="Escriba la fecha en formato yyyy-mm-dd o utilice el selector de fecha."><i class="fa fa-question"></i></button>
    {!! Form::text('fecha', null, ['placeholder'=>'yyyy-mm-dd','class' => 'form-control datepicker-here','id'=>'fecha', 'id'=>'fcreacion', 'data-language'=>'es', 'data-date-format'=>'yyyy-mm-dd', 'required', 'pattern'=>'(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))']) !!}
</div>

<!-- Monto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('monto', 'Monto:') !!}
    {!! Form::number('monto', null, ['class' => 'form-control', 'step'=>'0.01']) !!}
</div>

<!-- Concepto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('concepto', 'Concepto:') !!}
    {!! Form::text('concepto', null, ['class' => 'form-control maxlen', 'required', 'maxlength'=>'50' ]) !!}
</div>

<!-- Observaciones Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::textarea('observaciones', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('facturas.index') !!}" class="btn btn-secondary">Cancelar</a>
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
</script>

@endsection
