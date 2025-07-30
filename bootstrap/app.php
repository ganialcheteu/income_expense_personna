<?php

use App\Http\Middleware\CheckIfUserIsActive;
use App\Http\Middleware\CheckIfUserIsSuperAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
    //middleware globaux s'appliquent sur toutes les routes du dashboard
    //verifier si l'utilisateur est actif
    $middleware->append(CheckIfUserIsActive::class);
        //verifier si l'utilisateur est super_admin
        $middleware->append(CheckIfUserIsSuperAdmin::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
