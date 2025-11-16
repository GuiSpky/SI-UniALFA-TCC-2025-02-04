<?php

namespace App\Http\Controllers;

use App\Models\Consumo;
use App\Models\Estoque;
use App\Models\ItemConsumo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ConsumoController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10);

            $consumos = Consumo::with('itens.estoque.produto')
                ->whereHas('itens.estoque', function ($q) {
                    $q->where('escola_id', auth()->user()->escola_id);
                })
                ->orderByDesc('created_at')
                ->paginate($perPage);

            return view('consumos.index', compact('perPage', 'consumos'));
        } catch (\Throwable $e) {
            Log::error('Erro ao listar consumos', ['erro' => $e->getMessage()]);
            return redirect()->route('dashboard')->with('error', 'Erro ao listar consumos.');
        }
    }




    public function create()
    {
        try {
            $estoques = Estoque::with('produto')->where('escola_id', auth()->user()->escola_id)->get();

            if ($estoques->isEmpty()) {
                return redirect()->route('produtos.index')->with('aviso', 'Nenhum produto cadastrado para consumo.');
            }

            return view('consumos.create', compact('estoques'));
        } catch (\Exception $e) {
            Log::error('Erro ao carregar formulário de consumo: ' . $e->getMessage());
            return redirect()->route('consumos.index')->with('erro', 'Erro ao carregar formulário.');
        }
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'estoques' => 'required|array|min:1',
            'estoques.*' => 'exists:estoques,id',
            'quantidades' => 'required|array',
            'quantidades.*' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {

            $consumo = Consumo::create([
                'escola_id' => auth()->user()->escola_id
            ]);


            foreach ($dados['estoques'] as $i => $estoqueId) {

                $estoque = Estoque::findOrFail($estoqueId);

                // Bloqueio de segurança
                if ($estoque->escola_id !== auth()->user()->escola_id) {
                    throw new \Exception("Você não tem permissão para consumir itens desta escola.");
                }

                $qtd = $dados['quantidades'][$i];

                $saldo = $estoque->quantidade_saldo;

                if ($saldo < $qtd) {
                    throw new \Exception(
                        "Estoque insuficiente para o produto {$estoque->produto->nome}. Saldo disponível: $saldo"
                    );
                }

                ItemConsumo::create([
                    'consumo_id' => $consumo->id,
                    'estoque_id' => $estoque->id,
                    'quantidade' => $qtd,
                ]);

                $estoque->quantidade_saida += $qtd;
                $estoque->quantidade_saldo = $saldo - $qtd;
                $estoque->save();
            }

            DB::commit();

            return redirect()->route('consumos.index')
                ->with('sucesso', 'Consumo registrado com sucesso!');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('erro', $e->getMessage())->withInput();
        }
    }



    public function show(string $id)
    {
        try {
            $consumo = Consumo::with('itens.estoque.produto')->findOrFail($id);
            return view('consumos.show', compact('consumo'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('consumos.index')->with('erro', 'Consumo não encontrado.');
        } catch (\Exception $e) {
            Log::error('Erro ao exibir consumo: ' . $e->getMessage());
            return redirect()->route('consumos.index')->with('erro', 'Erro ao exibir detalhes do consumo.');
        }
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {
            $consumo = Consumo::with('itens.estoque')->findOrFail($id);

            foreach ($consumo->itens as $item) {
                $estoque = $item->estoque;

                // devolve no saldo
                $estoque->quantidade_saldo += $item->quantidade;

                // devolve na saída
                $estoque->quantidade_saida -= $item->quantidade;

                $estoque->save();
            }

            $consumo->delete();

            DB::commit();

            return redirect()->route('consumos.index')->with('sucesso', 'Consumo excluído e estoque restaurado!');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Erro ao excluir consumo: ' . $e->getMessage());
            return redirect()->route('consumos.index')->with('erro', 'Erro ao excluir consumo.');
        }
    }
}
