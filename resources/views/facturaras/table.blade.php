<table class="table table-responsive" id="facturaras-table">
    <thead>
        <tr>
            <th>Nombre</th>
        <th>Rfc</th>
        <th>Direccion</th>
            <th colspan="3">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($facturaras as $facturara)
        <tr>
            <td>{!! $facturara->nombre !!}</td>
            <td>{!! $facturara->rfc !!}</td>
            <td>{!! $facturara->direccion !!}</td>
            <td>
                {!! Form::open(['route' => ['facturaras.destroy', $facturara->id], 'method' => 'delete', 'id'=>'form'.$facturara->id]) !!}
                <div class='btn-group'>
                    <a href="{!! route('facturaras.show', [$facturara->id]) !!}" class='btn btn-info btn-xs'><i class="fa fa-eye"></i></a>
                    @can('facturaras-edit')
                    <a href="{!! route('facturaras.edit', [$facturara->id]) !!}" class='btn btn-primary btn-xs'><i class="fa fa-pencil"></i></a>
                    @endcan
                    @can('facturaras-delete')
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs', 'onclick' => "ConfirmDelete($facturara->id)"]) !!}
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
