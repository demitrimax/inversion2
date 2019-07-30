@extends('layouts.appv2')
@section('title',config('app.name').' | Categorías' )

@section('content')

    <div class="content">
      <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header card-header-default">
              <h3 class="card-title">Categoría </h3>
          </div>
            <div class="card-body">
                <div class="row">

                    @include('clasificas.show_fields')
                    <a href="{!! route('clasificas.index') !!}" class="btn btn-secondary">Regresar</a>

                    @can('clasificas-edit')
                    <a href="{!! route('clasificas.edit', [$clasifica->id]) !!}" class='btn btn-primary'>Editar</a>
                    @endcan

                </div>
            </div>
        </div>
    </div>
    @include('clasificas.subcategorias')
  </div>
  </div>
@endsection
