@extends('layouts.applogin')

@section('content')

<div class="panel panel-color panel-primary panel-pages">
<div class="card-body">
  <h3 class="text-center m-t-0 m-b-15">
      <a href="{{url('/')}}" class="logo"><img src="{{asset('logos/logo_x_white.png')}}" alt="logo-img"></a>
  </h3>

  <h4 class="text-muted text-center m-t-0"><b>{{ __('Reset Password') }}</b></h4>


<form class="form-horizontal m-t-20" method="POST" aaction="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group">
        <div class="col-xs-12">
            <input id="email" name="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" placeholder="{{ __('E-Mail Address') }}" value="{{ $email ?? old('email') }}" required autofocus>
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


    <div class="form-group text-center m-t-40">
        <div class="col-xs-12">
            <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">{{ __('Reset Password') }}</button>
        </div>
    </div>

  </form>

  </div>
</div>

@endsection
