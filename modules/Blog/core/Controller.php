<?php
namespace Blog;

use View;
use Config;
use App;
use Input;
use Redirect;
use Auth;

class core_Controller extends \BaseController
{

    public function getIndex()
    {
        $articles   = Article::paginate(5);
        $categories = Category::orderBy('sort_order')->get();
        return View::make('Blog::index')->with(compact('articles', 'categories'));
    }

    /**
     * 博客文章展示页面
     * @param  string $slug 文章缩略名
     * @return response
     */
    public function getBlogShow($slug)
    {
        $article = Article::where('slug', $slug)->first();
        is_null($article) AND App::abort(404);
        return View::make('Blog::show')->with(compact('article'));
    }

    /**
     * 提交评论
     * @param  string $slug 文章缩略名
     * @return response
     */
    public function postBlogComment($slug)
    {
        // 获取评论内容
        $content = e(Input::get('content'));
        // 字数检查
        if (mb_strlen($content)<3)
            return Redirect::back()->withInput()->withErrors($this->messages->add('content', '评论不得少于3个字符。'));
        // 查找对应文章
        $article = Article::where('slug', $slug)->first();
        // 创建文章评论
        $comment = new Comment;
        $comment->content    = $content;
        $comment->article_id = $article->id;
        $comment->user_id    = Auth::user()->id;
        if ($comment->save()) {
            // 创建成功
            return Redirect::back()->with('success', '评论成功。');
        } else {
            // 创建失败
            return Redirect::back()->withInput()->with('error', '评论失败。');
        }
    }

}