<?php

namespace App\Http\Controllers;

use App\Models\Consumo;
use App\Models\ItemProduto;
use App\Models\Produto;
use Illuminate\Http\Request;

class ConsumoController extends Controller
{
    public function index()
    {
        $consumo = Consumo::all();
        $produtos = Produto::all();
        $itemProdutos = ItemProduto::all();

        return view('consumo.index', compact('consumo', 'itemProdutos', 'produtos'));
    }

    public function create()
    {
        $consumo = Consumo::all();
        $produtos = Produto::all();
        $itemProdutos = ItemProduto::all();

        return view('consumo.create', compact('consumo', 'itemProdutos', 'produtos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'id_item_produto' => 'required|integer',
            'quantidade_consumo' => 'required|integer',
        ]);

        ItemProduto::create($dados);
        return redirect()->route('consumo.index')->with('sucesso', 'Cadastro realizado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $consumo = Consumo::findOrFail($id);
        $itemProduto = ItemProduto::all();
        $produtos = Produto::all();

        return view('consumo.show', compact('consumo', 'itemProduto', 'produtos'));
    }

    public function edit(string $id)
    {
        $consumo = Consumo::findOrFail($id);
        $itemProduto = ItemProduto::all();
        $produtos = Produto::all();

        return view('consumo.edit', compact('consumo', 'itemProduto', 'produtos'));
    }

    public function update(Request $request, string $id)
    {
        $consumo = Consumo::findOrFail($id);

        $dados = $request->validate([
            'id_item_estoque' => 'required|integer',
            'quantidade_consumo' => 'required|integer',
        ]);

        try {
            $consumo->update($dados);
            return redirect('/consumo')->with('sucesso', 'Saída de estoque atualizada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('erro', 'Falha ao atualizar saída de estoque. Tente novamente.');
        }
    }

    public function destroy(string $id)
    {
        try {
            // Usa o Model User
            $consumo = Consumo::findOrFail($id);
            $consumo->delete();
            return redirect()->route('consumo.index')->with('sucesso', 'Item excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('consumo.index')->with('erro', 'Erro ao excluir o item.');
        }
    }
}
