@extends('l.base')

@section('title'){{ $article->title }} @stop

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

    @include('w.navbarHome', array('active'=>'home'))

    <div class="container" style="margin-top:2em;">

        <div class="row row-offcanvas row-offcanvas-right">
            <div class="col-xs-12 col-sm-9">
                <p class="pull-right visible-xs" style="margin:-1.3em -1em 0 0;">
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">== ==</button>
                </p>
                <div class="row">

                    <div class="col-6 col-sm-6 col-lg-12 panel">
                        <h2>{{ $article->title }}</h2>
                        <p>{{ $article->content }}</p>
                        <p>
                            <i class="glyphicon glyphicon-calendar"></i><span> {{ $article->created_at }}（{{ $article->friendly_created_at }}）</span>
                            <a href="#" class="btn btn-default btn-xs" style="margin-top:-2px;" role="button">默认分类</a>
                        </p>
                    </div><!--/span-->

                    <div class="col-6 col-sm-6 col-lg-12 panel">
                        <a name="comments"></a>
                        <h4>评论 - {{ $article->comments->count() }}</h4>
                        <ul class="media-list">
                            @foreach($article->comments as $comment)
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object img-thumbnail" width="64" height="64" src="..." alt="...">
                                </a>
                                <div class="media-body well well-sm">
                                    <h5 class="media-heading">{{ $comment->user->email }}
                                        <small class="pull-right">发表于：{{ $comment->friendly_created_at }}</small>
                                    </h5>
                                    {{ $comment->content }}
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @include('w.notification')
                        <form class="form-horizontal" method="post" autocomplete="off">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <textarea name="content" class="form-control" rows="3">{{ Input::old('content') }}</textarea>
                            {{ $errors->first('content', '<span style="color:#c7254e;margin-top:1em;">:message</span>') }}
                            <button type="submit" class="btn btn-success pull-right" style="margin:1em 0;">发表评论</button>
                        </form>
                    </div><!--/span-->

                </div><!--/row-->
            </div><!--/span-->

            <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <ul class="list-group">
                    <li class="list-group-item">
                        <h4>文章分类</h4>
                    </li>
                    <li class="list-group-item"><a href="">默认分类</a></li>
                    <li class="list-group-item"><a href="">其它分类</a></li>
                </ul>
            </div><!--/span-->
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
    </script>
@stop
