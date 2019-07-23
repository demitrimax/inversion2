<table class="table table-responsive" id="metpagos-table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Nombre corto</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($metpagos as $metpago)
        <tr>
            <td>{!! $metpago->nombre !!}</td>
            <td>{!! $metpago->nomcorto !!}</td>
            <td>
                {!! Form::open(['route' => ['metpagos.destroy', $metpago->id], 'method' => 'delete', 'id'=>'form'.$metpago->id]) !!}
                <div class='btn-group'>
                    <a href="{!! route('metpagos.show', [$metpago->id]) !!}" class='btn btn-info btn-xs'><i class="fa fa-eye"></i></a>
                    @can('metpagos-edit')
                    <a href="{!! route('metpagos.edit', [$metpago->id]) !!}" class='btn btn-primary btn-xs'><i class="fa fa-pencil"></i></a>
                    @endcan
                    @can('metpagos-delete')
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs', 'onclick' => "ConfirmDelete($metpago->id)"]) !!}
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
