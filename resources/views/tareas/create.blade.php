@extends('layouts.appv2')
@section('title',config('app.name').' | Alta de Nuevo Tareas' )
@section('content')
<div class="row">
      <div class="col-lg-12">
          @include('adminlte-templates::common.errors')
          <div class="card bd-0">
              <div class="card-header card-header-default">
                  <h3 class="card-title">Alta de Tareas</h3>
              </div>
              <div class="card-body">
              {!! Form::open(['route' => 'tareas.store']) !!}

                  @include('tareas.fields')

              {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>

@endsection
