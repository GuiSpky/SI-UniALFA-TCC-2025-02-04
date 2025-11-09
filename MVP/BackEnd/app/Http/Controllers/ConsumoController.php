<?php

namespace App\Http\Controllers;

use App\Models\Consumo;
use App\Models\ItemProduto;
use App\Models\ItemConsumo;
use App\Models\Produto;
use Illuminate\Http\Request;

class ConsumoController extends Controller
{
    public function index()
    {
        $consumos = Consumo::with('itens.itemProduto.produto')->get();
        return view('consumos.index', compact('consumos'));
    }

    public function create()
    {
        $produtos = Produto::all();
        return view('consumos.create', compact('produtos'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'produtos' => 'required|array',
            'produtos.*' => 'exists:produtos,id',
        ]);

        $consumo = Consumo::create([
            'data' => now(),
        ]);

        foreach ($dados['produtos'] as $id_produto) {
            // busca o item_estoque correspondente
            $itemProduto = ItemProduto::where('id_produto', $id_produto)->first();
            if ($itemProduto) {
                ItemConsumo::create([
                    'id_consumo' => $consumo->id,
                    'id_item_produto' => $itemProduto->id,
                    'quantidade' => 1,
                ]);
            }
        }

        return redirect()->route('consumos.index')->with('sucesso', 'Consumo cadastrado com sucesso!');
    }

    public function show(string $id)
    {
        $consumo = Consumo::with('itens.itemProduto.produto')->findOrFail($id);
        return view('consumos.show', compact('consumo'));
    }

    public function destroy(string $id)
    {
        try {
            $consumo = Consumo::findOrFail($id);
            $consumo->delete();
            return redirect()->route('consumos.index')->with('sucesso', 'Consumo excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('consumos.index')->with('erro', 'Erro ao excluir consumo.');
        }
    }
}
