<!-- Logo -->
<a href="{{ route('admin_home') }}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>W</b>U</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>{{env('APP_NAME')}}</b></span>
</a>

<!-- Header Navbar -->
<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- The user image in the navbar-->
                    <?php $avatar = (Auth::user()->avatar!=null?'/img/user/'.Auth::user()->avatar:'/img/logo.jpg') ?>
                    <img src="{{$avatar}}" class="user-image" >
                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                    <span class="hidden-xs">{{ auth()->user()->username }}</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- The user image in the menu -->
                    <li class="user-header">
                        @if (auth()->user())
                        <img src="{{$avatar}}" class="img-circle" alt="User Image">

                        <p>
                            {{ auth()->user()->email }}
                            <small>Member since {{ date('m/Y', strtotime(auth()->user()->created_at)) }}</small>
                        </p>
                        @endif
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="{{route('core.user.change_information',['id'=>(auth()->id())])}}" class="btn btn-default btn-flat">Change user infomation</a>
                        </div>
                        <div class="pull-right">
                            <a href="{{ route('admin_logout') }}" class="btn btn-default btn-flat">Log out</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
