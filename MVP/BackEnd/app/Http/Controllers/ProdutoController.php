<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    private $grupos = [
        1 => 'Proteinas',
        2 => 'Carboidratos',
        3 => 'Oleogenosos',
        4 => 'Fibras',
    ];

    public function index()
    {
        $produtos = Produto::all();
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        return view('produtos.create', ['grupos' => $this->grupos]);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:200|unique:produtos,nome',
            'grupo' => 'required|integer|in:1,2,3,4',
        ], [
            'nome.required' => 'Nome deve ser informado.',
            'nome.unique' => 'Produto já cadastrado.',
        ]);

        Produto::create($dados);
        return redirect('/produtos')->with('sucesso', 'Cadastro realizado com sucesso!');
    }

    public function show(string $id)
    {
        $produto = Produto::findOrFail($id); // Encontra o recurso ou lança um erro 404

        return view('produtos.show', ['produto' => $produto]);
    }

    public function edit(string $id)
    {
        $produto = Produto::findOrFail($id);


        return view('produtos.edit', [
            'produto' => $produto,
            'grupos' => $this->grupos,
        ]);
    }


    public function update(Request $request, string $id)
    {
        $produto = Produto::find($id);

        $produto->update([
            'nome' => $request->nome,
            'grupo' => $request->grupo
        ]);

        return redirect('/produtos');
    }

    public function destroy(string $id)
    {
        $produto = Produto::findOrFail($id); // Encontra o recurso ou lança um erro 404

        // Exclui o ambiente
        $produto->delete();

        // Retorna apenas uma mensagem de sucesso
        return redirect('/produtos');
    }

    public function count()
    {
        return response()->json(['total' => Produto::count()]);
    }
}
