<?php

namespace App\Http;

class Kernel
{
    protected $routeMiddleware = [
        // Other middlewares
        'auth' => \App\Http\Middleware\AdminAuthenticate::class,
        'admin' => \App\Http\Middleware\AdminRedirect::class,
        'station.auth' => \App\Http\Middleware\StationsAuthentication::class
    ];
}