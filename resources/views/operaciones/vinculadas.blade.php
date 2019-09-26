<h5>Operaciones Vinculadas</h5>
<table class="table table-bordered table-hover table-primary">
  <thead>
    <tr>
      <th>Núm</th>
      <th>Categoria</th>
      <th>Concepto</th>
      <th>Monto</th>
      <th>Fecha</th>
    </tr>
  </thead>
  <tbody>
    @foreach($operaciones->comisionadas as $key=>$comisionada)
    <tr>
      <td>{{$key+1}}</td>
      <td><a href="{{url('operaciones/'.$comisionada->comisionada->id)}}">{{$comisionada->comisionada->subclasifica->clasifica->nombre.'|'.$comisionada->comisionada->subclasifica->nombre}}</a></td>
      <td>{{$comisionada->comisionada->concepto}}</td>
      <td>{{ number_format($comisionada->comisionada->monto,2)}}</td>
      <td>{{ $comisionada->comisionada->fecha->format('d-m-Y') }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@can('operaciones-create')
<button class="btn btn-teal mg-b-10" data-toggle="modal" data-target="#operacionVinculada">Nueva Operación Vinculada</button>

          <div id="operacionVinculada" class="modal fade" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content tx-size-sm">
            <div class="modal-header pd-x-20">
              <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Nueva Operación Vinculada</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            {!! Form::open(['url' => 'operacion/comisionable/save']) !!}
            <div class="modal-body pd-20">
              <div class="row">

                <div class="form-group col-sm-6">
                    {!! Form::label('cuenta_id', 'Cuenta:') !!}
                    {!! Form::select('cuenta_id', $cuental, $operaciones->cuenta_id, ['class' => 'form-control', 'required', 'placeholder'=>'Seleccione']) !!}
                    {!! Form::hidden('empresa_id', $operaciones->empresa_id) !!}
                    {!! Form::hidden('tipo', 'Salida')!!}
                    {!! Form::hidden('operacion_origen', $operaciones->id)!!}
                </div>

                <div class="form-group col-sm-6">
                    {!! Form::label('fecha', 'Fecha: (yyyy-mm-dd)') !!}
                    {!! Form::text('fecha', null, ['placeholder'=>'yyyy-mm-dd','class' => 'form-control datepicker-input', 'required', 'data-language'=>'es', 'data-date-format'=>'yyyy-mm-dd', 'pattern'=>'(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))' ]) !!}
                </div>

                <div class="form-group col-sm-6">
                    {!! Form::label('proveedor_id', 'Proveedor:') !!}
                    {!! Form::select('proveedor_id', $proveedores, null, ['class' => 'form-control', 'required']) !!}
                </div>

                @php
                  $saldofinal = abs($operaciones->empresa->saldofinal);
                @endphp
                <div class="form-group col-sm-6">
                    {!! Form::label('monto', 'Monto:') !!}
                    {!! Form::number('monto', null, ['class' => 'form-control', 'required', 'step'=>'0.01', 'max'=>$saldofinal, 'min'=>0]) !!}

                </div>

                <div class="form-group col-sm-6">
                    {!! Form::label('metpago', 'Método de Pago:') !!}
                    {!! Form::select('metpago', $metpago, null, ['class' => 'form-control', 'required']) !!}
                </div>

                <div class="form-group col-sm-6">
                    {!! Form::label('subclasifica_id', 'Categoría:') !!}
                    {!! Form::select('subclasifica_id', $subcategoriasAgrupadas, null, ['class' => 'form-control select2', 'required', 'placeholder'=>'Seleccione', 'style'=>'width: 100%;']) !!}

                </div>
                <div class="form-group col-sm-12">
                    {!! Form::label('concepto', 'Concepto:') !!}
                    {!! Form::text('concepto', null, ['class' => 'form-control maxlen', 'required', 'maxlength'=>'50']) !!}
                </div>
              </div>


            </div><!-- modal-body -->
            <div class="modal-footer">
              <button type="submit" class="btn btn-info pd-x-20">Guardar Operación</button>
              <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Cerrar</button>
              {!! Form::close()!!}
            </div>
          </div>
          </div><!-- modal-dialog -->
          </div>

          @section('scripts')
          <script src="{{asset('starlight/lib/select2/js/select2.full.min.js')}}"></script>
          <script src="{{asset('starlight/lib/numeral.js/min/numeral.min.js')}}"></script>
          <script src="{{asset('appzia/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}" type="text/javascript"></script>
          <script src="{{asset('airdatepicker/dist/js/datepicker.min.js')}}"></script>
          <script src="{{asset('airdatepicker/dist/js/i18n/datepicker.es.js')}}"></script>
          <script>
          $(document).ready(function() {
              $('.select2').select2();
          });
          // Initialize datepicker and save its instance in `dp`
          var dp = $('.datepicker-input').datepicker().data('datepicker');

          // When just use method .selectDate(), to select desirable date.
          dp.selectDate(new Date()) // Will select current date;
          </script>
          @endsection

          @push('css')
          <!-- select 2-->
          <link href="{{asset('starlight/lib/select2/css/select2.min.css')}}" rel="stylesheet" />
          <link href="{{asset('appzia/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">
          <link href="{{asset('airdatepicker/dist/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">

          <style>
           .datepicker{z-index:9999 !important}

          </style>

          @endpush

@endcan
