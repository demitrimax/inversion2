<div class="col-xl-6 mg-t-25 mg-xl-t-0">
  <div class="card pd-20 pd-sm-40"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
    <h6 class="card-body-title">COMPORTAMIENTO DE LAS Inversiones</h6>
    <p class="mg-b-20 mg-sm-b-30">En esta grafica podras ver como se comportan las inversiones a este proyecto.</p>
    <canvas id="chartBar2" height="445" width="715" class="chartjs-render-monitor" style="display: block; width: 715px; height: 445px;"></canvas>
  </div><!-- card -->
</div>

@section('scripts')
<script>
@php
  $pares =    array(0,2,4,6,8,10,12,14,16,18,20);
  $impares =  array(1,3,5,7,9,11,13,15,17,19,21);
  $cont = 0;
  $fechas = [];
  $inver = [];

    foreach($cproyectos->inversiones->sortBy('fecha') as $key=>$inversion){
        $cont++;
        $inver[] = $inversion->monto;
        $pagos[] = '['.$impares[$cont].',0]';
        $fechas[] = "'".$inversion->fecha->format('M-y')."'";
    }
    //dd($fechas);
@endphp
$(function(){
  'use strict';

  var ctx2 = document.getElementById('chartBar2').getContext('2d');
  var myChart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: [ {!! implode(',',$fechas) !!} ],
      datasets: [{
        label: '$',
        data: [ {{implode(',',$inver)}} ],
        backgroundColor: [
          '#5B93D3',
          '#324463',
          '#677489',
          '#218bc2',
          '#7CBDDF'
        ]
      }]
    },
    options: {
      legend: {
        display: false,
          labels: {
            display: false
          }
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero:true,
            fontSize: 10,
          }
        }],
        xAxes: [{
          ticks: {
            beginAtZero:true,
            fontSize: 11
          }
        }]
      }
    }
  });





});
</script>
@endsection
