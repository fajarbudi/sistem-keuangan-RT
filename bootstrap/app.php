<?php

use App\Http\Middleware\login;
use App\Http\Middleware\notLogin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'isLogin' => login::class
        ]);
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'isNotLogin' => notLogin::class
        ]);
    })
    ->withMiddleware(function (Middleware $middleware) {
        // Add your middleware aliases here
        $middleware->alias([
            'Excel' => Maatwebsite\Excel\Facades\Excel::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            '/user/import' // <-- exclude this route
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
