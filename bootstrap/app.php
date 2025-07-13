<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
    commands: __DIR__.'/../routes/console.php',
    using: function () {
        Route::middleware('api')
            ->prefix('owner-api')
            ->group(base_path('routes/owner-api.php'));

        Route::middleware('api')
            ->prefix('member-api')
            ->group(base_path('routes/member-api.php'));
 
        Route::middleware('web')
            ->prefix('/')
            ->group(base_path('routes/web.php'));
    },
)
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
