<?php

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CheckReferer;
use App\Http\Middleware\CheckSessionToken;
use App\Http\Middleware\JWTExceptionHandler;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../routes/api.php',
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->group('auth', [
            Authenticate::class,
        ]);
        // $middleware->group('api', [
        //     CheckReferer::class,
        // ]);
        $middleware->group('session', [
            CheckSessionToken::class,
        ]);
        $middleware->group('auth:api', [
            JWTExceptionHandler::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // $exceptions->render(function (Throwable $e, Request $request) {
        //     if ($request->is('api/*')) {
        //         return response()->json(['error' => 404, 'message' => 'not_found'], 404);
        //     }
        // });
    })->create();
