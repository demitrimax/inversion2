
      @if($empresas->operaciones->count()>0)
      <table class="table table-striped table-bordered detail-view" id="corrida-table">
       <thead class="bg-primary">
         <tr>
           <th>Num</th>
           <th>Fecha</th>
           <th>Monto</th>
           <th>Tipo</th>
           <th>Cuenta</th>
           <th>Acciones</th>
         </tr>
       </thead>
         <tbody>
         @foreach($empresas->operaciones->sortBy('fecha') as $key=>$operacion)
           <tr>
             <td>{{$key+1}}</td>
             <td>{{$operacion->fecha->format('d-m-Y')}}</td>
             <td>${{ number_format($operacion->monto,2).'('.$operacion->cuenta->divisa.')' }}</td>
             <td>{{ $operacion->tipo }}</td>
             <td>{{ $operacion->cuenta->nomcuenta }}</td>
             <td>
               {!! Form::open(['route' => ['operacion.destroy', $operacion->id], 'method' => 'delete', 'id'=>'formoper'.$operacion->id]) !!}
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
     @else
     No Existen Operaciones Registradas<br>
     @endif
     @can('operaciones-create')
     <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#RegOperacion">Registrar Operación </button>
     @endcan


@can('operaciones-create')
<div id="RegOperacion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
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
                $saldofinal = abs($empresas->saldoaldia);
                @endphp

                <div class="form-group col-sm-6">
                    {!! Form::label('cuenta_id', 'Cuenta:') !!}
                    {!! Form::select('cuenta_id', $cuental, null, ['class' => 'form-control', 'required', 'placeholder'=>'Seleccione']) !!}
                </div>


                <div class="form-group col-sm-6">
                    {!! Form::hidden('empresa_id', $empresas->id) !!}
                    {!! Form::hidden('maxmonto',$saldofinal) !!}
                    {!! Form::label('tipo', 'Tipo:') !!}
                    {!! Form::select('tipo', ['Salida'=>'Cargo','Entrada'=>'Abono'], null, ['class' => 'form-control', 'required', 'placeholder'=>'Seleccione']) !!}
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

                <div class="form-group col-sm-6">
                    {!! Form::label('fecha', 'Fecha:') !!}
                    {!! Form::text('fecha', null, ['class' => 'form-control datepicker-input', 'required', 'data-language'=>'es', 'data-date-format'=>'yyyy-mm-dd', 'pattern'=>'(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))' ]) !!}
                </div>

                <div class="form-group col-sm-6">
                    {!! Form::label('proveedor_id', 'Proveedor:') !!}
                    {!! Form::select('proveedor_id', $proveedores, null, ['class' => 'form-control', 'required']) !!}
                </div>

                <div class="form-group col-sm-6">
                    {!! Form::label('numfactura', '# de Factura:') !!}
                    {!! Form::text('numfactura', null, ['class' => 'form-control', 'required']) !!}
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
<script>
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
