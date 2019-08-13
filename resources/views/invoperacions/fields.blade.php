@section('css')
<link href="{{asset('appzia/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">
<link href="{{asset('airdatepicker/dist/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">

@endsection
  <!-- Usuario Id Field -->
  <div class="form-group">
      {!! Form::label('usu', 'Usuario:') !!}
      {!! Form::text('usu', Auth::user()->name, ['class' => 'form-control', 'readonly']) !!}
      {!! Form::hidden('usuario_id', Auth::user()->id)!!}
  </div>

  <!-- Tipo Mov Field -->
  <div class="form-group">
      {!! Form::label('tipo_mov', 'Tipo de Operación:') !!}
      {!! Form::select('tipo_mov', ['Entrada'=>'Entrada','Salida'=>'Salida'],null, ['class' => 'form-control', 'required']) !!}
  </div>

  <!-- Proveedor Id Field -->
  <div class="form-group">
      {!! Form::label('proveedor_id', 'Proveedor:') !!}
      {!! Form::select('proveedor_id', $proveedores, null, ['class' => 'form-control', 'required']) !!}
  </div>

  <!-- Cliente Id Field -->
  <div class="form-group">
      {!! Form::label('cliente_id', 'Cliente:') !!}
      {!! Form::select('cliente_id', $clientes, null, ['class' => 'form-control', 'required', 'placeholder'=>'Seleccione un cliente']) !!}
  </div>

  <!-- Monto Field -->
  <div class="form-group">
      {!! Form::label('total', 'Total:') !!}
      {!! Form::number('total', null, ['class' => 'form-control', 'readonly']) !!}
  </div>

  <!-- Fecha Field -->
  <div class="form-group">
      {!! Form::label('fecha', 'Fecha:') !!}
      {!! Form::text('fecha', date('Y-m-d'), ['class' => 'form-control datepicker-here', 'required','id'=>'finicio', 'data-language'=>'es', 'data-date-format'=>'yyyy-mm-dd', 'pattern'=>'(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))']) !!}
  </div>


  <!-- Submit Field -->
  <div class="form-group col-sm-12">
      {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
      <a href="{!! route('invoperacions.index') !!}" class="btn btn-secondary">Cancelar</a>
  </div>

  @section('scripts')
  <script src="{{asset('appzia/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('airdatepicker/dist/js/datepicker.min.js')}}"></script>
  <script src="{{asset('airdatepicker/dist/js/i18n/datepicker.es.js')}}"></script>
  <script>
       //Bootstrap-MaxLength
          $('.maxlen').maxlength();
          $(function () {
            $('[data-toggle="popover"]').popover()
          })
  </script>

  @endsection
