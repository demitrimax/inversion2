@extends('layouts.appv2')

@section('title',config('app.name').' | Editar Permisos' )

@section('content')

<div class='col-lg-4 col-lg-offset-4'>
  <div class="card bg-0">
    <div class="card-header card-header-default">

    <h1 class="card-title"><i class='fa fa-key'></i> Editar {{$permission->name}}</h1>
    <br>
  </div>
  <div class="card-body">
    {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with permission data --}}

    <div class="form-group">
        {{ Form::label('name', 'Nombre del permiso') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>
    <br>
    {{ Form::submit('Editar', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
  </div>
</div>

</div>

@endsection
