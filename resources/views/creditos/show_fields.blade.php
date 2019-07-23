<div class="col-lg-6">
    <div class="panel panel-color panel-primary">
        <div class="card-header card-header-default">
            <h3 class="card-title">Datos del credito</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered detail-view" id="creditos-table">
              <tbody>

          <!-- Nombre Field -->
          <tr>
            <th>{!! Form::label('nombre', 'Nombre del proyecto:') !!}</th>
            <td>{!! $creditos->nombre !!}</td>
          </tr>


          <!-- Numero Field -->
          <tr>
            <th>{!! Form::label('numero', 'Número:') !!}</th>
            <td>{!! $creditos->numero !!}</td>
          </tr>


          <!-- Finicio Field -->
          <tr>
            <th>{!! Form::label('finicio', 'Fecha de inicio:') !!}</th>
            <td>{!! $creditos->finicio->format('d-m-Y') !!}</td>
          </tr>


          <!-- Ftermino Field -->
          <tr>
            <th>{!! Form::label('ftermino', 'Fecha de termino:') !!}</th>
            <td>{!! $creditos->ftermino->format('d-m-Y') !!}</td>
          </tr>


          <!-- Tasainteres Field -->
          <tr>
            <th>{!! Form::label('tasainteres', 'Tasa de interes:') !!}</th>
            <td>{!! $creditos->tasainteres !!}%</td>
          </tr>



          <!-- Diapago Field -->
          <tr>
            <th>{!! Form::label('diapago', 'Día de pago:') !!}</th>
            <td>{!! $creditos->diapago !!}</td>
          </tr>

          <!-- Diapago Field -->
          <tr>
            <th>{!! Form::label('meseslibres', 'Meses libres de pago:') !!}</th>
            <td>{!! $creditos->meseslibres !!}</td>
          </tr>


          <!-- Monto Inicial Field -->
          <tr>
            <th>{!! Form::label('monto_inicial', 'Monto Inicial:') !!}</th>
            <td>{!! number_format($creditos->monto_inicial,2) !!}</td>
          </tr>

          <!-- Monto FinalField -->
          <tr>
            <th>{!! Form::label('monto_final', 'Monto Final:') !!}</th>
            @php
            $monto = $creditos->monto_inicial;
            $tasa = $creditos->tasainteres;
            $tSalidas = 0;
            $tEntradas = 0;
            $numpagos = $creditos->finicio->diffInMonths($creditos->ftermino)+1;
            foreach($creditos->movcreditos as $movimiento)
            {
              $movimiento->tipo == 'Salida' ? $tSalidas += $movimiento->monto : 0;
              $movimiento->tipo == 'Entrada'? $tEntradas += $movimiento->monto : 0;
            }

            $tasamensual = ($tasa/12);
            $saldocapital = $monto;
            $numpagos = $creditos->finicio->diffInMonths($creditos->ftermino)+1;
            $pagofijo = $monto / ($numpagos - $creditos->meseslibres);
            $pinteres = 0;
            $meseslibres = $creditos->meseslibres;
            $totalinteres = 0;
              function pagoint( $rt, $pv, $Tn, $n)
              {
                //Tasa de Interes mensual $rt = $tasainteres /12
                //Cantidad de Coutas $Tn
                // Valor Presente $pv
                // couta a calcular $n
                $rt = $rt/100;
                $pagointeres =($pv*$rt*(($rt + 1)**($Tn + 1) - ($rt + 1)**$n)) / (($rt + 1)* (($rt + 1)**$Tn - 1));
                return $pagointeres;
              }
            for ($i = 1; $i <= $numpagos; $i++){
              $i > $meseslibres ? $pcapital = $pagofijo : $pcapital=0;
              $pinteres = $saldocapital*($tasamensual/100);
              $mpago = $pcapital+$pinteres;
              $saldocapital = ($saldocapital+$pinteres) -$mpago;
              $totalinteres += $pinteres;
            }
            $saldofinal = $monto - ($tSalidas + $tEntradas);
            $montofinal = $monto + $totalinteres;
            @endphp
            <td>{!! number_format($montofinal,2) !!}</td>
          </tr>


          <!-- Saldo al día Field -->
          <tr>
            <th>{!! Form::label('saldo_dia', 'Saldo al día:') !!}</th>
            <td>{!! number_format($saldofinal,2) !!}</td>
          </tr>


          <!-- Fapertura Field -->
          <tr>
            <th>{!! Form::label('fapertura', 'Fecha de apertura:') !!}</th>
            <td>{!! $creditos->fapertura->format('d-m-Y') !!}</td>
          </tr>


          <!-- Diascalculo Field -->
          <tr>
            <th>{!! Form::label('diascalculo', 'Días de calculo:') !!}</th>
            <td>{!! $creditos->diascalculo !!} </td>
          </tr>

          <!-- Meses del periodo o pagos-->
          @php
          $meses = $creditos->finicio->diffInMonths($creditos->ftermino)+1;
          @endphp
          <tr>
            <th>{!! Form::label('meses', 'Plazo:') !!}</th>
            <td>{!! $meses !!} meses</td>
          </tr>

          <tr>
            <th>{!! Form::label('empresa', 'Empresa responsable del credito:') !!}</th>
            <td>{!! $creditos->empresa->nombre !!} </td>
          </tr>


            </tbody>
          </table>
          @can('creditos-edit')
          <a href="{!! route('creditos.edit', [$creditos->id]) !!}" class='btn btn-primary'><i class="fa fa-pencil"></i> Editar</a>
          @endcan
        </div>
    </div>
</div>
