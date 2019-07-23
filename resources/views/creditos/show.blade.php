@extends('layouts.appv2')
@section('title',config('app.name').' | Creditos' )

@section('breadcrum')
<nav class="breadcrumb sl-breadcrumb">
  <a class="breadcrumb-item" href="{{url('/')}}">Principal</a>
  <a class="breadcrumb-item" href="{{url('/creditos')}}">Creditos</a>
  <span class="breadcrumb-item active">{{$creditos->nombre}}</span>
</nav>
@endsection

@section('content')

    <div class="content">
        <div class="card bg-0">
            <div class="card-body">
                <div class="row" style="padding-left: 20px">

                    @include('creditos.show_fields')

                    



                </div>
                <div class="row">
                    @include('creditos.corridafinan')
                  </div>
                <a href="{!! route('creditos.index') !!}" class="btn btn-secondary">Regresar</a>
            </div>
        </div>
    </div>
@endsection
