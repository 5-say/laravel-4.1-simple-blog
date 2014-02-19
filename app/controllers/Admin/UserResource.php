<?php

class Admin_UserResource extends BaseResource
{
    /**
     * 资源视图目录
     * @var string
     */
    protected $resourceView = 'admin.user';

    /**
     * 资源模型名称，初始化后转为模型实例
     * @var string|Illuminate\Database\Eloquent\Model
     */
    protected $model = 'User';

    /**
     * 资源标识
     * @var string
     */
    protected $resource = 'users';

    /**
     * 资源数据库表
     * @var string
     */
    protected $resourceTable = 'users';

    /**
     * 资源名称（中文）
     * @var string
     */
    protected $resourceName = '用户';

    /**
     * 自定义验证消息
     * @var array
     */
    protected $validatorMessages = array(
        'email.required'      => '请输入邮箱地址。',
        'email.email'         => '请输入正确的邮箱地址。',
        'email.unique'        => '此邮箱已被使用。',
        'password.required'   => '请输入密码。',
        'password.alpha_dash' => '密码格式不正确。',
        'password.between'    => '密码长度请保持在:min到:max位之间。',
        'password.confirmed'  => '两次输入的密码不一致。',
        'is_admin.in'         => '非法输入。',
    );

    /**
     * 资源列表页面
     * GET         /resource
     * @return Response
     */
    public function index()
    {
        // 获取排序条件
        $orderColumn = Input::get('sort_up', Input::get('sort_down', 'created_at'));
        $direction   = Input::get('sort_up') ? 'asc' : 'desc' ;
        // 获取搜索条件
        switch (Input::get('status')) {
            case '0':
                $is_admin = 0;
                break;
            case '1':
                $is_admin = 1;
                break;
        }
        switch (Input::get('target')) {
            case 'email':
                $email = Input::get('like');
                break;
        }
        // 构造查询语句
        $query = $this->model->orderBy($orderColumn, $direction);
        isset($is_admin) AND $query->where('is_admin', $is_admin);
        isset($email)    AND $query->where('email', 'like', "%{$email}%");
        $datas = $query->paginate(15);
        return View::make($this->resourceView.'.index')->with(compact('datas'));
    }

    /**
     * 资源创建动作
     * POST        /resource
     * @return Response
     */
    public function store()
    {
        // 获取所有表单数据.
        $data   = Input::all();
        // 创建验证规则
        $unique = $this->unique();
        $rules  = array(
            'email'    => 'required|email|'.$unique,
            'password' => 'required|alpha_dash|between:6,16|confirmed',
            'is_admin' => 'in:1',
        );
        // 自定义验证消息
        $messages = $this->validatorMessages;
        // 开始验证
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // 验证成功
            // 添加资源
            $model = $this->model;
            $model->email        = Input::get('email');
            $model->password     = Input::get('password');
            $model->is_admin     = (int)Input::get('is_admin', 0);
            $model->activated_at = new Carbon;
            if ($model->save()) {
                // 添加成功
                return Redirect::back()
                    ->with('success', '<strong>'.$this->resourceName.'添加成功：</strong>您可以继续添加新'.$this->resourceName.'，或返回'.$this->resourceName.'列表。');
            } else {
                // 添加失败
                return Redirect::back()
                    ->withInput()
                    ->with('error', '<strong>'.$this->resourceName.'添加失败。</strong>');
            }
        } else {
            // 验证失败
            return Redirect::back()->withInput()->withErrors($validator);
        }
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
            'email'    => 'required|email|'.$this->unique('email', $id),
            'password' => 'alpha_dash|between:6,16|confirmed',
            'is_admin' => 'in:1',
        );
        // 自定义验证消息
        $messages  = $this->validatorMessages;
        // 开始验证
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // 验证成功
            // 更新资源
            $model = $this->model->find($id);
            $model->email    = Input::get('email');
            $model->is_admin = (int)Input::get('is_admin', 0);
            if ($model->save()) {
                // 更新成功
                return Redirect::back()
                    ->with('success', '<strong>'.$this->resourceName.'更新成功：</strong>您可以继续编辑'.$this->resourceName.'，或返回'.$this->resourceName.'列表。');
            } else {
                // 更新失败
                return Redirect::back()
                    ->withInput()
                    ->with('error', '<strong>'.$this->resourceName.'更新失败。</strong>');
            }
        } else {
            // 验证失败
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }


}
