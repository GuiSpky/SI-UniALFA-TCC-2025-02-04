<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use App\Models\ItemProduto;
use App\Models\Produto;
use Illuminate\Http\Request;

class ItemProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::all();
        $escolas = Escola::all();
        $itemProdutos = ItemProduto::all();

        return view('itemProdutos.index', compact('escolas', 'itemProdutos', 'produtos'));
    }

    public function create()
    {
        $produtos = Produto::all();
        $escolas = Escola::all();
        $itemProdutos = ItemProduto::all();

        return view('itemProdutos.create', compact('escolas', 'itemProdutos', 'produtos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'id_produto' => 'required|integer',
            'quantidade_entrada' => 'required|integer',
            'validade' => 'required|date',
            'id_escola' => 'required|integer',
        ]);

        ItemProduto::create($dados);
        return redirect()->route('itemProdutos.index')->with('sucesso', 'Cadastro realizado com sucesso!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $itemProduto = ItemProduto::find($id);
        $produtos = Produto::all();
        $escolas = Escola::all();

        return view('itemProdutos.show',compact('itemProduto', 'produtos', 'escolas'));
    }

    public function edit(string $id)
    {
        $itemProduto = ItemProduto::find($id);
        $produtos = Produto::all();
        $escolas = Escola::all();

        return view('itemProdutos.edit',compact('itemProduto', 'produtos', 'escolas'));
    }

    public function update(Request $request, string $id)
    {
        $ItemProduto = ItemProduto::findOrFail($id);

        $ItemProduto->update([
            'id_produto' => $request->id_produto,
            'quantidade_entrada' => $request->quantidade_entrada,
            'quantidade_saida' => $request->quantidade_saida,
            'validade' => $request->vallidade,
            'DataEntrada' => $request->DataEntrada,
            'id_escola' => $request->id_escola,
        ]);

        $ItemProduto = ItemProduto::findOrFail($id);

        return redirect()->route('itemProdutos.index')->with('sucesso', 'Cadastro realizado com sucesso!');
    }

    public function destroy(string $id)
    {
        try {
            // Usa o Model User
            $ItemProduto = ItemProduto::findOrFail($id);
            $ItemProduto->delete();
            return redirect()->route('itemProdutos.index')->with('sucesso', 'Item excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('itemProdutos.index')->with('erro', 'Erro ao excluir o item.');
        }
    }
}
