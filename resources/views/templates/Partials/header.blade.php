<header class="main-header">

  <!-- Logo -->
  <a href="index2.html" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">Trung Manucian</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Trung Manucian</b></span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- feed back of user  -->
        <li class="feedback">
            <a href="{{route('guest.feedback')}}" ><i class="fa fa-comment"></i> Feedback</a>
        </li>
        @if(Auth::check())
          <li class="logout">
            <a href="{{ url('/logout')}}"> <i class="fa fa-sign-out"></i> Logout</a>
          </li>
        @endif
      </ul>
    </div>
  </nav>
</header>