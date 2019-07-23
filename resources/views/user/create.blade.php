@extends('layouts.appv2')

@section('title',config('app.name').' | Alta de Usuario' )
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
    <div class="col-md-12">
          <div class="card bg-0">
            <div class="card-header card-header-default">
              <h3 class="card-title">Alta de Nuevo Usuario</h3>

            </div>
            <!-- /.box-header -->
            <div class="card-body">

              <div class="pull-right">
                  <a class="btn btn-primary" href="{{ route('user.index') }}"> Regresar</a>
              </div>
              {!! Form::open(array('route' => 'user.store','method'=>'POST')) !!}
              <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <strong>Nombre:</strong>
                          {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <strong>Email:</strong>
                          {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <strong>Password:</strong>
                          {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <strong>Confirm Password:</strong>
                          {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <strong>Role:</strong>
                          {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                      <button type="submit" class="btn btn-primary">Guardar</button>
                  </div>
              </div>
              {!! Form::close() !!}

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>











@endsection
