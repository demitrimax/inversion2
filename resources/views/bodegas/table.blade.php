<table class="table table-responsive" id="bodegas-table">
    <thead>
        <tr>
            <th>Nombre</th>
        <th>Ubicacion</th>
            <th colspan="3">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($bodegas as $bodegas)
        <tr>
            <td>{!! $bodegas->nombre !!}</td>
            <td>{!! $bodegas->ubicacion !!}</td>
            <td>
                {!! Form::open(['route' => ['bodegas.destroy', $bodegas->id], 'method' => 'delete', 'id'=>'form'.$bodegas->id]) !!}
                <div class='btn-group'>
                    <a href="{!! route('bodegas.show', [$bodegas->id]) !!}" class='btn btn-info btn-xs'><i class="fa fa-eye"></i></a>
                    @can('bodegas-edit')
                    <a href="{!! route('bodegas.edit', [$bodegas->id]) !!}" class='btn btn-primary btn-xs'><i class="fa fa-pencil"></i></a>
                    @endcan
                    @can('bodegas-delete')
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs', 'onclick' => "ConfirmDelete($bodegas->id)"]) !!}
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
