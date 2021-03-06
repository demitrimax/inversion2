@section('css')
<!-- DataTables -->
<link href="{{asset('appzia/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('appzia/plugins/datatables/buttons.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('appzia/plugins/datatables/fixedHeader.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('appzia/plugins/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('appzia/plugins/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('appzia/plugins/datatables/scroller.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

<table class="table table-responsive table-primary table-striped" id="operaciones-table">
    <thead>
        <tr>
          <th>Icono</th>
          <th>Monto</th>
          <th>Empresa</th>
          <th>Categoría</th>
          <th>Concepto</th>
          <th>Proveedor</th>
          <th>Fecha</th>
          <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($operaciones as $operacion)
        <tr>
          <td>{!! $operacion->tipo == 'Entrada' ? '<span class="badge badge-success"  title="Abono"><i class="fa fa-arrow-circle-down"></i></span>' : '<span class="badge badge-warning"  title="Cargo"><i class="fa fa-arrow-circle-up"></i></span>'  !!}
            {!! $operacion->inventarios->count() > 0 ?  '<span class="badge badge-primary" title="Operación Inventario"><i class="fa fa-crosshairs"></i></span>' : ''  !!}
            {!! $operacion->comisionable == 1 ?  '<span class="badge badge-danger" title="Operación Comisionable"><i class="fa fa-asterisk"></i></span>' : ''  !!}
          </td>
            <td>
              {!! $operacion->comisionable == 1 ? number_format($operacion->monto_comision,2) : number_format($operacion->monto,2) !!}
            </td>
            <td>{!! $operacion->empresa->nombre !!}</td>
            <td>{!! $operacion->subclasifica->nombre !!}</td>
            <td>{!! $operacion->concepto !!}</td>
            <td>{!! $operacion->proveedor->nombre !!}</td>
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
<!-- Datatables-->
<script src="{{asset('appzia/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('appzia/plugins/datatables/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('appzia/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('appzia/plugins/datatables/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('appzia/plugins/datatables/jszip.min.js')}}"></script>
<script src="{{asset('appzia/plugins/datatables/pdfmake.min.js')}}"></script>
<script src="{{asset('appzia/plugins/datatables/vfs_fonts.js')}}"></script>
<script src="{{asset('appzia/plugins/datatables/buttons.html5.min.js')}}"></script>
<script src="{{asset('appzia/plugins/datatables/buttons.print.min.js')}}"></script>
<script src="{{asset('appzia/plugins/datatables/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('appzia/plugins/datatables/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('appzia/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('appzia/plugins/datatables/responsive.bootstrap.min.js')}}"></script>
<script src="{{asset('appzia/plugins/datatables/dataTables.scroller.min.js')}}"></script>

<script>
$(document).ready(function() {

var table = $('#productos-table').DataTable({
    serverSide: true,
    processing: true,
    ajax: "{!! url('inventario/lista/productos') !!}",
    stateSave: false,
    columns: [
        { data:'codigo_1', name: 'codigo_1' },
        { data: 'nombre', name: 'nombre',
        'render': function(val, _, obj) {
              return '<a href="{{url('productos')}}/' + obj.id + '" target="_self">' + val + '</a>'; }
            },
        { data:'categoria.nombre', name: 'categoria.nombre' },
        { data:'umedida', name: 'medida' },
        { data:'stock', name: 'stock' },
        { data:'acciones', name: 'acciones', orderable: false, searchable: false,
        'render': function(val, _, obj) {

              return @can('productos-edit') '<a href="productos/' + obj.id + '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Detalles</a> ' + @else  '' +   @endcan @can('productos-delete') '<a href="productos/' + obj.id + '/delete" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</a> '  @else '' @endcan ;
            }
          },

    ],

});

} );
</script>
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
