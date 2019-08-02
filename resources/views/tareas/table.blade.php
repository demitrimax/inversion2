<table class="table table-responsive" id="tareas-table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Vencimiento</th>
            <th>Asignado a</th>
            <th>Avance</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($tareas as $tareas)
        <tr>
            <td>{!! $tareas->nombre !!}</td>
            <td>{!! $tareas->vencimiento->format('d-m-y') !!}</td>
            <td>{!! $tareas->user->name !!}</td>
            <td>{!! $tareas->avance_porc !!}</td>
            <td>
                {!! Form::open(['route' => ['tareas.destroy', $tareas->id], 'method' => 'delete', 'id'=>'form'.$tareas->id]) !!}
                <div class='btn-group'>
                    <a href="{!! route('tareas.show', [$tareas->id]) !!}" class='btn btn-info btn-xs'><i class="fa fa-eye"></i></a>
                    @can('tareas-edit')
                    <a href="{!! route('tareas.edit', [$tareas->id]) !!}" class='btn btn-primary btn-xs'><i class="fa fa-pencil"></i></a>
                    @endcan
                    @can('tareas-delete')
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs', 'onclick' => "ConfirmDelete($tareas->id)"]) !!}
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
