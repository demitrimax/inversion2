@extends('layouts.appv2')
@section('title',config('app.name').' | Facturaras' )
@section('content')
    <section class="content-header">
        <h1>
            Facturara
        </h1>
    </section>
    <div class="content">
        <div class="card">
        <div class="card-header card-header-default">
          <h3 class="card-title">Facturara</h3>
        </div>
            <div class="card-body">
                <div class="row" style="padding-left: 20px">
                <table class="table table-striped table-bordered detail-view" id="facturaras-table">
                  <tbody>
                    @include('facturaras.show_fields')
                    </tbody>
                  </table>
                    <a href="{!! route('facturaras.index') !!}" class="btn btn-secondary">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection