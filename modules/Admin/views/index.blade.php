@extends('l.base')

@section('title')后台 @stop

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

    @include('w.navbarAdmin', array('active'=>'admin'))

    <div class="container">

        <h1 class="demo">后台首页</h1>

    </div> <!-- /container -->

@stop


@section('end')
    {{ script(array('jquery-1.10.2', 'bootstrap-3.0.3')) }}
@stop
