<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">切换菜单栏</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Demo</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">首页</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
@if(Auth::guest()){{--游客--}}
                <li><a href="{{ route('signin') }}">登录</a></li>
                <li><a href="{{ route('signup') }}">注册</a></li>
@elseif(! Auth::user()->is_admin){{--普通登录用户--}}
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        欢迎 - [ {{ Auth::user()->email }} ]
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">账号信息</a></li>
                        <li><a href="#">修改密码</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('logout') }}">退出</a></li>
                    </ul>
                </li>
@else{{--管理员--}}
                <li><a href="{{ route('signin') }}">进入后台</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        欢迎 - [ {{ Auth::user()->email }} ]
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">账号信息</a></li>
                        <li><a href="#">修改密码</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('logout') }}">退出</a></li>
                    </ul>
                </li>
@endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>