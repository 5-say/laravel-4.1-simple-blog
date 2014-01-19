@extends('l.base')

@section('title')登录 @stop

@section('beforeStyle')
    {{ style('bootstrap-3.0.3') }}
@stop

@section('style')
body {
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #eee;
}

.center
{
    text-align: center;
}
@parent @stop

@section('container')

    @include('w::navbarHome')

    <div class="container" style="margin-top:2em;">

            <h2 class="center">账号激活成功</h2>

    </div> <!-- /container -->

@stop


@section('end')
    {{ script(array('jquery-1.10.2', 'bootstrap-3.0.3')) }}
    <script>
        $('[data-toggle]').popover({container:'body'});
    </script>
@stop
