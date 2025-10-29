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
        $Produtos = Produto::all();
        $ItemProduto = ItemProduto::all();

        return view('estoque.index', [
            'ItemProduto' => $ItemProduto,
            'Produtos' => $Produtos,
        ]);
    }

    public function create()
    {
        $Produtos = Produto::all();
        $ItemProduto = ItemProduto::all();

        return view('estoque.create', compact($Produtos, $ItemProduto));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'id_produto' => 'required|integer',
            'quantidade' => 'required|string|max:255|',
            'validade' => 'required|date',
            'DataEntrada' => 'required|date',
            'id_deposito' => 'required|integer',
        ]);

        ItemProduto::create($dados);
        return redirect('/estoques')->with('sucesso', 'Cadastro realizado com sucesso!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ItemProduto = ItemProduto::find($id);
        $Produtos = Produto::all();
        $Escola = Escola::all();

        return view('estoque.edit',compact($ItemProduto, $Produtos, $Escola));
    }

    public function edit(string $id)
    {
        $ItemProduto = ItemProduto::find($id);
        $Produtos = Produto::all();
        $Escola = Escola::all();

        return view('estoque.edit',compact($ItemProduto, $Produtos, $Escola));
    }

    public function update(Request $request, string $id)
    {
        $ItemProduto = ItemProduto::findOrFail($id);

        $ItemProduto->update([
            'id_produto' => $request->id_produto,
            'quantidade' => $request->quantidade,
            'validade' => $request->vallidade,
            'DataEntrada' => $request->DataEntrada,
            'id_deposito' => $request->id_deposito,
        ]);

        $ItemProduto = ItemProduto::findOrFail($id);

        return redirect('/estoques')->with('sucesso', 'Cadastro realizado com sucesso!');
    }

    public function destroy(string $id)
    {
        try {
            // Usa o Model User
            $ItemProduto = ItemProduto::findOrFail($id);
            $ItemProduto->delete();
            return redirect('/estoque')->with('sucesso', 'Item excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect('/estoque')->with('erro', 'Erro ao excluir o item.');
        }
    }
}
