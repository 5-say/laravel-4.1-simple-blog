<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="zh"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>@section('title')
               @show</title>{{-- 页面标题 --}}
        <meta name="description" content="@yield('description')">{{-- 页面描述 --}}
        <meta name="keywords" content="@yield('keywords')" />{{-- 页面关键词 --}}
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script>
            (function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)
        </script>
        @section('beforeStyle')
        @show{{-- 页面内联样式之前 --}}
        <style>
body, h1, .h1, h2, .h2, h3, .h3, h4, .h4, .lead
{
    font-family: "ff-tisa-web-pro-1","ff-tisa-web-pro-2","Lucida Grande","Helvetica Neue",Helvetica,Arial,"Hiragino Sans GB","Hiragino Sans GB W3","Microsoft YaHei UI","Microsoft YaHei","WenQuanYi Micro Hei",sans-serif;
}

@section('style')
@show{{-- 累加的页面内联样式 --}}
        </style>
        @section('afterStyle')
        @show{{-- 页面内联样式之后 --}}

    </head>
    <body>
        
        @yield('body')
        
        @section('end')
        @show{{-- 页面主体之后 --}}

    </body>
</html>
