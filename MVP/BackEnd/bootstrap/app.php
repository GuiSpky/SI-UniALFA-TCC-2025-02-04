<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // $middleware->append(\App\Http\Middleware\HandlePageExpired::class);

        $middleware->alias([
            'role' => \App\Http\Middleware\CheckUserRole::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {

        // ⚠️ 403 - Acesso negado
        $exceptions->render(function (HttpException $e, $request) {
            if ($e->getStatusCode() === 403) {
                return redirect()->back()
                    ->with('toast', 'Você não tem permissão para acessar esta página!')
                    ->with('toast_icon', '🔒'); // ícone suave
            }
        });

        // ⚠️ 404 - Página não encontrada
        $exceptions->render(function (HttpException $e, $request) {
            if ($e->getStatusCode() === 404) {
                return redirect()->back()
                    ->with('toast', 'A página solicitada não foi encontrada!')
                    ->with('toast_icon', '💡'); // ícone suave informativo
            }
        });

        // ⚠️ 500 - Erro interno inesperado
        $exceptions->render(function (Throwable $e, $request) {
            // qualquer exceção inesperada entra aqui
            return redirect()->back()
                ->with('toast', 'Ocorreu um erro interno no servidor. Tente novamente mais tarde.')
                ->with('toast_icon', '⚙️'); // ícone técnico e discreto
        });

    })
    ->create();
