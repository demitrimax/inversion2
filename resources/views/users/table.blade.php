<table class="table table-responsive" id="users-table">
    <thead>
        <tr>
          <th>Nombre</th>
          <th>Email</th>
          <th>Solcitudes Asignadas</th>
          <th>Roles</th>
          <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $users)
        <tr>
            <td>{!! $users->name !!}</td>
            <td>{!! $users->email !!}</td>
            <td>{!! $users->solicitudes->count() !!}</td>
            <td>
              @if(!empty($users->getRoleNames()))
                @foreach($users->getRoleNames() as $v)
                   <label class="badge badge-success">{{ $v }}</label>
                @endforeach
              @endif
            </td>
            <td>
                {!! Form::open(['route' => ['users.destroy', $users->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('users.show', [$users->id]) !!}" class='btn btn-info'><i class="fa fa-eye"></i></a>
                    <a href="{!! route('users.edit', [$users->id]) !!}" class='btn btn-primary'><i class="fa fa-edit"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Estás seguro de eliminar el usuario?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
