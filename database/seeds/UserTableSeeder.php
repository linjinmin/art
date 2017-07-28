<?php

use Illuminate\Database\Seeder;
use DDL\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'image_id' => 1,
            'email' => 'xxxx',
            'password' => bcrypt('xxxxx'),
            'nickname' => 'xxxx',
            'role'     => 'manager'
        ]);
    }
}
