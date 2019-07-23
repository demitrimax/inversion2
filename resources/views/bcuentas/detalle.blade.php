
<div class="col-md-12">
    <div class="card bg-0">
        <div class="card-header card-header-default">
            <h3 class="card-title">Detalles de Movimientos</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered detail-view">
              <thead class="bg-primary">
                <tr>
                    <td>No.</td>
                    <td>Fecha</td>
                    <td>Clase</td>
                    <td>Concepto</td>
                    <td>Tipo</td>
                    <td>Monto</td>
                    <td>Saldo</td>
                </tr>
              </thead>
              <tbody>
                @php
                  $saldo = 0;
                @endphp
                @foreach ($movimientos as $key=>$movimiento)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{ $movimiento['fecha']->format('d-m-Y')  }}</td>
                  <td>{{$movimiento['clase']}}</td>
                  <td>{{$movimiento['concepto']}}</td>
                  <td>{{ $movimiento['tipo']}}</td>
                  <td>
                    @if($movimiento['tipo'] == 'Cargo')
                    {{number_format( $monto = -$movimiento['monto'],2)}}
                    @else
                    {{number_format( $monto = $movimiento['monto'],2)}}
                    @endif

                  </td>
                  <td> {{ number_format($saldo += $monto,2)  }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
    </div>
</div>
