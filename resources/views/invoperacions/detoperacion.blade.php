
<table class="table mg-b-0 table-primary">
  <thead class="bg-info">
    <tr>
      <th>Cantidad  </th>
      <th>Producto</th>
      <th>P. Unitario</th>
      <th>Importe</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach($invoperacion->invdetoperacions as $key=>$detoperacion)
    <tr>
      <td>{{ number_format($detoperacion->cantidad) }} </td>
      <td>{{$detoperacion->producto->nombre }}</td>
      <td>{{ number_format($detoperacion->punitario,2)}}</td>
      <td>{{number_format($detoperacion->importe,2)}}</td>
      <td>
        {!! Form::open(['route' => ['inventario.producto.surtido.total', $detoperacion->id], 'id'=>'form'.$detoperacion->id]) !!}
        @if($detoperacion->estatus == 'S')
        {!! Form::button('<i class="fa fa-exchange"></i> Surtido Total', ['class'=>'btn btn-xs btn-info', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Surtido Total', 'onclick' => 'SurtidoTotal('.$detoperacion->id.')' ]) !!}

        {!! Form::button('<i class="fa fa-cubes"></i> Surtido Parcial', ['class'=>'btn btn-xs btn-warning', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Surtido Parcial', 'onclick' => "SurtidoParcial($detoperacion->id, $detoperacion->cantidad)"]) !!}
        @endif

        @if($detoperacion->estatus == 'T')
        <span class="badge badge-success"> <i class="fa fa-check-square-o"></i> Surtido en su Totalidad</span>
        @endif

        @if($detoperacion->estatus == 'P')
        {!! Form::button('<i class="fa fa-exchange"></i> Surtido Total', ['class'=>'btn btn-xs btn-info', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Surtido Total', 'onclick' => 'SurtidoTotal('.$detoperacion->id.')' ]) !!}
        <span class="badge badge-warning"> <i class="fa fa-check-square-o"></i> Surtido parcialmente ({{ number_format($detoperacion->parcial) }})</span>


        @endif
        {!! form::close()!!}


      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{!! Form::open(['route' => ['inventario.producto.surtido.parcial', $invoperacion->id], 'id'=>'formparcial'.$detoperacion->id]) !!}
  {!! Form::hidden('parcial', null, ['id'=>'parcial'])!!}
  {!! Form::hidden('detoperacionid', null, ['id'=>'detoperacionid'])!!}
{!! form::close()!!}

<div class="row">
  <div class="col-md-6">
  </div>
  <div class='col-md-6'>
       <table class="table bg-white">

         <tbody>
           <tr>
             <td class="pull-right"><b>SUBTOTAL</b></td>
             <td>
               <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                 {!! Form::text('csubtotal', number_format($invoperacion->subtotal,2), ['class'=>'form-control text-right', 'id'=>'csubtotal', 'placeholder'=>'00000', 'readonly', 'step'=>'0.01'])!!}</td>

               </div>
           </tr>
           <tr>
             <td class="pull-right"><b>IVA</b></td>
             <td>
               <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                 {!! Form::text('civa', number_format($invoperacion->iva,2), ['class'=>'form-control text-right', 'id'=>'civa', 'placeholder'=>'00000', 'readonly', 'step'=>'0.01'])!!}</td>

               </div>
           </tr>
           <tr>
             <td class="pull-right">
               <b>TOTAL</b>
             </td>
             <td>
               <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
               {!! Form::text('cTotal', number_format($invoperacion->total,2), ['class'=>'form-control text-right', 'id'=>'cTotal', 'placeholder'=>'00000', 'readonly', 'step'=>'0.01'])!!}
               {!! Form::hidden('aTotal', null, ['class'=>'form-control', 'id'=>'aTotal'])!!}
             </div>
             </td>
           </tr>

         </tbody>
       </table>
     </div>
 </div>

 @section('scripts')

<script>
function SurtidoTotal(id) {
  swal.fire({
        title: 'Surtido Total',
        text: 'Se marcará este elemento como Surtido en su totalidad.',
        type: 'question',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Continuar',
        }).then((result) => {
  if (result.value) {
    //window.location.href = "{{url('inventario/surtido/total')}}/"+id;
    document.forms['form'+id].submit();
  }
})
}
async function SurtidoParcial(id, maxval) {
const { value: surtido } = await swal.fire({
        title: 'Surtido Parcial',
        input: 'number',
        inputAttributes: {
            min: (maxval*0.1),
            max: maxval,
            step: 1
          },
        text: 'Escriba la cantidad que se surtió.',
        type: 'question',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Continuar',
        })
        if(surtido){
          //alert(surtido);
          $("#parcial").val(surtido);
          $("#detoperacionid").val(id);
          //alert($('#parcial').val());
          document.forms['formparcial'+id].submit();
        }
}

</script>
 @endsection
