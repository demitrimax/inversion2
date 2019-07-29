<!-- Id Field -->
<tr>
  <th>{!! Form::label('id', 'Id:') !!}</th>
  <td>{!! $operaciones->id !!}</td>
</tr>


<!-- Monto Field -->
<tr>
  <th>{!! Form::label('monto', 'Monto:') !!}</th>
  <td>{!! number_format($operaciones->monto,2) !!}</td>
</tr>


<!-- Empresa Id Field -->
<tr>
  <th>{!! Form::label('empresa_id', 'Empresa:') !!}</th>
  <td>{!! $operaciones->empresa->nombre !!}</td>
</tr>


<!-- Cuenta Id Field -->
<tr>
  <th>{!! Form::label('cuenta_id', 'Cuenta Id:') !!}</th>
  <td>{!! $operaciones->cuenta->numero !!}</td>
</tr>


<!-- Proveedor Id Field -->
<tr>
  <th>{!! Form::label('proveedor_id', 'Proveedor Id:') !!}</th>
  <td>{!! $operaciones->proveedor->nombre !!}</td>
</tr>


<!-- Numfactura Field -->
<tr>
  <th>{!! Form::label('numfactura', 'Numfactura:') !!}</th>
  <td>{!! $operaciones->numfactura !!}</td>
</tr>


<!-- Clasifica Id Field -->
<tr>
  <th>{!! Form::label('clasifica_id', 'Clasificación:') !!}</th>
  <td>{!! $operaciones->subclasifica->nombre !!}</td>
</tr>


<!-- Tipo Field -->
<tr>
  <th>{!! Form::label('tipo', 'Tipo:') !!}</th>
  <td>{!! $operaciones->tipo !!}</td>
</tr>


<!-- Metpago Field -->
<tr>
  <th>{!! Form::label('metpago', 'Método de pago:') !!}</th>
  <td>{!! $operaciones->metopago->nombre !!}</td>
</tr>


<!-- Concepto Field -->
<tr>
  <th>{!! Form::label('concepto', 'Concepto:') !!}</th>
  <td>{!! $operaciones->concepto !!}</td>
</tr>


<!-- Comentario Field -->
<tr>
  <th>{!! Form::label('comentario', 'Comentario:') !!}</th>
  <td>{!! $operaciones->comentario !!}</td>
</tr>


<!-- Fecha Field -->
<tr>
  <th>{!! Form::label('fecha', 'Fecha:') !!}</th>
  <td>{!! $operaciones->fecha->format('d-m-Y') !!}</td>
</tr>
