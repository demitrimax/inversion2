@extends('layouts.appv2')

@section('stylesheets')
  <style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>
@endsection

@section('body-class')
  skin-blue sidebar-mini
@endsection
@section('body-style')
  height: auto; min-height: 100%;
@endsection
@section('content')
<section class="content-header">
      <h1>
        Perfil
        <small>Datos del usuario</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Perfil</li>
      </ol>
    </section>
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Hubo un error!</h4>
          <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
<section class="content">
	<div class="row">
        <!-- /.col -->
        <div class="col-md-6 col-md-offset-3">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username">{{ Auth::user()->name }}</h3>
              <h5 class="widget-user-desc">Miembro desde: {{ Auth::user()->created_at->format('M. Y') }}</h5>
            </div>
            <a href="#" data-toggle="modal" data-target="#modal-default">
            <div class="widget-user-image">
              @if (empty(Auth::user()->avatar))
                <img src="{{asset('avatar/avatar.png')}}" class="img-circle" alt="User Image"/>
              @else
                   <img src="{{asset('avatar/'.Auth::user()->avatar)}}" class="img-circle" alt="User Image" />
              @endif
            </div></a>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{ Auth::user()->cargo }}</h5>
                    <span class="description-text">CARGO</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{ Auth::user()->nombre.' '.Auth::user()->apellidos }}</h5>
                    <span class="description-text">NOMBRE COMPLETO</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">@if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                            <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                    @endif</h5>
                    <span class="description-text">ROLES</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-12 border-right">
                  <div class="description-block">
                    <h5 class="description-header">BIO</h5>
                    <span class="description-text">
                      @if (Auth::user()->bio)
                      {{ Auth::user()->bio }} <br>
                      <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-bio">Modificar Biografía</button>
                      @else
                      Pequeña biografia del usuario...<br>
                      <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-bio">Agregar Biografía</button>
                      @endif
                    </span>
                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-password">Actualizar Contraseña</button>
                  </div>
                  <!-- /.description-block -->
                </div>

              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>

      </div>

      <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Imagen de Avatar</h4>
              </div>
              <div class="modal-body">
                <form method="post" action="{{url('/avatarchan')}}" enctype="multipart/form-data">
                  {{ csrf_field() }}
                <img src="{{ asset('avatar/'.Auth::user()->avatar)}}" width="400">
                <p>Cambiar la imagen de Avatar</p>
                <input type="file" name="avatarimg" class="form-control" accept="image/*">
                <input type="hidden" name="iduser" value="{{ Auth::user()->id }}">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
    </div>
        <!-- /.modal -->
        <div class="modal fade" id="modal-bio">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Pequeña Biografía del Usuario</h4>
                </div>
                <div class="modal-body">
                  <form method="post" action="{{url('/profile/bio')}}">
                    {{ csrf_field() }}
                  <p>Este dato se usuará describir al usuario.</p>
                  <textarea class="form-control" rows="3" placeholder="Escriba su biografía" name="biotext" id="biotext"></textarea>
                  <input type="hidden" name="userid" value="{{ Auth::user()->id }}">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
      </div>
          <!-- /.modal -->
          <div class="modal fade" id="modal-password">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualice su contraseña</h4>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="{{url('/profile/password')}}" class="form-horizontal" id="passwordForm">
                      {{ csrf_field() }}
                      <div class="box-body">
                          <p>Profavor escriba su nueva contraseña.</p>
                          <div class="form-group">
                            {!! Form::label('passanterior', 'Contraseña anterior:', ['class'=>'col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                              {!! Form::password('passanterior', null, ['class'=>'form-control']) !!}
                            </div>
                          </div>
                            <div class="form-group">
                              {!! Form::label('password', 'Escriba su contraseña:', ['class'=>'col-sm-4 control-label']) !!}
                              <div class="col-sm-8">
                                {!! Form::password('password', null, ['class'=>'form-control']) !!}
                              </div>
                            </div>
                            <div class="form-group">
                              {!! Form::label('password_confirmation', 'confirme la contraseña:', ['class'=>'col-sm-4 control-label']) !!}
                              <div class="col-sm-8">
                                {!! Form::password('password_confirmation', null, ['class'=>'form-control']) !!}
                              </div>
                            </div>
                          <input type="hidden" name="userid" value="{{ Auth::user()->id }}">
                          <div class="alert alert-info alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <h4><i class="icon fa fa-info"></i> Reglas</h4>
                              La contraseña debe contener al menos 6 carácteres y como máximo 15, es permitido el uso de simbolos así como acentos.
                            </div>
                        </div>
                      </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                  </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
        </div>
            <!-- /.modal -->
</section>
@stop

@section('scripts')
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
<script>
$("#passwordForm").validate({
           rules: {
               password: {
                 required: true,
                    minlength: 6,
                    maxlength: 15,

               } ,

                   password_confirmation: {
                    equalTo: "#password",
                     minlength: 6,
                     maxlength: 15
               }


           },
     messages:{
         password: {
                 required:"Password Requerido",
                 minlength: "Minimo 6 caracteres",
                 maxlength: "Maximo 15 caracteres"
               },
       password_confirmation: {
         equalTo: "El password debe ser igual al anterior",
         minlength: "Minimo 6 caracteres",
         maxlength: "Maximo 10 caracteres"
       }
     }

});
</script>
@endsection
