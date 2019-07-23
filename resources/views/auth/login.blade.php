@extends('layouts.appv2login')

@section('content')

<form class="form-horizontal m-t-20" method="POST" action="{{ route('login') }}">
    @csrf

<div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
  <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Proyectos <span class="tx-info tx-normal">Inversión</span></div>
  <div class="tx-center mg-b-60">Desarrollado para tu control</div>

  <div class="form-group">
    <input id="email" name="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" required="" placeholder="{{ __('E-Mail Address') }}">
    @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
  </div><!-- form-group -->
  <div class="form-group">
    <input id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" required="" placeholder="{{ __('Password') }}">
    @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
    <a href="{{ route('password.request') }}" class="tx-info tx-12 d-block mg-t-10"> {{ __('Forgot Your Password?') }}</a>
  </div><!-- form-group -->
  <button type="submit" class="btn btn-info btn-block">{{ __('Login') }}</button>

  <div class="mg-t-60 tx-center">No eres usuario? <a href="page-signup.html" class="tx-info">Crear una cuenta</a></div>
</div><!-- login-wrapper -->
        </form>

@endsection
