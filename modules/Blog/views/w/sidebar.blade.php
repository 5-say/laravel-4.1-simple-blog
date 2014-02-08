@section('style')
    @parent
    /*
     * 侧边栏切换样式支持
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
@stop

<?php
$is_active = function ($name='') use ($activeCategory)
{
    if ($activeCategory == $name)
        return ' active';
    else
        return '';
}
?>

<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
    <p class="visible-xs" style="margin:-1.3em -1em 0 -5.2em;">
        <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">== ==</button>
    </p>
    <div class="list-group">
        <span class="list-group-item"><h4>文章分类</h4></span>
        <a class="list-group-item{{ $is_active('all') }}" href="{{ route('home') }}">所有文章</a>
        @foreach($categories as $category)
        <a class="list-group-item{{ $is_active($category->id) }}" href="{{ route('categoryArticles', $category->id) }}">{{ $category->name }}</a>
        @endforeach
    </div>
</div><!--/span-->

@section('end')
    @parent
    <script>
        $(document).ready(function() {
            $('[data-toggle=offcanvas]').click(function() {
                $('.row-offcanvas').toggleClass('active');
            });
        });
    </script>
@stop