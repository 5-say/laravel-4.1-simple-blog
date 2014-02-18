@extends('l.admin', array('active' => $resource))

@section('title') @parent {{ $resourceName }}管理 @stop

@section('container')

    @include('w.notification')

    <h3>
        {{ $resourceName }}管理
        <div class="pull-right">
            <a href="{{ route($resource.'.create') }}" class="btn btn-sm btn-primary">
                添加新{{ $resourceName }}
            </a>
        </div>
    </h3>

    {{ Form::open(array('method' => 'get')) }}
        <div class="input-group col-md-9" style="margin:0 auto 1em auto;">
            <span class="input-group-btn" style="width:6em;">
                {{
                    Form::select(
                        'target',
                        array('title' => '标题'),
                        Input::get('target', 'title'),
                        array('class' => 'form-control input-sm')
                    )
                }}
            </span>
            <input type="text" class="form-control input-sm" name="like" placeholder="请输入搜索条件" value="{{ Input::get('like') }}">
            <span class="input-group-btn">
                <button class="btn btn-sm btn-default" type="submit" style="width:5em;">搜索</button>
            </span>
        </div>
    {{ Form::close() }}

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>标题 {{ order_by('title', 'up') }}</th>
                    <th>评论数 {{ order_by('comments') }}</th>
                    <th>创建时间 {{ order_by('created') }}</th>
                    <th style="width:7em;text-align:center;">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                <tr>
                    <td>
                        <a href="{{ route('blog.show', $data->slug) }}" target="_blank">
                            <i class="glyphicon glyphicon-share" style="font-size:0.5em;"></i>
                        </a>
                        {{ $data->title }}
                    </td>
                    <td>{{ $data->comments()->count() }}</td>
                    <td>{{ $data->created_at }}（{{ $data->friendly_created_at }}）</td>
                    <td>
                        <a href="{{ route($resource.'.edit', $data->id) }}" class="btn btn-xs">编辑</a>
                        <a href="javascript:void(0)" class="btn btn-xs btn-danger"
                             onclick="modal('{{ route($resource.'.destroy', $data->id) }}')">删除</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pull-right" style="">
        {{ pagination($datas->appends(Input::except('page')), 'p.slider-3') }}
    </div>

<?php
$modalData['modal'] = array(
    'id'      => 'myModal',
    'title'   => '系统提示',
    'message' => '确认删除此'.$resourceName.'？',
    'footer'  =>
        Form::open(array('id' => 'real-delete', 'method' => 'delete')).'
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">取消</button>
            <button type="submit" class="btn btn-sm btn-danger">确认删除</button>'.
        Form::close(),
);
?>
    @include('w.modal', $modalData)

@stop

@section('end')
    @parent
    <script>
        function modal(href)
        {
            $('#real-delete').attr('action', href);
            $('#myModal').modal();
        }
    </script>
@stop
