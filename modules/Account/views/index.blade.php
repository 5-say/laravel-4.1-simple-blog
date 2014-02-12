@extends('Account::l.base', array('active' => 'admin'))

@section('title') @parent 首页 @stop

@section('container')

    <div style="height:30em;">
        <h1 style="margin-top:2em; text-align:center;">用户中心首页</h1>
        <p style="text-align:center;">这里是博客系统的管理员后台，负责整个博客系统的资源管理。</p>
        @if(method_exists('AuthorityController', 'test')) {{ App::make('AuthorityController')->test() }} @endif
    </div>

@stop
