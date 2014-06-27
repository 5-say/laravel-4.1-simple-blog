<?php

/*
|--------------------------------------------------------------------------
| 复写官方函数
|--------------------------------------------------------------------------
|
| 官方函数库路径
| Illuminate/Support/helpers.php
|
*/

if (! function_exists('route')) {
    /**
     * Generate a URL to a named route.
     *
     * @param  string  $route
     * @param  string  $parameters
     * @return string
     */
    function route($route, $parameters = array())
    {
        if (Route::getRoutes()->hasNamedRoute($route))
            return app('url')->route($route, $parameters);
        else
            return 'javascript:void(0)';
    }
}

if (! function_exists('link_to_route')) {
    /**
     * Generate a HTML link to a named route.
     *
     * @param  string  $name
     * @param  string  $title
     * @param  array   $parameters
     * @param  array   $attributes
     * @return string
     */
    function link_to_route($name, $title = null, $parameters = array(), $attributes = array())
    {
        if (Route::getRoutes()->hasNamedRoute($name))
            return app('html')->linkRoute($name, $title, $parameters, $attributes);
        else
            return '<a href="javascript:void(0)"'.HTML::attributes($attributes).'>'.$name.'</a>';
    }
}


/*
|--------------------------------------------------------------------------
| 延伸自拓展配置文件
|--------------------------------------------------------------------------
|
*/

if (! function_exists('style')) {
    /**
     * 样式别名加载（支持批量加载，后期可拓展为自动多文件压缩合并）
     * @param  dynamic  mixed  配置文件中的别名
     * @return string
     */
    function style()
    {
        $cssAliases = Config::get('extend.cssAliases');
        $styleArray = array_map(function ($aliases) use ($cssAliases) {
            if (isset($cssAliases[$aliases]))
                return HTML::style($cssAliases[$aliases]);
        }, func_get_args());
        return implode('', array_filter($styleArray));
    }
}

if (! function_exists('script')) {
    /**
     * 脚本别名加载（支持批量加载，后期可拓展为自动多文件压缩合并）
     * @param  dynamic  mixed  配置文件中的别名
     * @return string
     */
    function script()
    {
        $jsAliases   = Config::get('extend.jsAliases');
        $scriptArray = array_map(function ($aliases) use ($jsAliases) {
            if (isset($jsAliases[$aliases]))
                return HTML::script($jsAliases[$aliases]);
        }, func_get_args());
        return implode('', array_filter($scriptArray));
    }
}


/*
|--------------------------------------------------------------------------
| 自定义核心函数
|--------------------------------------------------------------------------
|
*/

if (! function_exists('define_array')) {
    /**
     * 批量定义常量
     * @param  array  $define 常量和值的数组
     * @return void
     */
    function define_array($define = array())
    {
        foreach ($define as $key => $value)
            defined($key) OR define($key, $value);
    }
}

if (! function_exists('friendly_date')) {
    /**
     * 友好的日期输出
     * @param  string|\Carbon\Carbon $theDate 待处理的时间字符串 | \Carbon\Carbon 实例
     * @return string                         友好的时间字符串
     */
    function friendly_date($theDate)
    {
        // 获取待处理的日期对象
        if (! $theDate instanceof \Carbon\Carbon)
            $theDate = \Carbon\Carbon::createFromTimestamp(strtotime($theDate));
        // 取得英文日期描述
        $friendlyDateString = $theDate->diffForHumans(\Carbon\Carbon::now());
        // 本地化
        $friendlyDateArray  = explode(' ', $friendlyDateString);
        $friendlyDateString = $friendlyDateArray[0]
            .Lang::get('friendlyDate.'.$friendlyDateArray[1])
            .Lang::get('friendlyDate.'.$friendlyDateArray[2]);
        // 数据返回
        return $friendlyDateString;
    }
}

if (! function_exists('pagination')) {
    /**
     * 拓展分页输出，支持临时指定分页模板
     * @param  Illuminate\Pagination\Paginator $paginator 分页查询结果的最终实例
     * @param  string                          $viewName  分页视图名称
     * @return \Illuminate\View\View
     */
    function pagination(Illuminate\Pagination\Paginator $paginator, $viewName = null)
    {
        $viewName = $viewName ?: Config::get('view.pagination');
        $paginator->getEnvironment()->setViewName($viewName);
        return $paginator->links();
    }
}

if (! function_exists('strip')) {
    /**
     * 反引用一个经过 e（htmlentities）和 addslashes 处理的字符串
     * @param  string $string 待处理的字符串
     * @return 转义后的字符串
     */
    function strip($string)
    {
        return stripslashes(HTML::decode($string));
    }
}


/*
|--------------------------------------------------------------------------
| 公共函数库
|--------------------------------------------------------------------------
|
*/

if (! function_exists('close_tags')) {
    /**
     * 闭合 HTML 标签 （此函数仍存在缺陷，无法处理不完整的标签，暂无更优方案，慎用）
     * @param  string $html HTML 字符串
     * @return string
     */
    function close_tags($html)
    {
        // 不需要补全的标签
        $singleTags = array('meta', 'img', 'br', 'link', 'area');
        // 匹配开始标签
        preg_match_all('#<([a-z1-6]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
        $openedTags = array_filter(array_reverse($result[1]), function ($tag) use ($singleTags) {
            if (! in_array($tag, $singleTags)) return $tag;
        });
        // 匹配关闭标签
        preg_match_all('#</([a-z]+)>#iU', $html, $result);
        $closedTags = $result[1];
        // 开始补全
        foreach ($openedTags as $value) {
            if (in_array($value, $closedTags)) {
                unset($closedTags[array_search($value, $closedTags)]);
            } else {
                $html .= '</'.$value.'>';
            }
        }
        return $html;
    }
}

if (! function_exists('order_by')) {
    /**
     * 用于资源列表的排序标签
     * @param  string $columnName 列名
     * @param  string $default    是否默认排序列，up 默认升序 down 默认降序
     * @return string             a 标签排序图标
     */
    function order_by($columnName = '', $default = null)
    {
        $sortColumnName = Input::get('sort_up', Input::get('sort_down', false));
        if (Input::get('sort_up')) {
            $except = 'sort_up'; $orderType = 'sort_down';
        } else {
            $except = 'sort_down' ; $orderType = 'sort_up';
        }
        if ($sortColumnName == $columnName) {
            $parameters = array_merge(Input::except($except), array($orderType => $columnName));
            $icon       = Input::get('sort_up') ? 'chevron-up' : 'chevron-down' ;
        } elseif ($sortColumnName === false && $default == 'asc') {
            $parameters = array_merge(Input::all(), array('sort_down' => $columnName));
            $icon       = 'chevron-up';
        } elseif ($sortColumnName === false && $default == 'desc') {
            $parameters = array_merge(Input::all(), array('sort_up' => $columnName));
            $icon       = 'chevron-down';
        } else {
            $parameters = array_merge(Input::except($except), array('sort_up' => $columnName));
            $icon       = 'random';
        }
        $a  = '<a href="';
        $a .= action(Route::current()->getActionName(), $parameters);
        $a .= '" class="glyphicon glyphicon-'.$icon.'"></a>';
        return $a;
    }
}
