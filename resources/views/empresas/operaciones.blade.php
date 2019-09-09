@push('css')

<style>
span.select2-container {
    z-index:10050;
}
</style>
@endpush
      @if($empresas->operaciones->count()>0)
      <table class="table table-striped table-bordered detail-view" id="corrida-table">
       <thead class="bg-primary">
         <tr>
           <th>Núm</th>
           <th>Fecha</th>
           <th>Monto</th>
           <th>Categoría</th>
           <th>Cuenta</th>
           <th>Acciones</th>
         </tr>
       </thead>
         <tbody>@php $i=1; @endphp
         @foreach($operaciones as $key=>$operacion)
           <tr>
             <td>{{$i++}}</td>
             <td>{{$operacion->fecha->format('d-m-Y')}}</td>
             <td>{!! $operacion->tipo == 'Entrada' ? '<span class="badge badge-success"><i class="fa fa-arrow-circle-down"></i></span>' : '<span class="badge badge-warning"><i class="fa fa-arrow-circle-up"></i></span>'  !!} <a href="{{url('operaciones/'.$operacion->id)}}">${{ number_format($operacion->monto,2).'('.$operacion->cuenta->divisa.')' }}</a></td>
             <td>{{ $operacion->subclasifica->clasifica->nombre.':'.$operacion->subclasifica->nombre }}</td>
             <td>{{ $operacion->cuenta->nomcuenta }}</td>
             <td>
               {!! Form::open(['route' => ['operacion.destroy', $operacion->id], 'id'=>'formoper'.$operacion->id]) !!}
               <div class='btn-group'>

                   @can('operacion-delete')
                   {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs', 'onclick' => "ConfirmDelOper($operacion->id)"]) !!}
                   {!! Form::hidden('redirect', 'empresas.show') !!}
                   {!! Form::hidden('empresa_id', $empresas->id) !!}
                   @endcan
               </div>
               {!! Form::close() !!}
             </td>
           </tr>
           @endforeach
         </tbody>
     </table>
     {{$operaciones->links()}}
     @else
     No Existen Operaciones Registradas<br>
     @endif
     @can('operaciones-create')
     <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#RegOperacion">Registrar Operación </button>
     @endcan


@can('operaciones-create')

<div id="RegOperacion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">

              <div class="modal-header">
                  <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold" id="myModalLabel">Registrar Operación</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              {!! Form::open(['route' => 'operacion.store']) !!}
              <div class="modal-body">
                <div class="row">
                <!-- Tipo Field -->

                @php
                  $saldofinal = abs($empresas->saldofinal);
                @endphp

                <div class="form-group col-sm-6">
                    {!! Form::label('cuenta_id', 'Cuenta:') !!}
                    {!! Form::select('cuenta_id', $cuental, null, ['class' => 'form-control', 'required', 'placeholder'=>'Seleccione']) !!}
                </div>


                <div class="form-group col-sm-6">
                    {!! Form::hidden('empresa_id', $empresas->id) !!}
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
                        <input type="checkbox" name="inventariable" id="inventariable" value = "1"><span>Operación de Inventario</span>
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

            </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary waves-effect waves-light">Registrar Operación</button>
              </div>
                {!! Form::close() !!}
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div>
@endcan

@push('scripts')
<script src="{{asset('appzia/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}" type="text/javascript"></script>
<script>
  $('.maxlen').maxlength();

$("#tipo").on('change', function() {
  variasfacturas = document.getElementById('variasfacturasinput');
  monto = document.getElementById('monto_op');
  numfactura = document.getElementById('numfactura');
  if ($(this).val() == 'Entrada'){
      //alert('Abono');
      //$('#monto').attr('max', null);
      $('#monto_op').removeAttr( 'max' )
      variasfacturas.style.display ='block';
      numfactura.value = '(VARIAS FACTURAS)';
      monto.value = 0;
      //monto.setAttribute('readonly', 'true');
  } else {
      //alert('Cargo');
      var maxmonto = $('#maxmonto').val();
      $('#monto_op').attr('max', maxmonto);
      variasfacturas.style.display ='none';
      numfactura.value = '';
      //monto.removeAttribute('readonly');
  }
});

    //$('.select2').select2();

    $('.select2').select2({
    dropdownParent: $('#RegOperacion')
});

function ConfirmDelOper(id) {
  swal.fire({
        title: '¿Estás seguro?',
        text: 'Estás seguro de borrar esta operacion.',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Continuar',
        }).then((result) => {
  if (result.value) {
    document.forms['formoper'+id].submit();
  }
})
}

</script>
@endpush
