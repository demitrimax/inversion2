<h5>Operaciones de Traspasos</h5>
<table class="table table-bordered table-hover table-primary">
  <thead>
    <tr>
      <th>Núm</th>
      <th>Cta Origen</th>
      <th>Cta Destino</th>
      <th>Concepto</th>
      <th>Monto</th>
      <th>Fecha</th>
    </tr>
  </thead>
  <tbody>
    @foreach($operaciones->traspasos as $key=>$traspaso)
    <tr>
      <td>{{$key+1}}</td>
      <td>{{$traspaso->ctaorigen->nomcuenta }}</td>
      <td>{{$traspaso->ctadestino->nomcuenta}}</a></td>
      <td>{{$traspaso->concepto}}</td>
      <td>{{ number_format($traspaso->monto,2)}}</td>
      <td>{{ $traspaso->fecha->format('d-m-Y') }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
