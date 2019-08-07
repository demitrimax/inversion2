@extends('layouts.appV2')
@section('title',config('app.name').' | Categorias' )
@section('content')

    <div class="content">
        <div class="card">
        <div class="card-header card-header-default">
          <h3 class="card-title">Detalle de la Categoria</h3>
        </div>
            <div class="card-body">
                <div class="row" style="padding-left: 20px">
                <table class="table table-striped table-bordered detail-view" id="categorias-table">
                  <tbody>
                    @include('categorias.show_fields')
                    </tbody>
                  </table>
                    <a href="{!! route('categorias.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
