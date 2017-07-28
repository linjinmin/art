<?php

use Illuminate\Database\Seeder;

use DDL\Models\PaintingType;

class PaintingTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        PaintingType::create([
            'name' => '所有'
        ]);

    }
}
