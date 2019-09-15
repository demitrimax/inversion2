<table class="table table-responsive" id="facturas-table">
    <thead>
        <tr>
            <th>Número</th>
            <th>Monto</th>
            <th>Concepto</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($facturas as $factura)
        <tr>
            <td>{!! $factura->numfactura !!}</td>
            <td>{!! number_format($factura->monto) !!}</td>
            <td>{!! $factura->concepto !!}</td>
            <td>{!! $factura->fecha->format('d-m-y') !!}</td>
            <td>{!! $factura->operacion_id ? '<span class="badge badge-success">Asignada</span>' : '<span class="badge badge-warning">Pendiente</span>' !!}</td>
            <td>
                {!! Form::open(['route' => ['facturas.destroy', $factura->id], 'method' => 'delete', 'id'=>'form'.$factura->id]) !!}
                <div class='btn-group'>
                    <a href="{!! route('facturas.show', [$factura->id]) !!}" class='btn btn-info btn-xs'><i class="far fa-eye"></i></a>
                    @can('facturas-edit')
                    <a href="{!! route('facturas.edit', [$factura->id]) !!}" class='btn btn-primary btn-xs'><i class="far fa-edit"></i></a>
                    @endcan
                    @can('facturas-delete')
                    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs', 'onclick' => "ConfirmDelete($factura->id)"]) !!}
                    @endcan
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $facturas->links() }}

@section('scripts')
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
@endsection
