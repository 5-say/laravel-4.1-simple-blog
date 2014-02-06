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

                    @foreach($posts as $post)
                    <div class="col-6 col-sm-6 col-lg-12 panel">
                        <h2>
                            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            <a target="_blank" class="pull-left" 
                                href="{{ route('blog.show', $post->slug) }}">
                                <i class="glyphicon glyphicon-share" style="font-size:0.5em;margin-right:1em;"></i>
                            </a>
                        </h2>
                        <p>{{ Str::limit($post->content, 200) }}</p>
                        <p>
                            <i class="glyphicon glyphicon-calendar"></i><span> {{ $post->created_at }}（{{ $post->friendly_created_at }}）</span>
                            <a target="_blank" href="{{ route('blog.show', $post->slug) }}#comments" class="btn btn-default btn-xs" style="margin-top:-2px;"
                                role="button">评论（{{ $post->comments->count() }}）</a>
                        </p>
                    </div><!--/span-->
                    @endforeach

                    <div>
                        {{ pagination($posts, 'p.slider-3') }}
                    </div>

                </div><!--/row-->
            </div><!--/span-->

            <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <ul class="list-group">
                    <li class="list-group-item">
                        <h4>文章分类</h4>
                    </li>
                    @foreach($categories as $category)
                    <li class="list-group-item"><a href="">{{ $category->name }}</a></li>
                    @endforeach
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
