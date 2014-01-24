<?php namespace Blog;

use View;
use Config;
use Input;
use Validator;
use Redirect;

class PostController extends \BaseController {

    /**
     * 资源列表页面
     * GET         /resource
     * @return Response
     */
    public function index()
    {
        $posts = Post::paginate(15);
        return View::make('Blog::post.index')->with('posts', $posts);
    }

    /**
     * 资源创建页面
     * GET         /resource/create
     * @return Response
     */
    public function create()
    {
        return View::make('Blog::post.create');
    }

    /**
     * 资源创建动作
     * POST        /resource
     * @return Response
     */
    public function store()
    {
        // 获取所有表单数据.
        $data = Input::all();
        // 创建验证规则
        $rules = array(
            'title'   => 'required|unique:posts',
            'slug'    => 'required|unique:posts',
            'content' => 'required',
        );
        // 自定义验证消息
        $messages = array(
            'title.required'   => '请填写文章标题。',
            'title.unique'     => '已有同名文章。',
            'slug.required'    => '请填写文章 sulg。',
            'slug.unique'      => '已有同名 sulg。',
            'content.required' => '请填写文章内容。',
        );
        // 开始验证
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes())
        { // 验证成功
            // 添加文章
            $post = new Post;
            $post->title            = $data['title'];
            $post->slug             = $data['slug'];
            $post->content          = $data['content'];
            $post->meta_title       = $data['meta_title'];
            $post->meta_description = $data['meta_description'];
            $post->meta_keywords    = $data['meta_keywords'];
            if ( $post->save() )
            { // 添加成功
                return Redirect::back()
                    ->with('success', '<strong>文章添加成功：</strong>您可以继续添加新文章，或返回文章列表。');
            }
            else
            { // 添加失败
                return Redirect::back()
                    ->withInput()
                    ->with('error', '<strong>文章添加失败。</strong>');
            }
        }
        else
        { // 验证失败
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }

    /**
     * 资源展示页面
     * GET         /resource/{id}
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 资源编辑页面
     * GET         /resource/{id}/edit
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return View::make('Blog::post.edit')->with('post', $post);
    }

    /**
     * 资源编辑动作
     * PUT/PATCH   /resource/{id}
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * 资源删除动作
     * DELETE      /resource/{id}
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}