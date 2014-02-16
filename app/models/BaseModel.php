<?php

class BaseModel extends Eloquent
{
    /**
     * 软删除
     * @var boolean
     */
    protected $softDelete = false;

    /**
     * 访问器：友好的创建时间
     * @return string
     */
    public function getFriendlyCreatedAtAttribute()
    {
        return friendly_date($this->created_at);
    }

    /**
     * 访问器：友好的更新时间
     * @return string
     */
    public function getFriendlyUpdatedAtAttribute()
    {
        return friendly_date($this->updated_at);
    }

    /**
     * 访问器：友好的删除时间
     * @return string
     */
    public function getFriendlyDeletedAtAttribute()
    {
        return friendly_date($this->deleted_at);
    }

}