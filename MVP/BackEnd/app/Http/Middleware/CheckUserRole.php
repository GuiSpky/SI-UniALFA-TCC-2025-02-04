<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles Os cargos permitidos para acessar a rota.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Verifica se o usuário está logado. Se não, o middleware 'auth' já o barrou,
        //    mas é uma boa prática verificar.
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Pega o usuário autenticado.
        $user = Auth::user();

        // 3. Itera sobre os cargos permitidos passados para o middleware.
        foreach ($roles as $role) {
            // 4. Compara o nome do cargo com o número no banco de dados.
            //    Ex: Se a rota permite 'gerente' e o usuário tem cargo '1', ele pode passar.
            if ($user->cargo == $this->getRoleNumber($role)) {
                // 5. Se o cargo bate, permite que a requisição continue para o controlador.
                return $next($request);
            }
        }

        // 6. Se o loop terminar e o usuário não tiver nenhum dos cargos permitidos,
        //    ele é barrado. Redirecionamos para o dashboard com uma mensagem de erro.
        //    A função abort(403) também é uma ótima opção, pois retorna "Acesso Negado".
        return redirect()->route('dashboard')->with('erro', 'Você não tem permissão para acessar esta página.');
        // ou: abort(403, 'ACESSO NÃO AUTORIZADO.');
    }

    /**
     * Converte o nome do cargo (string) para o número correspondente.
     * Isso torna as rotas mais legíveis.
     */
    private function getRoleNumber(string $roleName): ?int
    {
        $roles = [
            'gerente' => 1,
            'cozinheiro-chefe' => 2,
            'cozinheiro' => 3,
            'nutricionista' => 4,
        ];

        return $roles[strtolower($roleName)] ?? null;
    }
}
