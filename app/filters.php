<?php

/*
|--------------------------------------------------------------------------
| 注册应用程序事件，执行顺序如下：
|--------------------------------------------------------------------------
|
| 1.执行 应用程序事件   App::before   参数 $request
| 2.执行 前置过滤器   Route::filter   参数 $route, $request
| 
| 3.执行（之前注册进路由的）匿名回调函数或相应的控制器方法，并取得响应实例 $response
| 
| 4.执行 后置过滤器   Route::filter   参数 $route, $request, $response
| 5.执行 应用程序事件   App::after    参数 $request, $response
| 
| 6.向客户端返回响应实例 $response
| 
| 7.执行 应用程序事件   App::finish   参数 $request, $response
| 8.执行 应用程序事件   App::shutdown 参数 $application
|
*/

# App::before(function ($request) {});

# App::after(function ($request, $response) {});

# App::finish(function ($request, $response) {});

# App::shutdown(function($application) {});


/*
|--------------------------------------------------------------------------
| [前置] 过滤器
|--------------------------------------------------------------------------
# Route::filter('beforeFilter', function ($route, $request) {});
|
*/


# CSRF保护过滤器，防止跨站点请求伪造攻击
Route::filter('csrf', function()
{
    if (Session::token() !== Input::get('_token'))
        throw new Illuminate\Session\TokenMismatchException;
});

# 必须是管理员
Route::filter('admin', function () {
    // 拦截非管理员用户，跳转回上一页面
    if (! Auth::user()->is_admin) return Redirect::back();
});

# 必须是登录用户
Route::filter('auth', function () {
    // 拦截未登录用户并记录当前 URL，跳转到登录页面
    if (Auth::guest()) return Redirect::guest(route('signin'));
});

# HTTP 基础身份验证过滤器 - 单次弹窗登录验证
Route::filter('auth.basic', function () {
    return Auth::basic();
});

# 必须是游客（较少应用）
Route::filter('guest', function () {
    // 拦截已登录用户
    if (Auth::check()) return Redirect::to('/');
});

# 禁止对自己的账号进行危险操作
Route::filter('not.self', function ($route) {
    // 拦截自身用户 ID
    if (Auth::user()->id == $route->parameter('id'))
        return Redirect::back();
});



/*
|--------------------------------------------------------------------------
| [后置] 过滤器
|--------------------------------------------------------------------------
# Route::filter('afterFilter', function ($route, $request, $response) {});
|
*/



/*
|--------------------------------------------------------------------------
| 事件监控
|--------------------------------------------------------------------------
|
*/
# 用户登录事件
Event::listen('auth.login', function ($user, $remember) {
    // 记录最后登录时间
    $user->signin_at = new Carbon;
    $user->save();
    // 后期可附加权限相关操作
    // ...
});
# 用户退出事件
// Event::listen('auth.logout', function ($user) {
//     // 
// });
