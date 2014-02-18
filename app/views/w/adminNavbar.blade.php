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
            <a class="navbar-brand" href="{{ route('admin') }}">Blog - Admin</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li{{ $is_active('admin') }}><a href="{{ route('admin') }}">后台首页</a></li>
                <li{{ $is_active('users') }}><a href="{{ route('users.index') }}">用户管理</a></li>
                <li{{ $is_active('categories') }}><a href="{{ route('categories.index') }}">分类管理</a></li>
                <li{{ $is_active('articles') }}><a href="{{ route('articles.index') }}">文章管理</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        [ {{ Auth::user()->email }} ] <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('home') }}">回到博客</a></li>
                        <li><a href="{{ route('account') }}">用户中心</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('logout') }}">退出</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>