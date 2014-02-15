@extends('l.base')

@section('title') Demo - @parent @stop

@section('beforeStyle')
    {{ style('bootstrap-3.0.3') }}
@parent @stop


@section('body')

    <div class="container panel">
        @yield('container')
    </div>

@stop



@section('end')
    {{ script(array('jquery-1.10.2', 'bootstrap-3.0.3')) }}
@parent @stop
