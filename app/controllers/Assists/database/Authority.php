<?php

use Illuminate\Database\Schema\Blueprint;

class Assists_database_Authority
{

    public $info = '基础权限';

    public function refresh()
    {
        $this->down();
        $this->up();
        $this->seed();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('activations');
        Schema::dropIfExists('password_reminders');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 用户表
        Schema::create('users', function (Blueprint $table) {
            $table->comment = '用户表';
            $table->engine  = 'MyISAM';
            $table->increments('id');
            // $table->string('name', 30)->unique()->comment('用户名');
            // $table->string('surname', 30)->default('')->comment('姓氏');
            // $table->boolean('gender')->comment('性别');
            $table->string('email', 60)      ->unique()  ->comment('邮箱');
            $table->string('password', 60)               ->comment('密码');
            $table->string('portrait', 60)   ->nullable()->comment('用户头像');
            $table->boolean('is_admin')      ->default(0)->comment('是否管理员，1-管理员，0-普通用户');
            $table->timestamp('signin_at')   ->nullable()->comment('最后登录时间');
            $table->timestamp('activated_at')->nullable()->comment('邮箱激活时间');
            $table->timestamps();
            $table->softDeletes();
        });
        // 账号激活
        Schema::create('activations', function (Blueprint $table) {
            $table->comment = '账号激活';
            $table->engine  = 'MyISAM';
            $table->increments('id');
            $table->string('email', 60)    ->index()->comment('邮箱');
            $table->string('token', 40)    ->index()->comment('令牌');
            $table->timestamp('created_at')         ->comment('创建时间');
        });
        // 密码重置
        Schema::create('password_reminders', function (Blueprint $table) {
            $table->comment = '密码重置';
            $table->engine  = 'MyISAM';
            $table->string('email', 60)    ->index()->comment('邮箱');
            $table->string('token', 40)    ->index()->comment('令牌');
            $table->timestamp('created_at')         ->comment('创建时间');
        });
    }

    /**
     * 基础数据填充
     * @return void
     */
    public function seed()
    {
        // 强制解除 Eloquent::create() 批量赋值限制
        Eloquent::unguard();
        // 用户
        User::truncate(); // 清空表
        $password = Hash::make('111111');
        User::create(array(
            'email'        => 'admin@demo.com',
            'password'     => $password,
            'is_admin'     => 1,
            'activated_at' => Carbon::now(),
        ));
    }

    /**
     * 测试数据填充
     * @return void
     */
    public function seedDemo()
    {
        // 用户
        $password = Hash::make('111111');
        $now      = Carbon::now();
        for ($i = 1; $i < 60; $i++) {
            User::create(array(
            'email'        => 'a'.$i.'@a.com',
            'password'     => $password,
            'activated_at' => $now,
            ));
        }
    }


}
