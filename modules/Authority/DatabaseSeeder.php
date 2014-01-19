<?php namespace Authority;

use Seeder;
use Eloquent;
use Carbon\Carbon;
use Hash;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $dateTime = new Carbon;
        // 用户表
        $password = Hash::make('111111');
        for ($i=0; $i < 20; $i++)
        { 
            $userData[] = array(
                'email'      => 'test'.$i.'@a.a',
                'password'   => $password,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            );
        }
        User::truncate();
        User::insert($userData);
    }

}