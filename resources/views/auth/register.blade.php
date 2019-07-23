@extends('layouts.applogin')

@section('content')

<div class="wrapper-page">
            <div class="panel panel-color panel-primary panel-pages">

                <div class="card-body">
                    <h3 class="text-center m-t-0 m-b-15">
                        <a href="index.html" class="logo"><img src="{{asset('logos/logo_x_white.png')}}" alt="logo-img"></a>
                    </h3>
                    <h4 class="text-muted text-center m-t-0"><b>Registro</b></h4>

                    <form class="form-horizontal m-t-20" method="POST" action="{{ route('register') }}">
                        @csrf

                      <div class="form-group">
                          <div class="col-xs-12">
                              <input id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}" required autofocus>
                              @if ($errors->has('name'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" placeholder="{{ __('E-Mail Address') }}" id="email" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" placeholder="{{ __('Password') }}" id="password" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" placeholder="{{ __('Confirm Password') }}" id="password-confirm" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox-signup" type="checkbox" checked="checked">
                                    <label for="checkbox-signup">
                                        Acepto los <a href="#">Terminos y condiciones</a>
                                    </label>
                                </div>

                            </div>
                        </div>

                        <div class="form-group text-center m-t-40">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">Registro</button>
                            </div>
                        </div>

                        <div class="form-group m-t-30 m-b-0">
                            <div class="col-sm-12 text-center">
                                <a href="{{url('login')}}" class="text-muted">Ya tengo una cuenta</a>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>

@endsection
