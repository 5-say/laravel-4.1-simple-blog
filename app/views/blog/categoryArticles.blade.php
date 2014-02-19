@extends('l.blog', array('active' => 'home'))

@section('container')

    <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9">
            <div class="row">

                @foreach($articles as $article)
                <div class="col-6 col-sm-6 col-lg-12 panel">
                    <h2>
                        <a href="{{ route('blog.show', $article->slug) }}">{{ $article->title }}</a>
                        <a target="_blank" class="pull-left" 
                            href="{{ route('blog.show', $article->slug) }}">
                            <i class="glyphicon glyphicon-share" style="font-size:0.5em;margin-right:1em;"></i>
                        </a>
                    </h2>
                    <p>{{ close_tags(Str::limit($article->content_html, 200)) }}</p>
                    <p>
                        <i class="glyphicon glyphicon-calendar"></i><span> {{ $article->created_at }}（{{ $article->friendly_created_at }}）</span>
                        <a target="_blank" href="{{ route('blog.show', $article->slug) }}#comments">
                            <i class="glyphicon glyphicon-share" style="font-size:0.5em;"></i>
                        </a>
                        <a href="{{ route('blog.show', $article->slug) }}#comments"
                            class="btn btn-default btn-xs" style="margin-top:-2px;"
                            role="button">评论（{{ $article->comments_count }}）</a>
                    </p>
                </div><!--/span-->
                @endforeach

                <div>
                    {{ pagination($articles, 'p.slider-3') }}
                </div>

            </div><!--/row-->
        </div><!--/span-->

        @include('w.blogSidebar', array('activeCategory' => $category_id))
        
    </div><!--/row-->

@stop
