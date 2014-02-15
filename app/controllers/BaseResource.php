<?php

class BaseResource extends BaseController
{
    /**
     * 资源视图目录
     * @var string
     */
    protected $resourceView = '';

    /**
     * 资源模型名称，初始化后转为模型实例
     * @var string|Illuminate\Database\Eloquent\Model
     */
    protected $model = '';

    /**
     * 资源标识
     * @var string
     */
    protected $resource = '';

    /**
     * 资源数据库表
     * @var string
     */
    protected $resourceTable = '';

    /**
     * 资源名称（中文）
     * @var string
     */
    protected $resourceName = '';

    /**
     * 自定义验证消息
     * @var array
     */
    protected $validatorMessages = array();

    /**
     * 初始化
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        // 实例化资源模型
        $this->model  = App::make($this->model);
        // 视图合成器
        $resource     = $this->resource;
        $resourceName = $this->resourceName;
        View::composer(array(
            $this->resourceView.'.index',
            $this->resourceView.'.create',
            $this->resourceView.'.edit',
        ), function ($view) use ($resource, $resourceName) {
            $view->with(compact('resource', 'resourceName'));
        });
    }

    /**
     * 资源列表页面
     * GET         /resource
     * @return Response
     */
    public function index()
    {
        $datas = $this->model->paginate(15);
        return View::make($this->resourceView.'.index')->with(compact('datas'));
    }

    /**
     * 资源创建页面
     * GET         /resource/create
     * @return Response
     */
    public function create()
    {
        return View::make($this->resourceView.'.create');
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
            # --- --- --- --- --- --- --- --- --- --- 此处添加验证规则 #
        );
        // 自定义验证消息
        $messages = $this->validatorMessages;
        // 开始验证
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // 验证成功
            // 添加资源
            $model = $this->model;
            # --- --- --- --- --- --- --- --- --- --- 此处为模型对象的属性赋值 #
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
        $data = $this->model->find($id);
        return View::make($this->resourceView.'.edit')->with('data', $data);
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
            # --- --- --- --- --- --- --- --- --- --- 此处添加验证规则 #
        );
        // 自定义验证消息
        $messages  = $this->validatorMessages;
        // 开始验证
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // 验证成功
            // 更新资源
            $model = $this->model->find($id);
            # --- --- --- --- --- --- --- --- --- --- 此处为模型对象的属性赋值 #
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

    /**
     * 资源删除动作
     * DELETE      /resource/{id}
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $data = $this->model->find($id);
        if (is_null($data))
            return Redirect::back()->with('error', '没有找到对应的'.$this->resourceName.'。');
        elseif ($data->delete())
            return Redirect::back()->with('success', $this->resourceName.'删除成功。');
        else
            return Redirect::back()->with('warning', $this->resourceName.'删除失败。');
    }

    /**
     * 资源回收站
     * GET      /resource/recycled
     * @param  int  $id
     * @return Response
     */
    public function recycled()
    {
        // 
    }

    /**
     * 资源还原动作
     * PATCH      /resource/{id}
     * @param  int  $id
     * @return Response
     */
    public function restore($id)
    {
        // 
    }

    /**
     * 构造 unique 验证规则
     * @param  string $column 字段名称
     * @param  int    $id     排除指定 ID
     * @return string
     */
    protected function unique($column = null, $id = null)
    {
        if (is_null($column))
            return 'unique:'.$this->resourceTable;
        else
            return 'unique:'.$this->resourceTable.','.$column.','.$id;
    }


}