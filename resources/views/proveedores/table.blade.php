<table class="table table-responsive" id="proveedores-table">
    <thead>
        <tr>
            <th>Nombre</th>
        <th>Rfc</th>
        <th>Domicilio</th>
        <th>Telefono</th>
        <th>Contacto</th>
            <th colspan="3">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($proveedores as $proveedores)
        <tr>
            <td><a href="{!! route('proveedores.show', [$proveedores->id]) !!}" > {!! $proveedores->nombre !!} </a></td>
            <td>{!! $proveedores->rfc !!}</td>
            <td>{!! $proveedores->domicilio !!}</td>
            <td>{!! $proveedores->telefono !!}</td>
            <td>{!! $proveedores->contacto !!}</td>
            <td>
                {!! Form::open(['route' => ['proveedores.destroy', $proveedores->id], 'method' => 'delete', 'id'=>'form'.$proveedores->id]) !!}
                <div class='btn-group'>
                    <a href="{!! route('proveedores.show', [$proveedores->id]) !!}" class='btn btn-info btn-xs'><i class="fa fa-eye"></i></a>
                    @can('proveedores-edit')
                    <a href="{!! route('proveedores.edit', [$proveedores->id]) !!}" class='btn btn-primary btn-xs'><i class="fa fa-pencil"></i></a>
                    @endcan
                    @can('proveedores-delete')
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs', 'onclick' => "ConfirmDelete($proveedores->id)"]) !!}
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
