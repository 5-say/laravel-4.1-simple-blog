@extends('l.base')

@section('title')文章 @stop

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

    @include('w.navbarAdmin', array('active'=>'posts'))

    <div class="container" style="margin-top:2em;">

        <h3>
            添加新文章
            <div class="pull-right">
                <a href="{{ route('posts.index') }}" class="btn btn-sm btn-default">
                    &laquo; 返回文章列表
                </a>
            </div>
        </h3>

        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">主要内容</a></li>
            <li><a href="#tab-meta-data" data-toggle="tab">SEO</a></li>
        </ul>

        <form class="form-horizontal" method="post" action="" autocomplete="off"
            style="background:#f8f8f8;padding:1em;border:1px solid #ddd;border-top:0;">
            <!-- CSRF Token -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <!-- Tabs Content -->
            <div class="tab-content">

                <!-- General tab -->
                <div class="tab-pane active" id="tab-general" style="margin:0 1em;">
                    <!-- Post Title -->
                    <div class="form-group {{ $errors->has('title') ? 'error' : '' }}">
                        <label for="title">标题</label>
                        <input class="form-control" type="text" name="title" id="title" value="{{ Input::old('title') }}" />
                        {{ $errors->first('title', '<span class="help-inline">:message</span>') }}
                    </div>

                    <!-- Post Slug -->
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default" >
                                    {{ str_finish(URL::to('/'), '/') }}
                                </span>
                            </span>
                            <input class="form-control" type="text" name="slug" id="slug" value="{{ Input::old('slug') }}">
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="form-group {{ $errors->has('content') ? 'error' : '' }}">
                        <label for="content">内容</label>
                        <textarea class="form-control" name="content" id="content" value="content" rows="10">{{ Input::old('content') }}</textarea>
                        {{ $errors->first('content', '<span class="help-inline">:message</span>') }}
                    </div>
                </div>

                <!-- Meta Data tab -->
                <div class="tab-pane" id="tab-meta-data" style="margin:0 1em;">
                    <!-- Meta Title -->
                    <div class="form-group {{ $errors->has('meta-title') ? 'error' : '' }}">
                        <label for="meta-title">Meta Title</label>
                        <input class="form-control" type="text" name="meta-title" id="meta-title" value="{{ Input::old('meta-title') }}" />
                        {{ $errors->first('meta-title', '<span class="help-inline">:message</span>') }}
                    </div>

                    <!-- Meta Description -->
                    <div class="form-group {{ $errors->has('meta-description') ? 'error' : '' }}">
                        <label for="meta-description">Meta Description</label>
                        <input class="form-control" type="text" name="meta-description" id="meta-description" value="{{ Input::old('meta-description') }}" />
                        {{ $errors->first('meta-description', '<span class="help-inline">:message</span>') }}
                    </div>

                    <!-- Meta Keywords -->
                    <div class="form-group {{ $errors->has('meta-keywords') ? 'error' : '' }}">
                        <label for="meta-keywords">Meta Keywords</label>
                        <input class="form-control" type="text" name="meta-keywords" id="meta-keywords" value="{{ Input::old('meta-keywords') }}" />
                        {{ $errors->first('meta-keywords', '<span class="help-inline">:message</span>') }}
                    </div>
                </div>
            </div>

            <!-- Form actions -->
            <div class="control-group">
                <div class="controls">
                    <button type="reset" class="btn btn-default">重 置</button>
                    <button type="submit" class="btn btn-success">提 交</button>
                </div>
            </div>
        </form>

    </div>

@stop


@section('end')
    {{ script(array('jquery-1.10.2', 'bootstrap-3.0.3')) }}
@stop
