<table class="table table-responsive" id="operaciones-table">
    <thead>
        <tr>
          <th>Monto</th>
          <th>Empresa</th>
          <th>Categoría</th>
          <th>Concepto</th>
          <th>Fecha</th>
          <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($operaciones as $operacion)
        <tr>
            <td> {!! $operacion->tipo == 'Entrada' ? '<span class="badge badge-success"><i class="fa fa-arrow-circle-down"></i></span>' : '<span class="badge badge-warning"><i class="fa fa-arrow-circle-up"></i></span>'  !!}
              {!! $operacion->comisionable == 1 ? number_format($operacion->monto_comision,2) : number_format($operacion->monto,2) !!}
              {!! $operacion->comisionable == 1 ? '<span class="badge badge-info"><i class="far fa-plus-square"></i></span>' : '' !!}
            </td>
            <td>{!! $operacion->empresa->nombre !!}</td>
            <td>{!! $operacion->subclasifica->nombre !!}</td>
            <td>{!! $operacion->concepto !!}</td>
            <td>{!! $operacion->fecha->format('d-m-Y') !!}</td>
            <td>
                {!! Form::open(['route' => ['operaciones.destroy', $operacion->id], 'method' => 'delete', 'id'=>'form'.$operacion->id]) !!}
                <div class='btn-group'>
                    <a href="{!! route('operaciones.show', [$operacion->id]) !!}" class='btn btn-info btn-xs'><i class="far fa-eye"></i></a>
                    @can('operaciones-edit')
                    <a href="{!! route('operaciones.edit', [$operacion->id]) !!}" class='btn btn-primary btn-xs'><i class="far fa-edit"></i></a>
                    @endcan
                    @can('operaciones-delete')
                    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs', 'onclick' => "ConfirmDelete($operacion->id)"]) !!}
                    @endcan
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>


{{$operaciones->links()}}
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
