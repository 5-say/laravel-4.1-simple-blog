<?php

// 注册视图别名
View::addNamespace('Authority', __DIR__.'/../views');
// 注册配置别名（模块不使用独立配置的可以注释掉）
Config::package('_modules/Authority', __DIR__, 'Authority');
Config::set('auth', Config::get('Authority::config'));

/*
|--------------------------------------------------------------------------
| Filters
|--------------------------------------------------------------------------
*/

// 身份验证过滤器
Route::filter('auth', function()
{
    // 拦截未登录用户并记录当前 URL
    if (Auth::guest()) return Redirect::guest( route('signin') );
});

// HTTP 基础身份验证过滤器
Route::filter('auth.basic', function()
{
    return Auth::basic();
});

// 游客身份过滤器
Route::filter('guest', function()
{
    // 拦截已登录用户
    if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
*/

Route::group(array('prefix'=>'/'), function()
{
    $Authority = 'Authority\AuthorityController@';

    # 登录
    Route::get('signin', array('as'=>'signin', 'uses'=>$Authority.'getSignin'));
    Route::post('signin', $Authority.'postSignin');

    # 退出
    Route::get('logout', array('as'=>'logout', 'uses'=>$Authority.'getLogout'));

    # 注册
    Route::get('signup', array('as'=>'signup', 'uses'=>$Authority.'getSignup'));
    Route::post('signup', $Authority.'postSignup');
    # 注册成功提示用户激活
    Route::get('signup/success', array('as'=>'signupSuccess', 'uses'=>$Authority.'getSignupSuccess'));
    
    # 激活账号
    Route::get('activate/{activationCode}', array('as'=>'activate', 'uses'=>$Authority.'getActivate'));

    # 忘记密码
    Route::get('forgot-password', array('as'=>'forgotPassword', 'uses'=>$Authority.'getForgotPassword'));
    Route::post('forgot-password', $Authority.'postForgotPassword');
    # 密码重置
    Route::get('forgot-password/{token}', array('as'=>'reset', 'uses'=>$Authority.'getReset'));
    Route::post('forgot-password/{token}', $Authority.'postReset');

});

/*
|--------------------------------------------------------------------------
| Events
|--------------------------------------------------------------------------
*/

# 用户登录事件
Event::listen('user.login', function($user)
{
    // 记录最后登录时间
    $user->last_login = new Carbon\Carbon;
    $user->save();
    // 后期附加权限相关操作
});

# 用户退出事件
Event::listen('user.logout', function($user)
{
    // 
});