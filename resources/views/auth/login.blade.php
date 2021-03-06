@extends('layout2')
@section('content')

<body class="be-splash-screen">
    <div class="be-wrapper be-login">
      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="splash-container">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
              <div class="panel-heading" style="    margin-bottom: 0;"><span style="font-size:24px;">Health Buddy</span></div>
              <div class="panel-body">
                <form method="POST" action="{{ url('/login') }}"><span class="splash-title xs-pb-20">Login</span>
                    {{ csrf_field() }}
                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                     <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Email Address">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                  </div>
                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                    <input id="password" type="password" class="form-control" name="password" required placeholder="Password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                  </div>
                  <div class="form-group row login-tools">
                    <div class="col-xs-6 login-remember">
                      <div class="be-checkbox">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">Remember Me</label>
                      </div>
                    </div>
                    <div class="col-xs-6 login-forgot-password"><a href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a></div>
                  </div>
                  <div class="form-group login-submit">
                    <button data-dismiss="modal" type="submit" class="btn btn-primary btn-xl">Login</button>
                    <div>&nbsp;</div>
                    <a href="{{ url('/register') }}" data-dismiss="modal" class="btn btn-default btn-xl">Register</a>
                  </div>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>




@endsection
