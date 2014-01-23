<?php namespace Blog;

use View;
use Config;

class PostController extends \BaseController {

    /**
     * 资源列表页面
     * GET         /resource
     * @return Response
     */
    public function index()
    {
        $post = Post::first();
        $comments = $post->number_of_comments;
        dd($comments, $post->friendly_created_at);
    }

    /**
     * 资源创建页面
     * GET         /resource/create
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * 资源创建动作
     * POST        /resource
     * @return Response
     */
    public function store()
    {
        //
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
        //
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