@extends('layouts.appv2')
@section('title',config('app.name').' | Alta de Nuevo Proveedores' )
@section('content')
<div class="row">
      <div class="col-lg-12">
          @include('adminlte-templates::common.errors')
          <div class="card bg-0">
              <div class="card-header card-header-default">
                  <h3 class="card-title">Alta de Proveedores</h3>
              </div>
              <div class="card-body">
              {!! Form::open(['route' => 'proveedores.store']) !!}

                  @include('proveedores.fields')

              {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>
  
@endsection
