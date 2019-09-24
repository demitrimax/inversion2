@extends('layouts.appv2')
@section('title',config('app.name').' | Empresa '.$empresas->nombre )

@section('breadcrum')
<nav class="breadcrumb sl-breadcrumb">
  <a class="breadcrumb-item" href="{{url('/')}}">Principal</a>
  <a class="breadcrumb-item" href="{{url('/empresas')}}">Empresas</a>
  <a class="breadcrumb-item" href="{{url('/empresas/'.$empresas->id)}}">{{$empresas->nombre}}</a>
  <span class="breadcrumb-item active">{{ $mesanio.' / '.$subclasifica->nombre }}</span>
</nav>
@endsection

@section('content')

<div class="clearfix"></div>

@include('flash::message')

<div class="clearfix"></div>

<div class="content">
  <div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
        <div class="card-body">
            <div class="row" style="padding-left: 20px">

              <table class="table table-responsive" id="operaciones-table">
    <thead>
        <tr>
          <th>Concepto</th>
          <th>Monto</th>
          <th>Categoría/Subcategoria</th>
          <th>Fecha</th>
          <th>Cuenta</th>
          <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($operaciones->sortBy('fecha') as $operacion)
        <tr>
            <td>{!! $operacion->concepto !!}</td>
            <td>{!! $operacion->comisionable == 1 ? number_format($operacion->monto_comision,2) : number_format($operacion->monto,2) !!}</td>
            <td>{!! $operacion->subclasifica->clasifica->nombre.' : '.$operacion->subclasifica->nombre !!}</td>
            <td>{!! $operacion->fecha->format('d-m-Y') !!}</td>
            <td><a href="{{route('bcuentas.show', [$operacion->cuenta->id])}}">{!! $operacion->cuenta->nomcuenta!!}</a></td>
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
    <tfoot>
      <tr>
        <td>TOTAL</td>
        <td> {{ number_format($operaciones->sum('monto')) }}    </td>
        <td colspan="4"></td>
      </tr>
    </tfoot>
</table>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
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

@endsection
