@extends('layouts.appv2')
@section('title',config('app.name').' | Editar Coddivisas' )
@section('content')
<div class="row">
      <div class="col-lg-12">
          @include('adminlte-templates::common.errors')
          <div class="card bg-0">
              <div class="card-header card-header-default">
                  <h3 class="panel-title">Editar Coddivisas</h3>
              </div>
              <div class="card-body">
              {!! Form::model($coddivisas, ['route' => ['coddivisas.update', $coddivisas->id], 'method' => 'patch']) !!}

                   @include('coddivisas.fields')

              {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>
@endsection
