@extends('layouts.appv2')
@section('title',config('app.name').' | Alta de Nuevo Credito' )

@section('css')
<link href="{{asset('appzia/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">
<link href="{{asset('airdatepicker/dist/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">

@endsection

@section('content')
<div class="row">
      <div class="col-lg-12">
          @include('adminlte-templates::common.errors')
          <div class="card bg-0">
              <div class="card-header card-header-default">
                  <h3 class="card-title">Alta de Creditos</h3>
              </div>
              <div class="card-body">
              {!! Form::open(['route' => 'creditos.store']) !!}

                  @include('creditos.fields')

              {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>

@endsection
