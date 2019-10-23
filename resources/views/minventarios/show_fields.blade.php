<div class="col-md-6">

    <table class="table table-striped table-bordered detail-view" id="minventarios-table">
      <tbody>

    <!-- Concepto Field -->
    <tr>
      <th>{!! Form::label('concepto', 'Concepto:') !!}</th>
      <td>{!! $minventario->concepto !!}</td>
    </tr>


    <!-- Descripcion Field -->
    <tr>
      <th>{!! Form::label('descripcion', 'Descripcion:') !!}</th>
      <td>{!! $minventario->descripcion !!}</td>
    </tr>


    <!-- Marca Field -->
    <tr>
      <th>{!! Form::label('marca', 'Marca:') !!}</th>
      <td>{!! $minventario->marca !!}</td>
    </tr>


    <!-- Codigo Field -->
    <tr>
      <th>{!! Form::label('codigo', 'Codigo:') !!}</th>
      <td>{!! $minventario->codigo !!}</td>
    </tr>


    <!-- Montocompra Field -->
    <tr>
      <th>{!! Form::label('montocompra', 'Monto de compra:') !!}</th>
      <td>{!! $minventario->montocompra !!}</td>
    </tr>


    <!-- Resguardoa Field -->
    <tr>
      <th>{!! Form::label('resguardoa', 'Resguardo a:') !!}</th>
      <td>{!! $minventario->resguardoa !!}</td>
    </tr>

    </tbody>
    </table>
  </div>
  <div class="col-md-6">
    @if($minventario->fileresguardo)
    @card(['title'=>'Documento de resguardo', 'color'=>'danger'])
    <div class="col-sm-12">
      <embed src="{{url('minventario/resguardo/'.$minventario->id)}}" width="600" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
    </div>
    @endcard
    @endif
  </div>
