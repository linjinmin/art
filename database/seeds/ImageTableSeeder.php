<?php

use Illuminate\Database\Seeder;
use DDL\Models\Image;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Image::create([
            'url' => '/images/default.jpeg'
        ]);

    }
}
