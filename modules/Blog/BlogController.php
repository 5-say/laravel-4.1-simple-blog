<?php namespace Blog;

use BaseController;
use View;
use Config;

class BlogController extends BaseController {

    public function getIndex()
    {
        return View::make('Blog::index')
            ->with(array(
                'demo'=>'Blog',
                'content'=> Config::get('Blog::test')
            ));
    }

}