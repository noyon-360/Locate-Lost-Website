<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            __DIR__ . '/../routes/fallback.php',
            __DIR__ . '/../routes/web.php',
            __DIR__ . '/../routes/admin.php',
            __DIR__ . '/../routes/user.php',
            __DIR__ . '/../routes/station.php',
        ],
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(
            [
                'admin.guest' => \App\Http\Middleware\AdminRedirect::class,
                'admin.auth' => \App\Http\Middleware\AdminAuthenticate::class,
                'station.auth' => \App\Http\Middleware\StationsAuthentication::class,
            ]
        );

        $middleware->redirectTo(
            guests: '/user/login',
            users: '/user/dashboard',
            
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
