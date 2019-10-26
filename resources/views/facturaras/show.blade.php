@extends('layouts.appv2')
@section('title',config('app.name').' | Empresa Facturadora' )
@section('content')

    <div class="content">
        <div class="card">
        <div class="card-header card-header-default">
          <h3 class="card-title">Empresa Facturadora</h3>
        </div>
            <div class="card-body">
                <div class="row" style="padding-left: 20px">

                    @include('facturaras.show_fields')


                </div>
                  <a href="{!! route('facturaras.index') !!}" class="btn btn-secondary">Regresar</a>
            </div>
        </div>
    </div>
@endsection
