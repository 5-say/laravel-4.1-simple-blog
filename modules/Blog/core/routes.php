<?php

// 注册视图别名
View::addNamespace('Blog', __DIR__.'/../views');
// 注册配置别名（模块不使用独立配置的可以注释掉）
// Config::package('_modules/Blog', __DIR__, 'Blog');

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
Route::group(array('prefix'=>'/'), function()
{
    $Blog = 'Blog\BlogController@';

    Route::get('about-us', function()
    {
        return View::make('frontend/about-us');
    });

    Route::get('contact-us', array('as'=>'contact-us', 'uses'=>'ContactUsController@getIndex'));
    Route::post('contact-us', 'ContactUsController@postIndex');

    Route::get('blog/{postSlug}', array('as'=>'view-post', 'uses'=>'BlogController@getView'));
    Route::post('blog/{postSlug}', 'BlogController@postView');

    Route::get('/', array('as'=>'home', 'uses'=>'BlogController@getIndex'));
});
