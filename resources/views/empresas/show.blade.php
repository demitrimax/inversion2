@extends('layouts.appv2')
@section('title',config('app.name').' | Empresa '.$empresas->nombre )
@section('breadcrum')
<nav class="breadcrumb sl-breadcrumb">
  <a class="breadcrumb-item" href="{{url('/')}}">Principal</a>
  <a class="breadcrumb-item" href="{{url('/empresas')}}">Empresas</a>
  <span class="breadcrumb-item active">{{$empresas->nombre}}</span>
</nav>
@endsection

@section('content')

<div class="clearfix"></div>

@include('flash::message')

<div class="clearfix"></div>

    <div class="content">
      <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-body">
                <div class="row" style="padding-left: 20px">
                    @include('empresas.show_fields')
                </div>
            </div>
            <div class="card-footer tx-center bg-gray-300">
              <a href="{!! route('empresas.index') !!}" class="btn btn-primary">Regresar</a>
            </div>
          </div>
        </div>

            <div class="col-md-6">
              <div class="card card-primary">
                <div class="card-body">
                  @include('empresas.resumenopera')
                </div>
              </div>
            </div>
          </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-body">
          @include('empresas.accordion')
        </div>
      </div>
    </div>
  </div>

</div>
@endsection

@section('scripts')
  @stack('scripts')
@endsection
