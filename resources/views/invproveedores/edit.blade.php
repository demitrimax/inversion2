@extends('layouts.appv2')
@section('title',config('app.name').' | Editar Invproveedores' )
@section('content')
<div class="row">
      <div class="col-lg-12">
          @include('adminlte-templates::common.errors')
          <div class="card bg-0">
              <div class="card-header card-header-default">
                  <h3 class="card-title">Editar Invproveedores</h3>
              </div>
              <div class="card-body">
              {!! Form::model($invproveedores, ['route' => ['invproveedores.update', $invproveedores->id], 'method' => 'patch']) !!}

                   @include('invproveedores.fields')

              {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>
@endsection
