<table class="table table-striped table-bordered detail-view" id="invoperacions-table">
  <tbody>
    <!-- Id Field -->
    <tr>
      <th>{!! Form::label('id', 'Id:') !!}</th>
      <td>{!! $invoperacion->id !!}</td>
    </tr>


    <!-- Tipo Mov Field -->
    <tr>
      <th>{!! Form::label('tipo_mov', 'Tipo de Movimiento:') !!}</th>
      <td>{!! $invoperacion->tipo_mov !!}</td>
    </tr>

    @if($invoperacion->proveedor_id)
    <!-- Proveedor Id Field -->
    <tr>
      <th>{!! Form::label('proveedor_id', 'Proveedor:') !!}</th>
      <td>{!! $invoperacion->proveedor->nombre !!}</td>
    </tr>
    @endif

    @if($invoperacion->cliente_id)
    <!-- Cliente Id Field -->
    <tr>
      <th>{!! Form::label('cliente_id', 'Cliente Id:') !!}</th>
      <td>{!! $invoperacion->cliente_id !!}</td>
    </tr>
    @endif


    <!-- Monto Field -->
    <tr>
      <th>{!! Form::label('Total', 'Total:') !!}</th>
      <td>{!! number_format($invoperacion->total,2) !!}</td>
    </tr>


    <!-- Fecha Field -->
    <tr>
      <th>{!! Form::label('fecha', 'Fecha:') !!}</th>
      <td>{!! $invoperacion->fecha->format('d-m-Y') !!}</td>
    </tr>

    <!-- Estatus Field -->
    <tr>
      <th>{!! Form::label('status', 'Estatus:') !!}</th>
      <td>
        {!! $invoperacion->estatusg !!}
      </td>
    </tr>

  @if($invoperacion->facturar_a)
    <!-- Facturar a Field -->
    <tr>
      <th>{!! Form::label('facturara', 'Facturar a:') !!}</th>
      <td>{!! $invoperacion->facturar_a !!}</td>
    </tr>
    @endif

    <!-- Usuario Id Field -->
    <tr>
      <th>{!! Form::label('usuario_id', 'Usuario Id:') !!}</th>
      <td>{!! $invoperacion->usuario->name !!}</td>
    </tr>
</tbody>
</table>
