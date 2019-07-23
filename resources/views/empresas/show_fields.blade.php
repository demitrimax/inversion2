<div class="card card-rounded-0">
    <div class="card-header card-header-default">
        <h3 class="card-title">Detalle de la Empresa</h3>
    </div>
    <div class="card-body">
      <table class="table table-striped table-bordered detail-view" id="empresas-table">
        <tbody>

          <!-- Id Field -->
          <tr>
            <th>{!! Form::label('id', 'Id:') !!}</th>
            <td>{!! $empresas->id !!}</td>
          </tr>


          <!-- Nombre Field -->
          <tr>
            <th>{!! Form::label('nombre', 'Nombre:') !!}</th>
            <td>{!! $empresas->nombre !!}</td>
          </tr>

          <!-- Giro Field -->
          <tr>
            <th>{!! Form::label('rfc', 'RFC:') !!}</th>
            <td>{!! $empresas->rfc !!}</td>
          </tr>

          <!-- Giro Field -->
          <tr>
            <th>{!! Form::label('giro', 'Giro:') !!}</th>
            <td>{!! $empresas->giro !!}</td>
          </tr>


          <!-- Fcreacion Field -->
          <tr>
            <th>{!! Form::label('fcreacion', 'Fecha de creación:') !!}</th>
            <td>{!! $empresas->fcreacion->format('d-m-Y') !!}</td>
          </tr>

          <!-- Observaciones Field -->
          <tr>
            <th>{!! Form::label('saldo', 'Saldo al día:') !!}</th>
            <td>$ {!! $empresas->saldoaldia !!}

              <button type="button" class="btn btn-primary btn-icon rounded-circle mg-r-5 mg-b-10" data-toggle="tooltip" data-placement="top" title="Ver Detalles del Saldo"><div><i class="fa fa-money"></i></div></button>
            </td>
          </tr>

          <!-- Observaciones Field -->
          <tr>
            <th>{!! Form::label('observaciones', 'Observaciones:') !!}</th>
            <td>{!! $empresas->observaciones !!}</td>
          </tr>


          </tbody>
        </table>
</div>
</div>
