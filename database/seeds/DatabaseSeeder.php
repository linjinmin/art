<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 基本数据填充
        $this->call(ImageTableSeeder::class);
        $this->call(PaintingTypeTableSeeder::class);
        $this->call(BulletinTableSeeder::class);

        // 数据填充
//        $this->call(PaintingTableSeeder::class);
//        $this->call(UserTableSeeder::class);
    }

}
