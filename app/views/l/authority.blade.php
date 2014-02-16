@extends('l.base')

@section('title') Simple - Blog @parent @stop

@section('beforeStyle')
    {{ style('bootstrap-3.0.3') }}
@parent @stop

@section('style')
body
{
    padding-bottom: 0;
    background-color: #f3f3ff;
}
@parent @stop

@section('body')

    @include('w.blogNavbar')

    <div class="container panel" style="margin-top:5em; padding-bottom:1em;">
        @yield('container')
    </div>

@stop

@section('end')
    {{ script(array('jquery-1.10.2', 'bootstrap-3.0.3')) }}
@parent @stop
