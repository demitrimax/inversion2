@extends('layouts.appv2')
@section('title',config('app.name').' | Editar Minventarios' )
@section('content')
<div class="row">
      <div class="col-lg-12">
          @include('adminlte-templates::common.errors')
          <div class="card bg-0">
              <div class="card-header card-header-default">
                  <h3 class="card-title">Editar Minventario</h3>
              </div>
              <div class="card-body">
              {!! Form::model($minventario, ['route' => ['minventarios.update', $minventario->id], 'method' => 'patch']) !!}

                   @include('minventarios.fields')

              {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>
@endsection
