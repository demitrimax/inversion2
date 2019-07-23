@section('css')
<link href="{{asset('appzia/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">
<link href="{{asset('airdatepicker/dist/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">

@endsection
<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control maxlen', 'required', 'maxlength'=>'35', 'placeholder'=>'Nombre del proyecto de credito']) !!}
</div>

<!-- Numero Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numero', 'Numero de credito:') !!}
    {!! Form::text('numero', null, ['class' => 'form-control maxlen', 'required', 'maxlength'=>'10', 'placeholder'=>'Referencia númerica del credito']) !!}
</div>

<!-- Empresa Responsable Field -->
<div class="form-group col-sm-6">
    {!! Form::label('empresa_id', 'Empresa responsable:') !!}
    {!! Form::select('empresa_id', $empresas, null, ['class' => 'form-control', 'required', 'placeholder'=>'Seleccione']) !!}
</div>

@php
$cuentas = [];
  if(isset($cuentasempresa)){
    $cuentas = $cuentasempresa;
  }
@endphp

<!-- Cuenta de la Empresa Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cuenta_id', 'Cuenta de Depósito:') !!}
    {!! Form::select('cuenta_id', $cuentas, null, ['class' => 'form-control', 'required']) !!}
</div>

@php
//conversion de fecha
$fecinicio = null;
$fectermino = null;
$fecapertura = null;
if(isset($creditos->finicio)){
    $fecinicio = $creditos->finicio->format('Y-m-d');
}
if(isset($creditos->ftermino)){
    $fectermino = $creditos->ftermino->format('Y-m-d');
}
if(isset($creditos->fapertura)){
    $fecapertura = $creditos->fapertura->format('Y-m-d');
}
@endphp
<!-- Finicio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('finicio', 'Fecha de inicio:') !!}
    {!! Form::text('finicio', $fecinicio, ['class' => 'form-control datepicker-here', 'required','id'=>'finicio', 'data-language'=>'es', 'data-date-format'=>'yyyy-mm-dd', 'pattern'=>'(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))']) !!}
</div>


<!-- Ftermino Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ftermino', 'Fecha de termino:') !!}
    {!! Form::text('ftermino', $fectermino, ['class' => 'form-control datepicker-here', 'required','id'=>'ftermino', 'data-language'=>'es', 'data-date-format'=>'yyyy-mm-dd', 'pattern'=>'(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))']) !!}
</div>


<!-- Tasainteres Field -->
<div class="form-group col-sm-6">
            {!! Form::label('tasainteres', 'Tasa de interes: %') !!}
     <div class="input-group bootstrap-touchspin">
        <span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span>
        {!! Form::number('tasainteres', null, ['class' => 'form-control', 'style'=>'display:block;','required', 'placeholder'=>'Porcentaje', 'min'=>'0.01', 'step'=>'0.01', 'max'=>'50.00']) !!}
        <span class="input-group-addon bootstrap-touchspin-postfix">%</span>
    </div>
</div>


<!-- Diapago Field -->
<div class="form-group col-sm-6">
    {!! Form::label('diapago', 'Dia de pago:') !!}
    {!! Form::number('diapago', null, ['class' => 'form-control','id'=>'diapago', 'min'=>'1', 'max'=>'30']) !!}
</div>

<!-- Monto Inicial Field -->
<div class="form-group col-sm-6">
    {!! Form::label('monto_inicial', 'Monto Inicial:') !!}
    {!! Form::number('monto_inicial', null, ['class' => 'form-control', 'required', 'min'=>'0.01', 'step'=>'0.01']) !!}
</div>

<!-- Fapertura Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fapertura', 'Fecha de apertura:') !!}
    {!! Form::date('fapertura', $fecapertura, ['class' => 'form-control','id'=>'fapertura', 'required', 'placeholder'=>'Fecha de apertura del credito']) !!}
</div>

<!-- Diascalculo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('diascalculo', 'Dias de calculo:') !!}
    {!! Form::number('diascalculo', null, ['class' => 'form-control']) !!}
</div>

<!-- Diascalculo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('meseslibres', 'Meses de gracia:') !!}
    {!! Form::number('meseslibres', null, ['class' => 'form-control', 'min'=>0]) !!}
</div>

<!-- Observaciones Field -->
<div class="form-group col-sm-12">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::textarea('observaciones', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('creditos.index') !!}" class="btn btn-secondary">Cancelar</a>
</div>


@section('scripts')
<script src="{{asset('appzia/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}" type="text/javascript"></script>
<script src="{{asset('airdatepicker/dist/js/datepicker.min.js')}}"></script>
<script src="{{asset('airdatepicker/dist/js/i18n/datepicker.es.js')}}"></script>
<script>
     //Bootstrap-MaxLength
        $('.maxlen').maxlength();
        $(function () {
          $('[data-toggle="popover"]').popover()
        })
</script>

<script>
$('#empresa_id').on('change', function(e) {
  //console.log(e);
  var empresa = e.target.value;
  //ajax
  $.get('{{url('getCuentasempresa')}}/' + empresa, function(data) {
    //exito al obtener los datos
    console.log(data);
    $('#cuenta_id').empty();
      //$('#cuenta_id').append('<option value ="">Seleccione una cuenta</option>' );
    $.each(data, function(index, cuentas) {
      $('#cuenta_id').append('<option value ="' + cuentas.id + '">'+cuentas.nombre+'</option>' );
    });

  });
});
</script>

@endsection
