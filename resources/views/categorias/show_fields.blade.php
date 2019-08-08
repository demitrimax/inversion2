<table class="table table-striped table-bordered detail-view" id="categorias-table">
  <tbody>
    <!-- Id Field -->
    <tr>
      <th>{!! Form::label('id', 'Id:') !!}</th>
      <td>{!! $categorias->id !!}</td>
    </tr>


    <!-- Nombre Field -->
    <tr>
      <th>{!! Form::label('nombre', 'Nombre:') !!}</th>
      <td>{!! $categorias->nombre !!}</td>
    </tr>


    <!-- Descripcion Field -->
    <tr>
      <th>{!! Form::label('descripcion', 'Descripcion:') !!}</th>
      <td>{!! $categorias->descripcion !!}</td>
    </tr>


    <!-- Imagen Field -->
    <tr>
      <th>{!! Form::label('imagen', 'Imagen:') !!}</th>
      <td>{!! $categorias->imagen !!}</td>
    </tr>
  </tbody>
</table>
