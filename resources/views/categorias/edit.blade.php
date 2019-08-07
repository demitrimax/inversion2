@extends('layouts.appv2')
@section('title',config('app.name').' | Editar Categorias' )
@section('content')
<div class="row">
      <div class="col-lg-12">
          @include('adminlte-templates::common.errors')
          <div class="card bg-0">
              <div class="card-header card-header-default">
                  <h3 class="panel-title">Editar Categorias</h3>
              </div>
              <div class="card-body">
              {!! Form::model($categorias, ['route' => ['categorias.update', $categorias->id], 'method' => 'patch']) !!}

                   @include('categorias.fields')

              {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>
@endsection
