<?php

declare(strict_types=1);

namespace App\Factories;

use App\DataTransObject\TodoDTO;
use App\Http\Requests\API\TodoRequest;

class TodoFactory
{
    public function create(TodoRequest $request): TodoDTO
    {
        return new TodoDTO([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => auth()->id()
        ]);
    }
}