@extends('layouts.appv2')
@section('title',config('app.name').' | Invproveedores' )
@section('content')
    <section class="content-header">
        <h1>
            Invproveedores
        </h1>
    </section>
    <div class="content">
        <div class="card">
        <div class="card-header card-header-default">
          <h3 class="card-title">Invproveedores</h3>
        </div>
            <div class="card-body">
                <div class="row" style="padding-left: 20px">
                <table class="table table-striped table-bordered detail-view" id="invproveedores-table">
                  <tbody>
                    @include('invproveedores.show_fields')
                    </tbody>
                  </table>
                    <a href="{!! route('invproveedores.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
