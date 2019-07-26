@extends('layouts.appv2')
@section('title',config('app.name').' | Editar Operaciones' )
@section('content')
<div class="row">
      <div class="col-lg-12">
          @include('adminlte-templates::common.errors')
          <div class="card bg-0">
              <div class="card-header card-header-default">
                  <h3 class="card-title">Editar Operaciones</h3>
              </div>
              <div class="card-body">
              {!! Form::model($operaciones, ['route' => ['operaciones.update', $operaciones->id], 'method' => 'patch']) !!}

                   @include('operaciones.fields')

              {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>
@endsection
