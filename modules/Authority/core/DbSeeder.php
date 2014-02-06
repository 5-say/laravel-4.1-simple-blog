<?php
namespace Authority;

use Seeder;
use Eloquent;
use Hash;

class core_DbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 强制解除 Eloquent::create() 批量赋值限制
        Eloquent::unguard();

        // 用户
        Usere::truncate(); // 清空表
        $password = Hash::make('111111');
        Usere::create(array(
            'email'    => 'bcw.5@foxmail.com',
            'password' => $password,
            'is_admin' => 1,
        ));
        for ($i = 1; $i < 60; $i++) {
            Usere::create(array(
            'email'    => 'bcw.5@foxmail.com',
            'password' => $password,
            ));
        }

    }

}