@php
  $montodelascompras = number_format($operaciones->inventarios->sum('montocompra'),2);
@endphp
@card(['title' => 'Equipo/Material Registrado con la Operación: '.$montodelascompras, 'color'=>'warning'])
<table class="table table-hover">
  <thead>
    <tr>
      <th>Concepto</th>
      <th>Monto</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach($operaciones->inventarios as $inventario)
    <tr>
      <td> {!! $inventario->concepto !!}</td>
      <td>{!! number_format($inventario->montocompra,2) !!}</td>
      <td>

        {!! Form::open(['route' => ['minventarios.destroy', $inventario->id], 'method' => 'delete', 'id'=>'form'.$inventario->id]) !!}
        <div class='btn-group'>
            <a href="{!! route('minventarios.show', [$inventario->id]) !!}" class='btn btn-info btn-xs'><i class="far fa-eye"></i></a>
            
            @can('minventarios-delete')
            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs', 'onclick' => "ConfirmDelete($inventario->id)"]) !!}
            @endcan
          </div>

      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#modproductos">Registrar Nuevo Producto </button>
@endcard

@component('components.modallarge', ['id'=>'modproductos','title'=>'Agregar producto Inventariable', 'closebutton'=>'Agregar'])

{!! Form::open(['url'=>'minventario/'.$operaciones->id.'/agregar'])!!}
<div class="row">
  <table class="table tabla-minventario table-responsive table-responsive-xl" id="minventario">
    <thead class="bg-primary text-white fixed">
      <tr>
        <th style="width:20%">Concepto</th>
        <th style="width:20%">Código o N/S</th>
        <th style="width:20%">Marca</th>
        <th style="width:20%;">Modelo</th>
        <th style="width:20%;" class="montoTitulo">Monto</th>
      </tr>
    </thead>
    <tbody>
      <tr>
      <td class="PConcepto">
          <div class="input-group P1Concepto">
            {!! Form::text('concepto_2', null, ['id'=>'concepto_2', 'class'=> 'form-control maxlen', 'required', 'style'=>'width: 100%;', 'maxlength'=>'50'] )!!}

        </div>
      </td>
      <td class="PCodigo">
        <div class="input-group P1Codigo">
         {!! Form::text('codigo_2', null, ['class'=>'form-control maxlen', 'maxlength'=>'30', 'required']) !!}

       </div>
      </td>
      <td class="PMarca">
        <div class="input-group P1Marca">
         {!! Form::text('marca_2', null, ['class'=>'form-control maxlen', 'maxlength'=>'30', 'required']) !!}

       </div>
      </td>
      <td class="PModelo">
        <div class="input-group P1Modelo">
         {!! Form::text('modelo_2', null, ['class'=>'form-control maxlen', 'maxlength'=>'30', 'required']) !!}

       </div>
      </td>
      <td>
        <div class="input-group col-md-12">
          <span class="input-group-addon d-none d-sm-block"><i class="fa fa-dollar"></i></span>
           {!! Form::number('monto_2', null, ['class'=>'form-control montoE', 'id'=>'monto_2[]', 'step'=>'0.01', 'required' ])!!}

        </div>
      </td>
      </tr>

    </tbody>
  </table>

</div>

@endcomponent


@push('scripts')
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
@endpush
