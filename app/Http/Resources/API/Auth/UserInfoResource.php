<?php

declare(strict_types=1);

namespace App\Http\Resources\API\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class UserInfoResource extends JsonResource
{
    public function withResponse($request, $response): array
    {
        return [
            'ok' => true,
            'message' => 'Successful authorization',
            'status' => $response->status()
        ];
    }

    public function toArray($request): array
    {
        return [
            'ok' => true,
            'token' => [
                'type' => 'Bearer',
                'value' => $this->createToken('auth-token')->plainTextToken
            ],
            'id' => $this->id,
            'name' => $this->name,
            'login' => $this->email
        ];
    }
}