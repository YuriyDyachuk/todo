<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userIds = User::query()->pluck('id')->toArray();

        $data = [];
        for ($i = 0; $i < 100; $i++) {
            $item['name'] = Str::random(10);
            $item['description'] = Str::random(50);
            $item['user_id'] = Arr::random($userIds);
            $data[] = $item;
        }

        \DB::table('todos')->insert($data);
    }
}
