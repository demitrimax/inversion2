@extends('layouts.appv2')

@section('title',config('app.name').' | Panel de Control' )

@section('breadcrum')
<nav class="breadcrumb sl-breadcrumb">
  <a class="breadcrumb-item" href="{{url('/')}}">Principal</a>
  <span class="breadcrumb-item active">Dashboard</span>
</nav>
@endsection

@section('content')

    <div class="sl-pagebody">

        <div class="row row-sm">
          <div class="col-sm-6 col-xl-3">
            <div class="card pd-20 bg-primary">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Pagos de Hoy</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-stats"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2"><canvas width="59" height="50" style="display: inline-block; width: 59px; height: 50px; vertical-align: top;"></canvas></span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">${{number_format($pagoshoy,2)}}</h3>
              </div><!-- card-body -->
              <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                <div>
                  <span class="tx-11 tx-white-6">Pag. Creditos</span>
                  <h6 class="tx-white mg-b-0">$2,210</h6>
                </div>
                <div>
                  <span class="tx-11 tx-white-6">Pag. Opera</span>
                  <h6 class="tx-white mg-b-0">$320</h6>
                </div>
              </div><!-- -->
            </div><!-- card -->
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
            <div class="card pd-20 bg-info">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">INGRESOS DE HOY</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2"><canvas width="59" height="50" style="display: inline-block; width: 59px; height: 50px; vertical-align: top;"></canvas></span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">$4,625</h3>
              </div><!-- card-body -->
              <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                <div>
                  <span class="tx-11 tx-white-6">Gross Sales</span>
                  <h6 class="tx-white mg-b-0">$2,210</h6>
                </div>
                <div>
                  <span class="tx-11 tx-white-6">Tax Return</span>
                  <h6 class="tx-white mg-b-0">$320</h6>
                </div>
              </div><!-- -->
            </div><!-- card -->
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-purple">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">PAGOS PENDIENTES ESTE MES</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2"><canvas width="59" height="50" style="display: inline-block; width: 59px; height: 50px; vertical-align: top;"></canvas></span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">${{ number_format($pagopend,2)}}</h3>
              </div><!-- card-body -->
              <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                <div>
                  <span class="tx-11 tx-white-6">Intereses</span>
                  <h6 class="tx-white mg-b-0">${{number_format($intereses,2)}}</h6>
                </div>
                <div>
                  <span class="tx-11 tx-white-6">Tax Return</span>
                  <h6 class="tx-white mg-b-0">$320</h6>
                </div>
              </div><!-- -->
            </div><!-- card -->
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-sl-primary">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">TOTAL PAGOS PENDIENTES</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                <span class="sparkline2"><canvas width="59" height="50" style="display: inline-block; width: 59px; height: 50px; vertical-align: top;"></canvas></span>
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">${{number_format($totalpagopend,2) }}</h3>
              </div><!-- card-body -->
              <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                <div>
                  <span class="tx-11 tx-white-6">Intereses</span>
                  <h6 class="tx-white mg-b-0">${{number_format($totalinteres,2)}}</h6>
                </div>
                <div>
                  <span class="tx-11 tx-white-6">Tax Return</span>
                  <h6 class="tx-white mg-b-0">$320</h6>
                </div>
              </div><!-- -->
            </div><!-- card -->
          </div><!-- col-3 -->
        </div><!-- row -->

        <div class="row row-sm mg-t-20">
          <div class="col-xl-8">
            <div class="card overflow-hidden">
              <div class="card-header bg-transparent pd-y-20 d-sm-flex align-items-center justify-content-between">
                <div class="mg-b-20 mg-sm-b-0">
                  <h6 class="card-title mg-b-5 tx-13 tx-uppercase tx-bold tx-spacing-1">Profile Statistics</h6>
                  <span class="d-block tx-12">October 23, 2017</span>
                </div>
                <div class="btn-group" role="group" aria-label="Basic example">
                  <a href="#" class="btn btn-secondary tx-12 active">Today</a>
                  <a href="#" class="btn btn-secondary tx-12">This Week</a>
                  <a href="#" class="btn btn-secondary tx-12">This Month</a>
                </div>
              </div><!-- card-header -->
              <div class="card-body pd-0 bd-color-gray-lighter">
                <div class="row no-gutters tx-center">
                  <div class="col-12 col-sm-4 pd-y-20 tx-left">
                    <p class="pd-l-20 tx-12 lh-8 mg-b-0">Note: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula...</p>
                  </div><!-- col-4 -->
                  <div class="col-6 col-sm-2 pd-y-20">
                    <h4 class="tx-inverse tx-lato tx-bold mg-b-5">6,112</h4>
                    <p class="tx-11 mg-b-0 tx-uppercase">Views</p>
                  </div><!-- col-2 -->
                  <div class="col-6 col-sm-2 pd-y-20 bd-l">
                    <h4 class="tx-inverse tx-lato tx-bold mg-b-5">102</h4>
                    <p class="tx-11 mg-b-0 tx-uppercase">Likes</p>
                  </div><!-- col-2 -->
                  <div class="col-6 col-sm-2 pd-y-20 bd-l">
                    <h4 class="tx-inverse tx-lato tx-bold mg-b-5">343</h4>
                    <p class="tx-11 mg-b-0 tx-uppercase">Comments</p>
                  </div><!-- col-2 -->
                  <div class="col-6 col-sm-2 pd-y-20 bd-l">
                    <h4 class="tx-inverse tx-lato tx-bold mg-b-5">960</h4>
                    <p class="tx-11 mg-b-0 tx-uppercase">Shares</p>
                  </div><!-- col-2 -->
                </div><!-- row -->
              </div><!-- card-body -->
              <div class="card-body pd-0">
                <div id="rickshaw2" class="wd-100p ht-200 rickshaw_graph"><svg width="755" height="200"><g><path d="M0,39.99999999999999Q50.333333333333336,3.46666666666667,58.07692307692308,4.0000000000000036C69.6923076923077,4.800000000000004,104.53846153846155,40.400000000000006,116.15384615384616,48S162.6153846153846,77.6,174.23076923076923,80S220.6923076923077,76,232.30769230769232,72S278.76923076923083,35.199999999999996,290.3846153846154,39.99999999999999S336.84615384615387,108,348.46153846153845,120S394.9230769230769,160,406.53846153846155,160S453,126,464.61538461538464,120S511.0769230769231,106,522.6923076923077,100S569.1538461538462,58.00000000000001,580.7692307692308,60.00000000000001S627.2307692307692,122,638.8461538461538,120S685.3076923076923,41.99999999999999,696.9230769230769,39.99999999999999Q704.6666666666666,38.66666666666666,755,100L755,150Q704.6666666666666,119.33333333333333,696.9230769230769,120C685.3076923076923,121,650.4615384615385,159,638.8461538461538,160S592.3846153846155,131,580.7692307692308,130S534.3076923076924,147,522.6923076923077,150S476.2307692307693,157,464.61538461538464,160S418.1538461538462,180,406.53846153846155,180S360.07692307692304,166,348.46153846153845,160S302,122.4,290.3846153846154,120S243.92307692307693,134,232.30769230769232,136S185.84615384615384,141.2,174.23076923076923,140S127.76923076923077,127.8,116.15384615384616,124S69.6923076923077,102.4,58.07692307692308,102Q50.333333333333336,101.73333333333333,0,120Z" class="area" fill="#73a9e7"></path></g><g><path d="M0,120Q50.333333333333336,101.73333333333333,58.07692307692308,102C69.6923076923077,102.4,104.53846153846155,120.2,116.15384615384616,124S162.6153846153846,138.8,174.23076923076923,140S220.6923076923077,138,232.30769230769232,136S278.76923076923083,117.6,290.3846153846154,120S336.84615384615387,154,348.46153846153845,160S394.9230769230769,180,406.53846153846155,180S453,163,464.61538461538464,160S511.0769230769231,153,522.6923076923077,150S569.1538461538462,129,580.7692307692308,130S627.2307692307692,161,638.8461538461538,160S685.3076923076923,121,696.9230769230769,120Q704.6666666666666,119.33333333333333,755,150L755,200Q704.6666666666666,200,696.9230769230769,200C685.3076923076923,200,650.4615384615385,200,638.8461538461538,200S592.3846153846155,200,580.7692307692308,200S534.3076923076924,200,522.6923076923077,200S476.2307692307693,200,464.61538461538464,200S418.1538461538462,200,406.53846153846155,200S360.07692307692304,200,348.46153846153845,200S302,200,290.3846153846154,200S243.92307692307693,200,232.30769230769232,200S185.84615384615384,200,174.23076923076923,200S127.76923076923077,200,116.15384615384616,200S69.6923076923077,200,58.07692307692308,200Q50.333333333333336,200,0,200Z" class="area" fill="#2B333E"></path></g></svg></div>
              </div><!-- card-body -->
            </div><!-- card -->

            <div class="card pd-20 pd-sm-25 mg-t-20"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
              <h6 class="card-body-title tx-13">Horizontal Bar Chart</h6>
              <p class="mg-b-20 mg-sm-b-30">A bar chart or bar graph is a chart with rectangular bars with lengths proportional to the values that they represent.</p>
              <canvas id="chartBar4" height="348" width="819" class="chartjs-render-monitor" style="display: block; width: 819px; height: 348px;"></canvas>
            </div><!-- card -->

          </div><!-- col-8 -->
          <div class="col-xl-4 mg-t-20 mg-xl-t-0">

            <div class="card pd-20 pd-sm-25">
              <h6 class="card-body-title">Distribución</h6>
              <p class="mg-b-20 mg-sm-b-30">El dinero que actualmente tiene cada proyecto</p>
              <div id="flotPie2" class="ht-200 ht-sm-250" style="padding: 0px; position: relative;"><canvas class="flot-base" width="819" height="250" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 819px; height: 250px;"></canvas><canvas class="flot-overlay" width="819" height="250" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 819px; height: 250px;"></canvas><span class="pieLabel" id="pieLabel1" style="position: absolute; top: 37px; left: 433px;"><div style="font-size:8pt; text-align:center; padding:2px; color:white;">Series 2<br>11%</div></span><span class="pieLabel" id="pieLabel2" style="position: absolute; top: 136px; left: 468px;"><div style="font-size:8pt; text-align:center; padding:2px; color:white;">Series 3<br>32%</div></span><span class="pieLabel" id="pieLabel3" style="position: absolute; top: 179px; left: 345px;"><div style="font-size:8pt; text-align:center; padding:2px; color:white;">Series 4<br>25%</div></span><span class="pieLabel" id="pieLabel4" style="position: absolute; top: 56px; left: 324px;"><div style="font-size:8pt; text-align:center; padding:2px; color:white;">Series 5<br>29%</div></span></div>
            </div><!-- card -->

            <div class="card widget-messages mg-t-20">
              <div class="card-header">
                <span>Messages</span>
                <a href=""><i class="icon ion-more"></i></a>
              </div><!-- card-header -->
              <div class="list-group list-group-flush">
                <a href="" class="list-group-item list-group-item-action media">
                  <img src="{{asset('starlight/img/img10.jpg')}}" alt="">
                  <div class="media-body">
                    <div class="msg-top">
                      <span>Mienard B. Lumaad</span>
                      <span>4:09am</span>
                    </div>
                    <p class="msg-summary">Many desktop publishing packages and web page editors now use...</p>
                  </div><!-- media-body -->
                </a><!-- list-group-item -->
                <a href="" class="list-group-item list-group-item-action media">
                  <img src="{{asset('starlight/img/img9.jpg')}}" alt="">
                  <div class="media-body">
                    <div class="msg-top">
                      <span>Isidore Dilao</span>
                      <span>Yesterday 3:00am</span>
                    </div>
                    <p class="msg-summary">On the other hand, we denounce with righteous indignation and dislike...</p>
                  </div><!-- media-body -->
                </a><!-- list-group-item -->
                <a href="" class="list-group-item list-group-item-action media">
                  <img src="{{asset('starlight/img/img8.jpg')}}" alt="">
                  <div class="media-body">
                    <div class="msg-top">
                      <span>Kirby Avendula</span>
                      <span>Yesterday 3:00am</span>
                    </div>
                    <p class="msg-summary">It is a long established fact that a reader will be distracted by the readable...</p>
                  </div><!-- media-body -->
                </a><!-- list-group-item -->
                <a href="" class="list-group-item list-group-item-action media">
                  <img src="{{asset('starlight/img/img7.jpg')}}" alt="">
                  <div class="media-body">
                    <div class="msg-top">
                      <span>Roven Galeon</span>
                      <span>Yesterday 3:00am</span>
                    </div>
                    <p class="msg-summary">Than the fact that climate change may be causing it to rapidly disappear... </p>
                  </div><!-- media-body -->
                </a><!-- list-group-item -->
              </div><!-- list-group -->
              <div class="card-footer">
                <a href="" class="tx-12"><i class="fa fa-angle-down mg-r-3"></i> Load more messages</a>
              </div><!-- card-footer -->
            </div><!-- card -->
          </div><!-- col-3 -->
        </div><!-- row -->

      </div>

@endsection

@section('scripts')

<script src="{{asset('starlight/js/dashboard.js')}}"></script>
//script del barchar
<script>
$(function(){
  'use strict';
  @php
  $colores = [
  '#677489',
  '#218bc2',
  '#7CBDDF',
  '#5B93D3',
  '#324463',
];
  @endphp
    var piedata = [
      @foreach($business as $key=>$empresa)
      { label: "{{$empresa->nombre}}", data: [[1,{{$empresa->saldoaldia}}]], color: '{{$colores[$key]}}'},
      @endforeach
    ];


    $.plot('#flotPie2', piedata, {
      series: {
        pie: {
          show: true,
          radius: 1,
          innerRadius: 0.5,
          label: {
            show: true,
            radius: 2/3,
            formatter: labelFormatter,
            threshold: 0.1
          }
        }
      },
      grid: {
        hoverable: true,
        clickable: true
      },
      legend: { show: false }
    });

    function labelFormatter(label, series) {
      return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
    }
  });
</script>
@endsection
