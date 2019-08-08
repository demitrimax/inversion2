@extends('layouts.appV2')
@section('title',config('app.name').' | Categorias' )
@section('content')

    <div class="content">
        <div class="card">
        <div class="card-header card-header-default">
          <h3 class="card-title">Detalle de la Categoria</h3>
        </div>
            <div class="card-body">
                <div class="row" style="padding-left: 20px">

                    @include('categorias.show_fields')

                    <a href="{!! route('categorias.index') !!}" class="btn btn-secondary">Regresar</a>
                    @can('categorias-edit')
                    <a href="{!! route('categorias.edit', [$categorias->id]) !!}" class='btn btn-primary btn-xs'>Editar</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
