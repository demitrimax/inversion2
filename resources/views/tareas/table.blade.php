@section('css')
<!-- DataTables -->
<link href="{{asset('starlight/lib/highlightjs/github.css')}}" rel="stylesheet">
<link href="{{asset('starlight/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
<link href="{{asset('starlight/lib/select2/css/select2.min.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">

@endsection
<table class="table table-responsive dt-responsive nowrap" style="width:100%" id="tareas-table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Avance</th>
            <th>Vencimiento</th>
            <th>Usuario Responsable</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($tareas as $tareas)
        <tr>
            <td><a href="{!! route('tareas.show', [$tareas->id]) !!}">{!! $tareas->nombre !!}</a></td>
            <td>

                <div class="progress mg-b-20">
                  <div class="progress-bar progress-bar-lg bg-indigo wd-{{$tareas->avance_porc}}p"
                  role="progressbar" aria-valuenow="{{$tareas->avance_porc}}" aria-valuemin="0" aria-valuemax="100">{{$tareas->avance_porc}}%</div>
                </div>
              </td>
            <td>{!! $tareas->vencimiento->format('d-m-Y') !!} <span class="badge badge-{!! $tareas->estatusdate['valor'] !!}">{!! $tareas->estatusdate['descripcion'] !!}</span></td>
            <td>{!! $tareas->user->name !!}</td>
            <td>
                {!! Form::open(['route' => ['tareas.destroy', $tareas->id], 'method' => 'delete', 'id'=>'form'.$tareas->id]) !!}
                <div class='btn-group'>
                    <a href="{!! route('tareas.show', [$tareas->id]) !!}" class='btn btn-info'><i class="far fa-eye"></i></a>
                    @can('tareas-edit')
                    <a href="{!! route('tareas.edit', [$tareas->id]) !!}" class='btn btn-primary'><i class="far fa-edit"></i></a>
                    @endcan
                    @can('tareas-delete')
                    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'button', 'class' => 'btn btn-danger', 'onclick' => "ConfirmDelete($tareas->id)"]) !!}
                    @endcan
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>


@section('scripts')

<script src="{{asset('starlight/lib/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('starlight/lib/datatables-responsive/dataTables.responsive.js')}}"></script>
<script src="{{asset('starlight/lib/select2/js/select2.min.js')}}"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
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
$(function(){
        'use strict';

        $('#tareas-table').DataTable({
          responsive: true,
          "language": {
                    "url": "{{asset('appzia/plugins/datatables/Spanish.json')}}"
                }
        });

        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });

</script>

@endsection
