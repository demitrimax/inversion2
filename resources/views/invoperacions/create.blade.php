@extends('layouts.appv2')
@section('title',config('app.name').' | Alta de Nuevo Invoperacions' )
@section('content')
<div class="row">
      <div class="col-lg-6">
          @include('adminlte-templates::common.errors')
          <div class="card bd-0">
              <div class="card-header card-header-default">
                  <h3 class="card-title">Nueva Operación de Inventario</h3>
              </div>
              <div class="card-body">

              {!! Form::open(['route' => 'invoperacions.store']) !!}

                  @include('invoperacions.fields')

              {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>

@endsection
