<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Middleware global (se ejecuta en todas las peticiones)
//        $middleware->append(\App\Http\Middleware\AuditRequests::class);
        $middleware->alias([
            'audit' => \App\Http\Middleware\AuditRequests::class,
        ]);
        
        // O si prefieres solo para grupos específicos:
        $middleware->web(append: [
            \App\Http\Middleware\AuditRequests::class,
        ]);
        
        $middleware->api(append: [
            \App\Http\Middleware\AuditRequests::class,
        ]);
        

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();