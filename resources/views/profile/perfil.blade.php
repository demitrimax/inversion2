@extends('layouts.appv2')

@section('title',config('app.name').' | Perfil de Usuario' )

@section('content')
<section class="content">

  <div class="row">

          <div class="col-lg-6">
            <div class="card card-primary">
              <div class="card-header card-header-default">
                <h3 class="card-title">Perfil del Usuario</h3>
              </div>
            <div class="card-body card-profile">
              <a href="#">
              <img class="wd-82 rounded-circle" src="{{asset(Auth::user()->uavatar)}}" width="50" alt="User profile picture">
            </a>
              <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

              <p class="text-muted text-center">{{Auth::user()->cargo}}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Miembro desde</b> <a class="pull-right">{{Auth::user()->created_at->format('M, Y')}}</a>
                </li>
                <li class="list-group-item">
                  <b>Correo Electronico</b> <a class="pull-right">{{Auth::user()->email}}</a>
                </li>
                <li class="list-group-item">
                  <b>Roles</b> <a class="pull-right">@foreach( Auth::user()->roles as $rol )
                    <span class="label label-success">{{$rol->name}}</span>
                  @endforeach</a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Editar Perfil</b></a>
            </div>
            <!-- /.box-body -->
          </div>

        </div>
        <div class="col-lg-6">
          <div class="card card-primary">
            <div class="card-header card-header-default">
              <h3 class="card-title">Tareas Asignadas Pendientes</h3>
            </div>
          <div class="card-body card-profile">
            <div class="col-md-12">
                      <h5>Progreso</h5>
                      <ul class="list-group">
                        @foreach( $vartareas as $key=>$tarea)
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{!! route('tareas.show', [$tarea->id]) !!}">{{$tarea->nombre}}</a>
                            @if($tarea->avance_porc)
                              <span class="badge badge-primary">{{$tarea->avance_porc}}%</span>
                              @endif
                          </li>
                          @endforeach
                      </ul>
                  </div>

          </div>
          <!-- /.box-body -->
        </div>
        <div class="card card-primary">
          <div class="card-header card-header-default">
            <h3 class="card-title">Todas mis tareas</h3>
          </div>
        <div class="card-body card-profile">
          <div class="col-md-12">
                    <h5>Progreso</h5>
                    <ul class="list-group">
                      @foreach( Auth::user()->tareas as $key=>$tarea)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          <a href="{!! route('tareas.show', [$tarea->id]) !!}">{{$tarea->nombre}}</a>
                          @if($tarea->avance_porc)
                            <span class="badge badge-primary">{{$tarea->avance_porc}}%</span>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>

        </div>
        <!-- /.box-body -->
      </div>

      </div>



</section>

@endsection
