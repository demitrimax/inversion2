<table class="table table-responsive" id="bancos-table">
    <thead>
        <tr>
          <th>Nombre</th>
          <th>Denominacion Social</th>
          <th>Email</th>
          <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($bancos as $bancos)
        <tr>
            <td><a href="{!! route('bancos.show', [$bancos->id]) !!}">{!! $bancos->nombre !!}</a></td>
            <td>{!! $bancos->denominacionsocial !!}</td>
            <td>{!! $bancos->email !!}</td>
            <td>
                {!! Form::open(['route' => ['bancos.destroy', $bancos->id], 'method' => 'delete', 'id'=>'form'.$bancos->id]) !!}
                <div class='btn-group'>
                    <a href="{!! route('bancos.show', [$bancos->id]) !!}" class='btn btn-info'><i class="fa fa-eye"></i></a>
                    @can('bancos-edit')
                    <a href="{!! route('bancos.edit', [$bancos->id]) !!}" class='btn btn-primary'><i class="fa fa-pencil"></i></a>
                    @endcan
                    @can('bancos-delete')
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'button', 'class' => 'btn btn-danger', 'onclick' => "ConfirmDelete($bancos->id)"]) !!}
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
