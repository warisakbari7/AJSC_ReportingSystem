<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AJSC</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Bootstrap 4 RTL -->
  <link rel="stylesheet" href="{{asset('bootstrap.min.css')}}">
  <!-- Custom style for RTL -->
  <link rel="stylesheet" href="{{asset('dist/css/custom.css')}}">

  @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav mr-auto-navbav">
      <li class="nav-item">
        <a class="nav-link" href="" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i>
        </a>
        <form id="logout-form" action="{{route('logout')}}" method="POST" class="d-none">
          @csrf
        </form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: #51131c !important ;">
    <!-- Brand Logo -->
    <a href="https://ajsc.af" target="_blank" class="brand-link">
      <div class="brand-text font-weight-light text-center">AJSC</div>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center justify-content-center">
        <div class="info">
          <a class="d-block text-white">{{Auth::user()->name }} {{Auth::user()->lastname}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="/dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                داشبورد
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{route('changepass.create')}}" class="nav-link ">
              <i class="nav-icon fa fa-user-lock"></i>
              <p>
                تغییر رمز
              </p>
            </a>
          </li>
          @if(Auth::user()->user_type == 'reporter')


          <li class="nav-item has-treeview">
            <a href="{{route('reporterreport.index')}}" class="nav-link ">
              <i class="nav-icon fa fa-newspaper"></i>
              <p>
                گزارش ها 
              </p>
            </a>
          </li>
          @endif



          
          @if(Auth::user()->user_type == 'super_admin' || Auth::user()->user_type == 'admin')
          <li class="nav-item has-treeview">
            <a href="{{route('reportschedule.index')}}" class="nav-link ">
              <i class="nav-icon fa fa-calendar-alt"></i>
              <p>
                فهرست تاریخ ها 
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-newspaper"></i>
              <p>
                گزارش
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('report.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>لیست گزارش ها</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('report.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ثبت گزارش</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                گزارش ماهانه 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('reportschedule.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>فهرست تاریخ ها </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('monthlyreport.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> فهرست گزارش ها</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('monthlyreport.info')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ثبت گزارش</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="{{route('zone.index')}}" class="nav-link ">
              <i class="nav-icon fa fa-compass"></i>
              <p>
               زون ها
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="{{route('province.index')}}" class="nav-link ">
              <i class="nav-icon fa fa-map-marker-alt"></i>
              <p>
                ولایات
              </p>
            </a>
          </li>
          
          <li class="nav-item has-treeview">
            <a href="{{route('reporter.index')}}" class="nav-link ">
              <i class="nav-icon fa fa-users"></i>
              <p>
                 گزارشگرها
              </p>
            </a>
          </li>
         
          @endif
          
          @if (Auth::user()->user_type == 'super_admin')

          <li class="nav-item has-treeview">
            <a href="{{route('super-admin.index')}}" class="nav-link ">
              <i class="nav-icon fa fa-user-tie"></i>
              <p>
                سوپر ادمین
              </p>
            </a>
          </li>


          <li class="nav-item has-treeview">
            <a href="{{route('admin.index')}}" class="nav-link ">
              <i class="nav-icon fa fa-user-alt"></i>
              <p>
                ادمین ها 
              </p>
            </a>
          </li>

          @endif
          <li class="nav-item has-treeview">

              <a class="nav-link" href="" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                خروج
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 d-flex justify-content-between">
            <h4 class="m-0 text-dark">
              @section('pagetitle')
              @show
            </h4>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        @section('content')
        
        @show
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer text-center">
    <strong>Developed by <a href="https://asoft-af.com" target="_blank"> <span style="color: #e28818;">A</span>SOFT</a></strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>  
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


@include('sweetalert::alert')






<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 rtl -->
<script src="{{asset('bootstrap.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>

@stack('scripts')
<script>
  $('ul>li>a[href="'+location.href+'"]').parents('ul').css('display','block');
  $('ul>li>a[href="'+location.href+'"]').addClass('bg-secondary')
</script>
</body>
</html>