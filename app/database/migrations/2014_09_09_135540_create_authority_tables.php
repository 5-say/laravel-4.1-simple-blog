<?php
/**
 * 基础权限
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorityTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        // 用户表
        Schema::create('users', function ($table) {

            $table->increments('id');
            $table->string('email'          )->comment('邮箱');
            $table->string('password'       )->comment('密码');
            $table->string('portrait'       )->nullable()->comment('用户头像');
            $table->string('remember_token' )->nullable()->comment('记住登陆状态的令牌');
            $table->boolean('is_admin'      )->default(false)->comment('是否管理员');
            $table->timestamp('signin_at'   )->nullable()->comment('最后登录时间');
            $table->timestamp('activated_at')->nullable()->comment('邮箱激活时间');

            $table->timestamps();
            $table->softDeletes();

            $table->comment = '用户表';
            $table->engine  = 'MyISAM';
	        $table->unique('email');
        });
        $this->seedUser();

        // 账号激活
        Schema::create('activations', function ($table) {

            $table->increments('id');
            $table->string('email')->comment('邮箱');
            $table->string('token')->comment('令牌');

            $table->timestamps();

            $table->comment = '账号激活';
            $table->engine  = 'MyISAM';
            $table->index('email');
            $table->unique('token');
        });

        // 密码重置
        Schema::create('password_reminders', function ($table) {

            $table->string('email')->comment('邮箱');
            $table->string('token')->comment('令牌');
            
            $table->timestamps();

            $table->comment = '密码重置';
            $table->engine  = 'MyISAM';
            $table->index('email');
            $table->unique('token');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('users');
        Schema::drop('activations');
        Schema::drop('password_reminders');
	}

	/**
	 * 填充 users 表基础数据
	 * @return void
	 */
	private function seedUser()
	{
		User::create(array(
            'email'        => 'admin@demo.com',
            'password'     => '111111',
            'is_admin'     => 1,
            'activated_at' => Carbon::now(),
        ));
	}

}
