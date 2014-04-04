@extends('l.account', array('active' => 'myComments'))

@section('container')

    @include('w.notification')

    <h3>我评论过的文章</h3>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>文章标题</th>
                    <th>评论内容</th>
                    <th style="width:5em;text-align:center;">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                <tr>
                    <td>
                        @if($comment->article)
                        <a href="{{ route('blog.show', $comment->article->slug) }}">{{ $comment->article->title }}</a>
                        @else
                        此文章已被删除
                        @endif
                    </td>
                    <td>{{ $comment->content }}</td>
                    <td>
                        <a href="javascript:void(0)" class="btn btn-xs btn-danger"
                             onclick="modal('{{ route('account.myComments.destroy', $comment->id) }}')">删除评论</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pull-right" style="">
        {{ pagination($comments, 'p.slider-3') }}
    </div>

<?php
$modalData['modal'] = array(
    'id'      => 'myModal',
    'title'   => '系统提示',
    'message' => '确认删除此评论？',
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
