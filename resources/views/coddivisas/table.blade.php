<table class="table table-responsive" id="coddivisas-table">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th colspan="3">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($coddivisas as $coddivisas)
        <tr>
            <td>{!! $coddivisas->codigo !!}</td>
            <td>{!! $coddivisas->nombre !!}</td>
            <td>
                {!! Form::open(['route' => ['coddivisas.destroy', $coddivisas->id], 'method' => 'delete', 'id'=>'form'.$coddivisas->id]) !!}
                <div class='btn-group'>
                    <a href="{!! route('coddivisas.show', [$coddivisas->codigo]) !!}" class='btn btn-info btn-xs'><i class="fa fa-eye"></i></a>
                    @can('coddivisas-edit')
                    <a href="{!! route('coddivisas.edit', [$coddivisas->codigo]) !!}" class='btn btn-primary btn-xs'><i class="fa fa-pencil"></i></a>
                    @endcan
                    @can('coddivisas-delete')
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs', 'onclick' => "ConfirmDelete($coddivisas->id)"]) !!}
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
