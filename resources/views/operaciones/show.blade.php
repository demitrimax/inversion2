@extends('layouts.appv2')
@section('title',config('app.name').' | Operaciones' )
@section('content')

    <div class="content">
        <div class="card">
        <div class="card-header card-header-default">
          <h3 class="card-title">Detalle de Operación</h3>
        </div>
            <div class="card-body">
                <div class="row" style="padding-left: 20px">

                    @include('operaciones.show_fields')

                  @can('operaciones-edit')
                  <a href="{!! route('operaciones.edit', [$operaciones->id]) !!}" class='btn btn-primary'>Editar</a>
                  @endcan
                    <a href="{!! route('operaciones.index') !!}" class="btn btn-secondary">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
