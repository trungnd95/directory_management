<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<!-- head -->
@include('templates.partials.head')
<!-- end head -->

<!-- start body -->
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <!-- Main Header -->
    @include('templates.Partials.header')
    <!-- end header -->

    <!-- Left side column. contains the logo and sidebar -->
    @include('templates.Partials.sidebar')
    <!-- end sitebar -->

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="col-lg-12">
      @if(Session::has('flash_message'))
      <div class="alert alert-{{Session::get('flash_level')}}">
        {{Session::get('flash_message')}}
      </div>
      @endif
    </div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('templates.body.headTitle')
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      @include('templates.Partials.errors')
      <!-- Your Page Content Here -->
      @yield('templates.body.content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    <!-- Main Footer -->
    @include('templates.Partials.footer')

  </div><!-- ./wrapper -->


  <!-- REQUIRED JS SCRIPTS -->

  <!-- jQuery 2.1.4 -->
  <script src="{{asset('public/js/jQuery.min.js')}}"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="{{asset('public/bootstrap/js/bootstrap.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('public/admin/dist/js/app.min.js')}}"></script>
  <!-- Custom js -->
  <script src="{{asset('public/js/administration.js')}}"></script>
  <script src="{{asset('public/js/departments.js')}}"></script>
  <script src="{{asset('public/js/employees.js')}}"></script>
  <script src="{{asset('public/js/common.js')}}"></script>
  <!-- Sweet Alert  -->
  <script src="{{asset('public/sweetalert/sweetalert-master/dist/sweetalert.min.js')}}"></script>
</body> <!-- body -->
</html>
