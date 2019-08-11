<table class="table table-responsive" id="invoperacions-table">
    <thead>
        <tr>
            <th>Usuario</th>
            <th>Tipo</th>
            <th>Persona</th>
            <th>Monto</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($invoperacions as $invoperacion)
        <tr>
            <td>{!! $invoperacion->usuario_id !!}</td>
            <td>{!! $invoperacion->tipo_mov !!}</td>
            <td>{!! $invoperacion->proveedor_id !!}</td>
            <td>{!! $invoperacion->monto !!}</td>
            <td>{!! $invoperacion->fecha !!}</td>
            <td>
                {!! Form::open(['route' => ['invoperacions.destroy', $invoperacion->id], 'method' => 'delete', 'id'=>'form'.$invoperacion->id]) !!}
                <div class='btn-group'>
                    <a href="{!! route('invoperacions.show', [$invoperacion->id]) !!}" class='btn btn-info btn-xs'><i class="fa fa-eye"></i></a>
                    @can('invoperacions-edit')
                    <a href="{!! route('invoperacions.edit', [$invoperacion->id]) !!}" class='btn btn-primary btn-xs'><i class="fa fa-pencil"></i></a>
                    @endcan
                    @can('invoperacions-delete')
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs', 'onclick' => "ConfirmDelete($invoperacion->id)"]) !!}
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