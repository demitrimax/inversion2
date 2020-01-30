<table class="table table-responsive" id="clasificas-table">
    <thead>
        <tr>
            <th>Nombre</th>
        <th>Descripcion</th>
        <th>Orden</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody class="sortable">
    @foreach($clasificas as $clasifica)
        <tr>
            <td><a href="{!! route('clasificas.show', [$clasifica->id]) !!}">{!! $clasifica->nombre !!}</a></td>
            <td>{!! $clasifica->descripcion !!}</td>
            <td>{!! $clasifica->orden !!}</td>
            <td>
                {!! Form::open(['route' => ['clasificas.destroy', $clasifica->id], 'method' => 'delete', 'id'=>'form'.$clasifica->id]) !!}
                <div class='btn-group'>
                    <a href="{!! route('clasificas.show', [$clasifica->id]) !!}" class='btn btn-info btn-xs'><i class="far fa-eye"></i></a>
                    @can('clasificas-edit')
                    <a href="{!! route('clasificas.edit', [$clasifica->id]) !!}" class='btn btn-primary btn-xs'><i class="far fa-edit"></i></a>
                    @endcan
                    @can('clasificas-delete')
                    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs', 'onclick' => "ConfirmDelete($clasifica->id)"]) !!}
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
<script>$(".sortable").sortable();</script>

@endsection
