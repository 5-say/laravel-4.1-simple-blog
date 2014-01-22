@extends('l.base')

@section('title'){{ $demo }} @stop

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

    @include('w.navbarHome')

    <div class="container" style="margin-top:2em;">

        <div class="row row-offcanvas row-offcanvas-right">

          <div class="col-xs-12 col-sm-9">

              <p class="pull-right visible-xs">
                  <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">[ - ]</button>
              </p>

              <div class="row">

                  <div class="col-6 col-sm-6 col-lg-12">
                      <h2><a href="">标题 Heading 标题 Heading 标题 Heading</a></h2>
                      <p>概述。Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                      <p>
                        <i class="glyphicon glyphicon-calendar"></i><span>14 天前</span>
                        <a href="#" class="btn btn-default btn-xs" style="margin-top:-4px;" role="button">评论 0</a>
                      </p>
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

        <hr />

        <footer>
          <p>© Company 2013</p>
        </footer>

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
