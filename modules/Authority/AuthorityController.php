<?php namespace Authority;

use View;
use Input;
use Validator;
use Redirect;
use Mail;
use Hash;
use App;
use Auth;
use Carbon\Carbon;
use Password;
use Lang;
use Config;

class AuthorityController extends \BaseController {
    

    /**
     * 登录
     * @return Response
     */
    public function getSignin()
    {
        return View::make('Authority::signin');
    }
    public function postSignin()
    {
        // 凭证
        $credentials = array('email'=>Input::get('email'), 'password'=>Input::get('password'));
        // 是否记住登录状态
        $remember    = Input::get('remember-me', 0);
        // 验证登录
        if (Auth::attempt($credentials, $remember))
        { // 登录成功，跳回之前被拦截的页面
            return Redirect::intended();
        } // 登录失败
        else
        { // 跳回
            return Redirect::back()
                ->withInput()
                ->withErrors(array('attempt'=>'“邮箱”或“密码”错误，请重新登录。'));
        }
    }

    /**
     * 退出
     * @return Response
     */
    public function getLogout()
    {
        Auth::logout();
        return Redirect::to(Config::get('Authority::lougoutTo'));
    }
    
    /**
     * 注册
     * @return Response
     */
    public function getSignup()
    {
        return View::make('Authority::signup');
    }
    public function postSignup()
    {
        // 获取所有表单数据.
        $data = Input::all();
        // 创建验证规则
        $rules = array(
            'email'    => 'email|unique:users',
            'password' => 'alpha_dash|between:6,16|confirmed'
        );
        // 自定义验证消息
        $messages = array(
            'email.email'  => '请输入正确的邮箱地址。',
            'email.unique' => '此邮箱已被使用。',
            'password.alpha_dash' => '密码格式不正确。',
            'password.between'    => '密码长度请保持在:min到:max位之间。',
            'password.confirmed'  => '两次输入的密码不一致。'
        );
        // 开始验证
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes())
        { // 验证成功
            // 添加用户
            $user = new User;
            $user->email    = Input::get('email');
            $user->password = Hash::make( Input::get('password') );
            if ( $user->save() )
            { // 添加成功
                // 生成激活码
                $activation = new Activation;
                $activation->email = $user->email;
                $activation->token = str_random(40);
                $activation->save();
                // 发送激活邮件
                $with = array('activationCode'=>$activation->token);
                Mail::send('Authority::email/activation', $with, function($message) use($user)
                {
                    $message
                        ->to($user->email)
                        ->subject('Demo 账号激活邮件'); // 标题
                });
                // 跳转到注册成功页面
                return Redirect::route('signupSuccess', $user->email);
            } // 添加失败
            else
            { // 跳回
                return Redirect::back()
                    ->withInput()
                    ->withErrors(array('add'=>'注册失败。'));
            }
        } // 验证失败
        else
        { // 跳回
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }
    }
    public function getSignupSuccess($email)
    {
        // 确认是否存在此未激活邮箱
        $activation = Activation::whereRaw("email = '{$email}'")->first();
        // 数据库中无邮箱，抛出404
        is_null($activation) AND App::abort(404);
        // 提示激活
        return View::make('Authority::signupSuccess')->with('email', $email);
    }
    
    /**
     * 动作：激活账号
     * @param  string $activationCode 激活令牌
     * @return Response
     */
    public function getActivate($activationCode)
    {
        // 数据库验证令牌
        $activation = Activation::whereRaw("token = '{$activationCode}'")->first();
        // 数据库中无令牌，抛出404
        is_null($activation) AND App::abort(404);
        // 数据库中有令牌
        // 激活对应用户
        $user = User::whereRaw("email = '{$activation->email}'")->first();
        $user->activated_at = new Carbon;
        $user->save();
        // 删除令牌
        $activation->delete();
        // 激活成功提示
        return View::make('Authority::activation');
    }

    /**
     * 忘记密码，发送密码重置邮件
     * @return Response
     */
    public function getForgotPassword()
    {
        return View::make('Authority::password.remind');
    }
    public function postForgotPassword()
    {
        // 调用系统提供的类
        // 检测邮箱并发送密码重置邮件
        switch ($response = Password::remind(Input::only('email')))
        {
            case Password::INVALID_USER:
                return Redirect::back()->with('error', Lang::get($response));
            case Password::REMINDER_SENT:
                return Redirect::back()->with('status', Lang::get($response));
        }
    }

    /**
     * 进行密码重置
     * @return Response
     */
    public function getReset($token)
    {
        return View::make('Authority::password.reset')->with('token', $token);
    }
    public function postReset()
    {
        // 调用系统自带密码重置流程
        $credentials = Input::only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function($user, $password)
        {
            $user->password = Hash::make($password);

            $user->save();
        });

        switch ($response)
        {
            case Password::INVALID_PASSWORD:
            case Password::INVALID_TOKEN:
            case Password::INVALID_USER:
                return Redirect::back()->with('error', Lang::get($response));

            case Password::PASSWORD_RESET:
                return Redirect::to(Config::get('Authority::resetedTo'));
        }
    }


}