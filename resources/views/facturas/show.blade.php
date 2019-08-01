@extends('layouts.appv2')
@section('title',config('app.name').' | Facturas' )
@section('content')
    <section class="content-header">
        <h1>
            Facturas
        </h1>
    </section>
    <div class="content">
        <div class="card">
        <div class="card-header card-header-default">
          <h3 class="card-title">Facturas</h3>
        </div>
            <div class="card-body">
                <div class="row" style="padding-left: 20px">
                <table class="table table-striped table-bordered detail-view" id="facturas-table">
                  <tbody>
                    @include('facturas.show_fields')
                    </tbody>
                  </table>
                    <a href="{!! route('facturas.index') !!}" class="btn btn-secondary">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
