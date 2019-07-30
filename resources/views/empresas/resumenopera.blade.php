
@push('css')

<link rel="stylesheet" type="text/css" href="{{asset('table_fixed_headers/vendor/animate/animate.css')}}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('table_fixed_headers/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('table_fixed_headers/vendor/perfect-scrollbar/perfect-scrollbar.css')}}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('table_fixed_headers/css/util.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('table_fixed_headers/css/main.css')}}">
<!--===============================================================================================-->
@endpush

<div class="col-xl-12 mg-t-25 mg-xl-t-0">
  <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">OPERACIONES AGRUPADAS</h6>
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

                Monto total del Mes: {{ number_format($toperacionesg->where('fechag',$fechas->fechag)->sum('montog'))}}

                <table id='subclasifica' class="table">
                  <thead>
                      <tr>
                        <th>Categoria</th>
                        <th>Subcategoria</th>
                        <th>Monto</th>
                      </tr>
                  </thead>

                  <tbody>

                    @foreach($toperacionesg->where('fechag',$fechas->fechag)->sortBy('subclasifica.clasifica.nombre') as $key=>$operacion)

                      <tr>
                        <td>{{$operacion->subclasifica->clasifica->nombre}}</td>
                        <td>{{$operacion->subclasifica->nombre}} </td>
                        <td class="pull-right">{{number_format($operacion->montog)}} </td>
                      </tr>

                    @endforeach
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

	<script src="{{asset('table_fixed_headers/vendor/select2/select2.min.js')}}"></script>

	<script>
		$('.js-pscroll').each(function(){
			var ps = new PerfectScrollbar(this);

			$(window).on('resize', function(){
				ps.update();
			})
		});


	</script>
<!--===============================================================================================-->
	<script src="{{asset('table_fixed_headers/js/main.js')}}"></script>

@endpush
