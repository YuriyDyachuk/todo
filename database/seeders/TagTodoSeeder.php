<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Todo;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;

class TagTodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagIds = Tag::query()->pluck('id')->toArray();
        $todoIds = Todo::query()->pluck('id')->toArray();

        $data = [];
        for ($i = 0; $i < 500; $i++) {
            $item['tag_id'] = Arr::random($tagIds);
            $random = rand(0, 1);
            if ($random) {
                $item['todo_id'] = Arr::random($todoIds);
            } else {
                $item['todo_id'] = Arr::random($todoIds);
            }
            $data[] = $item;
        }

        \DB::table('tag_todo')->insert($data);
    }
}
