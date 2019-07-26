@extends('layouts.appv2')
@section('title',config('app.name').' | Subclasificas' )
@section('content')
    <section class="content-header">
        <h1>
            SubCategoría
        </h1>
    </section>
    <div class="content">
        <div class="card">
        <div class="card-header card-header-default">
          <h3 class="card-title">SubCategoría</h3>
        </div>
            <div class="card-body">
                <div class="row" style="padding-left: 20px">

                    @include('subclasificas.show_fields')

                    <a href="{!! route('subclasificas.index') !!}" class="btn btn-primary">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
