@extends('Admin::l.base', array('active' => 'admin'))

@section('title') @parent 首页 @stop

@section('style')
.demo
{
    margin-top: 2em;
    text-align: center;
}
@parent @stop

@section('container')

    <h1 class="demo">后台首页</h1>

@stop
