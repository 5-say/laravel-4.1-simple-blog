@extends('Admin::l.base', array('active' => $resource))

@section('title') @parent 添加新{{ $resourceName }} @stop

@section('style')
.nav-tabs>li.active>a
{
    background-color: #f8f8f8 !important;
}
@parent @stop

@section('container')

    @include('w.notification')
    <h3>
        添加新{{ $resourceName }}
        <div class="pull-right">
            <a href="{{ route($resource.'.index') }}" class="btn btn-sm btn-default">
                &laquo; 返回{{ $resourceName }}列表
            </a>
        </div>
    </h3>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-general" data-toggle="tab">主要内容</a></li>
    </ul>

    <form class="form-horizontal" method="post" action="{{ route($resource.'.store') }}" autocomplete="off"
        style="background:#f8f8f8;padding:1em;border:1px solid #ddd;border-top:0;">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <!-- Tabs Content -->
        <div class="tab-content">

            <!-- General tab -->
            <div class="tab-pane active" id="tab-general" style="margin:0 1em;">

                <div class="form-group">
                    <label for="name">名称</label>
                    {{ $errors->first('name', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                    <input class="form-control" type="text" name="name" id="name" value="{{ Input::old('name') }}" />
                </div>

                <div class="form-group">
                    <label for="sort_order">排序</label>
                    {{ $errors->first('sort_order', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                    <input class="form-control" type="text" name="sort_order" id="sort_order" value="{{ Input::old('sort_order') }}" />
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

@stop
