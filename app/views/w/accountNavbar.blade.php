<?php
$is_active = function ($name = '') use ($active) {
    if ($active === $name)
        return ' class="active"';
    else
        return '';
}
?>

<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation"
    style="background-color:#fff;border-color:#fff;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">切换菜单栏</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('account.index') }}">用户中心</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <!-- <li{{ $is_active('userInfo') }}><a href="{{ route('account.userInfo') }}">账号信息</a></li> -->
                <li{{ $is_active('changePassword') }}><a href="{{ route('account.changePassword') }}">修改密码</a></li>
                <li{{ $is_active('changePortrait') }}><a href="{{ route('account.changePortrait') }}">更改头像</a></li>
                <li{{ $is_active('myComments') }}><a href="{{ route('account.myComments') }}">我的评论</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        [ {{ Auth::user()->email }} ]
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        @if(Auth::user()->is_admin)
                        <li><a href="{{ route('admin') }}">进入后台</a></li>
                        @endif
                        <li><a href="{{ route('home') }}">回到博客</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('logout') }}">退出</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>