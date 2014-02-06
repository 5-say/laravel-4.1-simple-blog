<?php

class BaseResource extends BaseController
{

	/**
	 * 初始化
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
        // 实例化资源模型
        $this->model = $this->namespace.'\\'.$this->model;
        $this->model = new $this->model;
        // 视图合成器
        $resource     = $this->resource;
        $resourceName = $this->resourceName;
        View::composer(array(
            $this->namespace.'::'.$this->resource.'.index',
            $this->namespace.'::'.$this->resource.'.create',
            $this->namespace.'::'.$this->resource.'.edit',
        ), function ($view) use ($resource, $resourceName) {
            $view->with(compact('resource', 'resourceName'));
        });
	}

    /**
     * 资源列表页面
     * GET         /resource
     * @return Response
     */
    protected function index()
    {
        $datas = $this->model->paginate(15);
        return View::make($this->namespace.'::'.$this->resource.'.index')->with(compact('datas'));
    }

    /**
     * 资源创建页面
     * GET         /resource/create
     * @return Response
     */
    public function create()
    {
        return View::make($this->namespace.'::'.$this->resource.'.create');
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
        return View::make($this->namespace.'::'.$this->resource.'.edit')->with('data', $data);
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