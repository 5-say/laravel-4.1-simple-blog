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
            <a class="navbar-brand" href="{{ route('account') }}">用户中心</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li{{ $is_active('') }}><a href="{{ route('account.userInfo') }}">账号信息</a></li>
                <li{{ $is_active('') }}><a href="{{ route('account.changePassword') }}">修改密码</a></li>
                <li{{ $is_active('') }}><a href="{{ route('account.changePortrait') }}">编辑头像</a></li>
                <li{{ $is_active('') }}><a href="{{ route('account.myComments') }}">我的回复</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ route('home') }}">回到博客</a></li>
                <li class="">
                    <a href="#" >
                        [ {{ Auth::user()->email }} ]
                    </a>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>