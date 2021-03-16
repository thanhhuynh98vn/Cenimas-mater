<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/adminlte/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>@if(Auth::check()){{ Auth::user()->name}}@endif</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="{{route('admin.dashboard.index')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.votes.show')}}">
                    <i class="fa fa-check-circle"></i> <span>Vote films Month {{now()->month}} </span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.posts.index')}}">
                    <i class="fa fa-book"></i> <span>Posts</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>
            @role(('superadmin'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Cinemas manage</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.votes.index')}}"><i class="fa fa-venus"></i> Votes</a></li>
                    <li><a href="{{route('admin.cinemas.index')}}"><i class="fa fa-file-movie-o"></i> Cinemas</a></li>
                    <li><a href="{{route('admin.rooms.index')}}"><i class="fa fa-home"></i> Rooms</a></li>
                    <li><a href="{{route('admin.settingrooms.index')}}"><i class="fa fa-home"></i> Setting rooms</a></li>
                </ul>
            </li>
            <li>
                <a href="{{route('admin.companies.index')}}">
                    <i class="fa fa-compass"></i> <span>Companies</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>

            @endrole
            @ability('admin,superadmin', 'dell_user,edit_user,create_user')
            <li>
                <a href="{{route('admin.users.index')}}">
                    <i class="fa fa-user"></i> <span>Users</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>
            @endability

            @role(('superadmin'))
            <li>
                <a href="{{route('admin.role.role')}}">
                    <i class="fa fa-road"></i> <span>Roles</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>
            @endrole

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
