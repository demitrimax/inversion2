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
                    {{ $fechas->fechag }}
                </a>
              </h6>
            </div><!-- card-header -->

            <div id="collapse{{$key}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$key}}" style="">
              <div class="card-body">

                Monto total del Mes: {{ number_format($toperacionesg->where('fechag',$fechas->fechag)->sum('monto'))}}

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


        @endforeach


          </div><!-- card -->

        </div>

  </div><!-- card -->
</div>
