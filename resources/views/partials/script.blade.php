 <!-- REQUIRED JS SCRIPTS -->

  <!-- jQuery 2.1.4 -->
  <script src="{{asset('public/js/jQuery.min.js')}}"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="{{asset('public/bootstrap/js/bootstrap.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('public/admin/dist/js/app.min.js')}}"></script>
  <script src="{{ url('public/admin/plugins/iCheck/icheck.min.js') }}"></script>
  <!-- Custom js -->
  <script src="{{asset('public/js/administration.js')}}"></script>
  <script src="{{asset('public/js/departments.js')}}"></script>
  <script src="{{asset('public/js/employees.js')}}"></script>
  <script src="{{asset('public/js/common.js')}}"></script>
  <script src="{{asset('public/js/modernizr.custom.79639.js')}}"></script>
  <!-- Sweet Alert  -->
  <script src="{{asset('public/sweetalert/sweetalert-master/dist/sweetalert.min.js')}}"></script>
  @include('sweet::alert')
