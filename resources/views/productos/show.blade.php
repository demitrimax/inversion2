@extends('layouts.appv2')
@section('title',config('app.name').' | Productos' )
@section('content')

    <div class="content">
        <div class="card">
        <div class="card-header card-header-default">
          <h3 class="card-title">Productos</h3>
        </div>
            <div class="card-body">
                <div class="row" style="padding-left: 20px">
                <table class="table table-striped table-bordered detail-view" id="productos-table">
                  <tbody>
                    @include('productos.show_fields')
                    </tbody>
                  </table>
                    <a href="{!! route('productos.index') !!}" class="btn btn-secondary">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
