@extends('Authority::l.base', array('active' => 'signin'))

@section('title') @parent 登录 @stop

@section('style')
    @parent
    .form-signin {
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
        margin-bottom: 10px;
    }
    .form-signin .checkbox {
        font-weight: normal;
    }
    .form-signin .form-control {
        position: relative;
        font-size: 16px;
        height: auto;
        padding: 10px;
        -webkit-box-sizing: border-box;
           -moz-box-sizing: border-box;
                box-sizing: border-box;
    }
    .form-signin .form-control:focus {
        z-index: 2;
    }
    .form-signin input[type="text"] {
        margin-bottom: 10px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
@stop

@section('container')

    {{ Form::open(array('class' => 'form-signin', 'role' => 'form')) }}
        <h2 class="form-signin-heading">用户登录</h2>
        <input name="email" value="{{ Input::old('email') }}" type="text" class="form-control" placeholder="邮箱" required autofocus>
        <input name="password" type="password" class="form-control" placeholder="密码" required>
        <label class="checkbox">
            <input type="checkbox" name="remember-me" value="1"> 记住我
            <a href="{{ route('forgotPassword') }}" style="float:right;">忘记密码 &gt;&gt;&gt;</a>
        </label>
        <div class="alert alert-warning alert-dismissable {{ $errors->first('attempt')?'':'hidden'; }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{ $errors->first('attempt') }}</strong>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">登 录</button>
    {{ Form::close() }}

@stop
