<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<!-- head -->
@include('partials.head')
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
      @include('partials.errors')
      <!-- Your Page Content Here -->
      @yield('templates.body.content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    <!-- Main Footer -->
    @include('templates.Partials.footer')

  </div><!-- ./wrapper -->


 @include("partials.script")
</body> <!-- body -->
</html>
