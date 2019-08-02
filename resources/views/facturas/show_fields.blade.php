<table class="table table-striped table-bordered detail-view" id="facturas-table">
  <tbody>

    <!-- Id Field -->
    <tr>
      <th>{!! Form::label('id', 'Id:') !!}</th>
      <td>{!! $facturas->id !!}</td>
    </tr>


    <!-- Numfactura Field -->
    <tr>
      <th>{!! Form::label('numfactura', 'Numfactura:') !!}</th>
      <td>{!! $facturas->numfactura !!}</td>
    </tr>


    <!-- Monto Field -->
    <tr>
      <th>{!! Form::label('monto', 'Monto:') !!}</th>
      <td>{!! $facturas->monto !!}</td>
    </tr>


    <!-- Concepto Field -->
    <tr>
      <th>{!! Form::label('concepto', 'Concepto:') !!}</th>
      <td>{!! $facturas->concepto !!}</td>
    </tr>


    <!-- Observaciones Field -->
    <tr>
      <th>{!! Form::label('observaciones', 'Observaciones:') !!}</th>
      <td>{!! $facturas->observaciones !!}</td>
    </tr>

  </tbody>
</table>
