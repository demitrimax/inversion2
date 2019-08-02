@extends('layouts.appv2')
@section('title',config('app.name').' | Tareas' )
@section('content')

    <div class="content">
        <div class="card">
        <div class="card-header card-header-default">
          <h3 class="card-title">Detalle de la Tarea</h3>
        </div>
            <div class="card-body">
                <div class="row" style="padding-left: 20px">

                    @include('tareas.show_fields')

                    <a href="{!! route('tareas.index') !!}" class="btn btn-secondary">Regresar</a>
                    @can('tareas-edit')
                    <a href="{!! route('tareas.edit', [$tareas->id]) !!}" class='btn btn-primary'>Editar</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
