<table class="table table-striped table-bordered detail-view" id="clientes-table">
  <tbody>
    <!-- Id Field -->
    <tr>
      <th>{!! Form::label('id', 'Id:') !!}</th>
      <td>{!! $clientes->id !!}</td>
    </tr>


    <!-- Nombre Field -->
    <tr>
      <th>{!! Form::label('nombre', 'Nombre:') !!}</th>
      <td>{!! $clientes->nombre !!}</td>
    </tr>


    <!-- Rfc Field -->
    <tr>
      <th>{!! Form::label('RFC', 'RFC:') !!}</th>
      <td>{!! $clientes->RFC !!}</td>
    </tr>


    <!-- Comentario Field -->
    <tr>
      <th>{!! Form::label('comentario', 'Comentario:') !!}</th>
      <td>{!! $clientes->comentario !!}</td>
    </tr>


    <!-- Direccion Field -->
    <tr>
      <th>{!! Form::label('direccion', 'Direccion:') !!}</th>
      <td>{!! $clientes->direccion !!}</td>
    </tr>


    <!-- Telefono Field -->
    <tr>
      <th>{!! Form::label('telefono', 'Telefono:') !!}</th>
      <td>{!! $clientes->telefono !!}</td>
    </tr>


    <!-- Correo Field -->
    <tr>
      <th>{!! Form::label('correo', 'Correo:') !!}</th>
      <td>{!! $clientes->correo !!}</td>
    </tr>
  </tbody>
</table>
