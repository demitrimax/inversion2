<table class="table table-responsive table-hover" id="productos-table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>U. Medida</th>
            <th>Existencias</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($productos as $productos)
        <tr>
            <td><a href="{!! route('productos.show', [$productos->id]) !!}">{!! $productos->nombre !!}</a> {!! $productos->inventariable ? '<span class="badge badge-warning">Inventariable<span>' : ''!!}</td>
            <td>{!! $productos->categoria->nombre !!}</td>
            <td>{!! $productos->umedida !!}</td>
            <td>{!! $productos->stock !!}</td>
            <td>
                {!! Form::open(['route' => ['productos.destroy', $productos->id], 'method' => 'delete', 'id'=>'form'.$productos->id]) !!}
                <div class='btn-group'>
                    <a href="{!! route('productos.show', [$productos->id]) !!}" class='btn btn-info btn-xs'><i class="fa fa-eye"></i></a>
                    @can('productos-edit')
                    <a href="{!! route('productos.edit', [$productos->id]) !!}" class='btn btn-primary btn-xs'><i class="fa fa-pencil"></i></a>
                    @endcan
                    @can('productos-delete')
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs', 'onclick' => "ConfirmDelete($productos->id)"]) !!}
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
