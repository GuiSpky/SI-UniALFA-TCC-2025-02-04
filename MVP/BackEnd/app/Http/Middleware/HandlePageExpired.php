<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandlePageExpired
{
    /**
     * Manipula a solicitação recebida.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Se a resposta for erro 419 (sessão expirada)
        if ($response->getStatusCode() === 419) {
            return redirect()
                ->route('login')
                ->with('error', 'Sua sessão expirou. Faça login novamente.');
        }

        return $response;
    }
}
