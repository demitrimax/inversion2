@extends('layouts.appv2')
@section('title',config('app.name').' | Alta de Nuevo Facturas' )
@section('content')
<div class="row">
      <div class="col-lg-12">
          @include('adminlte-templates::common.errors')
          <div class="card bd-0">
              <div class="card-header card-header-default">
                  <h3 class="card-title">Alta de Facturas</h3>
              </div>
              <div class="card-body">
              {!! Form::open(['route' => 'facturas.store']) !!}

                  @include('facturas.fields')

              {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>

@endsection
