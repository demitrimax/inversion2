@extends('layouts.appv2')
@section('title',config('app.name').' | Invoperacions' )
@section('content')

    <div class="content">
        <div class="card">
        <div class="card-header card-header-default">
          <h3 class="card-title">Operación de Inventario</h3>
        </div>
            <div class="card-body">
                <div class="row" style="padding-left: 20px">
                <table class="table table-striped table-bordered detail-view" id="invoperacions-table">
                  <tbody>
                    @include('invoperacions.show_fields')
                    </tbody>
                  </table>
                    <a href="{!! route('invoperacions.index') !!}" class="btn btn-secondary">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
