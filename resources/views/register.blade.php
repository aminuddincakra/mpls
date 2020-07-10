<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Prakerin SMK N 1 Rembang | Register</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('prakerin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('prakerin/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('prakerin/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('prakerin/dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('prakerin/plugins/iCheck/square/blue.css') }}">

  <link rel="stylesheet" href="{{ asset('prakerin/bower_components/select2/dist/css/select2.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="{{ url('/') }}"><b>{{ \Config::get('app.app_bold') }}</b>{{ \Config::get('app.app_nbold') }}</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    @include('flash::message')
    <form class="form-signin" role="form" method="POST" action="{{ route('register') }}">
      {{ csrf_field() }}
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email_reg" value="{{ old('email_reg') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>      
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>      
      <a href="{{ url('/auth/google') }}" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>

    <a href="{{ url('login') }}" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="{{ asset('prakerin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('prakerin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('prakerin/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('prakerin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
  $('.icheck').each(function(){
    var t = $(this);
        inp = t.find('input'),
        cek = t.find('input:checked'),
        form = inp.closest('form'),
        button = form.find('button[type="submit"]');

    inp.iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });

    function ceks(){
      if(cek.length == 0){
        button.prop('disabled', true);
      }else{
        button.prop('disabled', false);
      }
    }ceks();

    inp.on('ifChanged', function(event) {
      if(event.target.checked === true){
        button.prop('disabled', false);
      }else{
        button.prop('disabled', true);
      }
    });
  });

  $('.select2').each(function(){
    $(this).select2();
  })
</script>
</body>
</html>
