@extends('layouts.appv2')

@section('title',config('app.name').' | Administración de Roles' )

@section('content')

<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card bg-0 table-responsive no-padding">
            <div class="card-header card-header-default justify-content-between">
              <h3 class="card-title">Administrador de Roles</h3>

                @can('role-create')
                    <a class="btn btn-success pull-right" href="{{ route('roles.create') }}"> Alta de Nuevo Rol</a>
                @endcan

            </div>
            <div class="card-body">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
              <p>{{ $message }}</p>
            </div>
            @endif
            <!-- /.box-header -->
            <table class="table table-bordered">
              <tr>
                 <th>No</th>
                 <th>Name</th>
                 <th width="280px">Action</th>
              </tr>
                @foreach ($roles as $key => $role)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Mostrar</a>
                        @can('role-edit')
                            <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Editar</a>
                        @endcan
                        @can('role-delete')
                            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
                @endforeach
            </table>
          </div>
              <!-- /.box-body -->

              <div class="box-footer">
              {!! $roles->render() !!}
              </div>

          </div>
          <!-- /.box -->



        </div>

      </div>
      <!-- /.row -->

@endsection
