@extends('layouts.appv2')
@section('title',config('app.name').' | Editar Empresa' )
@section('content')
<div class="row">
      <div class="col-lg-12">
          @include('adminlte-templates::common.errors')
          <div class="card bg-0">
              <div class="card-header card-header-default">
                  <h3 class="card-title">Editar Empresa</h3>
              </div>
              <div class="card-body">
              {!! Form::model($facturara, ['route' => ['facturaras.update', $facturara->id], 'method' => 'patch', 'enctype'=>'multipart/form-data']) !!}
                  <div class="row">
                    <div class="col-md-6">
                      @include('facturaras.fields')
                    </div>
                   <div class="col-md-6">
                     @if($laimagen)
                     <img src="{!! $laimagen !!}" width="300">
                     @endif
                     @include('facturaras.fields_parametros')
                 </div>
               </div>

              {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>
@endsection
