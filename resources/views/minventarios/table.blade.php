<table class="table table-responsive" id="minventarios-table">
    <thead>
        <tr>
          <th>Concepto</th>
          <th>Descripcion</th>
          <th>Marca</th>
          <th>Codigo</th>
          <th>Monto</th>
          <th>Resguardo a</th>
          <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($minventarios as $minventario)
        <tr>
            <td>{!! $minventario->concepto !!}</td>
            <td>{!! $minventario->descripcion !!}</td>
            <td>{!! $minventario->marca !!}</td>
            <td>{!! $minventario->codigo !!}</td>
            <td>{!! $minventario->montocompra !!}</td>
            <td>{!! $minventario->resguardoa !!}</td>
            <td>
                {!! Form::open(['route' => ['minventarios.destroy', $minventario->id], 'method' => 'delete', 'id'=>'form'.$minventario->id]) !!}
                <div class='btn-group'>
                    <a href="{!! route('minventarios.show', [$minventario->id]) !!}" class='btn btn-info btn-xs'><i class="far fa-eye"></i></a>
                    @can('minventarios-edit')
                    <a href="{!! route('minventarios.edit', [$minventario->id]) !!}" class='btn btn-primary btn-xs'><i class="far fa-edit"></i></a>
                    @endcan
                    @can('minventarios-delete')
                    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs', 'onclick' => "ConfirmDelete($minventario->id)"]) !!}
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
