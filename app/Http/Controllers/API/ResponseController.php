<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use App\Contracts\ResponseContract;
use App\Http\Controllers\Controller;

class ResponseController extends Controller implements ResponseContract
{
    public function response($conditionData = null, ?callable $success = null, ?callable $failed = null): JsonResponse
    {
        $response = new JsonResponse($conditionData);

        if ($success !== null && $conditionData) {
            $success($response);
        }

        if ($failed !== null && !$conditionData) {
            $failed($response);
        }

        return $response;
    }
}