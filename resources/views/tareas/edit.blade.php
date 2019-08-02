@extends('layouts.appv2')
@section('title',config('app.name').' | Editar Tareas' )
@section('content')
<div class="row">
      <div class="col-lg-12">
          @include('adminlte-templates::common.errors')
          <div class="card bg-0">
              <div class="card-header card-header-default">
                  <h3 class="panel-title">Editar Tareas</h3>
              </div>
              <div class="card-body">
              {!! Form::model($tareas, ['route' => ['tareas.update', $tareas->id], 'method' => 'patch']) !!}

                   @include('tareas.fields')

              {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>
@endsection
