<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use App\Models\ItemProduto;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    /**
     * Exibe o formulário de filtros.
     */
    public function index()
    {
        $escolas = Escola::orderBy('nome')->get();
        $produtos = Produto::orderBy('nome')->get();

        return view('relatorios.index', compact('escolas', 'produtos'));
    }

    /**
     * Gera o relatório com base no tipo e filtros selecionados.
     */
    public function gerar(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string',
            'data_inicio' => 'nullable|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
        ]);

        $dados = collect();
        $titulo = '';
        $query = null;

        switch ($request->tipo) {
            case 'consumo_escolas':
                $titulo = 'Consumo por Escola';
                $query = DB::table('consumos')
                    ->join('escolas', 'escolas.id', '=', 'consumos.id_escola')
                    ->join('produtos', 'produtos.id', '=', 'consumos.id_produto')
                    ->select('escolas.nome as escola', DB::raw('SUM(consumos.quantidade) as total_consumido'))
                    ->groupBy('escolas.nome')
                    ->orderByDesc('total_consumido');

                if ($request->filled('data_inicio') && $request->filled('data_fim')) {
                    $query->whereBetween('consumos.data', [$request->data_inicio, $request->data_fim]);
                }

                if ($request->filled('escola_id')) {
                    $query->where('escolas.id', $request->escola_id);
                }

                if ($request->filled('produto_id')) {
                    $query->where('produtos.id', $request->produto_id);
                }

                $dados = $query->get();
                break;

            case 'solicitacoes_produtos':
                $titulo = 'Produtos Mais Solicitados';
                $query = DB::table('solicitacoes')
                    ->join('produtos', 'produtos.id', '=', 'solicitacoes.id_produto')
                    ->select('produtos.nome as produto', DB::raw('COUNT(*) as total_solicitacoes'))
                    ->groupBy('produtos.nome')
                    ->orderByDesc('total_solicitacoes');

                if ($request->filled('data_inicio') && $request->filled('data_fim')) {
                    $query->whereBetween('solicitacoes.data', [$request->data_inicio, $request->data_fim]);
                }

                if ($request->filled('limite')) {
                    $query->limit($request->limite);
                }

                $dados = $query->get();
                break;

            case 'estoque_critico':
                $titulo = 'Estoque Atual';
                $query = DB::table('produtos')
                    ->select('nome as produto', 'quantidade_atual as estoque')
                    ->orderBy('quantidade_atual');

                if ($request->filled('limite_estoque')) {
                    $query->where('quantidade_atual', '<', $request->limite_estoque);
                }

                $dados = $query->get();
                break;

            default:
                return redirect()->back()->withErrors('Tipo de relatório inválido.');
        }

        // Extrair dados para o gráfico
        $labels = $dados->pluck(array_keys((array) $dados->first())[0] ?? '')->toArray();
        $valores = $dados->pluck(array_keys((array) $dados->first())[1] ?? '')->toArray();

        return view('relatorios.resultado', compact('dados', 'titulo', 'labels', 'valores'));
    }
}
