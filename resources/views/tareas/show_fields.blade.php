<table class="table table-striped table-bordered detail-view" id="tareas-table">
  <tbody>
    <!-- Id Field -->
    <tr>
      <th>{!! Form::label('id', 'Id:') !!}</th>
      <td>{!! $tareas->id !!}</td>
    </tr>


    <!-- Nombre Field -->
    <tr>
      <th>{!! Form::label('nombre', 'Nombre:') !!}</th>
      <td>{!! $tareas->nombre !!}</td>
    </tr>


    <!-- Descripcion Field -->
    <tr>
      <th>{!! Form::label('descripcion', 'Descripcion:') !!}</th>
      <td>{!! $tareas->descripcion !!}</td>
    </tr>


    <!-- Vencimiento Field -->
    <tr>
      <th>{!! Form::label('vencimiento', 'Vencimiento:') !!}</th>
      <td>{!! $tareas->vencimiento->diffForHumans() !!} ({!! $tareas->vencimiento->format('d-m-Y') !!}) <span class="badge badge-{!! $tareas->estatusdate['valor'] !!}">{!! $tareas->estatusdate['descripcion'] !!}</span></td>
    </tr>


    <!-- User Id Field -->
    <tr>
      <th>{!! Form::label('user_id', 'Usuario Asignado:') !!}</th>
      <td>{!! $tareas->user->name !!}</td>
    </tr>


    <!-- Created At Field -->
    <tr>
      <th>{!! Form::label('created_at', 'Creado el:') !!}</th>
      <td>{!! $tareas->created_at->format('d-m-Y H:i:s') !!}</td>
    </tr>


    <!-- Updated At Field -->
    <tr>
      <th>{!! Form::label('updated_at', 'Actualizado el:') !!}</th>
      <td>{!! $tareas->updated_at->format('d-m-Y H:i:s') !!}</td>
    </tr>

    @if($tareas->viewed_at)
    <tr>
      <th>{!! Form::label('vistoat', 'Visto por el usuario el:') !!}</th>
      <td>{!! $tareas->viewed_at !!}</td>
    </tr>
    @endif

    @if($tareas->terminado)
    <tr>
      <th>{!! Form::label('terminado', 'Tarea completada por el Usuario:') !!}</th>
      <td>{!! $tareas->terminado->format('d-m-Y H:i:s') !!}</td>
    </tr>
    @endif

    <tr>
      <th>{!! Form::label('porcentaje', 'Porcentaje de Avance:') !!}</th>
      <td>{!! $tareas->avance_porc !!}%</td>
    </tr>
  </tbody>
</table>
