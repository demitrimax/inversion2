
@push('css')

<link rel="stylesheet" type="text/css" href="{{asset('table_fixed_header/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->

@endpush

<div class="col-xl-12 mg-t-25 mg-xl-t-0">
  <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">OPERACIONES AGRUPADAS {{date('Y')}}</h6>
    <p class="mg-b-30 tx-gray-600">Resumen de las operaciones agrupadas por categorias.</p>

    <div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">
      @php
        $summonto = 0;
      @endphp
      @foreach($fechasopg as $key=>$fechas)

          <div class="card">
            <div class="card-header" role="tab" id="heading{{$key}}">
              <h6 class="mg-b-0">
                <a class="tx-gray-800 transition collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}" aria-expanded="false" aria-controls="collapse{{$key}}">
                    {{ strtoupper($fechas->mesanio) }}
                </a>
              </h6>
            </div><!-- card-header -->

            <div id="collapse{{$key}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$key}}" style="">
              <div class="card-body">


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

                    @foreach($toperacionesg->where('fechag',$fechas->fechag) as $key=>$operacion)

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
                        <td class="pull-right"><a href="{{route('detalle.categoria', [$empresas->id, $operacion->fechag, $operacion->subclasifica_id])}}" target="_blank">{{number_format($operacion->montog)}} </a></td>
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


            </div>
          </div>





          </div><!-- card -->
                  @endforeach
        </div>

  </div><!-- card -->
</div>

@push('scripts')

	<script src="{{asset('table_fixed_header/vendor/select2/select2.min.js')}}"></script>

@endpush
