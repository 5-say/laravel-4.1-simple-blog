<?php # 注意：此文件位于顶层命名空间！！！

// 注册视图别名
View::addNamespace('Authority', __DIR__.'/../views');
// 注册配置别名（模块不使用独立配置的可以注释掉）
Config::package('_modules/Authority', __DIR__, 'Authority');
// 覆盖原始 auth 配置
Config::set('auth', Config::get('Authority::config'));

/*
|--------------------------------------------------------------------------
| Filters
|--------------------------------------------------------------------------
*/

// 身份验证过滤器 - 管理员
Route::filter('admin', function () {
    // 拦截非管理员用户
    // 跳转回上一页面
    if (! Auth::user()->is_admin) return Redirect::back();
});

// 身份验证过滤器 - 登录用户
Route::filter('auth', function () {
    // 拦截未登录用户并记录当前 URL
    // 跳转到登录页面
    if (Auth::guest()) return Redirect::guest( route('signin') );
});

// HTTP 基础身份验证过滤器 - 登录用户
Route::filter('auth.basic', function () {
    return Auth::basic();
});

// 身份验证过滤器 - 游客（较少应用）
Route::filter('guest', function () {
    // 拦截已登录用户
    if (Auth::check()) return Redirect::to('/');
});

// 不可对自己的账号进行危险操作
Route::filter('not.self', function ($route, $request) {
    // 拦截自身用户 ID
    if (Auth::user()->id == $route->parameter('id'))
        return Redirect::back();
});

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
*/

/**
 * 基础功能
 */
Route::group(array('prefix' => '/'), function () {
    
    $Authority = 'Authority\AuthorityController@';

    # 退出
    Route::get('logout', array('as' => 'logout', 'uses' => $Authority.'getLogout'));

    Route::group(array('before' => 'guest'), function () use ($Authority) {
        # 登录
        Route::get('signin', array('as' => 'signin', 'uses' => $Authority.'getSignin'));
        Route::post('signin', $Authority.'postSignin');
        # 注册
        Route::get('signup', array('as' => 'signup', 'uses' => $Authority.'getSignup'));
        Route::post('signup', $Authority.'postSignup');
        # 注册成功提示用户激活
        Route::get('success/{email}', array('as' => 'signupSuccess', 'uses' => $Authority.'getSignupSuccess'));
        # 激活账号
        Route::get('activate/{activationCode}', array('as' => 'activate', 'uses' => $Authority.'getActivate'));
        # 忘记密码
        Route::get('forgot-password', array('as' => 'forgotPassword', 'uses' => $Authority.'getForgotPassword'));
        Route::post('forgot-password', $Authority.'postForgotPassword');
        # 密码重置
        Route::get('forgot-password/{token}', array('as' => 'reset', 'uses' => $Authority.'getReset'));
        Route::post('forgot-password/{token}', $Authority.'postReset');
    });
});
/**
 * 管理员后台
 */
Route::group(array('prefix' => 'admin', 'before' => 'auth|admin'), function () {
    # 用户管理
    Route::group(array('prefix' => 'users'), function () {
        $resource   = 'users';
        $controller = 'Authority\UserResource@';
        Route::get(        '/' , array('as' => $resource.'.index'   , 'uses' => $controller.'index'  ));
        Route::get(   'create' , array('as' => $resource.'.create'  , 'uses' => $controller.'create' ));
        Route::post(       '/' , array('as' => $resource.'.store'   , 'uses' => $controller.'store'  ));
        // Route::get(     '{id}' , array('as' => $resource.'.show'    , 'uses' => $controller.'show'   ));
        Route::get('{id}/edit' , array('as' => $resource.'.edit'    , 'uses' => $controller.'edit'   ))->before('not.self');
        Route::put(     '{id}' , array('as' => $resource.'.update'  , 'uses' => $controller.'update' ))->before('not.self');
        Route::delete(  '{id}' , array('as' => $resource.'.destroy' , 'uses' => $controller.'destroy'))->before('not.self');
    });
});
/**
 * 用户后台
 */
Route::group(array('prefix' => 'account'), function () {
    $Account = 'Authority\core_Controller@';
    # 修改当前账号密码
    Route::get('change-password', array('as' => 'changePassword', 'uses' => $Account.'getChangePassword'));
    Route::put('change-password', $Account.'putChangePassword');
});

/*
|--------------------------------------------------------------------------
| Events
|--------------------------------------------------------------------------
*/

# 用户登录事件
Event::listen('auth.login', function ($user, $remember) {
    // 记录最后登录时间
    $user->signin_at = new Carbon\Carbon;
    $user->save();
    // 后期附加权限相关操作
});

# 用户退出事件
Event::listen('auth.logout', function ($user) {
    // 
});