<?php

class AuthorityTablesSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// 填充用户数据
		$password = Hash::make('111111');
        $now      = Carbon::now();
        for ($i = 1; $i < 30; $i++) {
            User::create(array(
            'email'        => 'a'.$i.'@a.com',
            'password'     => $password,
            'activated_at' => $now,
            ));
        }

		$this->command->info('测试用户数据填充完毕');
	}

}