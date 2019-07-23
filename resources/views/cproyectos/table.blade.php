<table class="table table-responsive" id="cproyectos-table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Inicio</th>
            <th>Categoría</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($cproyectos as $cproyectos)
        <tr>
            <td><a href="{!! route('cproyectos.show', [$cproyectos->id]) !!}">{!! $cproyectos->nombre !!}</a></td>
            <td>{!! $cproyectos->descripcion !!}</td>
            <td>{!! $cproyectos->finicio->format('d-m-Y') !!}</td>
            <td>{!! $cproyectos->clasifica->nombre !!}</td>
            <td>
                {!! Form::open(['route' => ['cproyectos.destroy', $cproyectos->id], 'method' => 'delete', 'id'=>'form'.$cproyectos->id]) !!}
                <div class='btn-group'>
                    <a href="{!! route('cproyectos.show', [$cproyectos->id]) !!}" class='btn btn-info'><i class="fa fa-eye"></i></a>
                    @can('cproyectos-edit')
                    <a href="{!! route('cproyectos.edit', [$cproyectos->id]) !!}" class='btn btn-primary'><i class="fa fa-pencil"></i></a>
                    @endcan
                    @can('cproyectos-delete')
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'button', 'class' => 'btn btn-danger', 'onclick' => "ConfirmDelete($cproyectos->id)"]) !!}
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
