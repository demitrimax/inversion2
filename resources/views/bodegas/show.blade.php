@extends('layouts.appv2')
@section('title',config('app.name').' | Bodegas' )
@section('content')
    <section class="content-header">
        <h1>
            Bodegas
        </h1>
    </section>
    <div class="content">
        <div class="card">
        <div class="card-header card-header-default">
          <h3 class="card-title">Bodegas</h3>
        </div>
            <div class="card-body">
                <div class="row" style="padding-left: 20px">
                <table class="table table-striped table-bordered detail-view" id="bodegas-table">
                  <tbody>
                    @include('bodegas.show_fields')
                    </tbody>
                  </table>
                    <a href="{!! route('bodegas.index') !!}" class="btn btn-secondary">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
