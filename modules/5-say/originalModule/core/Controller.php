<?php
namespace Blog;

use View;
use Config;

class core_Controller extends \BaseController
{

    public function getIndex()
    {
        $articles   = Article::paginate(5);
        $categories = Category::orderBy('sort_order')->get();
        return View::make('Blog::index')->with(compact('articles', 'categories'));
    }


}