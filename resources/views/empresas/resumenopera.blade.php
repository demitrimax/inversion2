
@push('css')

<link rel="stylesheet" type="text/css" href="{{asset('table_fixed_header/vendor/select2/select2.min.css')}}">
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
                    @php
                      $catunicas = '';

                    @endphp

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
                        <td class="pull-right"><a href="{{route('detalle.categoria', [$empresas->id, $operacion->fechag, $operacion->subclasifica_id])}}">{{number_format($operacion->montog)}} </a></td>
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

	<script src="{{asset('table_fixed_header/vendor/select2/select2.min.js')}}"></script>

@endpush
