<?php
namespace Blog;

use Input;
use Validator;
use Redirect;
use Auth;

class ArticleResource extends \BaseResource
{

    /**
     * 模块命名空间
     * @var string
     */
    protected $namespace = 'Blog';

    /**
     * 资源模型名称，初始化后转为模型实例
     * @var string|Illuminate\Database\Eloquent\Model
     */
    protected $model = 'Article';

    /**
     * 资源标识
     * @var string
     */
    protected $resource = 'articles';

    /**
     * 资源数据库表
     * @var string
     */
    protected $resourceTable = 'articles';

    /**
     * 资源名称
     * @var string
     */
    protected $resourceName = '文章';

    /**
     * 自定义验证消息
     * @var array
     */
    protected $validatorMessages = array(
        'title.required'   => '请填写文章标题。',
        'title.unique'     => '已有同名文章。',
        'slug.required'    => '请填写文章 sulg。',
        'slug.unique'      => '已有同名 sulg。',
        'content.required' => '请填写文章内容。',
    );

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
            'title'   => 'required|'.$unique,
            'slug'    => 'required|'.$unique,
            'content' => 'required',
        );
        // 自定义验证消息
        $messages = $this->validatorMessages;
        // 开始验证
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // 验证成功
            // 添加资源
            $model = $this->model;
            $model->user_id          = Auth::user()->id;
            $model->title            = e($data['title']);
            $model->slug             = e($data['slug']);
            $model->content          = e($data['content']);
            $model->meta_title       = e($data['meta_title']);
            $model->meta_description = e($data['meta_description']);
            $model->meta_keywords    = e($data['meta_keywords']);
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
            'title'   => 'required|'.$this->unique('title', $id),
            'slug'    => 'required|'.$this->unique('slug', $id),
            'content' => 'required',
        );
        // 自定义验证消息
        $messages = $this->validatorMessages;
        // 开始验证
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // 验证成功
            // 更新资源
            $model = $this->model->find($id);
            $model->title            = e($data['title']);
            $model->slug             = e($data['slug']);
            $model->content          = e($data['content']);
            $model->meta_title       = e($data['meta_title']);
            $model->meta_description = e($data['meta_description']);
            $model->meta_keywords    = e($data['meta_keywords']);
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