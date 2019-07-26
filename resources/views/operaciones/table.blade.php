<table class="table table-responsive" id="operaciones-table">
    <thead>
        <tr>
          <th>Monto</th>
          <th>Empresa</th>
          <th>Clasifica Id</th>
          <th>Concepto</th>
          <th>Fecha</th>
          <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($operaciones as $operaciones)
        <tr>
            <td>{!! number_format($operaciones->monto,2) !!}</td>
            <td>{!! $operaciones->empresa->nombre !!}</td>
            <td>{!! $operaciones->clasifica->nombre !!}</td>
            <td>{!! $operaciones->concepto !!}</td>
            <td>{!! $operaciones->fecha !!}</td>
            <td>
                {!! Form::open(['route' => ['operaciones.destroy', $operaciones->id], 'method' => 'delete', 'id'=>'form'.$operaciones->id]) !!}
                <div class='btn-group'>
                    <a href="{!! route('operaciones.show', [$operaciones->id]) !!}" class='btn btn-info btn-xs'><i class="fa fa-eye"></i></a>
                    @can('operaciones-edit')
                    <a href="{!! route('operaciones.edit', [$operaciones->id]) !!}" class='btn btn-primary btn-xs'><i class="fa fa-pencil"></i></a>
                    @endcan
                    @can('operaciones-delete')
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs', 'onclick' => "ConfirmDelete($operaciones->id)"]) !!}
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
