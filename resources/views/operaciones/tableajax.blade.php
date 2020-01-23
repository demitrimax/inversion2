@section('css')
<!-- DataTables -->
<!--
<link href="{{asset('appzia/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('appzia/plugins/datatables/buttons.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('appzia/plugins/datatables/fixedHeader.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('appzia/plugins/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('appzia/plugins/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('appzia/plugins/datatables/scroller.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
-->
<link href="{{asset('starlight/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">

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

</table>


@section('scripts')
<!-- Datatables-->
<!--
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
-->

<script src="{{asset('starlight/lib/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('starlight/lib/datatables-responsive/dataTables.responsive.js')}}"></script>

<script>

$(document).ready(function() {

var table = $('#operaciones-table').DataTable({
    serverSide: true,
    processing: true,
    ajax: "{!! url('operaciones/lista') !!}",
    stateSave: false,
    language: {
                "url": "{{asset('starlight/lib/datatables/spanish.json')}}"
            },
    columns: [
        { data:'id', name: 'id' ,
          'render': function(val, _, obj) {
            var resultado = '';
            resultado = obj.entrada == 1?  '<span class="badge badge-success"  title="Abono"><i class="fa fa-arrow-circle-down"></i></span>' : '<span class="badge badge-warning"  title="Cargo"><i class="fa fa-arrow-circle-up"></i></span>';
            resultado += obj.inventario == 1 ? '<span class="badge badge-primary" title="Operación Inventario"><i class="fa fa-crosshairs"></i></span>' : '';
            resultado += obj.comisionable == 1? '<span class="badge badge-danger" title="Operación Comisionable"><i class="fa fa-asterisk"></i></span>' : '' ;

            return resultado;
          }
        },
        { data: 'monto', name: 'monto',
        'render': function(val, _, obj)  {
              return '<a href="{{url('operaciones')}}/' + obj.id + '" target="_self">' + val + '</a>'; }
            },
        { data:'empresanombre', name: 'empresanombre' },
        { data:'categoria', name: 'categoria' },
        { data:'concepto', name: 'concepto' },
        { data:'proveedor', name: 'proveedor' },
        { data:'fecha', name: 'fecha' },
        { data:'acciones', name: 'acciones', orderable: false, searchable: false,
        'render': function(val, _, obj) {

              return @can('operaciones-edit') '<a href="operaciones/' + obj.id + '" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Detalles</a> ' + @else  '' +   @endcan @can('operaciones-delete') '<button onclick="ConfirmDelete('+ obj.id + ')" class="btn btn-xs btn-danger"><i class="far fa-trash-alt"></i> Eliminar</a> '  @else '' @endcan ;
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
    window.location.href = "operaciones/"+id+"/delete";
    //document.forms['form'+id].submit();
  }
})
}

</script>
@endsection
