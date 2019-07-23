@extends('layouts.appv2')
@section('title',config('app.name').' | Editar Creditos' )
@section('content')
<div class="row">
      <div class="col-lg-12">
          @include('adminlte-templates::common.errors')


        <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        ADVERTENCIA: Modificar los datos de un credito puede afectar considerablemente la corrida financiera y los pagos efectuados.
        Asegurese de Eliminar los datos de la Corrida Financiera.
    </div>
          <div class="card bg-0">
              <div class="card-header card-header-default">
                  <h3 class="card-title">Editar Credito: {{$creditos->nombre}}</h3>
              </div>
              <div class="card-body">
              {!! Form::model($creditos, ['route' => ['creditos.update', $creditos->id], 'method' => 'patch']) !!}

                   @include('creditos.fields')

              {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>
@endsection
