<table class="table table-responsive" id="efinancieras-table">
    <thead>
        <tr>
            <th>Nombre</th>
        <th>Contacto</th>
        <th>Telefono</th>
            <th colspan="3">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($efinancieras as $efinanciera)
        <tr>
            <td>{!! $efinanciera->nombre !!}</td>
            <td>{!! $efinanciera->contacto !!}</td>
            <td>{!! $efinanciera->telefono !!}</td>
            <td>
                {!! Form::open(['route' => ['efinancieras.destroy', $efinanciera->id], 'method' => 'delete', 'id'=>'form'.$efinanciera->id]) !!}
                <div class='btn-group'>
                    <a href="{!! route('efinancieras.show', [$efinanciera->id]) !!}" class='btn btn-info btn-xs'><i class="fa fa-eye"></i></a>
                    @can('efinancieras-edit')
                    <a href="{!! route('efinancieras.edit', [$efinanciera->id]) !!}" class='btn btn-primary btn-xs'><i class="fa fa-pencil"></i></a>
                    @endcan
                    @can('efinancieras-delete')
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs', 'onclick' => "ConfirmDelete($efinanciera->id)"]) !!}
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
