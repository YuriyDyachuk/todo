<?php

declare(strict_types=1);

namespace App\DataTransObject;

use Spatie\DataTransferObject\DataTransferObject;

class TodoDTO extends DataTransferObject
{
    public string $name;

    public string $description;

    public int    $user_id;
}