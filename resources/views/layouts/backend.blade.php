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
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/'.\Request::segment(1)) }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>{{ \Config::get('app.app_bold') }}</b> {{ \Config::get('app.app_nbold') }}</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>      
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('prakerin/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
              <span class="hidden-xs">
                {{ Auth::user()->name }}
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset('prakerin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                <p>
                  {{ Auth::user()->name }}
                  <small>{{ date('d F Y') }}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                @if(Auth::user()->perm_id != 4)
                  <div class="pull-left">
                    <a href="{{ url('dashboard/profiles') }}" class="btn btn-default btn-flat">Profile</a>
                  </div>
                @endif
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
                </div>
              </li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                  <input type="hidden" name="redrrt" value="{{ \Request::segment(1) }}">
                </form>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('prakerin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        @php ($routes = Route::currentRouteName())
        @php ($route = explode('.', $routes))
        @php ($perm = @unserialize(Auth::user()->perm->permission) ? @unserialize(Auth::user()->perm->permission) : [])
        @if(Request::segment(1) != 'cbt')
          <li class="{!! ($routes == 'dashboard')?'active':'' !!}">
            <a href="{{ url('dashboard') }}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>          
          @if(in_array('Jurusan',$perm))
            <li class="treeview {!! ($route['0'] == 'jurusans')?'active':'' !!}">
              <a href="#">
                <i class="fa fa-database"></i>
                <span>Data Master</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="{!! ($route['0'] == 'jurusans')?'active':'' !!}">
                    <a href="{{ url('dashboard/jurusans') }}"><i class="fa fa-circle-o" aria-hidden="true"></i>Jurusan</a>
                </li>                
              </ul>
            </li>
          @endif
          @if(in_array('User',$perm) || in_array('Role',$perm))            
            <li class="treeview {!! ($route['0'] == 'users' || $route['0'] == 'roles')?'active':'' !!}">
              <a href="#">
                <i class="fa fa-user-circle"></i>
                <span>Manajemen User</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                @if(in_array('User',$perm))
                  <li class="{!! ($route['0'] == 'users')?'active':'' !!}">
                    <a href="{{ url('dashboard/users') }}"><i class="fa fa-circle-o" aria-hidden="true"></i>User</a>
                  </li>
                @endif
                @if(in_array('Role',$perm))
                  <li class="{!! ($route['0'] == 'roles')?'active':'' !!}">
                    <a href="{{ url('dashboard/roles') }}"><i class="fa fa-circle-o" aria-hidden="true"></i>Roles</a>
                  </li>
                @endif
              </ul>
            </li>
          @endif
          @if(in_array('Siswa',$perm))
            <li class="{!! ($route['0'] == 'siswa')?'active':'' !!}">
              <a href="{{ url('dashboard/siswa') }}"><i class="fa fa-user-circle-o" aria-hidden="true"></i>Siswa</a>
            </li>
          @endif
          @if(in_array('Post',$perm))
            <li class="{!! ($route['0'] == 'post')?'active':'' !!}">
              <a href="{{ url('dashboard/post') }}"><i class="fa fa-comments-o" aria-hidden="true"></i>Post</a>
            </li>
          @endif
          <li class="{!! ($route['0'] == 'pengumumans')?'active':'' !!}">
            <a href="{{ url('dashboard/pengumumans') }}"><i class="fa fa-comments-o" aria-hidden="true"></i>Pengumuman</a>
          </li>
        @endif        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('flash::message')
    @yield('content')
    <!-- /.content -->
  </div>
  <div class="modal modal-success fade" id="modal-success">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="{{ url('cbt/update') }}">
          {{ csrf_field() }}
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Update Information</h4>
          </div>
          <div class="modal-body">
            <p>Ada update terhadap aplikasi, silahkan tekan tombol update</p>
          </div>
          <div class="modal-footer">
            <a type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</a>
            <input type="submit" name="submit" value="Update" class="btn btn-outline">
          </div>
        </form>
      </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0c
    </div>
    <strong>Copyright &copy; {{ date('Y') }} <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
    <div id="modal-delete" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <form class="form-horizontal" method="POST" action="{{ url('dashboard/fungsionals') }}" id="formDelete">
            <div class="modal-content">            
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Konfirmasi Hapus</h4>
                </div>
                <div class="modal-body">
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Cancel</a>            
                    <button type="submit" class="btn btn-success">Hapus</button>
                </div>        
            </div>
        </form>
      </div>
    </div>
    <div id="modal-bahas" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <form class="form-horizontal" method="POST" action="{{ url('dashboard/bahas-soal') }}" id="formDelete">
            <div class="modal-content">            
                {{ csrf_field() }}
                <input type="hidden" name="soal_id">
                <input type="hidden" name="ujian_id">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Pembahasan Soal</h4>
                </div>
                <div class="modal-body">
                    <textarea name="pembahasan" class="editor" id="soal"></textarea>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Cancel</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>        
            </div>
        </form>
      </div>
    </div>
    <div id="modal-share" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">  
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Konfirmasi Hapus</h4>
            </div>
            <div class="modal-body">
                <p>Silahkan Bagikan link URL Kode Ujian <span class="link"><a href="" target="_blank"></a></span></p>
            </div>          
            <div class="modal-footer">&nbsp;</div>  
        </div>
      </div>
    </div>

    <div id="modal-duplicate" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">  
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Konfirmasi Duplikasi Ujian</h4>
            </div>
            <form class="form-horizontal" method="POST" action="{{ url('dashboard/duplicate-ujian') }}" id="formDelete">
              {{ csrf_field() }}
              <input type="hidden" name="ujian_id">
              <div class="modal-body">
                <p>Apakah anda yakin akan duplikasi Ujian?</p>
              </div>  
              <div class="modal-footer">
                <a href="#" class="btn btn-default" data-dismiss="modal">Cancel</a>
                <button type="submit" class="btn btn-success">Duplicate</button>
              </div>
            </form>         
            <div class="modal-footer">&nbsp;</div>  
        </div>
      </div>
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
</body>
</html>