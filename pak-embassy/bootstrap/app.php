<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use App\Http\Middleware\OrgCustomerRoleMiddleware;
use App\Http\Middleware\EmbassyDashboardAuth;
use App\Http\Middleware\CheckUserActive;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Add CheckUserActive middleware to web group (runs on all web requests)
        $middleware->web(append: [
            CheckUserActive::class,
        ]);
        
        $middleware->alias([
            'org_customer_role' => OrgCustomerRoleMiddleware::class,
            'embassy_auth' => EmbassyDashboardAuth::class,
            'check.user.active' => CheckUserActive::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
