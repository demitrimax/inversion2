@extends('layouts.appv2')
@section('title',config('app.name').' | Editar Bancos' )
@section('content')
<div class="row">
      <div class="col-lg-12">
          @include('adminlte-templates::common.errors')
          <div class="card bg-0">
              <div class="card-header card-header-default">
                  <h3 class="card-title">Editar Bancos</h3>
              </div>
              <div class="card-body">
              {!! Form::model($bancos, ['route' => ['bancos.update', $bancos->id], 'method' => 'patch']) !!}

                   @include('bancos.fields')

              {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>
@endsection
