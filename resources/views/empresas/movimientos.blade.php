
@section('css')
<link href="{{asset('airdatepicker/dist/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">
<style>
 .datepicker{z-index:9999 !important}
 </style>
@endsection
      <table class="table table-striped table-bordered detail-view" id="movcuentas-table">
       <thead class="bg-primary">
         <tr>
           <th>Num</th>
           <th>Fecha</th>
           <th>Monto</th>
           <th>Proyecto</th>
           <th>Acciones</th>
         </tr>
       </thead>
         <tbody>
         @foreach($empresas->cuentas as $cuentas)
          @foreach($cuentas->inversiones as $key=>$inversion)
           <tr>
             <td>{{$key+1}}</td>
             <td>{{$inversion->fecha->format('d-m-Y')}}</td>
             <td>${{number_format($inversion->monto,2).'('.$inversion->cuenta->divisa.')' }}</td>
             <td>{{ $inversion->proyecto->nombre }}</td>
             <td></td>
           </tr>
            @endforeach
           @endforeach
         </tbody>
     </table>

     @can('movcreditos-create')
     <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#MovInver">Registrar Inversión </button>
     @endcan

@can('movcreditos-create')
<div id="MovInver" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">

              <div class="modal-header">
                  <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold" id="myModalLabel">Registrar Inversión de Proyecto</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              {!! Form::open(['route' => 'inversion.proyecto']) !!}
              <div class="modal-body">
                <div class="row">
                <!-- Tipo Field -->

                @php
                $saldofinal = abs($empresas->saldoaldia);
                @endphp
                {!! Form::hidden('empresa_id', $empresas->id) !!}
                {!! Form::hidden('concepto', 'pago credito') !!}
                <div class="form-group col-sm-6">
                    {!! Form::label('cuenta_id', 'Cuenta:') !!}
                    {!! Form::select('cuenta_id', $cuental, null, ['class' => 'form-control', 'required', 'placeholder'=>'Seleccione']) !!}
                </div>

                <div class="form-group col-sm-6">
                    {!! Form::label('proyecto_id', 'Proyecto:') !!}
                    {!! Form::select('proyecto_id', $proyectos, null, ['class' => 'form-control', 'placeholder'=>'Seleccione', 'required']) !!}
                </div>

                <div class="form-group col-sm-6">
                    {!! Form::label('monto', 'Monto:') !!}
                    {!! Form::text('monto', null, ['class' => 'form-control', 'required']) !!}
                </div>

                <div class="form-group col-sm-6">
                    {!! Form::label('metpago', 'Método de Pago:') !!}
                    {!! Form::select('metpago', $metpago, null, ['class' => 'form-control', 'required']) !!}
                </div>

                <div class="form-group col-sm-6">
                    {!! Form::label('tinteres', 'Tasa de Interés:') !!} <button type="button" class="btn btn-sm btn-primary" data-toggle="popover" title="Tasa de Interés" data-content="Tasa de Interés adicional al crédito, interés propio aplicado a la inversión.">?</button>
                    {!! Form::number('tinteres', null, ['class' => 'form-control', 'required', 'step'=>'0.01']) !!}
                </div>

                <div class="form-group col-sm-6">
                    {!! Form::label('fecha', 'Fecha:') !!}
                    {!! Form::text('fecha', null, ['class' => 'form-control datepicker-input', 'required', 'data-language'=>'es', 'data-date-format'=>'yyyy-mm-dd', 'pattern'=>'(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))']) !!}
                </div>


                <div class="form-group col-sm-12">
                    {!! Form::label('observaciones', 'Comentario:') !!}
                    {!! Form::textarea('observaciones', null, ['class' => 'form-control']) !!}
                </div>
              </div>

            </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary waves-effect waves-light">Registrar Inversión</button>
              </div>
                {!! Form::close() !!}
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div>
@endcan

@push('scripts')
<script src="{{asset('airdatepicker/dist/js/datepicker.min.js')}}"></script>
<script src="{{asset('airdatepicker/dist/js/i18n/datepicker.es.js')}}"></script>
<script>
$('#credito_id').on('change', function(e) {
  //console.log(e);
  var creditoid = e.target.value;
  //ajax
  $.get('{{url('getCreditoPagos')}}/' + creditoid, function(data) {
    //exito al obtener los datos
    console.log(data);
    $('#pagoref').empty();
    $.each(data, function(index, pagos) {
      console.log(pagos);
      $('#pagoref').append('<option value ="' + pagos.id + '">'+pagos.nombre+'</option>' );
    });

  });
});
$(function () {
  $('[data-toggle="popover"]').popover()
})
// Initialize datepicker and save its instance in `dp`
var dp = $('.datepicker-input').datepicker().data('datepicker');

// When just use method .selectDate(), to select desirable date.
dp.selectDate(new Date()) // Will select current date;
</script>
@endpush
