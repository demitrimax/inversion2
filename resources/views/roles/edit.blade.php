@extends('layouts.appv2')

@section('title',config('app.name').' | Editar Rol' )

@section('css')
<link href="{{asset('starlight/lib/select2/css/select2.min.css')}}" rel="stylesheet" />
@endsections

@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card bg-0">
            <div class="card-header card-header-default justify-content-between">
              <h3 class="card-title">Editar Rol</h3>
              <div class="pull-right">
                  <a class="btn btn-primary" href="{{ route('roles.index') }}"> Regresar</a>
              </div>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
              <p>{{ $message }}</p>
            </div>
            @endif
            <!-- /.box-header -->
            {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Permisos:</strong>
                        <br/>
                        @foreach($permission as $value)
                            <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                            {{ $value->name }}</label>
                        <br/>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Permisos:</strong>
                        {!! Form::select('permission[]', $permissions, $rolePermissions, array('class' => 'form-control select2','multiple')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            {!! Form::close() !!}
              <!-- /.box-body -->

              <div class="box-footer">

              </div>

          </div>
          <!-- /.box -->

        </div>

      </div>
      <!-- /.row -->


@endsection

@section('scripts')
<script src="{{asset('starlight/lib/select2/js/select2.full.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>
@endsection
