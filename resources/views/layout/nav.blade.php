<div class="mean-mask"></div>
<header class="header-wrap header-closed">
    <div class="header clearfix container">
        <a class="logo fl" href="#" style="height: 57px;"><img class="white" src="/images/logo.png" alt="ArkBio"></a>
        <a class="logo fl" href="#" style="height: 57px;"><img class="black" src="/images/logo-black.png" alt="ArkBio" style="display:none"></a>
        <button class="hamburger-btn icon icon-menu fr white"></button>
        <button class="hamburger-btn icon icon-menu fr black" style="display:none"></button>

        <nav class="nav responsive-nav fr clearfix">
            <a class="link-nav fr nav-item mobile" href="/home/index">首页</a>
            <a class="link-nav fr nav-item mobile" href="/home/painting/work">作品</a>
            @if (isset($user))
                @if ($user->role == 'member')
                    <a class="link-nav fr nav-item mobile" href="/home/user/painer">画家之路</a>
                @elseif ($user->role == 'painer')
                    <a class="link-nav fr nav-item mobile" href="/home/painting/release">发表作品</a>
                @endif
                <a class="link-nav fr nav-item mobile" href="/home/user/info/{{$user->nickname}}">用户中心</a>
                    <a class="link-nav fr nav-item mobile" href="/home/user/message">个人消息</a>
                    <a class="link-nav fr nav-item mobile" href="/home/bulletin/index">公告</a>
                    <a class="link-nav fr nav-item mobile" href="/home/bug/index">bug反馈</a>
                <a class="link-nav fr nav-item mobile" href="/auth/logout">Logout</a>

            @else
                <a class="link-nav fr nav-item mobile" href="/home/bulletin/index">公告</a>
                <a class="link-nav fr nav-item mobile" href="/home/bug/index">bug反馈</a>
                <a class="link-nav fr nav-item mobile" href="/auth/login">登录</a>
            @endif



            @if (isset($user))
                <a class="link-nav fr nav-item desktop" href="/auth/logout">Logout</a>
                <a class="link-nav fr nav-item desktop" href="/home/bug/index">bug反馈</a>
                <a class="link-nav fr nav-item desktop" href="/home/bulletin/index">公告</a>
                <a class="link-nav fr nav-item desktop" href="/home/user/message">个人消息</a>
                <a class="link-nav fr nav-item desktop" href="/home/user/info/{{$user->nickname}}">用户中心</a>
                @if ($user->role == 'member')
                    <a class="link-nav fr nav-item desktop" href="/home/user/painer">画家之路</a>
                @elseif ($user->role == 'painer')
                    <a class="link-nav fr nav-item desktop" href="/home/painting/release">发表作品</a>
                @endif

            @else
                <a class="link-nav fr nav-item desktop" href="/auth/login">登录</a>
                <a class="link-nav fr nav-item desktop" href="/home/bug/index">bug反馈</a>
                <a class="link-nav fr nav-item desktop" href="/home/bulletin/index">公告</a>
            @endif
            {{--<a class="link-nav fr nav-item desktop" onclick="alert('还未开放，敬请期待')">画廊</a>--}}
            <a class="link-nav fr nav-item desktop" href="/home/painting/work">作品</a>
            <a class="link-nav fr nav-item desktop" href="/home/index">首页</a>
        </nav>
    </div>
</header>
