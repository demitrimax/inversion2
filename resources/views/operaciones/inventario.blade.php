@card(['title' => 'Equipo/Material Registrado con la Operación', 'color'=>'warning'])
<table class="table table-hover">
  <thead>
    <tr>
      <th>Concepto</th>
      <th>Monto</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach($operaciones->inventarios as $inventario)
    <tr>
      <td>{!! $inventario->concepto !!}</td>
      <td>{!! number_format($inventario->montocompra,2) !!}</td>
      <td></td>
    </tr>
    @endforeach
  </tbody>
</table>

@endcard
