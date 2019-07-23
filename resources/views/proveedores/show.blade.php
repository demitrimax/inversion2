@extends('layouts.appv2')
@section('title',config('app.name').' | Proveedores' )

@section('breadcrum')
<nav class="breadcrumb sl-breadcrumb">
  <a class="breadcrumb-item" href="{{url('/')}}">Principal</a>
  <a class="breadcrumb-item" href="{{url('/proveedores')}}">Proveedores</a>
  <span class="breadcrumb-item active">{{$proveedores->nombre}}</span>
</nav>
@endsection

@section('content')
    <section class="content-header">

    </section>
    <div class="content">
        <div class="card bd-0">
          <div class="card-header card-header-default">
            <h3 class="card-title"> Proveedores     </h3>
          </div>
            <div class="card-body">
                <div class="row" style="padding-left: 20px">

                    @include('proveedores.show_fields')

                    <a href="{!! route('proveedores.index') !!}" class="btn btn-secondary">Regresar</a>
                    @can('proveedores-edit')
                    <a href="{!! route('proveedores.edit', [$proveedores->id]) !!}" class='btn btn-primary'>Editar</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
