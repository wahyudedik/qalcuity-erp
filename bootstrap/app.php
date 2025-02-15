<?php

use App\Http\Middleware\DevMiddleware;
use Illuminate\Foundation\Application;
use PHPUnit\Framework\Attributes\Group;
use App\Http\Middleware\UserTenantMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware
            ->group('tenant', [
                \Spatie\Multitenancy\Http\Middleware\NeedsTenant::class,
                \Spatie\Multitenancy\Http\Middleware\EnsureValidTenantSession::class,
            ])
            ->Group('dev', [
                DevMiddleware::class,
            ])
            ->Group('user_tenant', [
                UserTenantMiddleware::class,
            ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
