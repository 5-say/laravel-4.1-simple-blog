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

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>排序</th>
                    <th>名称</th>
                    <th>创建时间</th>
                    <th style="width:7em;text-align:center;">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                <tr>
                    <td>{{ $data->sort_order }}</td>
                    <td>{{ $data->name }}</td>
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
        {{ pagination($datas, 'p.slider-3') }}
    </div>
    
<?php
$modalData['modal'] = array(
    'id' => 'myModal',
    'title' => '系统提示',
    'message' => '确认删除此'.$resourceName.'？',
    'footer'=>
'
    <form id="real-delete" action="" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="_method" value="DELETE" />
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-sm btn-danger">确认删除</button>
    </form>
',
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
