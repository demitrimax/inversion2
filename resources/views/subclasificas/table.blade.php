@section('css')
<!-- DataTables -->
<link href="{{asset('starlight/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
<link href="{{asset('starlight/lib/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{asset('starlight/lib/highlightjs/github.css')}}" rel="stylesheet">

@endsection
<?php
function limit_text($text, $limit) {
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]) . '...';
      }
      return $text;
    }
?>
<table class="table table-responsive" id="subclasificas-table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Categoría</th>
            <th>Operaciones</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($subclasificas as $subclasifica)
        <tr>
            <td><a href="{!! route('subclasificas.show', [$subclasifica->id]) !!}">{!! $subclasifica->nombre !!}</a></td>
            <td>{!! limit_text($subclasifica->descripcion, 10) !!}</td>
            <td>{!! $subclasifica->clasifica->nombre !!}</td>
            <td>{!! $subclasifica->operaciones->count() !!}</td>
            <td>
                {!! Form::open(['route' => ['subclasificas.destroy', $subclasifica->id], 'method' => 'delete', 'id'=>'form'.$subclasifica->id]) !!}
                <div class='btn-group'>
                    <a href="{!! route('subclasificas.show', [$subclasifica->id]) !!}" class='btn btn-info btn-xs'><i class="far fa-eye"></i></a>
                    @can('subclasificas-edit')
                    <a href="{!! route('subclasificas.edit', [$subclasifica->id]) !!}" class='btn btn-primary btn-xs'><i class="far fa-edit"></i></a>
                    @endcan
                    @can('subclasificas-delete')
                    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs', 'onclick' => "ConfirmDelete($subclasifica->id)"]) !!}
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

<!-- DataTables -->
<script src="{{asset('starlight/lib/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('starlight/lib/datatables-responsive/dataTables.responsive.js')}}"></script>

<script>
  $(function () {
    $('#subclasificas-table').DataTable({
      responsive: true,
       stateSave: true,
      "language": {
                "url": "{{asset('appzia/plugins/datatables/Spanish.json')}}"
            }
    })
  })
</script>

@endsection
