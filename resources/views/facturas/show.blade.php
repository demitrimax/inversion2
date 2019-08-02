@extends('layouts.appv2')
@section('title',config('app.name').' | Facturas' )
@section('content')

    <div class="content">
        <div class="card">
        <div class="card-header card-header-default">
          <h3 class="card-title">Detalle de la Factura</h3>
        </div>
            <div class="card-body">
                <div class="row" style="padding-left: 20px">

                    @include('facturas.show_fields')

                    <a href="{!! route('facturas.index') !!}" class="btn btn-secondary">Regresar</a>

                    @can('facturas-edit')
                    <a href="{!! route('facturas.edit', [$facturas->id]) !!}" class='btn btn-primary'>Editar</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
