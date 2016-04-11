{{-- Side bar partial --}}
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel (optional) -->
    @if(\Auth::check())
    <div class="user-panel">
      <div class="pull-left image">
      @if(\Auth::user()->avatar != null)
      <img src="{{ asset('/public/upload/images/users/'.Auth::user()->avatar)}}" class="img-circle" alt="User Image">
      @else
      <img src="{{ asset('/public/upload/images/default-user.png')}}" class="img-circle" alt="User Image">
      @endif
      </div>
      <div class="pull-left info">

        <p>
          {{\Auth::user()->username }}
        </p>
        
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    @endif

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">Directory Management</li>
      <!-- Optionally, you can add icons to the links -->
      @if(\Auth::check())
      <li class="active"><a href="{{route('administration.index')}}"><i class="fa fa-lock"></i><span>Administrators</span></a></li>
      @endif
      <li class="treeview">
        <a href="{{route('departments.index')}}"><i class="fa fa-home"></i><span>Departments</span><i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
            <li><a href="{{route('departments.index')}}"><i class="fa fa-list"></i>List Departments</a></li>
            @if(\Auth::check())
            <li><a href="{{route('departments.add')}}"><i class="fa fa-plus-circle"></i>Add Department</a></li>
            @endif
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><i class="fa fa-user"></i><span>Employee</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{route('employees.index')}}"><i class="fa fa-list"></i>List Employees</a></li>
          @if(\Auth::check())
          <li><a href="{{route('employees.add')}}"><i class="fa fa-plus-circle"></i>Add Employee</a></li>
          @endif
        </ul>
      </li>
      @if(Auth::check())
        <li class="treeview">
          <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i><span>Feedback</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="{{route('feedback.listFeedBack')}}"><i class="fa fa-list"></i>All feedbacks</a></li>
          </ul>
        </li>
      @endif
    </ul><!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>

{{-- End side bar partial --}}