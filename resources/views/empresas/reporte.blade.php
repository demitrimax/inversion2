@extends('layouts.appv2')
@section('title',config('app.name').' | Reporte de Operaciones '.$empresa->nombre )

  @php
    $colors = ['default','primary', 'success', 'warning', 'danger', 'info', 'indigo', 'purple', 'pink', 'orange', 'teal', 'dark'];
    @endphp

@section('breadcrum')
<nav class="breadcrumb sl-breadcrumb">
  <a class="breadcrumb-item" href="{{url('/')}}">Principal</a>
  <a class="breadcrumb-item" href="{{url('/empresas')}}">Reporte de Operaciones</a>
  <a class="breadcrumb-item">{{date('Y')}}</a>
  <span class="breadcrumb-item active">{{$empresa->nombre}}</span>
</nav>
@endsection

@section('content')

@component('components.card', ['title'=>'Reportes Mensuales'])
    <p class="mg-b-20 mg-sm-b-30">Seleccione el año del reporte. {!! Form::select('Año Fiscal', $anios->pluck('anio', 'anio'), $anio, ['class'=>'form-control col-md-4', 'id'=>'aniorep'])!!}
      {!! Form::button('Seleccionar', ['class'=>'btn btn-primary', 'onclick'=>'gotorepyear()'])!!}
      {!! Form::button('Exportar a Excel', ['class'=>'btn btn-primary', 'onclick'=>'reporteExcel()' ]) !!}
    </p>

  <div class="row">

    <div class="col-md-12">
      <table class="table">
        <thead>
          <tr>
            <th>Categoria</th>
            <th>Subcategoria</th>
            <th>Enero</th>
            <th>Febrero</th>
            <th>Marzo</th>
            <th>Abril</th>
            <th>Mayo</th>
            <th>Junio</th>
            <th>Julio</th>
            <th>Agosto</th>
            <th>Septiembre</th>
            <th>Octubre</th>
            <th>Noviembre</th>
            <th>Diciembre</th>
          </tr>
        </thead>
        <tbody>
          @foreach($toperacionesg->unique('subclasifica.clasifica') as $operaciong)
          <tr>
            <td> {{$operaciong->subclasifica->clasifica->nombre }} </td>
            @foreach($toperacionesg->where('subclasifica.clasifica_id', $operaciong->subclasifica_id) as $operacionguno )
            <tr>
              <td></td>
              <td> {{$operacionguno->subclasifica->nombre }}</td>
            </tr>
            @endforeach
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endcomponent

@endsection

@section('scripts')
<script>
  function gotorepyear(anio){
    var mianio = $('#aniorep').val();
    window.location.href = "{{url('operaciones/empresa/'.$empresa->id.'/')}}/"+mianio+"/reporte";
  }
  function reporteExcel(anio){
    var mianio = $('#aniorep').val();
    window.location.href = "{{url('operaciones/empresa/'.$empresa->id.'/')}}/"+mianio+"/reporteExcel";
  }
</script>
@endsection
