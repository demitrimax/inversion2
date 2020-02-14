@extends('layouts.appv2')
@section('title',config('app.name').' | Editar Empresas' )
@section('content')
<div class="row">
      <div class="col-lg-12">
          @include('adminlte-templates::common.errors')
          <div class="card bg-0">
              <div class="card-header card-header-default bg-primary">
                  <h3 class="card-title">Editar Empresas</h3>
              </div>
              <div class="card-body">
                <div class="row">
                <div class="col-md-6">
              {!! Form::model($empresas, ['route' => ['empresas.update', $empresas->id], 'method' => 'patch', 'enctype'=>'multipart/form-data']) !!}

                   @include('empresas.fields')

              {!! Form::close() !!}
                </div>
                <div class="col-md-6">
                  @include('empresas.categoriasOrden')
                </div>
              </div><!-- Row -->
              </div>
          </div>
      </div>
  </div>
@endsection
