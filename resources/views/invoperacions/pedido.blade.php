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
                    <a href="{!! route('invoperacions.miformato', [$invoperacion->id])!!}"  class="btn btn-secondary">Formato Remisión</a>
                    @endif
                </div>
            </div>
        </div>



@endsection
