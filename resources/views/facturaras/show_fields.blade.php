<div class="col-md-6">
<table class="table table-striped table-bordered detail-view" id="facturaras-table">
  <tbody>
    <!-- Id Field -->
    <tr>
      <th>{!! Form::label('id', 'Id:') !!}</th>
      <td>{!! $facturara->id !!}</td>
    </tr>


    <!-- Nombre Field -->
    <tr>
      <th>{!! Form::label('nombre', 'Nombre:') !!}</th>
      <td>{!! $facturara->nombre !!}</td>
    </tr>


    <!-- Rfc Field -->
    <tr>
      <th>{!! Form::label('rfc', 'RFC:') !!}</th>
      <td>{!! $facturara->rfc !!}</td>
    </tr>


    <!-- Direccion Field -->
    <tr>
      <th>{!! Form::label('direccion', 'Direccion:') !!}</th>
      <td>{!! $facturara->direccion !!}</td>
    </tr>

  </tbody>
</table>
</div>
@if($laimagen)
<div class="col-md-6">
    <img src="{!! asset($laimagen)!!}" width="400">
</div>
@endif
