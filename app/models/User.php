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
            return '新账号尚未登录';
        else
            return friendly_date($this->signin_at);
    }

    /**
     * 访问器：用户头像（大）
     * @return string 用户头像的 URI
     */
    public function getPortraitLargeAttribute()
    {
        if ($this->portrait)
            return asset('portrait/large/'.$this->portrait);
        else
            return with(new Identicon)->getImageDataUri($this->email, 220);
    }

    /**
     * 访问器：用户头像（中）
     * @return string 用户头像的 URI
     */
    public function getPortraitMediumAttribute()
    {
        if ($this->portrait)
            return asset('portrait/medium/'.$this->portrait);
        else
            return with(new Identicon)->getImageDataUri($this->email, 128);
    }

    /**
     * 访问器：用户头像（小）
     * @return string 用户头像的 URI
     */
    public function getPortraitSmallAttribute()
    {
        if ($this->portrait)
            return asset('portrait/small/'.$this->portrait);
        else
            return with(new Identicon)->getImageDataUri($this->email, 64);
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