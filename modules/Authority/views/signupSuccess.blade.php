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

            <h2 class="center">注册成功</h2>
            <p class="center">激活邮件已发送，请登录您的邮箱激活账号。</p>

    </div> <!-- /container -->

@stop


@section('end')
    {{ script(array('jquery-1.10.2', 'bootstrap-3.0.3')) }}
    <script>
        $('[data-toggle]').popover({container:'body'});
    </script>
@stop
