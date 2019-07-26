@extends('layouts.app')
@section('title',config('app.name').' | Operaciones' )
@section('content')
    <section class="content-header">
        <h1>
            Operaciones
        </h1>
    </section>
    <div class="content">
        <div class="card">
        <div class="card-header card-header-default">
          <h3 class="card-title">Operaciones</h3>
        </div>
            <div class="card-body">
                <div class="row" style="padding-left: 20px">
                <table class="table table-striped table-bordered detail-view" id="operaciones-table">
                  <tbody>
                    @include('operaciones.show_fields')
                    </tbody>
                  </table>
                    <a href="{!! route('operaciones.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
