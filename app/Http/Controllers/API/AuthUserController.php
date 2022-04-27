<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Services\UserService;
use Illuminate\Http\Response;
use App\Factories\UserFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\UserAuthRequest;
use App\Http\Requests\API\UserLoginRequest;
use App\Http\Resources\API\Auth\UserInfoResource;

class AuthUserController extends ResponseController
{
    protected UserService $userService;
    protected UserFactory $userFactory;

    public function __construct(
        UserService $userService,
        UserFactory $userFactory
    ){
        $this->userService = $userService;
        $this->userFactory = $userFactory;
    }

    public function register(UserAuthRequest $request): JsonResponse
    {
        try {
            $DTO = $this->userFactory->create($request);
            $this->userService->create($DTO);

            return $this->response(['status' => true, 'data' => 'Successfully registration.'])
                        ->setStatusCode(Response::HTTP_CREATED);
        }catch (\Throwable $exception){
            return $this->response([
                        'data' => [],
                        'status' => false,
                        'code' => $exception->getCode(),
                        'message' => $exception->getMessage()
                    ]);
        }
    }

    public function login(UserLoginRequest $request)
    {
        try {
            if (!Auth::attempt($request->only('email', 'password')))
                throw new \Exception('The user not found. Please try again!',Response::HTTP_UNPROCESSABLE_ENTITY);

            return $this->response(UserInfoResource::make($request->user()))
                        ->setStatusCode(Response::HTTP_OK);
        }catch (\Throwable $exception) {
            return $this->response([
                        'data' => [],
                        'status' => false,
                        'code' => $exception->getCode(),
                        'message' => $exception->getMessage()
                    ]);
        }
    }

    public function logout(): JsonResponse
    {
        try {
            auth()->user()->tokens()->delete();

            return $this->response(['status' => true, 'data' => ['Successfully logout.']])
                        ->setStatusCode(Response::HTTP_NO_CONTENT);
        }catch (\Throwable $exception) {
            return $this->response([
                        'data' => [],
                        'status' => false,
                        'code' => $exception->getCode(),
                        'message' => $exception->getMessage()
                    ]);
        }
    }
}