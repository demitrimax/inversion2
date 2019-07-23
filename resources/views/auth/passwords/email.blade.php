@extends('layouts.applogin')

@section('content')
      <div class="panel panel-color panel-primary panel-pages">
            <div class="card-body">
                    <h3 class="text-center m-t-0 m-b-15">
                        <a href="{{url('/')}}" class="logo"><img src="{{asset('logos/logo_x_white.png')}}" alt="logo-img"></a>
                    </h3>
                    <h4 class="text-muted text-center m-t-0"><b>{{ __('Reset Password') }}</b></h4>

                    <form class="form-horizontal m-t-20" method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            Introduzca su <b>Email</b> y las instrucciones le serán enviadas!
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" required="" placeholder="{{ __('E-Mail Address') }}" id="email" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group text-center m-t-30 m-b-0">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">{{ __('Send Password Reset Link') }}</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>


@endsection
