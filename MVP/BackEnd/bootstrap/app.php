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

        /**
         * 404 - Página não encontrada
         */
        $exceptions->render(function (HttpException $e, $request) {

            if ($e->getStatusCode() === 404) {

                // Nunca quebrar logout
                if ($request->is('logout') || $request->routeIs('logout')) {
                    return redirect()->route('login');
                }

                return redirect('/dashboard')
                    ->with('toast', 'A página solicitada não foi encontrada!')
                    ->with('toast_icon', '💡');
            }
        });

        /**
         * 500 - Erro interno do servidor
         */
        $exceptions->render(function (Throwable $e, $request) {

            // Não sobrescrever erros HTTP válidos
            if ($e instanceof HttpException) {
                return null;
            }

            // Nunca quebrar logout
            if ($request->is('logout') || $request->routeIs('logout')) {
                return redirect()->route('login');
            }

            return redirect('/dashboard')
                ->with('toast', 'Ocorreu um erro interno no servidor. Tente novamente mais tarde.')
                ->with('toast_icon', '⚙️');
        });

    })
    ->create();
