<div class="card pd-20 pd-sm-40">

  <h6 class="card-body-title">Pedido ID: {!! $invoperacion->id !!}</h6>
  <p class="mg-b-20 mg-sm-b-30"> Tipo de Movimiento: {{$invoperacion->tipo_mov}}</p>

  <div class="row">
    @if($invoperacion->proveedor_id)
    <label class="col-sm-4 form-control-label">{!! Form::label('proveedor_id', 'Proveedor:') !!} <span class="tx-danger">*</span></label>
    <div class="col-sm-4 mg-t-10 mg-sm-t-0">
      {!! $invoperacion->proveedor->nombre !!}
    </div>
      @endif
    <div class="col-sm-4 pull-right">
        {!! $invoperacion->fecha->format('d-m-Y') !!}
    </div>
  </div><!-- row -->

  <div class="row mg-t-20">
    <label class="col-sm-4 form-control-label">Lastname: <span class="tx-danger">*</span></label>
    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
      <input type="text" class="form-control" placeholder="Enter lastname">
    </div>
  </div>
  <div class="row mg-t-20">
    <label class="col-sm-4 form-control-label">Email: <span class="tx-danger">*</span></label>
    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
      <input type="text" class="form-control" placeholder="Enter email address">
    </div>
  </div>
  <div class="row mg-t-20">
    <label class="col-sm-4 form-control-label">Address: <span class="tx-danger">*</span></label>
    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
      <textarea rows="2" class="form-control" placeholder="Enter your address"></textarea>
    </div>
  </div>

</div>
