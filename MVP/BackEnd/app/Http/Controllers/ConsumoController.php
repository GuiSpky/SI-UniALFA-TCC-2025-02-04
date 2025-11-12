<?php

namespace App\Http\Controllers;

use App\Models\Consumo;
use App\Models\ItemProduto;
use App\Models\ItemConsumo;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConsumoController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10);
            $consumos = Consumo::with('itens.itemProduto.produto')
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
            $produtos = Produto::all();

            if ($produtos->isEmpty()) {
                return redirect()->route('produtos.index')->with('aviso', 'Nenhum produto cadastrado para consumo.');
            }

            return view('consumos.create', compact('produtos'));
        } catch (\Exception $e) {
            Log::error('Erro ao carregar formulário de consumo: ' . $e->getMessage());
            return redirect()->route('consumos.index')->with('erro', 'Erro ao carregar formulário.');
        }
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'produtos' => 'required|array|min:1',
            'produtos.*' => 'exists:produtos,id',
            'quantidades' => 'required|array',
            'quantidades.*' => 'required|integer|min:1',
        ], [
            'produtos.required' => 'Selecione ao menos um produto.',
            'produtos.*.exists' => 'Produto selecionado é inválido.',
            'quantidades.required' => 'Informe ao menos uma quantidade.',
            'quantidades.*.required' => 'Informe a quantidade para cada produto selecionado.',
        ]);

        try {
            // Cria o consumo (timestamps automáticos)
            $consumo = Consumo::create();

            foreach ($dados['produtos'] as $index => $id_produto) {
                $itemProduto = ItemProduto::where('id_produto', $id_produto)->first();

                if (!$itemProduto) {
                    Log::warning("Produto ID {$id_produto} não encontrado em item_produtos.");
                    continue;
                }

                $quantidade = $dados['quantidades'][$index] ?? 1;

                ItemConsumo::create([
                    'consumo_id' => $consumo->id,
                    'item_produto_id' => $itemProduto->id,
                    'quantidade' => $quantidade,
                ]);
            }




            return redirect()->route('consumos.index')->with('sucesso', 'Consumo cadastrado com sucesso!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Erro ao salvar consumo: ' . $e->getMessage());
            return redirect()->route('consumos.index')->with('erro', 'Erro ao salvar consumo.');
        }
    }

    public function show(string $id)
    {
        try {
            $consumo = Consumo::with('itens.itemProduto.produto')->findOrFail($id);
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
