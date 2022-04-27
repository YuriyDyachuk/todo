<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\TagTodoRepository;

class TagTodoService
{
    protected TagTodoRepository $tagTodoRepository;

    public function __construct(TagTodoRepository $tagTodoRepository)
    {
        $this->tagTodoRepository = $tagTodoRepository;
    }

    public function attachTag(int $todoId, array $tagIds): void
    {
        foreach ($tagIds as $tagId) {
            $data = [
                'tag_id' => $tagId,
                'todo_id' => $todoId,
            ];

            $this->tagTodoRepository->store($data);
        }
    }
}