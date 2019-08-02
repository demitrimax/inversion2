<table class="table table-responsive" id="facturas-table">
    <thead>
        <tr>
            <th>Número</th>
            <th>Monto</th>
            <th>Concepto</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($facturas as $facturas)
        <tr>
            <td>{!! $facturas->numfactura !!}</td>
            <td>{!! number_format($facturas->monto) !!}</td>
            <td>{!! $facturas->concepto !!}</td>
            <td>{!! $facturas->fecha->format('d-m-y') !!}</td>
            <td>
                {!! Form::open(['route' => ['facturas.destroy', $facturas->id], 'method' => 'delete', 'id'=>'form'.$facturas->id]) !!}
                <div class='btn-group'>
                    <a href="{!! route('facturas.show', [$facturas->id]) !!}" class='btn btn-info btn-xs'><i class="fa fa-eye"></i></a>
                    @can('facturas-edit')
                    <a href="{!! route('facturas.edit', [$facturas->id]) !!}" class='btn btn-primary btn-xs'><i class="fa fa-pencil"></i></a>
                    @endcan
                    @can('facturas-delete')
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs', 'onclick' => "ConfirmDelete($facturas->id)"]) !!}
                    @endcan
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

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
