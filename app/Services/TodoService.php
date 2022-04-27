<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Todo;
use App\DataTransObject\TodoDTO;
use App\Repositories\TodoRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class TodoService
{
    protected TagService $tagService;
    protected TodoRepository $todoRepository;
    protected TagTodoService $tagTodoService;

    public function __construct(
        TagService $tagService,
        TagTodoService $tagTodoService,
        TodoRepository $todoRepository
    ){
        $this->tagService = $tagService;
        $this->tagTodoService = $tagTodoService;
        $this->todoRepository = $todoRepository;
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->todoRepository->getAll();
    }

    public function create(TodoDTO $DTO, array $tagIds): Todo
    {
        $todo = $this->todoRepository->create($DTO);
        $this->tagTodoService->attachTag($todo->id, $tagIds);

        return $todo;
    }

    public function getByIdWithTag(int $id): ?Todo
    {
        return $this->todoRepository->getByIdWithTag($id);
    }

    ############################## [CUSTOM METHOD] ##############################

    public function existById(int $id): bool
    {
        return $this->todoRepository->existsById($id);
    }
}