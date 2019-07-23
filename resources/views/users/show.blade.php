@extends('layouts.appv2')

@section('title',config('app.name').' | Usuario '.$users->name )

@section('content')
    <section class="content-header">
        <h1>
            Usuario de la Aplicación 
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('users.show_fields')
                    <a href="{!! route('users.index') !!}" class="btn btn-secondary">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
