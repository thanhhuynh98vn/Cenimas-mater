<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Green Global | Reset Password</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{mix('css/app.css')}}">
  <script src="{{mix('js/app.js')}}"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Reset Password
      </b>GREENGLOBAL</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    {{--<p class="login-box-msg">Sign in to start your session</p>--}}

    <form action="{{ route('password.request') }}" method="post">
      <input type="hidden" name="token" value="{{ $token }}">
      <div class="form-group has-feedback">
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="Email..." required autofocus>
        @if ($errors->has('email'))
          <span class="invalid-feedback">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
        @endif
        {{--<span class="glyphicon glyphicon-envelope form-control-feedback"></span>--}}
      </div>
      <div class="form-group has-feedback">
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password..." name="password" required>
        @if ($errors->has('password'))
          <span class="invalid-feedback">
            <strong>{{ $errors->first('password') }}</strong>
          </span>
        @endif
      </div>
      <div class="form-group has-feedback">
        <input id="password-confirm" type="password" class="form-control" placeholder="Password confirmation..." name="password_confirmation" required>

  </div>
      <div class="row">
        {{--<div class="col-xs-8">--}}
          {{--<div class="checkbox icheck">--}}
            {{--<label>--}}
              {{--<input type="checkbox"> Remember Me--}}
            {{--</label>--}}
          {{--</div>--}}
        {{--</div>--}}
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">


      @if(Session::has('msg'))

          <span class="invalid-feedback">
                                        <strong style="color: red">{{Session::get('msg')}}</strong>
                                    </span>


      @endif
    </div>
    <!-- /.social-auth-links -->

    <a href="{{ route('login') }}">Or sign in as a different user</a> <br>
    <a href="{{ route('register') }}" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
{{--<script src="/adminlte/js/jquery.min.js"></script>--}}
{{--<!-- Bootstrap 3.3.7 -->--}}
{{--<script src="/adminlte/js/bootstrap.min.js"></script>--}}
{{--<!-- iCheck -->--}}
{{--<script src="/adminlte/js/icheck.min.js"></script>--}}
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
