<table class="table table-striped table-bordered detail-view" id="proveedores-table">
  <tbody>
    <!-- Id Field -->
    <tr>
      <th>{!! Form::label('id', 'Id:') !!}</th>
      <td>{!! $proveedores->id !!}</td>
    </tr>


    <!-- Nombre Field -->
    <tr>
      <th>{!! Form::label('nombre', 'Nombre:') !!}</th>
      <td>{!! $proveedores->nombre !!}</td>
    </tr>


    <!-- Rfc Field -->
    <tr>
      <th>{!! Form::label('rfc', 'Rfc:') !!}</th>
      <td>{!! $proveedores->rfc !!}</td>
    </tr>


    <!-- Domicilio Field -->
    <tr>
      <th>{!! Form::label('domicilio', 'Domicilio:') !!}</th>
      <td>{!! $proveedores->domicilio !!}</td>
    </tr>


    <!-- Telefono Field -->
    <tr>
      <th>{!! Form::label('telefono', 'Telefono:') !!}</th>
      <td>{!! $proveedores->telefono !!}</td>
    </tr>


    <!-- Contacto Field -->
    <tr>
      <th>{!! Form::label('contacto', 'Contacto:') !!}</th>
      <td>{!! $proveedores->contacto !!}</td>
    </tr>
    <!-- Observaciones Field -->
    <tr>
      <th>{!! Form::label('observaciones', 'Observaciones:') !!}</th>
      <td>{!! $proveedores->observaciones !!}</td>
    </tr>
  </tbody>
</table>
