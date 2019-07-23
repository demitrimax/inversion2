<div class="col-lg-12">
    <div class="panel panel-color panel-info">
        <div class="card-header card-header-default">
            <h3 class="card-title">Corrida Financiera</h3>
        </div>
        <div class="card-body">

           <table class="table table-striped table-bordered detail-view" id="corrida-table">
           	<thead>
           		<tr>
           			<th>Num</th>
                <th>Año</th>
                <th>Sdo. Capital</th>
           			<th>Pago Capital</th>
           			<th>P. Intereses</th>
           			<th>Monto de Pago</th>
           			<th>Sdo. Capital</th>
           			<th>No. Pago</th>
                <th>Fecha</th>
                <th>Estatus</th>
           		</tr>
           	</thead>
              <tbody>
              @php
              $numpagos = $creditos->finicio->diffInMonths($creditos->ftermino)+1;
              @endphp

          @if($creditos->corridas->count()==$numpagos)
            @foreach($creditos->corridas as $key=>$corrida)
            <tr class="text-center">
              <td>{{$key+1}}</td>
              <td>{{$corrida->anio}}</td>
              <td>{{ number_format($corrida->sdocapital,2) }}</td>
              <td>{{ number_format($corrida->pagcapital,2) }}</td>
              <td>{{ number_format($corrida->pintereses,2) }}</td>
              <td>{{ number_format($corrida->mpago,2) }}</td>
              <td>{{ number_format($corrida->saldocapital,2) }}</td>
              <td>{{$corrida->numpago}}</td>
              <td>{{$corrida->fecha->format('d-m-Y')}}</td>
              <td>{!! $corrida->pagado_at ? '<span class="badge badge-info">PAGADO</span>' : '<span class="badge badge-warning">Pendiente</span>' !!}</td>
            </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th></th>
                <th></th>
                <th></th>
                <th>Total Intereses</th>
                <th>{{ number_format($creditos->corridas->sum('pintereses'),2)}}</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </tfoot>
          </table>
          @else
              	@php
					$primerpagfecha = $creditos->finicio;
					$ultimopagfecha = $creditos->ftermino;
          $meseslibres = $creditos->meseslibres;
					$linea = 0;
					$monto = $creditos->monto_inicial;
					$tasa = $creditos->tasainteres;
          $tasamensual = ($tasa/12);
					$numdias = $creditos->finicio->diffInDays($creditos->ftermino);
          $anios =  $creditos->finicio->diffInYears($creditos->ftermino);
					$numpagos = $creditos->finicio->diffInMonths($creditos->ftermino)+1;
					//echo $numpagos;
          //cantidad final con el interes de la tasa
          $montofinal = $monto * (($tasa/100)+1);
					$pagofijo = $monto / ($numpagos - $creditos->meseslibres);
          $saldocapital = $monto;
					$interesi = $pagofijo*($tasamensual);
					$interes = 0;
					$total = 0;
          $line = 0;

          function pagointe( $rt, $pv, $Tn, $n)
          {
            //Tasa de Interes mensual $rt = $tasainteres /12
            //Cantidad de Coutas $Tn
            // Valor Presente $pv
            // couta a calcular $n
            $rt = $rt/100;
            //$pagointeres = ($pv * $rt * (($rt+1) ** ($Tn+1) - ($rt+1) ** $n )) / (( $rt+1 )*( (( $rt+1 ) ** $Tn) - 1));
            $pagointeres =($pv*$rt*(($rt + 1)**($Tn + 1) - ($rt + 1)**$n)) / (($rt + 1)* (($rt + 1)**$Tn - 1));
            return $pagointeres;
          }
              	@endphp

              	@for($i = $primerpagfecha; $i <= $ultimopagfecha; $i->addMonth() )
              	<tr>
                        		<td>{{$linea+=1}}</td>
                        		<td>{{ $creditos->finicio->diffInYears($i)+1 }}</td>
                            <td>{{ number_format($saldocapital,2) }}</td>
    <!-- pago capital-->    <td>{{ ($linea) > $meseslibres ? number_format($pcapital = $pagofijo ,2) : $pcapital=0 }}</td>
    <!-- pago interes-->    <td>{{ number_format($pinteres = pagointe($tasamensual, $saldocapital, $numpagos, $line+1) ,2) }}</td>
    <!-- monto de pago-->   <td>{{ number_format($mpago = $pcapital+$pinteres,2) }}</td>
   <!-- saldo capital-->    <td>{{ number_format($saldocapital = ($saldocapital+$pinteres) - $mpago,2) }}</td>
  <!-- No de pago-->        <td>{{ ($linea) > $meseslibres ? $line = $linea - $creditos->meseslibres : $line = 0 }}</td>
                            <td>{{$i->format('d-m-Y')}}</td>
                            <td><span class="badge badge-secondary tx-white">Temporal</span></td>
              	</tr>
              	@endfor

              </tbody>
          </table>

          <a href="{!! route('CorridaFinanciera.create', [$creditos->id]) !!}" class='btn btn-info'><i class="ion ion-help-buoy"></i> Crear Corrida Financiera</a>
          @endif

        </div>
    </div>
</div>
