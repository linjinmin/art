<?php

use Illuminate\Database\Seeder;
use DDL\Models\Bulletin;

class BulletinTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bulletin::create([
            'title' => '园丁鸟',
            'content' => '无'
        ]);

    }
}
