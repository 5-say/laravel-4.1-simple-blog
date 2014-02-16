<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends BaseModel implements UserInterface, RemindableInterface
{
    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'users';

    /**
     * 软删除
     * @var boolean
     */
    protected $softDelete = true;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    /**
     * 访问器：友好的最后登录时间
     * @return string
     */
    public function getFriendlySigninAtAttribute()
    {
        if (is_null($this->signin_at))
            return '新账号未登录';
        else
            return friendly_date($this->signin_at);
    }

    /**
     * 调整器：密码
     * @param  string $value 未处理的密码字符串
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        // 若传入的字符串已经进行了 Hash 加密，则不重复处理
        $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
    }

}