<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\DataTransObject\RegisterDTO;

class UserRepository extends AbstractRepository
{
    public function model(): string
    {
        return User::class;
    }

    public function create(RegisterDTO $DTO): void
    {
        $this->query()->create($DTO->toArray())->refresh();
    }
}