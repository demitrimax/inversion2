@extends('layouts.appv2')
@section('title',config('app.name').' | Editar Cproyectos' )
@section('content')
<div class="row">
      <div class="col-lg-12">
          @include('adminlte-templates::common.errors')
          <div class="card panel-default">
              <div class="card-header card-header-default">
                  <h3 class="card-title">Editar Proyectos</h3>
              </div>
              <div class="card-body">
              {!! Form::model($cproyectos, ['route' => ['cproyectos.update', $cproyectos->id], 'method' => 'patch']) !!}

                   @include('cproyectos.fields')

              {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>
@endsection
