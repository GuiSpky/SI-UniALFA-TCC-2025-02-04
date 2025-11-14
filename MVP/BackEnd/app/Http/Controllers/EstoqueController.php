<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use App\Models\Estoque;
use App\Models\Produto;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $produtos = Produto::all();
        $escolas = Escola::all();
        $estoque = Estoque::paginate($perPage);

        return view('estoque.index', compact('perPage', 'escolas', 'estoque', 'produtos'));
    }

    public function create()
    {
        $produtos = Produto::all();
        $escolas = Escola::all();
        $estoque = Estoque::all();

        return view('estoque.create', compact('escolas', 'estoque', 'produtos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'id_produto' => 'required|integer',
            'quantidade_entrada' => 'required|integer|min:1',
            'validade' => 'required|date',
            'id_escola' => 'required|integer',
        ]);

        // Saldo inicial = quantidade de entrada
        $dados['quantidade_saldo'] = $dados['quantidade_entrada'];
        $dados['quantidade_saida'] = 0;

        Estoque::create($dados);

        return redirect()->route('estoque.index')->with('sucesso', 'Cadastro realizado com sucesso!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $estoque = Estoque::find($id);
        $produtos = Produto::all();
        $escolas = Escola::all();

        return view('estoque.show', compact('estoque', 'produtos', 'escolas'));
    }

    public function edit(string $id)
    {
        $estoque = Estoque::find($id);
        $produtos = Produto::all();
        $escolas = Escola::all();

        return view('estoque.edit', compact('estoque', 'produtos', 'escolas'));
    }

    public function update(Request $request, string $id)
    {
        $estoque = Estoque::findOrFail($id);

        $dados = $request->validate([
            'id_produto' => 'required|integer',
            'quantidade_entrada' => 'required|integer|min:1',
            'validade' => 'required|date',
            'id_escola' => 'required|integer',
        ]);

        // Recalcular saldo (entrada - saídas já registradas)
        $dados['quantidade_saldo'] = $dados['quantidade_entrada'] - $estoque->quantidade_saida;

        if ($dados['quantidade_saldo'] < 0) {
            return back()->with('erro', 'Não é possível atualizar: saldo ficaria negativo!');
        }

        $estoque->update($dados);

        return redirect('/estoque')->with('sucesso', 'Entrada de estoque atualizada com sucesso!');
    }


    public function destroy(string $id)
    {
        try {
            // Usa o Model User
            $estoque = Estoque::findOrFail($id);
            $estoque->delete();
            return redirect()->route('estoque.index')->with('sucesso', 'Item excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('estoque.index')->with('erro', 'Erro ao excluir o item.');
        }
    }
}
