@extends('layouts.appv2')
@section('title',config('app.name').' | Operación de Inventario' )
@section('content')

    <div class="content">


        <div class="card">
        <div class="card-header card-header-default">
          <h3 class="card-title">Operación de Inventario</h3>
        </div>
            <div class="card-body">

                    @include('invoperacions.invdetped')


                  <div class="col-lg-12">
                    @include('invoperacions.detoperacion')
                  </div>

                    <a href="{!! route('invoperacions.index') !!}" class="btn btn-secondary">Regresar</a>
                    @if($invoperacion->tipo_mov == 'Salida')
                      @if($invoperacion->facturara_id)
                        <a href="{!! route('invoperacions.miformato', [$invoperacion->id])!!}"  class="btn btn-secondary">Formato Remisión</a>
                      @endif
                    @endif
                    @if($invoperacion->estatus == 'R')
                    <a href="{!! route('invoperacions.edit', [$invoperacion->id])!!}"  class="btn btn-warning">Editar</a>
                    <a href="{!! route('invoperacions.esta.facturada', [$invoperacion->id])!!}"  class="btn btn-success">Marcar como Facturada</a>
                    @endif
                </div>
            </div>
        </div>



@endsection
