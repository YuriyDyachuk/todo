<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Requests\API\TagRequest;
use App\Services\TagService;
use App\Factories\TagFactory;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\API\TagResource;
use App\Http\Resources\API\TagResourceCollection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TagController extends ResponseController
{
    protected TagFactory $tagFactory;
    protected TagService $tagService;

    public function __construct(
        TagFactory $tagFactory,
        TagService $tagService
    ){
        $this->tagFactory = $tagFactory;
        $this->tagService = $tagService;
    }

    public function index(): JsonResponse
    {
        return $this->response(new TagResourceCollection($this->tagService->getAll()));
    }

    public function store(TagRequest $request): JsonResponse
    {
        try {
            $DTO = $this->tagFactory->create($request);
            $tag = $this->tagService->create($DTO);

            return $this->response(TagResource::make($tag))->setStatusCode(Response::HTTP_CREATED);
        }catch (\Throwable $exception) {

            return $this->response([
                'data' => [],
                'status' => false,
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function show(int $id): JsonResponse
    {
        if (!$this->tagService->existById($id)) {
            throw new NotFoundHttpException();
        }

        return $this->response(TagResource::make($this->tagService->getByIdWithTodo($id)))
            ->setStatusCode(Response::HTTP_OK);
    }
}