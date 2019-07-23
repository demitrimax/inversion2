<table class="table table-responsive" id="creditos-table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Numero</th>
            <th>Cuenta</th>
            <th>Fecha Apertura</th>
            <th>Monto Restante</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($creditos as $creditos)
        <tr>
            <td><a href="{{route('creditos.show',[$creditos->id] )}}">{!! $creditos->nombre !!}</a></td>
            <td>{!! $creditos->numero !!}</td>
            <td>

              {!! $creditos->cuenta->nomcuenta !!}</td>
            <td>{!! $creditos->fapertura->format('d-m-Y') !!}</td>
            <td>{!! '$'.number_format($creditos->montorestante).'('.round(($creditos->montorestante/$creditos->monto_inicial)*100,2).'%)' !!}</td>
            <td>
                {!! Form::open(['route' => ['creditos.destroy', $creditos->id], 'method' => 'delete', 'id'=>'form'.$creditos->id]) !!}
                <div class='btn-group'>
                    <a href="{!! route('creditos.show', [$creditos->id]) !!}" class='btn btn-info'><i class="fa fa-eye"></i></a>
                    @can('creditos-edit')
                    <a href="{!! route('creditos.edit', [$creditos->id]) !!}" class='btn btn-primary'><i class="fa fa-pencil"></i></a>
                    @endcan
                    @can('creditos-delete')
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'button', 'class' => 'btn btn-danger', 'onclick' => "ConfirmDelete($creditos->id)"]) !!}
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
