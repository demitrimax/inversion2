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
        <td>{!! $tareas->vencimiento !!}</td>
      </tr>


      <!-- User Id Field -->
      <tr>
        <th>{!! Form::label('user_id', 'User Id:') !!}</th>
        <td>{!! $tareas->user_id !!}</td>
      </tr>


      <!-- Created At Field -->
      <tr>
        <th>{!! Form::label('created_at', 'Created At:') !!}</th>
        <td>{!! $tareas->created_at !!}</td>
      </tr>


      <!-- Updated At Field -->
      <tr>
        <th>{!! Form::label('updated_at', 'Updated At:') !!}</th>
        <td>{!! $tareas->updated_at !!}</td>
      </tr>


      <!-- Deleted At Field -->
      <tr>
        <th>{!! Form::label('deleted_at', 'Deleted At:') !!}</th>
        <td>{!! $tareas->deleted_at !!}</td>
      </tr>


      <!-- Viewed At Field -->
      <tr>
        <th>{!! Form::label('viewed_at', 'Viewed At:') !!}</th>
        <td>{!! $tareas->viewed_at !!}</td>
      </tr>


      <!-- Terminado Field -->
      <tr>
        <th>{!! Form::label('terminado', 'Terminado:') !!}</th>
        <td>{!! $tareas->terminado !!}</td>
      </tr>


      <!-- Avance Porc Field -->
      <tr>
        <th>{!! Form::label('avance_porc', 'Avance Porc:') !!}</th>
        <td>{!! $tareas->avance_porc !!}</td>
      </tr>

    </tbody>
</table>
