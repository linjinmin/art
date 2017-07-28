<div id="header">
    <div class="container-fluid">
        <div class="navbar">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html">
                    <i class="im-windows8 text-logo-element animated bounceIn"></i><span class="text-logo"></span><span class="text-slogan">园丁鸟</span>
                </a>
            </div>
            <nav class="top-nav" role="navigation">
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown">
                            <img class="user-avatar" src="{{$user->image->url}}" alt="SuggeElson">{{$user->nickname}}</a>
                        <ul class="dropdown-menu right" role="menu">
                            <li><a href="/admin/auth/logout"><i class="im-exit"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- End #header-area -->
    </div>
    <!-- Start .header-inner -->
</div>

<div id="sidebar">
    <!-- Start .sidebar-inner -->
    <div class="sidebar-inner">
        <!-- Start #sideNav -->
        <ul id="sideNav" class="nav nav-pills nav-stacked">
            <li><a href="/admin/painting/index">作品 <i class="im-file2"></i></a></li>
            <li><a href="/admin/user/index">用户管理 <i class="ec-users"></i></a></li>
            <li><a href="/admin/apply/index">画家申请 <i class="ec-pencil"></i></a></li>
            <li><a href="/admin/painting/type/index">画画类型 <i class="st-chart"></i></a></li>
            <li><a href="/admin/image/index">图片管理 <i class="im-images"></i></a></li>
            <li><a href="/admin/bug/index">bug <i class="im-bug"></i></a></li>
            <li><a href="/admin/bulletin/index">公告 <i class="im-notification"></i></a></li>
        </ul>
    </div>
</div>
