<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    /**
     * Exibe filtros e resultados (caso existam).
     */
    public function index(Request $request)
    {
        $escolas  = Escola::orderBy('nome')->get();
        $produtos = Produto::orderBy('nome')->get();
        $dados    = collect();
        $titulo   = null;

        if ($request->filled('tipo')) {
            $dados = $this->gerarDados($request, $titulo);
        }

        return view('relatorios.index', compact('escolas', 'produtos', 'dados', 'titulo'));
    }


    /**
     * Processa os filtros e retorna os dados.
     */
    private function gerarDados($request, &$titulo)
    {
        $request->validate([
            'tipo' => 'required|string',
            'data_inicio' => 'nullable|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
        ]);

        $dados = collect();
        $titulo = '';

        switch ($request->tipo) {

            /* --------------------------------------------------------------
            | RELATÓRIO 1 — CONSUMO POR ESCOLA
            ---------------------------------------------------------------*/
            case 'consumo_escolas':
                $titulo = 'Consumo por Escola';

                $query = DB::table('item_consumos')
                    ->join('consumos', 'consumos.id', '=', 'item_consumos.consumo_id')
                    ->join('escolas', 'escolas.id', '=', 'consumos.escola_id')
                    ->join('estoques', 'estoques.id', '=', 'item_consumos.estoque_id')
                    ->join('produtos', 'produtos.id', '=', 'estoques.produto_id')
                    ->select(
                        'escolas.nome as escola',
                        DB::raw('SUM(item_consumos.quantidade) as total_consumido')
                    )
                    ->groupBy('escolas.nome')
                    ->orderByDesc('total_consumido');

                if ($request->filled('data_inicio') && $request->filled('data_fim')) {
                    $query->whereBetween('consumos.created_at', [$request->data_inicio, $request->data_fim]);
                }

                if ($request->filled('escola_id')) {
                    $query->where('escolas.id', $request->escola_id);
                }

                if ($request->filled('produto_id')) {
                    $query->where('produtos.id', $request->produto_id);
                }

                return $query->get();


                /* --------------------------------------------------------------
            | RELATÓRIO 2 — PRODUTOS MAIS SOLICITADOS
            | Baseado na tabela itens do PEDIDO!
            ---------------------------------------------------------------*/
            case 'solicitacoes_produtos':
                $titulo = 'Produtos Mais Solicitados';

                $query = DB::table('item_pedidos')
                    ->join('produtos', 'produtos.id', '=', 'item_pedidos.produto_id')
                    ->join('pedidos', 'pedidos.id', '=', 'item_pedidos.pedido_id')
                    ->select(
                        'produtos.nome as produto',
                        DB::raw('SUM(item_pedidos.quantidade) as total_solicitado')
                    )
                    ->groupBy('produtos.nome')
                    ->orderByDesc('total_solicitado');

                if ($request->filled('data_inicio') && $request->filled('data_fim')) {
                    $query->whereBetween('pedidos.created_at', [$request->data_inicio, $request->data_fim]);
                }

                if ($request->filled('limite')) {
                    $query->limit($request->limite);
                }

                return $query->get();


                /* --------------------------------------------------------------
            | RELATÓRIO 3 — ESTOQUE CRÍTICO
            ---------------------------------------------------------------*/
            case 'estoque_critico':
                $titulo = 'Estoque Crítico';

                $query = DB::table('estoques')
                    ->join('produtos', 'produtos.id', '=', 'estoques.produto_id')
                    ->select(
                        'produtos.nome as produto',
                        DB::raw('(estoques.quantidade_entrada - estoques.quantidade_saida) AS saldo'),
                        'estoques.validade'
                    )
                    ->orderBy('saldo');

                if ($request->filled('limite_estoque')) {
                    $query->havingRaw('(estoques.quantidade_entrada - estoques.quantidade_saida) < ?', [
                        $request->limite_estoque
                    ]);
                }

                return $query->get();


            default:
                return collect();
        }

        return [
            'dados' => $dados,
            'titulo' => $titulo,
            'labels' => $dados->pluck(array_keys((array) $dados->first())[0] ?? '')->toArray(),
            'valores' => $dados->pluck(array_keys((array) $dados->first())[1] ?? '')->toArray(),
        ];
    }

    public function exportarPDF(Request $request)
    {
        // Reexecuta a geração do relatório com os filtros atuais
        $dadosRelatorio = $this->gerarDados($request);

        // Gera o PDF
        $pdf = Pdf::loadView('relatorios.pdf', $dadosRelatorio);

        return $pdf->download('relatorio.pdf');
    }

    public function exportarExcel(Request $request)
    {
        $dadosRelatorio = $this->gerarDados($request);

        return Excel::download(new \App\Exports\RelatorioExport($dadosRelatorio), 'relatorio.xlsx');
    }
}
