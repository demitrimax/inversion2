<div class="col-lg-6">
    <div class="card bg-0">
        <div class="card-header card-header-default">
            <h3 class="card-title">Datos de la Cuenta</h3>
        </div>
        <div class="card-body">
          <table class="table table-striped table-bordered detail-view" id="bcuentas-table">
            <tbody>
                <!-- Id Field -->
                <tr>
                  <th>{!! Form::label('id', 'Id:') !!}</th>
                  <td>{!! $bcuentas->id !!}</td>
                </tr>


                <!-- Banco Id Field -->
                <tr>
                  <th>{!! Form::label('banco_id', 'Banco:') !!}</th>
                  <td>{!! $bcuentas->banco->nombrecorto !!}</td>
                </tr>


                <!-- Numcuenta Field -->
                <tr>
                  <th>{!! Form::label('numcuenta', 'Número de cuenta:') !!}</th>
                  <td>{!! $bcuentas->numcuenta !!}</td>
                </tr>


                <!-- Clabeinterbancaria Field -->
                <tr>
                  <th>{!! Form::label('clabeinterbancaria', 'Clabe interbancaria:') !!}</th>
                  <td>{!! $bcuentas->clabeinterbancaria !!}</td>
                </tr>


                <!-- Sucursal Field -->
                <tr>
                  <th>{!! Form::label('sucursal', 'Sucursal:') !!}</th>
                  <td>{!! $bcuentas->sucursal !!}</td>
                </tr>

                <tr>
                  <th>{!! Form::label('divisa', 'Moneda:') !!}</th>
                  <td>{!! $bcuentas->divisa !!}</td>
                </tr>

                <tr>
                  <th>{!! Form::label('saldo', 'Saldo:') !!}</th>
                  <td>{!! '$'.number_format($bcuentas->saldocuenta,2) !!}</td>
                </tr>


                <!-- Empresa Id Field -->
                <tr>
                  <th>{!! Form::label('empresa_id', 'Empresa:') !!}</th>
                  <td>
                    @foreach($bcuentas->empresa as $empres)
                    <a href="{!! route('empresas.show', [$empres->id]) !!}">{!! $empres->nombre !!}</a>
                    @endforeach
                  </td>
                </tr>


                <!-- Swift Field -->
                <tr>
                  <th>{!! Form::label('swift', 'Clabe Swift:') !!}</th>
                  <td>{!! $bcuentas->swift !!}</td>
                </tr>

              </tbody>
          </table>
        </div>
    </div>
</div>
