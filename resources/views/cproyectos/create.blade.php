@extends('layouts.appv2')
@section('title',config('app.name').' | Alta de Nuevo Cproyectos' )
@section('content')
<div class="row">
      <div class="col-lg-12">
          @include('adminlte-templates::common.errors')
          <div class="card card-default">
              <div class="card-heading">

              </div>

              <div class="card-body">
                <h3 class="card-title">Alta de Proyectos</h3>
              {!! Form::open(['route' => 'cproyectos.store']) !!}

                  @include('cproyectos.fields')

              {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>

@endsection
