<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Importando exceções específicas
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {

        // Aliases de middleware
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckUserRole::class,
        ]);

    })

    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->render(function (HttpException $e, $request) {

            // Evita bloquear logout
            if ($request->is('logout') || $request->routeIs('logout')) {
                return redirect()->route('login');
            }

            // ERRO 500 - Interno do Servidor
            if ($e->getStatusCode() === 500) {
                return redirect()->route('dashboard')
                    ->with('toast', 'Ocorreu um erro interno no servidor. Tente novamente mais tarde.')
                    ->with('toast_icon', '⚙️');
            }

            // ERRO 500 - Interno do Servidor
            if ($e->getStatusCode() === 419) {
                return redirect()->route('dashboard')
                    ->with('toast', 'Ocorreu um erro interno no servidor. Tente novamente mais tarde.')
                    ->with('toast_icon', '⚙️');
            }

            return null;
        });

    })

    ->create();
