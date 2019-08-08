@extends('layouts.appv2')
@section('title',config('app.name').' | Alta de Nuevo Bodegas' )
@section('content')
<div class="row">
      <div class="col-lg-12">
          @include('adminlte-templates::common.errors')
          <div class="card bd-0">
              <div class="card-header card-header-default">
                  <h3 class="card-title">Alta de Bodegas</h3>
              </div>
              <div class="card-body">
              {!! Form::open(['route' => 'bodegas.store']) !!}

                  @include('bodegas.fields')

              {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>

@endsection
