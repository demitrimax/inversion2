@extends('layouts.appv2')
@section('title',config('app.name').' | Editar Facturas' )
@section('content')
<div class="row">
      <div class="col-lg-12">
          @include('adminlte-templates::common.errors')
          <div class="card bg-0">
              <div class="card-header card-header-default">
                  <h3 class="card-title">Editar Facturas</h3>
              </div>
              <div class="card-body">
              {!! Form::model($facturas, ['route' => ['facturas.update', $facturas->id], 'method' => 'patch']) !!}

                   @include('facturas.fields')

              {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>
@endsection
