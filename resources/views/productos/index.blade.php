@extends('layouts.appv2')

@section('title',config('app.name').' | Productos' )

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-0">
              <div class="card-header card-header-default">
                  <h3 class="card-title">Productos</h3>
              </div>
                <div class="card-body">
                    <h1 class="pull-right">
                      @can('productos-create')
                       <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('productos.create') !!}">Agregar Nuevo</a>
                      @endcan
                    </h1>
                    <div class="content">
                        <div class="clearfix"></div>

                        @include('flash::message')

                        <div class="clearfix"></div>
                        <div class="box box-primary">
                            <div class="box-body">
                                    @include('productos.table')
                            </div>
                            <a class="btn btn-xs btn-info" href="{{url('inventario/informe/productos')}}">Vista Reporte</a>
                        </div>
                        <div class="text-center">

                        </div>
                    </div>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div>
@endsection
