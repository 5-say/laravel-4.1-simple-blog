@extends('l.system')
@section('title')404 @stop

@section('container')
    <h1>404 <span>!</span></h1>
    <p>抱歉，您请求的页面不存在。</p>
    <p>可能是以下原因:</p>
    <ul>
        <li>您输入了一个错误的地址</li>
        <li>这是一个过时的链接</li>
    </ul>
    @include('w.googleSearch')
@stop
