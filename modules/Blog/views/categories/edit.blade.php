@extends('l.base')

@section('title'){{ $resourceName }}管理 @stop

@section('beforeStyle')
    {{ style('bootstrap-3.0.3') }}
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

    @include('w.navbarAdmin', array('active'=>$resource))

    <div class="container panel" style="margin-top:2em;padding:1em;">

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
                        <label for="name">名称</label>
                        {{ $errors->first('name', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                        <input class="form-control" type="text" name="name" id="name" value="{{ Input::old('name', $data->name) }}" />
                    </div>

                    <div class="form-group">
                        <label for="sort_order">排序</label>
                        {{ $errors->first('sort_order', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                        <input class="form-control" type="text" name="sort_order" id="sort_order" value="{{ Input::old('sort_order', $data->sort_order) }}" />
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

    </div>

@stop


@section('end')
    {{ script(array('jquery-1.10.2', 'bootstrap-3.0.3')) }}
@stop
