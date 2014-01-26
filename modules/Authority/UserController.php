<?php namespace Authority;

use View;
use Config;
use Input;
use Validator;
use Redirect;
use Auth;

class UserController extends \BaseController {

    /**
     * 资源列表页面
     * GET         /resource
     * @return Response
     */
    public function index()
    {
        $users = User::paginate(15);
        return View::make('Authority::user.index')->with('users', $users);
    }

    /**
     * 资源创建页面
     * GET         /resource/create
     * @return Response
     */
    public function create()
    {
        return View::make('Authority::user.create');
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
            'title'   => 'required|unique:users',
            'slug'    => 'required|unique:users',
            'content' => 'required',
        );
        // 自定义验证消息
        $messages = array(
            'title.required'   => '请填写用户标题。',
            'title.unique'     => '已有同名用户。',
            'slug.required'    => '请填写用户 sulg。',
            'slug.unique'      => '已有同名 sulg。',
            'content.required' => '请填写用户内容。',
        );
        // 开始验证
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes())
        { // 验证成功
            // 添加用户
            $post = new Post;
            $post->user_id          = Auth::user()->id;
            $post->title            = e($data['title']);
            $post->slug             = e($data['slug']);
            $post->content          = e($data['content']);
            $post->meta_title       = e($data['meta_title']);
            $post->meta_description = e($data['meta_description']);
            $post->meta_keywords    = e($data['meta_keywords']);
            if ( $post->save() )
            { // 添加成功
                return Redirect::back()
                    ->with('success', '<strong>用户添加成功：</strong>您可以继续添加新用户，或返回用户列表。');
            }
            else
            { // 添加失败
                return Redirect::back()
                    ->withInput()
                    ->with('error', '<strong>用户添加失败。</strong>');
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
        $post = User::find($id);
        return View::make('Authority::user.edit')->with('post', $post);
    }

    /**
     * 资源编辑动作
     * PUT/PATCH   /resource/{id}
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        // 获取所有表单数据.
        $data = Input::all();
        // 创建验证规则
        $rules = array(
            'title'   => 'required|unique:users,title,'.$id,
            'slug'    => 'required|unique:users,slug,'.$id,
            'content' => 'required',
        );
        // 自定义验证消息
        $messages = array(
            'title.required'   => '请填写用户标题。',
            'title.unique'     => '已有同名用户。',
            'slug.required'    => '请填写用户 sulg。',
            'slug.unique'      => '已有同名 sulg。',
            'content.required' => '请填写用户内容。',
        );
        // 开始验证
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes())
        { // 验证成功
            // 更新用户
            $post = User::find($id);
            $post->title            = e($data['title']);
            $post->slug             = e($data['slug']);
            $post->content          = e($data['content']);
            $post->meta_title       = e($data['meta_title']);
            $post->meta_description = e($data['meta_description']);
            $post->meta_keywords    = e($data['meta_keywords']);
            if ( $post->save() )
            { // 更新成功
                return Redirect::back()
                    ->with('success', '<strong>用户更新成功：</strong>您可以继续编辑用户，或返回用户列表。');
            }
            else
            { // 更新失败
                return Redirect::back()
                    ->withInput()
                    ->with('error', '<strong>用户更新失败。</strong>');
            }
        }
        else
        { // 验证失败
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }

    /**
     * 资源删除动作
     * DELETE      /resource/{id}
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $post = User::find($id);
        if ( is_null($post) )
            return Redirect::back()->with('error', '没有找到对应的用户。');
        elseif ( $post->delete() )
            return Redirect::back()->with('success', '用户删除成功。');
        else
            return Redirect::back()->with('warning', '用户删除失败。');
    }

}