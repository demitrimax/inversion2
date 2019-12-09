@extends('layouts.appv2')
@section('title',config('app.name').' | Operaciones' )
@section('content')

@php
  $miclass = 'col-md-12';
  if ($operaciones->comisionable == 1 || $operaciones->inventarios->count() > 0) {
    $miclass = 'col-md-6';
  }
@endphp
    <div class="content">
        <div class="card">
        <div class="card-header card-header-default">
          <h3 class="card-title">Detalle de Operación</h3>
        </div>
            <div class="card-body">
                <div class="row" style="padding-left: 20px">
                    <div class="{!! $miclass !!}">
                      @include('operaciones.show_fields')
                    </div>
                    @if($operaciones->comisionable == 1)
                      <div class="col-md-6">
                        @include('operaciones.vinculadas')
                      </div>
                    @endif
                    @if($operaciones->inventarios->count() > 0)
                        <div class="col-md-6">
                          @include('operaciones.inventario')
                        </div>
                    @endif

                    @if($operaciones->traspasos->count() > 0)
                    <div class="col-md-6">
                      @include('operaciones.traspasos')
                    </div>
                    @endif

                    <div class="col-md-12">
                      @can('operaciones-edit')
                      <a href="{!! route('operaciones.edit', [$operaciones->id]) !!}" class='btn btn-primary'>Editar</a>
                      @endcan
                        <a href="{!! route('operaciones.index') !!}" class="btn btn-secondary">Regresar</a>
                  </div>
                </div>

            </div>
        </div>
    </div>

    @stack('modals')
@endsection
