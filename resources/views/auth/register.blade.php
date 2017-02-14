@extends('layout2')
@section('content')



 <body class="be-splash-screen">
    <div class="be-wrapper be-login be-signup">
      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="splash-container sign-up">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
              <div class="panel-heading"><span style="font-size:24px;">Health Buddy</span></div>
              <div class="panel-body">
                <form action="{{ url('/register') }}" method="POST"><span class="splash-title xs-pb-20">Sign Up</span>
                {{ csrf_field() }}
                  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <input type="text" name="name" id="name" required="" placeholder="Name" autocomplete="off" class="form-control" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                  </div>

                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" name="email" id="email" required="" placeholder="E-mail" autocomplete="off" class="form-control" value="{{ old('email') }}">

                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                  </div>

                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} signup-password">
                    
                      <input id="password" name="password" placeholder="Password" type="password" required="" class="form-control">
                      @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                   




                   
                  </div>

                  <div class="form-group signup-password">
                    
                      <input id="password-confirm" name="password_confirmation" placeholder="Confirm Password" type="password" required="" class="form-control">
                    




                   
                  </div>
                  <div class="form-group xs-pt-10">
                    <button type="submit" class="btn btn-block btn-primary btn-xl">Sign Up</button>
                  </div>
                  
                  
                </form>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    
    
@endsection
