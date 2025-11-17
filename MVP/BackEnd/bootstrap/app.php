<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->alias([
            'role' => \App\Http\Middleware\CheckUserRole::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {

        // 403 - Acesso negado
        // $exceptions->render(function (HttpException $e, $request) {
        //     if ($e->getStatusCode() === 403) {

        //         // EVITAR LOOP NO LOGOUT
        //         if ($request->is('logout') || $request->routeIs('logout')) {
        //             return redirect()->route('login');
        //         }

        //         return redirect()->route('dashboard')
        //             ->with('toast', 'Você não tem permissão para acessar esta página!')
        //             ->with('toast_icon', '🔒');
        //     }
        // });

        // 404 - Página não encontrada
        $exceptions->render(function (HttpException $e, $request) {
            if ($e->getStatusCode() === 404) {
                return redirect()->back(fallback: url('/dashboard'))
                    ->with('toast', 'A página solicitada não foi encontrada!')
                    ->with('toast_icon', '💡');
            }
        });

        // 500 - Erro interno
        $exceptions->render(function (Throwable $e, $request) {

            if ($e instanceof HttpException) {
                return null;
            }

            return redirect()->back(fallback: url('/dashboard'))
                ->with('toast', 'Ocorreu um erro interno no servidor. Tente novamente mais tarde.')
                ->with('toast_icon', '⚙️');
        });

    })
    ->create();
