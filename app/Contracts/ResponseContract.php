<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Http\JsonResponse;

interface ResponseContract
{
    public function response($conditionData = null): JsonResponse;
}