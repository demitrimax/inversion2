
@extends('layouts.appv2')

@section('content')
    <div class="container -body-block pb-5">
        @card(['title' => 'Backups de la base de datos'])
            @component('backupv.menu-nav')
                <li class="nav-item active mr-3">
                    <a href="{{ url('backup/create') }}" class="nav-link text-primary" title="Crear nuevo backup">
                        <i class="fa fa-plus" aria-hidden="true"></i> Crear nuevo backup
                    </a>
                </li>
            @endcomponent
                    @include('flash::message')
            <div class="py-4"></div>
            @include('backupv.backups-table')
            <div class="py-3"></div>
        @endcard
    </div>
@endsection
