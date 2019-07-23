@extends('layouts.appv2')
@section('title',config('app.name').' | Alta de Nuevo Empresas' )
@section('content')
<div class="row">
      <div class="col-lg-12">
          @include('adminlte-templates::common.errors')
          <div class="card bd-0">
              <div class="card-header card-header-default bg-primary">
                  <h3 class="card-title">Alta de Empresas</h3>
              </div>
              <div class="card-body">
              {!! Form::open(['route' => 'empresas.store']) !!}

                  @include('empresas.fields')

              {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>

@endsection
