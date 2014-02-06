<?php
namespace Authority;

use View;
use Config;
use Input;
use Validator;
use Redirect;
use Auth;
use Carbon\Carbon;
use Hash;

class UserResource extends \BaseResource
{

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
            'email'    => 'required|email|unique:users',
            'password' => 'required|alpha_dash|between:6,16|confirmed',
            'is_admin' => 'in:1',
        );
        // 自定义验证消息
        $messages = array(
            'email.required'      => '请输入邮箱地址。',
            'email.email'         => '请输入正确的邮箱地址。',
            'email.unique'        => '此邮箱已被使用。',
            'password.required'   => '请输入密码。',
            'password.alpha_dash' => '密码格式不正确。',
            'password.between'    => '密码长度请保持在:min到:max位之间。',
            'password.confirmed'  => '两次输入的密码不一致。',
            'is_admin.in'         => '非法输入。',
        );
        // 开始验证
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes())
        { // 验证成功
            // 添加用户
            $user = new User;
            $user->email        = Input::get('email');
            $user->password     = Hash::make( Input::get('password') );
            $user->is_admin     = (int)Input::get('is_admin', 0);
            $user->activated_at = new Carbon;
            if ( $user->save() )
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
        } // 验证失败
        else
        { // 跳回
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
        $user = User::find($id);
        return View::make('Authority::user.edit')->with('user', $user);
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
            'email'    => 'required|email|unique:users,email,'.$id,
            'password' => 'alpha_dash|between:6,16|confirmed',
            'is_admin' => 'in:1',
        );
        // 自定义验证消息
        $messages = array(
            'email.required'      => '请输入邮箱地址。',
            'email.email'         => '请输入正确的邮箱地址。',
            'email.unique'        => '此邮箱已被使用。',
            'password.alpha_dash' => '密码格式不正确。',
            'password.between'    => '密码长度请保持在:min到:max位之间。',
            'password.confirmed'  => '两次输入的密码不一致。',
            'is_admin.in'         => '非法输入。',
        );
        // 开始验证
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes())
        { // 验证成功
            // 更新用户
            $user = User::find($id);
            $user->email    = Input::get('email');
            $user->is_admin = (int)Input::get('is_admin', 0);
            Input::has('password') AND $user->password = Hash::make( Input::get('password') );
            if ( $user->save() )
            { // 更新成功
                return Redirect::back()
                    ->with('success', '<strong>用户信息编辑成功：</strong>您可以继续编辑用户，或返回用户列表。');
            }
            else
            { // 更新失败
                return Redirect::back()
                    ->withInput()
                    ->with('error', '<strong>用户信息编辑失败。</strong>');
            }
        } // 验证失败
        else
        { // 跳回
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