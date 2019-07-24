@extends('layouts.appv2')
@section('title',config('app.name').' | Detalles del Proyecto' )
@section('content')

    <div class="content">

        <div class="row row-sm mg-t-20">
          @include('cproyectos.detallefields')
          @include('cproyectos.detinversion')
        </div>
    </div>
@endsection
