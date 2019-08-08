@extends('layouts.appv2')

@section('title',config('app.name').' | Inventario Entrada' )

@section('content')
{!! Form::open(['route'=>'inventario.regentrada'])!!}
  {!! Form::hidden('usuario_id', Auth::user()->id) !!}
  {!! Form::hidden('tipo_mov', 'Entrada') !!}
<div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Registro de Entradas del Inventario</h6>
          <p class="mg-b-20 mg-sm-b-30">Movimiento de entradas</p>

          <div class="form-layout">
            <div class="row mg-b-25">

              <div class="col-lg-8">
                <div class="form-group">
                  <label class="form-control-label">Proveedor: <span class="tx-danger">*</span></label>
                  {!! Form::select('proveedor_id', $proveedores, null, ['class'=>'form-control', 'required'])!!}
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Fecha: <span class="tx-danger">*</span></label>
                  {!! Form::text('fecha', Date('Y-m-d'), ['class'=>'form-control', 'required'] )!!}
                </div>
              </div><!-- col-4 -->

            </div><!-- row -->

            <div class="form-layout-footer">
              <button class="btn btn-info mg-r-5">Submit Form</button>
              <button class="btn btn-secondary">Cancel</button>
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
        </div>
        {!! Form::close()!!}

  @endsection
