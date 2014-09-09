<?php

class BaseModel extends Eloquent
{
    /**
     * 软删除
     * @var boolean
     */
    protected $softDelete = false;

    /**
     * 自动维护时间戳
     * @var boolean
     */
    public $timestamps = true;

    /**
     * 其它需要使用日期调整器的字段
     * @var array
     */
    protected $dates = array();

    /**
     * 集体赋值白名单（高优先级）
     * @var array
     */
    protected $fillable = array();

    /**
     * 集体赋值黑名单
     * @var array
     */
    protected $guarded = array();

/*
|--------------------------------------------------------------------------
| 访问器
|--------------------------------------------------------------------------
*/
    /**
     * 友好的创建时间
     * @return string
     */
    public function getFriendlyCreatedAtAttribute()
    {
        return friendly_date($this->created_at);
    }

    /**
     * 友好的更新时间
     * @return string
     */
    public function getFriendlyUpdatedAtAttribute()
    {
        return friendly_date($this->updated_at);
    }

    /**
     * 友好的删除时间
     * @return string
     */
    public function getFriendlyDeletedAtAttribute()
    {
        return friendly_date($this->deleted_at);
    }


}