{{-- \resources\views\permissions\create.blade.php --}}
@extends('layouts.appv2')

@section('title',config('app.name').' | Alta de Permisos' )

@section('content')

<div class='col-lg-4 col-lg-offset-4'>
  <div class="card bg-0">
    <div class="card-header card-header-default">
    <h1 class="card-title"><i class='fa fa-key'></i> Alta de Permisos</h1>
    <br>
  </div>
    <div class="card-body">
    {{ Form::open(array('url' => 'permissions')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', '', array('class' => 'form-control')) }}
    </div><br>
    @if(!$roles->isEmpty()) //Si todavía no se han asignado permisos
        <h4>Asignar Permiso a Rol</h4>

        @foreach ($roles as $role)
            {{ Form::checkbox('roles[]',  $role->id ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach
    @endif
    <br>
    {{ Form::submit('Agregar', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
  </div>

</div>
</div>

@endsection
