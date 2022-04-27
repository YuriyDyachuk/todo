<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Tag;
use App\Enums\PaginateEnum;
use App\DataTransObject\TagDTO;
use Illuminate\Pagination\LengthAwarePaginator;

class TagRepository extends AbstractRepository
{
    public function model(): string
    {
        return Tag::class;
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->query()
                    ->with('todos')
                    ->orderByDesc('id')
                    ->paginate(PaginateEnum::defaultCount()->value);
    }

    public function create(TagDTO $DTO): Tag
    {
        /** @var TYPE_NAME $this */
        return $this->query()->create($DTO->toArray())->refresh();
    }

    public function getByIdWithTodo(int $id): ?Tag
    {
        /** @var TYPE_NAME $this */
        return $this->query()->where(['id' => $id])->with(['todos'])->first();
    }

    ############################## [RELATION METHOD] ##############################

    public function existsById(int $id): bool
    {
        return $this->query()->where(['id' => $id])->exists();
    }
}