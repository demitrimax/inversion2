@extends('layouts.appv2')
@section('title',config('app.name').' | Bancos' )
@section('content')
    <section class="content-header">
        <h1>
            Bancos
        </h1>
    </section>
    <div class="content">
        <div class="card card-primary">
            <div class="card-body">
                <div class="row" style="padding-left: 20px">

                    @include('bancos.show_fields')


                </div>
                <a href="{!! route('bancos.index') !!}" class="btn btn-secondary">Regresar</a>
                @can('bancos-edit')
                <a href="{!! route('bancos.edit', [$bancos->id]) !!}" class='btn btn-primary'>Editar</a>
                @endcan
            </div>
        </div>
    </div>
@endsection
