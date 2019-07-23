@extends('layouts.appv2')

@section('content')
    <section class="content-header">
        <h1>
            Crear usuario
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
      <div class="row">
        <div class="col-md-6">
        <div class="box box-primary">

            <div class="box-body">

                    {!! Form::open(['route' => 'users.store']) !!}

                        @include('users.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
