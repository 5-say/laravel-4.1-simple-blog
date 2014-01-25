<?php namespace Blog;

use View;
use Config;
use App;

class BlogController extends \BaseController {

    public function getIndex()
    {
        return View::make('Blog::index')
            ->with(array(
                'demo'=>'Blog',
                'content'=> '博客首页'
            ));
    }

    public function getBlogShow($slug)
    {
        $post = Post::where('slug', '=', $slug)->first();
        is_null($post) AND App::abort(404);
        return View::make('Blog::show')->with(compact('post'));
    }

}