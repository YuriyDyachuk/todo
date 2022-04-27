<?php

declare(strict_types=1);

namespace App\Services;

use App\DataTransObject\TagDTO;
use App\Models\Tag;
use App\Repositories\TagRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class TagService
{
    protected TagRepository $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->tagRepository->getAll();
    }

    public function create(TagDTO $DTO): Tag
    {
        return $this->tagRepository->create($DTO);
    }

    public function getByIdWithTodo(int $id): ?Tag
    {
        return $this->tagRepository->getByIdWithTodo($id);
    }

    ############################## [CUSTOM METHOD] ##############################

    public function existById(int $id): bool
    {
        return $this->tagRepository->existsById($id);
    }
}