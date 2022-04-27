<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Services\TodoService;
use Illuminate\Http\Response;
use App\Factories\TodoFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\API\TodoRequest;
use App\Http\Resources\API\TodoResource;
use App\Http\Resources\API\TodoResourceCollection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TodoController extends ResponseController
{
    protected TodoFactory $todoFactory;
    protected TodoService $todoService;

    public function __construct(
        TodoFactory $todoFactory,
        TodoService $todoService
    ){
        $this->todoFactory = $todoFactory;
        $this->todoService = $todoService;
    }

    public function index(): JsonResponse
    {
        return $this->response(new TodoResourceCollection($this->todoService->getAll()));
    }

    public function store(TodoRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $DTO = $this->todoFactory->create($request);
            $todo = $this->todoService->create($DTO, $request->input('tags'));

            DB::commit();

            return $this->response(TodoResource::make($todo))->setStatusCode(Response::HTTP_CREATED);
        }catch (\Throwable $exception) {
            DB::rollBack();

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
        if (!$this->todoService->existById($id)) {
            throw new NotFoundHttpException();
        }

        return $this->response(TodoResource::make($this->todoService->getByIdWithTag($id)))
                    ->setStatusCode(Response::HTTP_OK);
    }
}