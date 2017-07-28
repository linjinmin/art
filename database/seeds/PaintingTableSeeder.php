<?php

use Illuminate\Database\Seeder;

use DDL\Models\Painting;


class PaintingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $n = 100;
        while($n--){
            Painting::create([
                'user_id' => 1,
                'image_id'=> 1,
                'title'  => 'aaa',
                'introduction' => 'bbb',
                'painting_type_id' => '1'
            ]);
        }


    }
}
