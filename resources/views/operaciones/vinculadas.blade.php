<h5>Operaciones Vinculadas</h5>
<table class="table table-bordered table-hover table-primary">
  <thead>
    <tr>
      <th>Núm</th>
      <th>Categoria</th>
      <th>Concepto</th>
      <th>Monto</th>
    </tr>
  </thead>
  <tbody>
    @foreach($operaciones->comisionadas as $key=>$comisionada)
    <tr>
      <td>{{$key+1}}</td>
      <td><a href="{{url('operaciones/'.$comisionada->comisionada->id)}}">{{$comisionada->comisionada->subclasifica->clasifica->nombre}}</a></td>
      <td>{{$comisionada->comisionada->concepto}}</td>
      <td>{{ number_format($comisionada->comisionada->monto,2)}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<button class="btn btn-teal mg-b-10">Nueva Operación Vinculada</button>
