<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Todo;
use App\Enums\PaginateEnum;
use App\DataTransObject\TodoDTO;
use Illuminate\Pagination\LengthAwarePaginator;

class TodoRepository extends AbstractRepository
{
    public function model(): string
    {
        return Todo::class;
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->query()
                    ->with('tags')
                    ->orderByDesc('id')
                    ->paginate(PaginateEnum::defaultCount()->value);
    }

    public function create(TodoDTO $DTO): Todo
    {
        /** @var TYPE_NAME $this */
        return $this->query()->create($DTO->toArray())->refresh();
    }

    public function getByIdWithTag(int $id): ?Todo
    {
        /** @var TYPE_NAME $this */
        return $this->query()->where(['id' => $id])->with(['tags'])->first();
    }

    ############################## [CUSTOM METHOD] ##############################

    public function existsById(int $id): bool
    {
        return $this->query()->where(['id' => $id])->exists();
    }
}