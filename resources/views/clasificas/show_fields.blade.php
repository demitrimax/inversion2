<table class="table table-striped table-bordered detail-view" id="clasificas-table">
  <tbody>
<!-- Id Field -->
    <tr>
      <th>{!! Form::label('id', 'Id:') !!}</th>
      <td>{!! $clasifica->id !!}</td>
    </tr>


    <!-- Nombre Field -->
    <tr>
      <th>{!! Form::label('nombre', 'Nombre:') !!}</th>
      <td>{!! $clasifica->nombre !!}</td>
    </tr>


    <!-- Descripcion Field -->
    <tr>
      <th>{!! Form::label('descripcion', 'Descripcion:') !!}</th>
      <td>{!! $clasifica->descripcion !!}</td>
    </tr>

    <!-- Descripcion Field -->
    <tr>
      <th>{!! Form::label('orden', 'Orden:') !!}</th>
      <td>{!! $clasifica->orden !!}</td>
    </tr>

    <!-- Tipo Field -->
    <tr>
      <th>{!! Form::label('tipo', 'Tipo:') !!}</th>
      <td>{!! $clasifica->tip ==  'E' ? 'Egreso' : 'Ingreso' !!}</td>
    </tr>

</tbody>
</table>
