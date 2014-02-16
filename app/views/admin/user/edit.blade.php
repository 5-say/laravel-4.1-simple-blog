@extends('l.admin', array('active' => $resource))

@section('title') @parent 编辑{{ $resourceName }} @stop

@section('beforeStyle')
    @parent
    {{ style('bootstrap-3-switch') }}
@stop

@section('style')
.nav-tabs>li.active>a
{
    background-color: #f8f8f8 !important;
}
@parent @stop

@section('container')

    @include('w.notification')
    <h3>
        编辑{{ $resourceName }}
        <div class="pull-right">
            <a href="{{ route($resource.'.index') }}" class="btn btn-sm btn-default">
                &laquo; 返回{{ $resourceName }}列表
            </a>
        </div>
    </h3>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-general" data-toggle="tab">主要内容</a></li>
        <li><a href="#tab-meta-data" data-toggle="tab">权限相关</a></li>
    </ul>

    <form class="form-horizontal" method="post" action="{{ route($resource.'.update', $data->id) }}" autocomplete="off"
        style="background:#f8f8f8;padding:1em;border:1px solid #ddd;border-top:0;">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="_method" value="PUT" />

        <!-- Tabs Content -->
        <div class="tab-content">

            <!-- General tab -->
            <div class="tab-pane active" id="tab-general" style="margin:0 1em;">
                
                <div class="form-group">
                    <label for="email">邮箱</label>
                    {{ $errors->first('email', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                    <input class="form-control" type="text" name="email" id="email" value="{{ Input::old('email', $data->email) }}" />
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
                            {{ Input::old('is_admin', $data->is_admin) ? 'checked': ''; }}
                            data-on="danger" data-off="default" data-text-label="　　　　"
                            data-on-label="管理员" data-off-label="普通用户">
                    </div>
                </div>

            </div>

        </div>

        <!-- Form actions -->
        <div class="control-group">
            <div class="controls">
                <a class="btn btn-default" href="{{ route($resource.'.edit', $data->id) }}">重 置</a>
                <button type="submit" class="btn btn-success">提 交</button>
            </div>
        </div>
    </form>

@stop

@section('end')
    @parent
    {{ script('bootstrap-3-switch') }}
    <script>
         $('input[type="checkbox"],[type="radio"]').bootstrapSwitch();
    </script>
@stop
