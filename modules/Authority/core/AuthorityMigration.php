<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class core_AuthorityMigration extends Migration
{

    public function refresh()
    {
        $this->down();
        $this->up();
        App::make('core_AuthoritySeeder')->run();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('groups_users', function (Blueprint $table) {
            $table->increments('id');
            $table->softDeletes();
            $table->timestamps();
        });*/
        // 用户表
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            // $table->string('name', 30)->unique()->comment('用户名');
            $table->string('surname', 30)->comment('姓氏');
            $table->boolean('gender')->comment('性别');
            $table->string('email', 60)->unique()->comment('邮箱');
            $table->string('password', 60)->comment('密码');
            $table->boolean('is_admin')->comment('是否管理员，1-管理员，0-普通用户');
            $table->timestamp('signin_at')->nullable()->comment('最后登录时间');
            $table->timestamp('activated_at')->nullable()->comment('邮箱激活时间');
            $table->timestamps();
            $table->softDeletes();
        });
        // 账号激活
        Schema::create('activations', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->string('email', 60)->index()->comment('邮箱');
            $table->string('token', 40)->index()->comment('令牌');
            $table->timestamps();
        });
        // 密码重置
        Schema::create('password_reminders', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->string('email', 60)->index()->comment('邮箱');
            $table->string('token', 40)->index()->comment('令牌');
            $table->timestamp('created_at')->comment('创建时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('groups');
        // Schema::dropIfExists('groups_users');
        Schema::dropIfExists('users');
        Schema::dropIfExists('activations');
        Schema::dropIfExists('password_reminders');
    }

}
