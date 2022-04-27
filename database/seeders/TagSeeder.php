<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        for ($i = 0; $i < 300; $i++) {
            $item['name'] = Str::random(6);
            $data[] = $item;
        }

        \DB::table('tags')->insert($data);
    }
}
