@extends('Authority::l.base', array('active' => 'signin'))

@section('title') @parent 忘记密码 @stop

@section('style')
    @parent
    .center
    {
        text-align: center;
    }
    .form-center, .alert-dismissable
    {
        float: none;
        margin: 0 auto;
        margin-top: 2em;
    }
    .input-group
    {
        margin-top: 2em;
    }
@stop

@section('container')

    {{ Form::open(array('class' => 'col-lg-6 form-center', 'role' => 'form')) }}
        <h2 class="center">发送密码重置邮件</h2>
        <div class="input-group">
            <input type="text" class="form-control input-lg" name="email" placeholder="请填写您注册时所使用的邮箱">
            <span class="input-group-btn">
                <button class="btn btn-lg btn-primary" type="submit" style="width:9em;">发 送</button>
            </span>
        </div><!-- /input-group -->
        @if( Session::get('error') )
        <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{ Session::get('error') }}</strong>
        </div>
        @elseif( Session::get('status') )
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{ Session::get('status') }}</strong>
        </div>
        @endif
    {{ Form::close() }}

@stop
