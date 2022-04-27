<?php

use App\Http\Controllers\API\TagController;
use App\Http\Controllers\API\TodoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AuthUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function (){
    Route::prefix('auth')->group(function (){
        Route::post('register',[AuthUserController::class, 'register']);
        Route::post('login',[AuthUserController::class, 'login']);
    });

    Route::middleware('auth:sanctum')->group(function () {

        /* My profile */
        Route::prefix('profile')->group(function () {
            Route::post('logout', [AuthUserController::class, 'logout']);
        });

        /* Todos list */
        Route::prefix('todos')->group(function () {
            Route::get('',[TodoController::class, 'index']);
            Route::post('',[TodoController::class, 'store']);
            Route::get('{id}', [TodoController::class, 'show']);
        });

        /* Tags list */
        Route::prefix('tags')->group(function () {
            Route::get('',[TagController::class, 'index']);
            Route::post('',[TagController::class, 'store']);
            Route::get('{id}', [TagController::class, 'show']);
        });

    });
});