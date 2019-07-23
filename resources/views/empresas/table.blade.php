<table class="table table-responsive" id="empresas-table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Fecha de creación</th>
            <td>Saldo al día</th>
            <th colspan="3">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($empresas as $empresas)
        <tr>
            <td><a href="{!! route('empresas.show', [$empresas->id]) !!}">{!! $empresas->nombre !!}</a></td>
            <td>{!! $empresas->fcreacion->format('M, Y') !!}</td>
            <td>{{ $empresas->saldoaldia}}</td>
            <td>
                {!! Form::open(['route' => ['empresas.destroy', $empresas->id], 'method' => 'delete', 'id'=>'form'.$empresas->id]) !!}
                <div class='btn-group'>
                    <a href="{!! route('empresas.show', [$empresas->id]) !!}" class='btn btn-info'><i class="fa fa-eye"></i></a>
                    @can('empresas-edit')
                    <a href="{!! route('empresas.edit', [$empresas->id]) !!}" class='btn btn-primary'><i class="fa fa-pencil"></i></a>
                    @endcan
                    @can('empresas-delete')
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'button', 'class' => 'btn btn-danger', 'onclick' => "ConfirmDelete($empresas->id)"]) !!}
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
