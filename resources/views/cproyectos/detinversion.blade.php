<div class="col-xl-12 mg-t-25 mg-xl-t-0">
  <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Detalle de las Inversiones</h6>
    <p class="mg-b-30 tx-gray-600">Listado por detalle de cada una de las inversiones.</p>

    <div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">
      @foreach($cproyectos->inversiones->sortBy('fecha') as $key=>$inversion)
          <div class="card">
            <div class="card-header" role="tab" id="heading{{$key}}">
              <h6 class="mg-b-0">
                <a class="tx-gray-800 transition collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}" aria-expanded="false" aria-controls="collapse{{$key}}">
                  Monto: {{ number_format($inversion->monto,2).$inversion->cuenta->divisa }}
                </a>
              </h6>
            </div><!-- card-header -->

            <div id="collapse{{$key}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$key}}" style="">
              <div class="card-body">
                Tasa de Interés segun credito : {{ $tasaint = $inversion->cuenta->creditos->sum('tasainteres') }} <br>
                Tasa de Interes propia: {{ number_format($inversion->tinteres,2).'%'}}

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
                   $factual = date('Y-m-d');
                   $numpagos = $inversion->fecha->diffInMonths($factual)+1;
           					$primerpagfecha = $inversion->fecha;
           					$ultimopagfecha = $factual;
           					$linea = 0;
           					$monto = $inversion->monto;
           					$tasa = $inversion->tinteres + $tasaint;
                    $tasamensual = ($tasa/12);
           					$numdias = $inversion->fecha->diffInDays($factual);
                    $anios =  $inversion->fecha->diffInYears($factual);
           				  $numpagos = $inversion->fecha->diffInMonths($factual)+1;
           					//echo $numpagos;
                    //cantidad final con el interes de la tasa
                    $montofinal = $monto * (($tasa/100)+1);
           					$pagofijo = $monto / ($numpagos);
                    $saldocapital = $monto;
           					$interesi = $pagofijo*($tasamensual);
           					$interes = 0;
           					$total = 0;
                    $line = 0;
                    $tpinteres = 0;

                 	@endphp

                 	@for($i = $primerpagfecha; $i <= $ultimopagfecha; $i->addMonth() )
                 	<tr>
                           		<td>{{$linea+=1}}</td>
                           		<td>{{ $inversion->fecha->diffInYears($i)+1 }}</td>
                               <td>{{ number_format($saldocapital,2) }}</td>
       <!-- pago capital-->    <td>{{ number_format($pcapital = $pagofijo ,2) }}</td>
       <!-- pago interes-->    <td>{{ number_format($pinteres = App\Helpers\SomeClass::pagointeExcel($tasamensual, $saldocapital, $numpagos, $line+1) ,2) }}</td>
       <!-- monto de pago-->   @php $tpinteres += $pinteres; @endphp
                                <td>{{ number_format($mpago = $pcapital+$pinteres,2) }}</td>
      <!-- saldo capital-->    <td>{{ number_format($saldocapital = ($saldocapital+$pinteres) - $mpago,2) }}</td>
     <!-- No de pago-->        <td>{{ $line = $linea  }}</td>
                               <td>{{$i->format('d-m-Y')}}</td>
                               <td><span class="badge badge-secondary tx-white">Temporal</span></td>
                 	</tr>
                 	@endfor

                 </tbody>
                 <tfoot>
                   <tr>
                     <th></th>
                     <th></th>
                     <th></th>
                     <th>Total Interes:</th>
                     <th>${{ number_format($tpinteres,2)}}</th>
                     <th></th>
                     <th></th>
                     <th></th>
                     <th></th>
                     <th></th>
                   </tr>
                 </tfoot>
             </table>

              </div>
            </div>
          </div>
        @endforeach

          <!--
          <div class="card">
            <div class="card-header" role="tab" id="headingTwo">
              <h6 class="mg-b-0">
                <a class="transition collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Horizontal Navigation Menu Fold Animation
                </a>
              </h6>
            </div>
            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" style="">
              <div class="card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore.
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" role="tab" id="headingThree">
              <h6 class="mg-b-0">
                <a class="transition" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Creating CSS3 Button with Rounded Corners
                </a>
              </h6>
            </div>
            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" style="">
              <div class="card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore.
              </div>
            </div>--><!-- collapse -->
          </div><!-- card -->

        </div>

    <div class="row row-xs mg-t-30">
      <div class="col-sm-8 mg-l-auto">
        <div class="form-layout-footer">
          <!--
          <button class="btn btn-info mg-r-5">Submit Form</button>
          <button class="btn btn-secondary">Cancel</button>
        -->
        </div><!-- form-layout-footer -->
      </div><!-- col-8 -->
    </div>
  </div><!-- card -->
</div><!-- col-6 -->
