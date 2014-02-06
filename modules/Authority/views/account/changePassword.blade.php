@extends('l.base')

@section('title')Demo @stop

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
/*
 * Off Canvas
 * --------------------------------------------------
 */
@media screen and (max-width: 767px) {
    .row-offcanvas {
        position: relative;
        -webkit-transition: all 0.25s ease-out;
        -moz-transition: all 0.25s ease-out;
        transition: all 0.25s ease-out;
    }

    .row-offcanvas-right
    .sidebar-offcanvas {
        right: -50%; /* 6 columns */
    }

    .row-offcanvas-left
    .sidebar-offcanvas {
        left: -50%; /* 6 columns */
    }

    .row-offcanvas-right.active {
        right: 50%; /* 6 columns */
    }

    .row-offcanvas-left.active {
        left: 50%; /* 6 columns */
    }

    .sidebar-offcanvas {
        position: absolute;
        top: 0;
        width: 50%; /* 6 columns */
    }
}
@parent @stop

@section('container')

    @include('w.navbarHome', array('active' => ''))

    <div class="container" style="margin-top:2em;">
        
        <div class="row row-offcanvas row-offcanvas-right">
            <div class="col-xs-12 col-sm-9">
                <p class="pull-right visible-xs" style="margin:-1.3em -1em 0 0;">
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">== ==</button>
                </p>
                <div class="row panel">
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


                </div><!--/row-->
            </div><!--/span-->

            @include('w.sidebarAccount', array('active' => 'changePassword'))
            
        </div><!--/row-->

    </div>

@stop


@section('end')
    {{ script(array('jquery-1.10.2', 'bootstrap-3.0.3')) }}
    <script>
        $(document).ready(function() {
            $('[data-toggle=offcanvas]').click(function() {
                $('.row-offcanvas').toggleClass('active');
            });
        });
        $('[data-toggle]').popover({container:'body'});
    </script>
@stop
