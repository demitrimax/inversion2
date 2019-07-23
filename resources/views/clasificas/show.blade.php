@extends('layouts.appv2')
@section('title',config('app.name').' | Clasificas' )
@section('content')
    <section class="content-header">
        <h1>
            Clasifica
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                <table class="table table-striped table-bordered detail-view" id="clasificas-table">
                  <tbody>
                    @include('clasificas.show_fields')
                    </tbody>
                  </table>
                    <a href="{!! route('clasificas.index') !!}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
