<div class="panel panel-color panel-primary">
    <div class="card-header card-header-default">
        <h3 class="card-title">Detalles del Banco</h3>
    </div>
    <div class="card-body">

      <table class="table table-striped table-bordered detail-view" id="bancos-table">
        <tbody>
            <!-- Id Field -->
            <tr>
              <th>{!! Form::label('id', 'Id:') !!}</th>
              <td>{!! $bancos->id !!}</td>
            </tr>


            <!-- Nombre Field -->
            <tr>
              <th>{!! Form::label('nombre', 'Nombre:') !!}</th>
              <td>{!! $bancos->nombre !!}</td>
            </tr>


            <!-- Denominacionsocial Field -->
            <tr>
              <th>{!! Form::label('denominacionsocial', 'Denominacion Social:') !!}</th>
              <td>{!! $bancos->denominacionsocial !!}</td>
            </tr>


            <!-- Nombrecorto Field -->
            <tr>
              <th>{!! Form::label('nombrecorto', 'Nombre corto:') !!}</th>
              <td>{!! $bancos->nombrecorto !!}</td>
            </tr>


            <!-- Rfc Field -->
            <tr>
              <th>{!! Form::label('RFC', 'RFC:') !!}</th>
              <td>{!! $bancos->RFC !!}</td>
            </tr>


            <!-- Entidad Field -->
            <tr>
              <th>{!! Form::label('Entidad', 'Entidad:') !!}</th>
              <td>{!! $bancos->Entidad !!}</td>
            </tr>


            <!-- Grupofinancierto Field -->
            <tr>
              <th>{!! Form::label('grupofinancierto', 'Grupo Financierto:') !!}</th>
              <td>{!! $bancos->grupofinancierto !!}</td>
            </tr>


            <!-- Paginainternet Field -->
            <tr>
              <th>{!! Form::label('paginainternet', 'Pagina de internet:') !!}</th>
              <td>{!! $bancos->paginainternet !!}</td>
            </tr>


            <!-- Logo Field -->
            <tr>
              <th>{!! Form::label('logo', 'Logo:') !!}</th>
              <td>{!! $bancos->logo !!}</td>
            </tr>


            <!-- Email Field -->
            <tr>
              <th>{!! Form::label('email', 'Email:') !!}</th>
              <td>{!! $bancos->email !!}</td>
            </tr>

          </tbody>
      </table>

  </div>
</div>
