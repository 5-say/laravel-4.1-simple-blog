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
@parent @stop

@section('container')

    @include('w.navbarAdmin', array('active'=>'posts'))

    <div class="container" style="margin-top:2em;">

        <h3>
            博客文章管理
            <div class="pull-right">
                <a href="{{ route('posts.create') }}" class="btn btn-sm btn-primary">
                    添加新文章
                </a>
            </div>
        </h3>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="">标题</th>
                    <th class="span2">评论数</th>
                    <th class="span2">创建时间</th>
                    <th style="width:7em;text-align:center;">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->comments()->count() }}</td>
                    <td>{{ $post->friendly_created_at }}</td>
                    <td>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-xs">编辑</a>
                        <a href="{{ route('posts.destroy', $post->id) }}" class="btn btn-xs btn-danger">删除</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pull-right" style="margin-top:-2em;">
            {{ pagination($posts, 'p.slider-3') }}
        </div>

    </div>

@stop


@section('end')
    {{ script(array('jquery-1.10.2', 'bootstrap-3.0.3')) }}
@stop
