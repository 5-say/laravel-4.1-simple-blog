<?php namespace Blog;

use View;
use Config;

class BlogController extends \BaseController {

    public function getIndex()
    {
        return View::make('Blog::index')
            ->with(array(
                'demo'=>'Blog',
                'content'=> '博客首页'
            ));
    }

}