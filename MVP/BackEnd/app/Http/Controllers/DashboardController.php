<?php

namespace App\Http\Controllers;

use App\Models\Consumo;
use App\Models\ItemConsumo;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Estoque;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth()->user();

        // Caso o usuário NÃO seja gerente, filtrar pela escola dele
        $filtrarPorEscola = in_array($user->cargo, [2, 3, 4]);
        $escolaId = $user->escola_id;

        // ===============================
        // TOTAL DE CONSUMOS
        // ===============================
        if ($filtrarPorEscola) {
            $totalConsumos = ItemConsumo::whereHas('consumo', function ($q) use ($escolaId) {
                $q->where('escola_id', $escolaId);
            })->sum('quantidade');
        } else {
            $totalConsumos = ItemConsumo::sum('quantidade');
        }

        // ===============================
        // TOTAL DE PEDIDOS
        // ===============================
        if ($filtrarPorEscola) {
            $totalPedidos = Pedido::where('escola_id', $escolaId)->count();
        } else {
            $totalPedidos = Pedido::count();
        }

        // ===============================
        // TOTAL DE PRODUTOS → ocultado no Blade
        // ===============================
        $totalProdutos = Produto::count();

        // ===============================
        // MAIS CONSUMIDOS
        // ===============================
        $maisConsumidos = ItemConsumo::select('estoque_id', DB::raw('SUM(quantidade) as total'))
            ->when($filtrarPorEscola, function ($q) use ($escolaId) {
                $q->whereHas('consumo', function ($cons) use ($escolaId) {
                    $cons->where('escola_id', $escolaId);
                });
            })
            ->groupBy('estoque_id')
            ->with('estoque.produto')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        // ===============================
        // CONSUMO ÚLTIMOS 7 DIAS
        // ===============================
        $consumoDias = ItemConsumo::select(
            DB::raw('DATE(created_at) as dia'),
            DB::raw('SUM(quantidade) as total')
        )
            ->when($filtrarPorEscola, function ($q) use ($escolaId) {
                $q->whereHas('consumo', function ($cons) use ($escolaId) {
                    $cons->where('escola_id', $escolaId);
                });
            })
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('dia')
            ->orderBy('dia')
            ->get();

        // ===============================
        // LOTES VENCENDO
        // ===============================
        $lotesVencendo = Estoque::when($filtrarPorEscola, function ($q) use ($escolaId) {
            $q->where('escola_id', $escolaId);
        })
            ->where('validade', '<=', now()->addDays(7))
            ->where('quantidade_saldo', '>', 0)
            ->with('produto')
            ->orderBy('validade')
            ->get();

        return view('dashboard.index', compact(
            'totalConsumos',
            'totalPedidos',
            'totalProdutos',
            'maisConsumidos',
            'consumoDias',
            'lotesVencendo'
        ));
    }
}
