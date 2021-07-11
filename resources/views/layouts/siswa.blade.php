<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ \Config::get('app.app_title') }} | Dashboard</title>
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('prakerin/dist/css/skins/_all-skins.min.css') }}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ asset('prakerin/bower_components/morris.js/morris.css') }}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('prakerin/bower_components/jvectormap/jquery-jvectormap.css') }}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('prakerin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('prakerin/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('prakerin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('prakerin/bower_components/select2/dist/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('prakerin/plugins/iCheck/all.css') }}">  
  <link rel="stylesheet" href="{{ asset('prakerin/plugins/timepicker/bootstrap-timepicker.min.css') }}">
  <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
  <style type="text/css">
    .stepwizard-step p {
        margin-top: 0px;
        color:#666;
    }
    .stepwizard-row {
        display: table-row;
    }
    .stepwizard {
        display: table;
        width: 100%;
        position: relative;
    }
    .stepwizard-step button[disabled] {
        /*opacity: 1 !important;
        filter: alpha(opacity=100) !important;*/
    }
    .stepwizard .btn.disabled, .stepwizard .btn[disabled], .stepwizard fieldset[disabled] .btn {
        opacity:1 !important;
        color:#bbb;
    }
    .stepwizard-row:before {
        top: 14px;
        bottom: 0;
        position: absolute;
        content:" ";
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-index: 0;
    }
    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
    }
    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }
  </style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="{{ url('dashboard') }}" class="navbar-brand"><b>{{ \Config::get('app.app_bold') }}</b> {{ \Config::get('app.app_nbold') }}</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        @php ($routes = Route::currentRouteName())
        @php ($route = explode('.', $routes))       
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li {!! ($routes == 'home') ? 'class="active"' : '' !!}><a href="{{ url('dashboard') }}">Dashboard</a></li>            
            <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
          </ul>   
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
            <input type="hidden" name="redrrt" value="{{ \Request::segment(1) }}">
          </form>       
        </div>        
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    @include('flash::message')
    @yield('content')
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.13
      </div>
      <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('prakerin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('prakerin/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('prakerin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="{{ asset('prakerin/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('prakerin/bower_components/morris.js/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('prakerin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('prakerin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('prakerin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('prakerin/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('prakerin/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('prakerin/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('prakerin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('prakerin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('prakerin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('prakerin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('prakerin/plugins/iCheck/icheck.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('prakerin/bower_components/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('plugins/mask-master/dist/jquery.mask.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('prakerin/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('prakerin/dist/js/pages/dashboard.js') }}"></script>
<script src="{{ asset('plugins/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('prakerin/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('prakerin/dist/js/demo.js') }}"></script>
<script src="{{ asset('js/main.js?v=1') }}"></script>
<script type="text/javascript">
  $('#modal-pengumuman').each(function(){
    $(this).modal('show');
  });

  $(document).ready(function () {
    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-success').addClass('btn-default');
            $item.addClass('btn-success');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function () {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-success').trigger('click');
  });

  $('.submit-activity').each(function(){
    var t = $(this);

    t.click(function(){
      var x = $(this),
          user = x.data('user'),
          materi = x.data('materi');

      $.post( "/dashboard/submit-activity", { user: user, materi: materi } );
    });
  })
</script>
</body>
</html>