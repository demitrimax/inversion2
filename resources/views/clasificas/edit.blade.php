@extends('layouts.appv2')
@section('title',config('app.name').' | Editar Clasificas' )
@section('content')
<div class="row">
      <div class="col-lg-12">
          @include('adminlte-templates::common.errors')
          <div class="card bg-0">
              <div class="card-header card-header-default">
                  <h3 class="card-title">Editar Clasifica</h3>
              </div>
              <div class="card-body">
              {!! Form::model($clasifica, ['route' => ['clasificas.update', $clasifica->id], 'method' => 'patch']) !!}

                   @include('clasificas.fields')

              {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>
@endsection
