@extends('layouts.appv2')
@section('title',config('app.name').' | Minventarios' )
@section('content')

    <div class="content">
        <div class="card">
        <div class="card-header card-header-default">
          <h3 class="card-title">Mi nventario</h3>
        </div>
            <div class="card-body">
                <div class="row" style="padding-left: 20px">

                    @include('minventarios.show_fields')


                </div>
                <a href="{!! route('minventarios.index') !!}" class="btn btn-secondary">Regresar</a>
            </div>
        </div>
    </div>
@endsection
