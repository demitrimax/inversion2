<table class="table table-bordered table-striped table-hover table-responsive">
  <thead class="bg-primary">
    <tr>
      <th class="text-center">Categoria</th>
      <th class="text-center">Material</th>
      <th class="text-center">Unidad de Medida</th>
      <th class="text-center">Cantidad en Existencias</th>
      <th class="text-center">Medida</th>
      <th class="text-center">Precio Compra</th>
      <th class="text-center">Importe Costo</th>
      <th class="text-center">Precio Venta</th>
      <th class="text-center">Importe Venta</th>
    </tr>
  </thead>
  <tbody>
    @php
      $timpcosto = 0;
      $timpventa = 0;
    @endphp
    @foreach($productos->sortBy('categoria.nombre') as $producto)
    <tr>
      <td>{{$producto->categoria->nombre}}</td>
      <td>{{$producto->nombre}}</td>
      <td>{{$producto->umedida}}</td>
      <td class="text-center">{{ number_format($producto->stock) }}</td>
      <td class="text-center">{{$producto->medida}}</td>
      <td class="text-right">{{ number_format($producto->pcompra,2)}}</td>
      <td class="text-right">{{ number_format($impcosto = $producto->pcompra * $producto->stock, 2) }}</td>
      <td class="text-right">{{ number_format($producto->pventa,2) }}</td>
      <td class="text-right">{{ number_format($impventa = $producto->pventa * $producto->stock, 2) }}</td>
    </tr>
    @php
      $timpcosto += $impcosto;
      $timpventa += $impventa;
    @endphp
    @endforeach
    <tfoot class="bg-secondary">
      <tr>
        <th colspan="6" class="text-right">Subtotal</th>
          <th class="text-center">{{number_format($timpcosto,2)}}</th>
          <th></th>
          <th class="text-center">{{number_format($timpventa,2)}}</th>
      </tr>
      <tr>
        <th colspan="6" class="text-right">IVA</th>
          <th class="text-center">{{number_format($timpcosto*0.16,2)}}</th>
          <th></th>
          <th class="text-center">{{number_format($timpventa*0.16,2)}}</th>
      </tr>
      <tr>
        <th colspan="6" class="text-right">TOTALES</th>
          <th class="text-center">{{number_format($timpcosto*1.16,2)}}</th>
          <th></th>
          <th class="text-center">{{number_format($timpventa*1.16,2)}}</th>
      </tr>
    </tfoot>
  </tbody>
</table>
