@section('css')

        <link href="{{asset('airdatepicker/dist/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">

@endsection
Operaciones por mes

  <div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">

      @foreach($toperacionesg as $key=>$mensual)
            <div class="card">
              <div class="card-header" role="tab" id="heading{{$key}}">
                <h6 class="mg-b-0">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed">
                    {{$mensual->mesanio}} : {{number_format($mensual->montog,2)}}
                  </a>
                </h6>
              </div><!-- card-header -->

              <div id="collapse{{$key}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$key}}" style="">
                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Tipo</th>
                        <th>Concepto</th>
                        <th>Monto</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($lasoperaciones->where('fechag', $mensual->fechag) as $operacion)
                      <tr>
                        <td>{{$operacion->id}}</td>
                        <td>{{$operacion->tipo}}</td>
                        <td><a href="{{url('operaciones/'.$operacion->id)}}" target="_blank">{{$operacion->concepto}}</a></td>
                        <td>{{number_format($operacion->monto,2)}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            @endforeach


          </div>


        <div class="d-flex align-items-center justify-content-center bg-gray-100 ht-md-80 bd pd-x-20">
          {!! Form::open(['url'=>'operaciones/proveedor']) !!}
            <div class="d-md-flex pd-y-20 pd-md-y-0">

              {!! Form::text('daterange', null, ['class'=>'form-control datepicker-here', 'id'=>'rangoFechas','required', 'data-language'=>'es', 'data-range'=>'true', 'data-multiple-dates-separator'=>' : ', 'data-date-format'=>'yyyy-mm-dd', 'pattern'=>'.{23}', 'title'=>'Rango de Fechas', 'placeholder'=>'ejemplo: 2019-09-10 : 2019-09-30' ])!!}

              {!! Form::hidden('proveedor_id', $proveedores->id)!!}
              {!! Form::button('Reporte en Excel', ['class'=>'btn btn-primary', 'type'=>'submit']) !!}

            </div>
            {!! Form::close() !!}
          </div>

          @section('scripts')
          <script src="{{asset('airdatepicker/dist/js/datepicker.min.js')}}"></script>
          <script src="{{asset('airdatepicker/dist/js/i18n/datepicker.es.js')}}"></script>

          @endsection
