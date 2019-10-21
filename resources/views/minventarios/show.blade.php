@extends('layouts.appv2')
@section('title',config('app.name').' | Minventarios' )
@section('content')

    <div class="content">
        <div class="card">
        <div class="card-header card-header-default">
          <h3 class="card-title">Minventario</h3>
        </div>
            <div class="card-body">
                <div class="row" style="padding-left: 20px">
                <table class="table table-striped table-bordered detail-view" id="minventarios-table">
                  <tbody>
                    @include('minventarios.show_fields')
                    </tbody>
                  </table>
                    <a href="{!! route('minventarios.index') !!}" class="btn btn-secondary">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
