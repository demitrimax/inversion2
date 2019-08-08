@extends('layouts.appv2')
@section('title',config('app.name').' | Clientes' )
@section('content')
    <div class="content">
        <div class="card">
        <div class="card-header card-header-default">
          <h3 class="card-title">Clientes</h3>
        </div>
            <div class="card-body">
                <div class="row" style="padding-left: 20px">

                    @include('clientes.show_fields')

                    <a href="{!! route('clientes.index') !!}" class="btn btn-default">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
