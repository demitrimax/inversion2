@extends('layouts.appv2')
@section('title',config('app.name').' | Editar Bcuentas' )
@section('content')
<div class="row">
      <div class="col-lg-12">
          @include('adminlte-templates::common.errors')
          <div class="card bg-0">
              <div class="card-header card-header-default">
                  <h3 class="card-title">Editar Cuenta</h3>
              </div>
              <div class="card-body">
              {!! Form::model($bcuentas, ['route' => ['bcuentas.update', $bcuentas->id], 'method' => 'patch']) !!}

                   @include('bcuentas.fields')

              {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>
@endsection
