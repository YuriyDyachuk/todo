<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class TagTodoRepository
{
    public function store(array $data): void
    {
        DB::table('tag_todo')->insert($data);
    }
}