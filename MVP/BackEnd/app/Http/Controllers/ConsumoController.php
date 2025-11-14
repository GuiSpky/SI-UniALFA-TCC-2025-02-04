<?php

namespace App\Http\Controllers;

use App\Models\Consumo;
use App\Models\Estoque;
use App\Models\ItemConsumo;
use App\Models\Produto;
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
            $estoques = Estoque::with('produto')->get();

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
        'estoques.*' => 'exists:estoque,id',
        'quantidades' => 'required|array',
        'quantidades.*' => 'required|integer|min:1',
    ]);

    DB::beginTransaction();

    try {
        $consumo = Consumo::create();

        foreach ($dados['estoques'] as $i => $estoqueId) {
            $estoque = Estoque::findOrFail($estoqueId);
            $qtd = $dados['quantidades'][$i];

            $saldo = $estoque->quantidade_entrada - $estoque->quantidade_saida;

            if ($saldo < $qtd) {
                throw new \Exception("Estoque insuficiente para o produto {$estoque->produto->nome}. Saldo: $saldo");
            }

            ItemConsumo::create([
                'consumo_id' => $consumo->id,
                'estoque_id' => $estoque->id,
                'quantidade' => $qtd,
            ]);

            $estoque->increment('quantidade_saida', $qtd);
        }

        DB::commit();

        return redirect()->route('consumos.index')->with('sucesso', 'Consumo registrado com sucesso!');
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
        try {
            $consumo = Consumo::findOrFail($id);
            $consumo->delete();

            return redirect()->route('consumos.index')->with('sucesso', 'Consumo excluído com sucesso!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('consumos.index')->with('erro', 'Consumo não encontrado.');
        } catch (\Exception $e) {
            Log::error('Erro ao excluir consumo: ' . $e->getMessage());
            return redirect()->route('consumos.index')->with('erro', 'Erro ao excluir consumo.');
        }
    }
}
