@extends('layouts.appv2')
@section('title',config('app.name').' | Bancos' )
@section('content')
    <section class="content-header">
        <h1>
            Bancos
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">

                    @include('bancos.show_fields')

                    <a href="{!! route('bancos.index') !!}" class="btn btn-secondary">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
