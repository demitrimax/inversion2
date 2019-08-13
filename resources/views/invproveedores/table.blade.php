<table class="table table-responsive" id="invproveedores-table">
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
    @foreach($invproveedores as $invproveedores)
        <tr>
            <td>{!! $invproveedores->nombre !!}</td>
            <td>{!! $invproveedores->rfc !!}</td>
            <td>{!! $invproveedores->domicilio !!}</td>
            <td>{!! $invproveedores->telefono !!}</td>
            <td>{!! $invproveedores->contacto !!}</td>
            <td>
                {!! Form::open(['route' => ['invproveedores.destroy', $invproveedores->id], 'method' => 'delete', 'id'=>'form'.$invproveedores->id]) !!}
                <div class='btn-group'>
                    <a href="{!! route('invproveedores.show', [$invproveedores->id]) !!}" class='btn btn-info btn-xs'><i class="fa fa-eye"></i></a>
                    @can('invproveedores-edit')
                    <a href="{!! route('invproveedores.edit', [$invproveedores->id]) !!}" class='btn btn-primary btn-xs'><i class="fa fa-pencil"></i></a>
                    @endcan
                    @can('invproveedores-delete')
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs', 'onclick' => "ConfirmDelete($invproveedores->id)"]) !!}
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
