@extends('Account::l.base', array('active' => 'changePassword'))

@section('title') @parent 修改密码 @stop

@section('style')
    @parent
    .form
    {
        width: 330px;
        margin: 0 auto;
        padding-bottom: 2em;
    }
    .form input, .form button
    {
        margin-top: 10px;
    }
    .form strong.error{
        color: #b94a48;
    }
@stop

@section('container')

    @include('w.notification')
    <form class="form" role="form" method="post">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="_method" value="PUT" />

        <h3 class="form-register-heading">修改您的密码</h3>
        <input name="password_old" type="password" class="form-control" placeholder="原始密码" required>
        {{ $errors->first('password_old', '<strong class="error">:message</strong>') }}
        <div class="input-group">
            <input name="password" type="password" class="form-control" placeholder="新密码" required>
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-toggle="popover" data-content="请使用字母、数字、下划线、中划线。长度在6-16位之间。">?</button>
            </span>
        </div>
        {{ $errors->first('password', '<strong class="error">:message</strong>') }}
        <input name="password_confirmation" type="password" class="form-control" placeholder="确认密码" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">确认修改</button>
    </form>

@stop


@section('end')
    @parent
    <script>
        $('[data-toggle]').popover({container:'body'});
    </script>
@stop
