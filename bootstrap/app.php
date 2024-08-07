<?php

use Illuminate\Foundation\Application;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Middlewares to appended on every routes
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        // Middlewares to appended on individual routes
        $middleware->alias([
            'admin' => \App\Http\Middleware\Admin::class,
            'author' => \App\Http\Middleware\Author::class,
            'editor' => \App\Http\Middleware\Editor::class,
            'visitor' => \App\Http\Middleware\Visitor::class,
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            //'resp-cache' => \Spatie\ResponseCache\Middlewares\CacheResponse::class,
            'prevent-back-history' => \App\Http\Middleware\PreventBackHistory::class,
        ]);

        $middleware->redirectTo(
            users : '/authorization',
        );


        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
        $exceptions->respond(function (Response $response) {
        if ($response->getStatusCode() === 419) {
            return back()->with([
                'message' => 'The page expired, please try again.',
            ]);
        }

        return $response;
        });

    })->create();
