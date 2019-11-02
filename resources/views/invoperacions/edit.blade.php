@extends('layouts.appv2')
@section('title',config('app.name').' | Editar Invoperacions' )
@section('content')
<div class="row">
      <div class="col-lg-12">
          @include('adminlte-templates::common.errors')
          <div class="card bg-0">
              <div class="card-header card-header-default">
                  <h3 class="card-title">Editar Operación</h3>
              </div>
              <div class="card-body">
              {!! Form::model($invoperacion, ['route' => ['invoperacions.updateRemision', $invoperacion->id], 'method' => 'post']) !!}

                   @include('invoperacions.editfields')

              {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>
@endsection
