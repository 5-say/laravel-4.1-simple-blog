<?php

/*
|--------------------------------------------------------------------------
| Filters
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
*/

/**
 * 基础功能
 */
Route::group(array('prefix' => '/'), function () {

    # 博客首页
    Route::get('/', array('as' => 'home', 'uses' => 'BlogController@getIndex'));
    # 分类文章列表
    Route::get('category/{id}', array('as' => 'categoryArticles', 'uses' => 'BlogController@getCategoryArticles'));
    # 展示博客文章
    Route::get('{slug}', array('as' => 'blog.show', 'uses' => 'BlogController@getBlogShow'));
    # 提交文章评论
    Route::post('{slug}', 'BlogController@postBlogComment');

});

/**
 * 管理员后台
 */
Route::group(array('prefix' => 'admin', 'before' => 'auth|admin'), function () {

    # 文章分类管理
    Route::group(array('prefix' => 'categories'), function () {
        $resource   = 'categories';
        $controller = 'CategoryResource@';
        Route::get(        '/' , array('as' => $resource.'.index'   , 'uses' => $controller.'index'  ));
        Route::get(   'create' , array('as' => $resource.'.create'  , 'uses' => $controller.'create' ));
        Route::post(       '/' , array('as' => $resource.'.store'   , 'uses' => $controller.'store'  ));
        // Route::get(     '{id}' , array('as' => $resource.'.show'    , 'uses' => $controller.'show'   ));
        Route::get('{id}/edit' , array('as' => $resource.'.edit'    , 'uses' => $controller.'edit'   ));
        Route::put(     '{id}' , array('as' => $resource.'.update'  , 'uses' => $controller.'update' ));
        Route::delete(  '{id}' , array('as' => $resource.'.destroy' , 'uses' => $controller.'destroy'));
    });

    # 文章管理
    Route::group(array('prefix' => 'articles'), function () {
        $resource   = 'articles';
        $controller = 'ArticleResource@';
        Route::get(        '/' , array('as' => $resource.'.index'   , 'uses' => $controller.'index'  ));
        Route::get(   'create' , array('as' => $resource.'.create'  , 'uses' => $controller.'create' ));
        Route::post(       '/' , array('as' => $resource.'.store'   , 'uses' => $controller.'store'  ));
        // Route::get(     '{id}' , array('as' => $resource.'.show'    , 'uses' => $controller.'show'   ));
        Route::get('{id}/edit' , array('as' => $resource.'.edit'    , 'uses' => $controller.'edit'   ));
        Route::put(     '{id}' , array('as' => $resource.'.update'  , 'uses' => $controller.'update' ));
        Route::delete(  '{id}' , array('as' => $resource.'.destroy' , 'uses' => $controller.'destroy'));
    });
});
