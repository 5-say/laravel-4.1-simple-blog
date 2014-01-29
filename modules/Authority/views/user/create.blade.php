@extends('l.base')

@section('title')用户 @stop

@section('beforeStyle')
    {{ style(array('bootstrap-3.0.3', 'bootstrap-3-switch')) }}
@stop

@section('style')
body
{
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #eee;
}
.nav-tabs>li.active>a
{
    background-color: #f8f8f8 !important;
}
@parent @stop

@section('container')

    @include('w.navbarAdmin', array('active'=>'users'))

    <div class="container panel" style="margin-top:2em;padding:1em;">

        @include('w.notification')
        <h3>
            添加新用户
            <div class="pull-right">
                <a href="{{ route('users.index') }}" class="btn btn-sm btn-default">
                    &laquo; 返回用户列表
                </a>
            </div>
        </h3>

        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">账号</a></li>
            <li><a href="#tab-meta-data" data-toggle="tab">权限相关</a></li>
        </ul>

        <form class="form-horizontal" method="post" action="{{ route('users.store') }}" autocomplete="off"
            style="background:#f8f8f8;padding:1em;border:1px solid #ddd;border-top:0;">
            <!-- CSRF Token -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <!-- Tabs Content -->
            <div class="tab-content">

                <!-- General tab -->
                <div class="tab-pane active" id="tab-general" style="margin:0 1em;">
                    
                    <div class="form-group">
                        <label for="email">邮箱</label>
                        {{ $errors->first('email', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                        <input class="form-control" type="text" name="email" id="email" value="{{ Input::old('email') }}" />
                    </div>
                    
                    <div class="form-group">
                        <label for="password">密码</label>
                        {{ $errors->first('password', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                        <input class="form-control" type="password" name="password" id="password" value="" />
                    </div>
                    
                    <div class="form-group">
                        <label for="password_confirmation">确认密码</label>
                        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" value="" />
                    </div>

                </div>

                <!-- Meta Data tab -->
                <div class="tab-pane" id="tab-meta-data" style="margin:0 1em;">
                    
                    <div class="form-group">
                        <label for="meta_title">用户身份</label>
                        {{ $errors->first('is_admin', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                        <div>
                            <input type="checkbox" name="is_admin" value="1"
                                {{ Input::old('is_admin') ? 'checked': ''; }}
                                data-on="danger" data-off="default" data-text-label="　　　　"
                                data-on-label="管理员" data-off-label="普通用户">
                        </div>
                    </div>

                </div>
            </div>

            <!-- Form actions -->
            <div class="control-group">
                <div class="controls">
                    <button type="reset" class="btn btn-default">清 空</button>
                    <button type="submit" class="btn btn-success">提 交</button>
                </div>
            </div>
        </form>

    </div>
@stop


@section('end')
    {{ script(array('jquery-1.10.2', 'bootstrap-3.0.3', 'bootstrap-3-switch')) }}
    <script>
         $('input[type="checkbox"],[type="radio"]').bootstrapSwitch();
    </script>
@stop
