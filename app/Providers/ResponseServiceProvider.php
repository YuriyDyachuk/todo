<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Psr\Http\Message\ResponseInterface;
use App\Http\Controllers\API\ResponseController;

class ResponseServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->app->bind(ResponseInterface::class, ResponseController::class);
    }
}
