<table class="table table-responsive" id="bcuentas-table">
    <thead>
        <tr>
            <th>Banco</th>
            <th>Núm. de cuenta</th>
            <th>Empresa</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($bcuentas as $bcuentas)
        <tr>
            <td><a href="{!! route('bcuentas.show', [$bcuentas->id]) !!}">{!! $bcuentas->banco->nombrecorto !!}<a/></td>
            <td><a href="{!! route('bcuentas.show', [$bcuentas->id]) !!}">{!! $bcuentas->numcuenta !!}</a></td>
            <td>@foreach($bcuentas->empresa as $empresa) {!! $empresa->nombre !!} @endforeach</td>
            <td>
                {!! Form::open(['route' => ['bcuentas.destroy', $bcuentas->id], 'method' => 'delete', 'id'=>'form'.$bcuentas->id]) !!}
                <div class='btn-group'>
                    <a href="{!! route('bcuentas.show', [$bcuentas->id]) !!}" class='btn btn-info btn-xs'><i class="fa fa-eye"></i></a>
                    @can('bcuentas-edit')
                    <a href="{!! route('bcuentas.edit', [$bcuentas->id]) !!}" class='btn btn-primary btn-xs'><i class="fa fa-pencil"></i></a>
                    @endcan
                    @can('bcuentas-delete')
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs', 'onclick' => "ConfirmDelete($bcuentas->id)"]) !!}
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
