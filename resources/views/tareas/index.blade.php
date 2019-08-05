@extends('layouts.appv2')

@section('title',config('app.name').' | Tareas' )

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-0">
              <div class="card-header card-header-default">
                  <h3 class="card-title">Tareas</h3>
              </div>
                <div class="card-body">
                    <h1 class="pull-right">
                      @can('tareas-create')
                       <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('tareas.create') !!}">Agregar Nuevo</a>
                      @endcan
                    </h1>
                    <div class="content">
                        <div class="clearfix"></div>

                        @include('flash::message')

                        <div class="clearfix"></div>
                        <div class="box box-primary">
                            <div class="box-body">
                                    @include('tareas.table')
                                    <a class="btn btn-primary" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('tareas.todas') !!}">Todas las Tareas</a>
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
