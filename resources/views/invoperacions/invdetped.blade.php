<div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Operación ID: {!! $invoperacion->folio !!}</h6>
          <p class="mg-b-20 mg-sm-b-30">Tipo de Operación: {!! $invoperacion->tipo_mov !!} ({!! $invoperacion->estatusg !!})</p>

          <div class="form-layout">
            <div class="row mg-b-25">

            @if($invoperacion->proveedor_id)
              <div class="col-md-4">
                  {!! Form::label('proveedor_id', 'Proveedor:') !!}
                  {!! Form::text('proveedor', $invoperacion->proveedor->nombre, ['class'=>'form-control', 'readonly']) !!}
              </div><!-- col-4 -->
              @endif
              @if($invoperacion->cliente_id)
              <div class="col-md-4">
                  {!! Form::label('cliente', 'Cliente:') !!}
                  {!! Form::text('cliente', $invoperacion->cliente_id, ['class'=>'form-control', 'readonly']) !!}
              </div><!-- col-4 -->
              @endif
              <div class="col-md-2">
                  {!! Form::label('fecha', 'Fecha:') !!}
                  {!! Form::text('fecha', $invoperacion->fecha->format('d-m-Y'), ['class'=>'form-control text-right', 'readonly']) !!}
              </div><!-- col-4 -->

              <div class="col-md-6">
                  {!! Form::label('facturar_a', 'Cliente:') !!}
                  {!! Form::text('facturar_a', $invoperacion->facturar_a, ['class'=>'form-control', 'readonly']) !!}
              </div><!-- col-4 -->


            </div><!-- row -->

            <div class="form-layout-footer">
              <!--<button class="btn btn-info mg-r-5">Submit Form</button>
              <button class="btn btn-secondary">Cancel</button> -->
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
        </div>