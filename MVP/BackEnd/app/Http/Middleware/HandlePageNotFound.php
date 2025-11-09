<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HandlePageNotFound
{
    public function handle($request, Closure $next)
    {
        try {
            return $next($request);
        } catch (NotFoundHttpException $e) {
            // Se for requisição AJAX
            if ($request->ajax()) {
                return response()->json(['error' => 'Página não encontrada'], 404);
            }

            // Caso normal (clique em botão/link)
            return redirect()->back()->with('erro404', true);
        }
    }
}
