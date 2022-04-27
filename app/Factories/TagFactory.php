<?php

declare(strict_types=1);

namespace App\Factories;

use App\DataTransObject\TagDTO;
use App\Http\Requests\API\TagRequest;

class TagFactory
{
    public function create(TagRequest $request): TagDTO
    {
        return new TagDTO([
            'name' => $request->input('name')
        ]);
    }
}