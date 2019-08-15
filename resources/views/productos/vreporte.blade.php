@extends('layouts.appv2')

@section('title',config('app.name').' | Reporte de Existencia de Productos' )

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card bg-0">
          <div class="card-header card-header-default">
              <h3 class="card-title">Reporte de Existencia de Productos</h3>
          </div>
            <div class="card-body">
                <div class="content">
                    <div class="clearfix"></div>

                    @include('flash::message')

                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body">
                                @include('productos.tablever2')
                        </div>

                    </div>
                    <div class="text-center">

                    </div>
                </div>
            </div> <!-- panel-body -->
        </div> <!-- panel -->
    </div> <!-- col -->
</div>
@endsection
