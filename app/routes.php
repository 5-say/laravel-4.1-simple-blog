<?php

// 开发辅助（若无需要可以注释）
include __DIR__.'/controllers/Assists/assist.php';


/*
|--------------------------------------------------------------------------
| 基础权限
|--------------------------------------------------------------------------
*/
Route::group(array('prefix' => 'auth'), function () {
    $Authority = 'AuthorityController@';
    # 退出
    Route::get('logout', array('as' => 'logout', 'uses' => $Authority.'getLogout'));
    Route::group(array('before' => 'guest'), function () use ($Authority) {
        # 登录
        Route::get(                   'signin', array('as' => 'signin'        , 'uses' => $Authority.'getSignin'));
        Route::post(                  'signin', $Authority.'postSignin');
        # 注册
        Route::get(                   'signup', array('as' => 'signup'        , 'uses' => $Authority.'getSignup'));
        Route::post(                  'signup', $Authority.'postSignup');
        # 注册成功提示用户激活
        Route::get(          'success/{email}', array('as' => 'signupSuccess' , 'uses' => $Authority.'getSignupSuccess'));
        # 激活账号
        Route::get('activate/{activationCode}', array('as' => 'activate'      , 'uses' => $Authority.'getActivate'));
        # 忘记密码
        Route::get(          'forgot-password', array('as' => 'forgotPassword', 'uses' => $Authority.'getForgotPassword'));
        Route::post(         'forgot-password', $Authority.'postForgotPassword');
        # 密码重置
        Route::get(  'forgot-password/{token}', array('as' => 'reset'         , 'uses' => $Authority.'getReset'));
        Route::post( 'forgot-password/{token}', $Authority.'postReset');
    });
});
/*
|--------------------------------------------------------------------------
| 管理员后台
|--------------------------------------------------------------------------
*/
Route::group(array('prefix' => 'admin', 'before' => 'auth|admin'), function () {
    $Admin = 'AdminController@';
    # 后台首页
    Route::get('/', array('as' => 'admin', 'uses' => $Admin.'getIndex'));
    # 用户管理
    Route::group(array('prefix' => 'users'), function () {
        $resource   = 'users';
        $controller = 'Admin_UserResource@';
        Route::get(        '/', array('as' => $resource.'.index'  , 'uses' => $controller.'index'  ));
        Route::get(   'create', array('as' => $resource.'.create' , 'uses' => $controller.'create' ));
        Route::post(       '/', array('as' => $resource.'.store'  , 'uses' => $controller.'store'  ));
        // Route::get(     '{id}', array('as' => $resource.'.show'   , 'uses' => $controller.'show'   ));
        Route::get('{id}/edit', array('as' => $resource.'.edit'   , 'uses' => $controller.'edit'   ))->before('not.self');
        Route::put(     '{id}', array('as' => $resource.'.update' , 'uses' => $controller.'update' ))->before('not.self');
        Route::delete(  '{id}', array('as' => $resource.'.destroy', 'uses' => $controller.'destroy'))->before('not.self');
    });
    # 文章分类管理
    Route::group(array('prefix' => 'categories'), function () {
        $resource   = 'categories';
        $controller = 'Admin_CategoryResource@';
        Route::get(        '/', array('as' => $resource.'.index'  , 'uses' => $controller.'index'  ));
        Route::get(   'create', array('as' => $resource.'.create' , 'uses' => $controller.'create' ));
        Route::post(       '/', array('as' => $resource.'.store'  , 'uses' => $controller.'store'  ));
        // Route::get(     '{id}', array('as' => $resource.'.show'   , 'uses' => $controller.'show'   ));
        Route::get('{id}/edit', array('as' => $resource.'.edit'   , 'uses' => $controller.'edit'   ));
        Route::put(     '{id}', array('as' => $resource.'.update' , 'uses' => $controller.'update' ));
        Route::delete(  '{id}', array('as' => $resource.'.destroy', 'uses' => $controller.'destroy'));
    });
    # 文章管理
    Route::group(array('prefix' => 'articles'), function () {
        $resource   = 'articles';
        $controller = 'Admin_ArticleResource@';
        Route::get(        '/', array('as' => $resource.'.index'  , 'uses' => $controller.'index'  ));
        Route::get(   'create', array('as' => $resource.'.create' , 'uses' => $controller.'create' ));
        Route::post(       '/', array('as' => $resource.'.store'  , 'uses' => $controller.'store'  ));
        // Route::get(     '{id}', array('as' => $resource.'.show'   , 'uses' => $controller.'show'   ));
        Route::get('{id}/edit', array('as' => $resource.'.edit'   , 'uses' => $controller.'edit'   ));
        Route::put(     '{id}', array('as' => $resource.'.update' , 'uses' => $controller.'update' ));
        Route::delete(  '{id}', array('as' => $resource.'.destroy', 'uses' => $controller.'destroy'));
    });
});
/*
|--------------------------------------------------------------------------
| 用户中心
|--------------------------------------------------------------------------
*/
Route::group(array('prefix' => 'account', 'before' => 'auth'), function () {
    $Account = 'AccountController@';
    # 用户中心首页
    Route::get(              '/', array('as' => 'account'               , 'uses' => $Account.'getIndex'));
    # 修改当前账号密码
    Route::get('change-password', array('as' => 'account.changePassword', 'uses' => $Account.'getChangePassword'));
    Route::put('change-password', $Account.'putChangePassword');
    # 我的评论管理
    Route::get('my-comments'    , array('as' => 'account.myComments'    , 'uses' => $Account.'getIndex'));
});
/*
|--------------------------------------------------------------------------
| 博客
|--------------------------------------------------------------------------
*/
Route::group(array(), function () {
    $Blog = 'BlogController@';
    # 博客首页
    Route::get(            '/', array('as' => 'home'            , 'uses' => $Blog.'getIndex'));
    # 分类文章列表
    Route::get('category/{id}', array('as' => 'categoryArticles', 'uses' => $Blog.'getCategoryArticles'));
    # 展示博客文章
    Route::get(       '{slug}', array('as' => 'blog.show'       , 'uses' => $Blog.'getBlogShow'));
    # 提交文章评论
    Route::post(      '{slug}', $Blog.'postBlogComment');
});



