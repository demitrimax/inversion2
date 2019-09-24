<table class="table table-striped table-bordered detail-view" id="operaciones-table">
  <tbody>
      <!-- Id Field -->
      <tr>
        <th>{!! Form::label('id', 'Id:') !!}</th>
        <td>{!! $operaciones->id !!}</td>
      </tr>


      <!-- Monto Field -->
      <tr>
        <th>{!! Form::label('monto', 'Monto:') !!}</th>
        <td>
          {!! $operaciones->comisionable == 1 ? number_format($operaciones->monto_comision,2) : number_format($operaciones->monto,2) !!}
          @if($operaciones->facturas->count()>0)
              <ul class="list-group">
                @foreach($operaciones->facturas as $factura)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  {{$factura->numfactura}}

                  <span class="badge badge-primary badge-pill">{!! number_format($factura->monto,2) !!}</span>
                </li>
                @endforeach
              </ul>
              @endif
        </td>
      </tr>
      @if($operaciones->comisionable == 1)
      <!-- Empresa Id Field -->
      <tr>
        <th>{!! Form::label('comisionable', 'Monto Comisionable:') !!}</th>
        <td>{!! number_format($operaciones->monto,2) !!}</td>
      </tr>
    @endif

      <!-- Empresa Id Field -->
      <tr>
        <th>{!! Form::label('empresa_id', 'Empresa:') !!}</th>
        <td>{!! $operaciones->empresa->nombre !!}</td>
      </tr>


      <!-- Cuenta Id Field -->
      <tr>
        <th>{!! Form::label('cuenta_id', 'Cuenta:') !!}</th>
        <td>{!! $operaciones->cuenta->nomcuenta !!}</td>
      </tr>


      <!-- Proveedor Id Field -->
      <tr>
        <th>{!! Form::label('proveedor_id', 'Proveedor:') !!}</th>
        <td>{!! $operaciones->proveedor->nombre !!}</td>
      </tr>


      <!-- Numfactura Field -->
      <tr>
        <th>{!! Form::label('numfactura', 'Número de factura:') !!}</th>
        <td>{!! $operaciones->numfactura !!}</td>
      </tr>


      <!-- Clasifica Id Field -->
      <tr>
        <th>{!! Form::label('clasifica_id', 'Clasificación:') !!}</th>
        <td>{!! $operaciones->subclasifica->clasifica->nombre.' : '.$operaciones->subclasifica->nombre !!}</td>
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
  </tbody>
</table>
