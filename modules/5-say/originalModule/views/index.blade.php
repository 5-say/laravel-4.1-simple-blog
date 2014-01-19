@extends('l.base')

@section('title'){{ $demo }} @stop

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
.demo
{
    margin-top: 2em;
    text-align: center;
}
@parent @stop

@section('container')

    <div class="container">

        <h1 class="demo">{{ $demo }} 模块测试页面</h1>
        <p class="demo">{{ $content }}</p>

    </div> <!-- /container -->

@stop


@section('end')
    {{ script(array('jquery-1.10.2', 'bootstrap-3.0.3')) }}
@stop
