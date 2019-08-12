<table class="table mg-b-0 table-primary table-hover">
  <thead class="bg-info">
    <tr>
      <th>Cantidad  </th>
      <th>Producto</th>
      <th>P. Unitario</th>
      <th>Importe</th>
    </tr>
  </thead>
  <tbody>
    @foreach($invoperacion->invdetoperacions as $key=>$detoperacion)
    <tr>
      <td>{{$detoperacion->cantidad}} </td>
      <td>{{$detoperacion->producto->nombre }}</td>
      <td>{{ number_format($detoperacion->punitario,2)}}</td>
      <td>{{number_format($detoperacion->importe,2)}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
