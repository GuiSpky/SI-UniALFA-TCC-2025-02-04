<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

class RelatorioController extends Controller
{
    public function index(Request $request)
    {
        $escolas  = Escola::orderBy('nome')->get();
        $produtos = Produto::orderBy('nome')->get();
        $hoje = Carbon::today();

        $resultado = [
            'dados'   => collect(),
            'titulo'  => null,
            'labels'  => [],
            'valores' => [],
        ];

        if ($request->data_inicio > $hoje) {
            return redirect('relatorios')
                ->withInput()
                ->with('toast', 'A data inicial não pode ser maior que a data atual!')
                ->with('toast_icon', '🗓️');
        }

        // Verifica data inicial maior que data final
        if ($request->data_inicio > $request->data_fim) {
            return redirect('relatorios')
                ->withInput()
                ->with('toast', 'A data inicial não pode ser maior que a data final!')
                ->with('toast_icon', '🗓️');
        }


        if ($request->filled('tipo')) {
            $resultado = $this->gerarDados($request);
        }

        return view('relatorios.index', array_merge($resultado, compact('escolas', 'produtos')));
    }


    /* =====================================================
    |  APLICA FILTROS COMUNS EM QUALQUER QUERY
    ===================================================== */
    private function applyCommonFilters($query, Request $request, $tabelaData = null)
    {
        if ($request->filled('data_inicio') && $request->filled('data_fim')) {
            $campo = $tabelaData ? "$tabelaData.created_at" : 'created_at';
            $query->whereBetween($campo, [$request->data_inicio, $request->data_fim]);
        }



        return $query;
    }


    /* =====================================================
    |  GERA RELATÓRIO COMPLETO
    ===================================================== */
    private function gerarDados(Request $request)
    {
        $dados = collect();
        $titulo = '';


        switch ($request->tipo) {

            /* ----------------------------------------
            | RELATÓRIO 1 — CONSUMO POR ESCOLA
            -----------------------------------------*/
            case 'consumo_escolas':
                $titulo = 'Consumo por Escola';

                $query = DB::table('item_consumos')
                    ->join('consumos', 'consumos.id', '=', 'item_consumos.consumo_id')
                    ->join('escolas', 'escolas.id', '=', 'consumos.escola_id')
                    ->join('estoques', 'estoques.id', '=', 'item_consumos.estoque_id')
                    ->join('produtos', 'produtos.id', '=', 'estoques.produto_id')
                    ->select(
                        'escolas.nome as escola',
                        'produtos.nome as produto',
                        'produtos.medida',
                        DB::raw('SUM(item_consumos.quantidade) as total_consumido')
                    )
                    ->groupBy('escolas.nome', 'produtos.nome', 'produtos.medida')
                    ->orderByDesc('total_consumido');

                $query = $this->applyCommonFilters($query, $request, 'consumos');


                if ($request->filled('escola_id')) {
                    $query->where('escolas.id', $request->escola_id);
                }

                if ($request->filled('produto_id')) {
                    $query->where('produtos.id', $request->produto_id);
                }

                $dados = $query->get();

                $dados = $dados->map(function ($item) {
                    $item->total_consumido = $item->total_consumido . ' ' . $item->medida;

                    unset($item->medida);

                    return $item;
                });


                break;


            /* ----------------------------------------
            | RELATÓRIO 2 — PRODUTOS MAIS SOLICITADOS
            -----------------------------------------*/
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

                $query = $this->applyCommonFilters($query, $request, 'pedidos');

                if ($request->filled('limite')) {
                    $query->limit($request->limite);
                }

                $dados = $query->get();

                // Formatar datas
                $dados = $dados->map(function ($item) {
                    foreach ($item as $key => $value) {
                        if ($value && (str_contains($key, 'data') || str_contains($key, 'created_at') || str_contains($key, 'validade'))) {
                            try {
                                $item->$key = \Carbon\Carbon::parse($value)->format('d/m/Y');
                            } catch (\Exception $e) {
                            }
                        }
                    }
                    return $item;
                });

                break;


            /* ----------------------------------------
            | RELATÓRIO 3 — ESTOQUE CRÍTICO / A VENCER
            -----------------------------------------*/
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
                    $query->having('saldo', '<', $request->limite_estoque);
                }

                // Filtro: produtos vencidos
                if ($request->filled('vencidos') && $request->vencidos == 1) {
                    $query->where('estoques.validade', '<', now());
                }

                // Filtro: vencendo em X dias
                if ($request->filled('vencendo_dias')) {
                    $query->where('estoques.validade', '<=', now()->addDays($request->vencendo_dias));
                }

                $dados = $query->get();

                // Formatar datas
                $dados = $dados->map(function ($item) {
                    foreach ($item as $key => $value) {
                        if ($value && (str_contains($key, 'data') || str_contains($key, 'created_at') || str_contains($key, 'validade'))) {
                            try {
                                $item->$key = \Carbon\Carbon::parse($value)->format('d/m/Y');
                            } catch (\Exception $e) {
                            }
                        }
                    }
                    return $item;
                });

                break;
        }

        return [
            'dados' => $dados,
            'titulo' => $titulo,
            'labels' => $dados->pluck(array_keys((array)$dados->first())[0] ?? '')->toArray(),
            'valores' => $dados->pluck(array_keys((array)$dados->first())[1] ?? '')->toArray(),
        ];
    }


    /* -------------------- EXPORTAÇÕES ------------------- */

    public function exportarPDF(Request $request)
    {
        $result = $this->gerarDados($request);
        $pdf = Pdf::loadView('relatorios.pdf', $result);
        return $pdf->download('relatorio.pdf');
    }

    public function exportarExcel(Request $request)
    {
        $result = $this->gerarDados($request);
        return Excel::download(new \App\Exports\RelatorioExport($result), 'relatorio.xlsx');
    }
}
