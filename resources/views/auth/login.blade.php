<!DOCTYPE html>
<html>
<head>
  <title>{{\App\SiteSetting::name()}} | Login</title>
  
  <link href="{{ asset('Gawebny/css/bootstrap.min.css') }}" rel="stylesheet" id="bootstrap-css">
  <link href="{{ asset('Gawebny/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('Gawebny/css/login.css') }}" rel="stylesheet">
  <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>


    <div style="width: 70%" id="login-overlay" class="modal-dialog">
      <div  class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"><center><div class="text-danger"> {{\App\SiteSetting::name()}}</div> </center></h4>
      </div>
      <div class="modal-body">
          <div class="row">
            <div class="col-xs-6">
                <h2>{{trans('login.sign_in')}} </h2>
                <hr>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <a href="{{ url('login/facebook') }}" class="btn btn-lg btn-primary btn-block"><i class="fa fa-facebook-square" ></i> Facebook </a>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6">
                      <a href="{{ url('login/google') }}" class="btn btn-lg btn-danger btn-block"> <i class="fa fa-google"></i> Google</a>
                  </div>
              </div>
              <div class="login-or">
                <hr class="hr-or">
                <span class="span-or">{{trans('login.or')}}</span>
            </div>

            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group">
                  <input placeholder="{{trans('login.user_name')}}" id="email" type="email" class="form-control input-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                  @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
                  @endif
                  <span class="help-block"></span>
              </div>
              <div class="form-group">
                  <a class=" pull-right " href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                <input placeholder="{{trans('login.password')}}" id="password" type="password" class="form-control input-lg {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
              @endif
          </div>
          <div class="custom-control custom-checkbox">

              <div class="form-check">
                <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                  {{trans('login.remember_me')}}
              </label>
          </div>
      </div>
      <button type="submit" class="btn btn btn-primary col-xs-12 col-md-6 btn-block">
{{trans('login.login')}}
    </button>
</form>

</div>
<div class="col-xs-6">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <h2>{{trans('login.sign_up')}} </h2>
        <hr class="colorgraph">
        <div class="form-group">
            <input id="name" type="text" class="form-control input-lg {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" placeholder="{{trans('login.user_name')}}" value="{{ old('name') }}" required autofocus>
            @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('name') }}</strong>
          </span>
          @endif
      </div>
      <div class="form-group">
          <input id="email" placeholder="{{trans('login.email')}}" type="email" class="form-control input-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

          @if ($errors->has('email'))
          <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif

      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <input id="password" placeholder="{{trans('login.password')}}" type="password" class=" input-lg form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
              @endif
          </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <input id="password-confirm" type="password" class="form-control input-lg" name="password_confirmation" placeholder="{{trans('login.confirm_password')}}" required>
        </div>
    </div>
</div>
<div class="form-group">
 <div class="g-recaptcha" data-sitekey="6Le12XEUAAAAAMSBgKAesH7fj759L-eIO1aXdlwd"></div>
 @if ($errors->has('g-recaptcha-response'))
 <span class="invalid-feedback" role="alert">
    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
</span>
@endif

</div> 
<div class="form-group">
    <div class="col-xs-12 col-md-6 ">
      <button type="submit" class="btn btn-primary btn-block btn-lg pull-right">
        {{trans('login.register')}}
    </button>
</div>
</div>
</form>


</div>
</div>
</div>
<div class="modal-footer">
  <a href="#">العربية</a> , <a href="#">English</a>
</div>
</div>
</div>
</body>
</html>
