<?php

declare(strict_types=1);

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TodoResourceCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'data' => $this->resource->items(),
            'links' => [
                'total'         => $this->resource->total(),
                'lastPage'      => $this->resource->lastPage(),
                'perPage'       => $this->resource->perPage(),
                'currentPage'   => $this->resource->currentPage(),
                'next_page_url' => $this->resource->nextPageUrl(),
                'prev_page_url' => $this->resource->previousPageUrl(),
            ]
        ];
    }
}