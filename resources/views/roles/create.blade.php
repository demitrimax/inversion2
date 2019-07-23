@extends('layouts.appv2')

@section('title',config('app.name').' | Alta de Roles' )

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
              <h3 class="card-title">Alta de Nuevo Rol</h3>
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
            {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
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
                            <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                            {{ $value->name }}</label>
                        <br/>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Permisos:</strong>
                        {!! Form::select('permission[]', $permissions, null, array('class' => 'form-control select2','multiple')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                </div>
            {!! Form::close() !!}
              <!-- /.box-body -->

              <div class="card-footer tx-center bg-gray-300">
                    <button type="submit" class="btn btn-primary">Guardar</button>
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
