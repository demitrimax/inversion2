@extends('layouts.appv2')

@section('title',config('app.name').' | Rol '.$role->name )

@section('content')
<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card bg-0">
            <div class="card-hader card-header-default">
              <h3 class="card-title">Rol: {{ $role->name }}</h3>
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
            <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $role->name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Permisos:</strong>
                        @if(!empty($rolePermissions))
                            @foreach($rolePermissions as $v)
                                <label class="label label-success">{{ $v->name }},</label>
                            @endforeach
                        @endif
                    </div>
                </div>
              <!-- /.box-body -->

              <div class="box-footer">
                        Asignar Permisos
              </div>
            </div>

          </div>
          <!-- /.box -->



        </div>

      </div>
      <!-- /.row -->




@endsection
