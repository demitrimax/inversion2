<table class="table table-striped table-bordered detail-view" id="subclasificas-table">
  <tbody>
    <!-- Id Field -->
    <tr>
      <th>{!! Form::label('id', 'Id:') !!}</th>
      <td>{!! $subclasifica->id !!}</td>
    </tr>


    <!-- Nombre Field -->
    <tr>
      <th>{!! Form::label('nombre', 'Nombre:') !!}</th>
      <td>{!! $subclasifica->nombre !!}</td>
    </tr>


    <!-- Descripcion Field -->
    <tr>
      <th>{!! Form::label('descripcion', 'Descripcion:') !!}</th>
      <td>{!! $subclasifica->descripcion !!}</td>
    </tr>


    <!-- Clasifica Id Field -->
    <tr>
      <th>{!! Form::label('clasifica_id', 'Categoría Principal:') !!}</th>
      <td>{!! $subclasifica->clasifica->nombre !!}</td>
    </tr>

  </tbody>
</table>
