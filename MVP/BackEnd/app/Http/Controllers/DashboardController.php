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
        // Quantidades totais
        $totalConsumos = ItemConsumo::sum('quantidade');
        $totalPedidos = Pedido::count();
        $totalProdutos = Produto::count();

        // Itens mais consumidos
        $maisConsumidos = ItemConsumo::select('estoque_id', DB::raw('SUM(quantidade) as total'))
            ->groupBy('estoque_id')
            ->with('estoque.produto')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        // Consumo dos últimos 7 dias
        $consumoDias = ItemConsumo::select(
            DB::raw('DATE(created_at) as dia'),
            DB::raw('SUM(quantidade) as total')
        )
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('dia')
            ->orderBy('dia')
            ->get();

        // Lotes prestes a vencer (7 dias)
        $lotesVencendo = Estoque::where('validade', '<=', now()->addDays(7))
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
