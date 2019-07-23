{{-- \resources\views\permissions\index.blade.php --}}
@extends('layouts.appv2')
@section('title',config('app.name').' | Permisos' )

@section('css')
<!-- DataTables -->
<link href="{{asset('starlight/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
<link href="{{asset('starlight/lib/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{asset('starlight/lib/highlightjs/github.css')}}" rel="stylesheet">

@endsection

@section('content')
<section class="content">
  <div class="row">
      <div class="col-md-12">
          <div class="card bg-0">

              <div class="card-header card-header-default">
                  <h4 class="m-b-30 m-t-0 card-title"><i class="fa fa-key"></i> Permisos Disponibles</h4>

                  <div class="pull-right">
                    <a href="{{ route('user.index') }}" class="btn btn-primary pull-right">Usuarios</a>
                    <a href="{{ route('roles.index') }}" class="btn btn-primary pull-right">Roles</a>
                  </div>
                </div>

                <div class="card-body">


                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                          <p>{{ $message }}</p>
                        </div>
                        @endif
                        <div class="table-wrapper">
                          <table class="table display responsive nowrap" id="permisos-table">
                              <thead>
                              <tr>
                                <th>#</th>
                                <th>Permiso</th>
                                <th>Operaciones</th>
                              </tr>
                              </thead>
                              <tbody>
                                @foreach ($permissions as $key=>$permission)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                    <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Editar</a>

                                    {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
                                    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}

                                    </td>
                                </tr>
                                @endforeach
                              </tbody>
                          </table>
                        </div>
                      </div>
                          <div class="card-footer">
                            <a href="{{ URL::to('permissions/create') }}" class="btn btn-success">Agregar Permiso</a>
                          </div>


          </div>
      </div>
  </div>
</section>

@endsection
@section('scripts')
<!-- DataTables -->
<script src="{{asset('starlight/lib/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('starlight/lib/datatables-responsive/dataTables.responsive.js')}}"></script>

<script>
  $(function () {
    $('#permisos-table').DataTable({
      responsive: true,
      "language": {
                "url": "{{asset('appzia/plugins/datatables/Spanish.json')}}"
            }
    })
  })
</script>
@endsection
