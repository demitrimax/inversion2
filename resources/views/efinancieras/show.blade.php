@extends('layouts.appv2')
@section('title',config('app.name').' | Efinancieras' )
@section('content')
    <section class="content-header">
        <h1>
            Efinanciera
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                <table class="table table-striped table-bordered detail-view" id="efinancieras-table">
                  <tbody>
                    @include('efinancieras.show_fields')
                    </tbody>
                  </table>
                    <a href="{!! route('efinancieras.index') !!}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
