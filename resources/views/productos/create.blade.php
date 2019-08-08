@extends('layouts.appv2')
@section('title',config('app.name').' | Alta de Nuevo Productos' )
@section('content')
<div class="row">
      <div class="col-lg-12">
          @include('adminlte-templates::common.errors')
          <div class="card bd-0">
              <div class="card-header card-header-default">
                  <h3 class="card-title">Alta de Productos</h3>
              </div>
              <div class="card-body">
              {!! Form::open(['route' => 'productos.store']) !!}

                  @include('productos.fields')

              {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>

@endsection
