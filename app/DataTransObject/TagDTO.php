<?php

declare(strict_types=1);

namespace App\DataTransObject;

use Spatie\DataTransferObject\DataTransferObject;

class TagDTO extends DataTransferObject
{
    public string $name;
}