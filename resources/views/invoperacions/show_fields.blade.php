<table class="table table-striped table-bordered detail-view" id="invoperacions-table">
  <tbody>
    <!-- Id Field -->
    <tr>
      <th>{!! Form::label('id', 'Id:') !!}</th>
      <td>{!! $invoperacion->id !!}</td>
    </tr>


    <!-- Usuario Id Field -->
    <tr>
      <th>{!! Form::label('usuario_id', 'Usuario Id:') !!}</th>
      <td>{!! $invoperacion->usuario_id !!}</td>
    </tr>


    <!-- Tipo Mov Field -->
    <tr>
      <th>{!! Form::label('tipo_mov', 'Tipo Mov:') !!}</th>
      <td>{!! $invoperacion->tipo_mov !!}</td>
    </tr>


    <!-- Proveedor Id Field -->
    <tr>
      <th>{!! Form::label('proveedor_id', 'Proveedor Id:') !!}</th>
      <td>{!! $invoperacion->proveedor_id !!}</td>
    </tr>


    <!-- Cliente Id Field -->
    <tr>
      <th>{!! Form::label('cliente_id', 'Cliente Id:') !!}</th>
      <td>{!! $invoperacion->cliente_id !!}</td>
    </tr>


    <!-- Monto Field -->
    <tr>
      <th>{!! Form::label('monto', 'Monto:') !!}</th>
      <td>{!! $invoperacion->monto !!}</td>
    </tr>


    <!-- Fecha Field -->
    <tr>
      <th>{!! Form::label('fecha', 'Fecha:') !!}</th>
      <td>{!! $invoperacion->fecha !!}</td>
    </tr>


    <!-- Cancelada Field -->
    <tr>
      <th>{!! Form::label('cancelada', 'Cancelada:') !!}</th>
      <td>{!! $invoperacion->cancelada !!}</td>
    </tr>
</tbody>
</table>
