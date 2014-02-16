@extends('l.authority', array('active' => 'signin'))

@section('title') 注册成功 @parent @stop

@section('style')
    @parent
    .center
    {
        text-align: center;
    }
@stop

@section('container')

    <h2 class="center">请激活您的账号</h2>
    <p class="center">激活邮件已发送，请登录您的邮箱（{{ $email }}）激活账号。</p>

@stop
