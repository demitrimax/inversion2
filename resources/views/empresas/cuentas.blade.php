<table class="table table-striped table-bordered detail-view" id="cuentas-table">
 <thead class="bg-primary">
   <tr>
     <th>Núm</th>
     <th>Cuenta</th>
     <th>Banco</th>
     <th>Saldo</th>
     <th>Acciones</th>
   </tr>
 </thead>
   <tbody>
   @foreach($empresas->cuentas as $key=>$cuenta)
     <tr>
       <td>{{$key+1}}</td>
       <td>{{$cuenta->numcuenta.'('.$cuenta->divisa.')' }}</td>
       <td>{{ $cuenta->banco->nombrecorto }}</td>
       <td><a href="{!! route('bcuentas.show', [$cuenta->id]) !!}" target="_blank">${{ number_format($cuenta->saldocuenta,2) }}</a></td>
       <td>
         {!! Form::open(['route' => ['bcuentas.destroy', $cuenta->id], 'method' => 'delete', 'id'=>'form'.$cuenta->id]) !!}
         <div class='btn-group'>
            @can('bcuentas-list')
             <a href="{!! route('bcuentas.show', [$cuenta->id]) !!}" class='btn btn-info btn-xs'><i class="fa fa-eye"></i></a>
             @endcan
             @can('bcuentas-edit')
               <a href="{!! route('bcuentas.edit', [$cuenta->id]) !!}" class='btn btn-primary btn-xs'><i class="fa fa-pencil"></i></a>
             @endcan
             @can('bcuentas-delete')
             {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs', 'onclick' => "ConfirmDelete($cuenta->id)"]) !!}
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

@can('bcuentas-create')
<button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#RegCuenta">Registrar nueva cuenta</button>
@endcan

@can('bcuentas-create')
<div id="RegCuenta" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">

              <div class="modal-header">
                  <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold" id="myModalLabel">Registrar Nueva Cuenta</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

              </div>
              {!! Form::open(['route' => 'bcuentas.store']) !!}
              <div class="modal-body">
                <div class="row">

                  <!-- Banco Id Field -->
                  {!! Form::hidden('empresa_id', $empresas->id) !!}
                  {!! Form::hidden('redirect', 'empresas.show') !!}
                  <div class="form-group col-sm-6">
                      {!! Form::label('banco_id', 'Banco:') !!}
                      {!! Form::select('banco_id', $bancos, null, ['class' => 'form-control', 'required', 'placeholder'=>'Seleccione un banco']) !!}
                  </div>

                  <!-- Numcuenta Field -->
                  <div class="form-group col-sm-6">
                      {!! Form::label('numcuenta', 'Número de cuenta:') !!}
                      {!! Form::text('numcuenta', null, ['class' => 'form-control']) !!}
                  </div>

                  <!-- Numcuenta Field -->
                  <div class="form-group col-sm-6">
                      {!! Form::label('divisa', 'Moneda:') !!}
                      {!! Form::select('divisa', $divisas, null, ['class' => 'form-control']) !!}
                  </div>

                  <!-- Clabeinterbancaria Field -->
                  <div class="form-group col-sm-6">
                      {!! Form::label('clabeinterbancaria', 'Clabe interbancaria:') !!}
                      {!! Form::text('clabeinterbancaria', null, ['class' => 'form-control']) !!}
                  </div>

                  <!-- Sucursal Field -->
                  <div class="form-group col-sm-6">
                      {!! Form::label('sucursal', 'Sucursal:') !!}
                      {!! Form::text('sucursal', null, ['class' => 'form-control', 'maxlength'=>'5']) !!}
                  </div>

                  <!-- Swift Field -->
                  <div class="form-group col-sm-6">
                      {!! Form::label('swift', 'Swift:') !!}
                      {!! Form::text('swift', null, ['class' => 'form-control']) !!}
                  </div>

              </div>

            </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary">Registrar nueva Cuenta</button>
              </div>
                {!! Form::close() !!}
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div>
@endcan

@push('scripts')
<script>
function ConfirmDelete(id) {
  swal.fire({
        title: '¿Estás seguro?',
        text: 'Estás seguro de borrar este elemento.',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Continuar',
        }).then((result) => {
  if (result.value) {
    document.forms['form'+id].submit();
  }
})
}
</script>
@endpush
