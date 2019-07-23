@extends('layouts.appv2')

@section('title',config('app.name').' | Editar Usuario' )

@section('content')
    <section class="content-header">
        <h1>
            Editar Usuario
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
    <div class="row">
      <div class="col-md-6">
       <div class="box box-primary">
           <div class="box-body">

                   {!! Form::model($users, ['route' => ['users.update', $users->id], 'method' => 'patch']) !!}

                        @include('users.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
 </div>
@endsection
