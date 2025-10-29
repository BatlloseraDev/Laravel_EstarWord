<?php

use App\Http\Middleware\midAdmin;
use App\Http\Middleware\midGestor;
use App\Http\Middleware\midUser;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Sanctum\Http\Middleware\CheckAbilities;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo('/api/nologin');
        $middleware->alias([
            'todas' => CheckAbilities::class,
            'alguna' => CheckForAnyAbility::class,
            'midadmin' =>midAdmin::class,
            'midgestor'=>midGestor::class,
            'miduser'=>midUser::class,
            
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
