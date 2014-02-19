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
            <span class="input-group-btn" style="width:8em;">
                {{
                    Form::select(
                        'status',
                        array('all' => '所有', '1' => '管理员', '0' => '普通用户'),
                        Input::get('status', 'all'),
                        array('class' => 'form-control input-sm')
                    )
                }}
            </span>
            <span class="input-group-btn" style="width:6em;">
                {{
                    Form::select(
                        'target',
                        array('email' => '邮箱'),
                        Input::get('target', 'email'),
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
                    <th>身份 {{ order_by('is_admin') }}</th>
                    <th>邮箱 {{ order_by('email') }}</th>
                    <th>注册时间 {{ order_by('created_at', 'desc') }}</th>
                    <th>最后登录时间 {{ order_by('siginin_at') }}</th>
                    <th style="width:7em;text-align:center;">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php $currentId = Auth::user()->id; ?>
                @foreach ($datas as $data)
                <tr>
                    <td>{{ $data->is_admin ? '管理员' : '普通用户' }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->created_at }}（{{ $data->friendly_created_at }}）</td>
                    <td>{{ $data->signin_at }}（{{ $data->friendly_signin_at }}）</td>
                    <td>
                        @if($data->id!=$currentId)
                        <a href="{{ route($resource.'.edit', $data->id) }}" class="btn btn-xs">编辑</a>
                        <a href="javascript:void(0)" class="btn btn-xs btn-danger"
                             onclick="modal('{{ route($resource.'.destroy', $data->id) }}')">删除</a>
                        @endif
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

