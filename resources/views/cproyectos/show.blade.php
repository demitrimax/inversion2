@extends('layouts.appv2')
@section('title',config('app.name').' | Detalles del Proyecto' )
@section('content')

    <div class="content">
        <div class="card bg-0">
            <div class="card-body">
                <div class="row" style="padding-left: 20px">

                    @include('cproyectos.show_fields')


                </div>
                <a href="{!! route('cproyectos.index') !!}" class="btn btn-primary">Regresar</a>
            </div>
        </div>
    </div>
@endsection
