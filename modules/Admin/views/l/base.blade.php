@extends('l.base')

@section('title') 后台 - @parent @stop

@section('beforeStyle')
    {{ style('bootstrap-3.0.3') }}
@parent @stop

@section('style')
body
{
    padding-bottom: 0;
    background-color: #eee;
}
@parent @stop

@section('body')

    @include('Admin::w.navbar')

    <div class="container panel" style="margin-top:55px; padding-bottom:1em;">
        @yield('container')
    </div>

@stop


@section('end')
    {{ script(array('jquery-1.10.2', 'bootstrap-3.0.3')) }}
@parent @stop
