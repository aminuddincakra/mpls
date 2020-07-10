<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KONSEEN.ID | Materi</title>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="../../index2.html"><b>Prakerin</b>SMK</a>
  </div>
  <!-- User name -->
  <div class="lockscreen-name">{{ $materi->name }}</div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="{{ asset('prakerin/dist/img/user1-128x128.jpg') }}" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials" method="POST" action="{{ url('ikuti-ujian') }}">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="password" value="Materi {{ $materi->name }}" disabled="disabled">

        <div class="input-group-btn">
          <a class="btn" href="{{ url('read/'.$materi->slug) }}" {!! ($materi->status == '')?'disabled="disabled"':'' !!}><i class="fa fa-arrow-right text-muted"></i></a>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  @if($materi->status == '')
    <div class="help-block text-center">
      Materi sedangt tidak aktif
    </div>
  @endif
  <!-- /.lockscreen-item -->
  <div class="lockscreen-footer text-center">
    Copyright &copy; {{ date('Y') }} <b><a href="https://adminlte.io" class="text-black">Sutabu</a></b><br>
    All rights reserved
  </div>
</div>
<!-- /.center -->

<!-- jQuery 3 -->
<script src="{{ asset('prakerin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('prakerin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>
</html>
