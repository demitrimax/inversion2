@extends('layouts.appv2')
@section('title',config('app.name').' | Reporte de Operaciones '.$empresa->nombre )

  @php
    $colors = ['default','primary', 'success', 'warning', 'danger', 'info', 'indigo', 'purple', 'pink', 'orange', 'teal', 'dark']
    @endphp

@section('breadcrum')
<nav class="breadcrumb sl-breadcrumb">
  <a class="breadcrumb-item" href="{{url('/')}}">Principal</a>
  <a class="breadcrumb-item" href="{{url('/empresas')}}">Reporte de Operaciones</a>
  <span class="breadcrumb-item active">{{$empresa->nombre}}</span>
</nav>
@endsection

@section('content')

@component('components.card', ['title'=>'Reportes Mensuales'])
    <p class="mg-b-20 mg-sm-b-30">Seleccione el año del reporte. {!! Form::select('Año Fiscal', ['2018', '2019'],'null', ['class'=>'form-control col-md-4'])!!}</p>
  <div class="row">
    @foreach($fechasopg as $key=>$fechas)
      <div class="col-md-4 mg-t-20">
        @component('components.cardv2', ['title'=> strtoupper($fechas->mesaniog), 'color'=>$colors[$key]] )

        <table id='subclasifica' class="table">
          <thead>
              <tr>
                <th>Categoria</th>
                <th>Subcategoria</th>
                <th>Monto</th>
              </tr>
          </thead>

          <tbody>
            @php
              $catunicas = '';

            @endphp

        @isset($saldofiscal)
            <tr>
              <td colspan="2"><b>SALDO INICIAL</b></td>
              @php $saldoinicial = $saldofiscal + $saldoporfuera; @endphp
              <td><b class="tx-purple">$ {{ number_format($saldoinicial,2)}}</b><td>
            </tr>
              @isset($saldoinicial)
              <tr>
                <td></td>
                <td>SALDO INICIAL FISCAL</td>
                <td><b class="pull-right">$ {{number_format($saldofiscal,2)}}<b></td>
              </tr>
              @endisset
              @isset($saldoporfuera)
                <tr>
                  <td></td>
                  <td>SALDO INICIAL X FUERA</td>
                  <td><b class="pull-right">$ {{number_format($saldoporfuera,2)}}<b></td>
                </tr>
                @endisset
            @endisset

            @foreach($toperacionesg->where('fechag',$fechas->fechag)->sortBy('subclasifica.clasifica.orden') as $key=>$operacion)

              @if($catunicas <> $operacion->subclasifica->clasifica->nombre )
                <tr>
                  <td colspan="2"><b>{{ $categoria = $operacion->subclasifica->clasifica->nombre}}</b></td>
                  @php
                    //echo $operacion->subclasifica->clasifica_id;
                    $montocat = $toperacionesg->where('fechag',$fechas->fechag)->where('subclasifica.clasifica_id', $operacion->subclasifica->clasifica_id)->sum('montog');

                  @endphp
                  <td> <b class="{{ $operacion->subclasifica->clasifica->tip == 'I' ? 'tx-teal' : 'tx-danger'}}">{{ number_format($montocat,2) }}</b></td>
                  </tr>
                  @php $catunicas = $operacion->subclasifica->clasifica->nombre; @endphp
              @endif
              <tr>
                <td></td>
                <td>{{$operacion->subclasifica->nombre}} </td>
                <td class="pull-right"><a href="{{route('detalle.categoria', [$empresa->id, $operacion->fechag, $operacion->subclasifica_id])}}" target="_blank">{{number_format($operacion->montog)}} </a></td>
              </tr>

            @endforeach
            <tr>
              <td colspan="2">TOTAL DE EGRESOS</td>
              <td><b class="tx-danger">{{ number_format($tegreso = $toperacionesg->where('fechag', $fechas->fechag)->where('subclasifica.clasifica.tip', 'E')->sum('montog'),2) }}</b></td>
            </tr>
            <tr>
              <td colspan="2">TOTAL DE INGRESOS</td>
              <td><b class="tx-teal">{{ number_format($tingreso = $toperacionesg->where('fechag', $fechas->fechag)->where('subclasifica.clasifica.tip', 'I')->sum('montog'),2) }}</b></td>
            </tr>
            <tr>
              <td colspan="2">SALDOS</td>
              <td>
                <b class="tx-purple">{{ number_format($tingreso-$tegreso,2) }}</b><br>
                @php

                if(!isset($saldoporfuera)){
                  $saldoporfuera = 0;
                }
                $saldoporfuera = 0;

                foreach($toperacionesporcuenta->where('fechag',$fechas->fechag)->where('cuenta.efectivo',1) as $key=>$saldocuentaefectivo)
                {
                  $saldoporfuera += $saldocuentaefectivo->montog;
                }
                $saldofiscal = $tingreso-$tegreso - $saldoporfuera;
                @endphp
                    FISCAL: <b class="tx-purple">{{ number_format($saldofiscal,2) }}</b><br>

                    POR FUERA: <b class="tx-purple">{{ number_format($saldoporfuera,2) }}</b><br>
              </td>

            </tr>
          </tbody>
        </table>

        @endcomponent
      </div>
    @endforeach
  </div>
@endcomponent

@endsection
