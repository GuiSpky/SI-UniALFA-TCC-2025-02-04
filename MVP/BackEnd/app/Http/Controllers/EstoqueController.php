<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use App\Models\Estoque;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $perPage = $request->input('per_page', 10);

        $produtos = Produto::all();
        $escolas  = Escola::all();

        // 📌 Cargo 1 → pode filtrar por qualquer escola
        if ($user->cargo == 1) {

            $escolaSelecionada = $request->input('escola_id', $user->escola_id);

            $estoque = Estoque::where('escola_id', $escolaSelecionada)
                ->paginate($perPage);

            return view('estoques.index', compact('perPage', 'estoque', 'produtos', 'escolas', 'escolaSelecionada'));
        }

        // 📌 Cargo 2 → só vê sua própria escola
        $estoque = Estoque::where('escola_id', $user->escola_id)
            ->paginate($perPage);

        $escolaSelecionada = $user->escola_id;

        return view('estoques.index', compact('perPage', 'estoque', 'produtos', 'escolas', 'escolaSelecionada'));
    }


    public function create()
    {
        if (auth()->user()->cargo != 1) {
            return redirect()->route('estoques.index')
                ->with('error', 'Acesso permitido somente para administradores municipais.');
        }

        $produtos = Produto::all();
        $escolas = Escola::all();

        return view('estoques.create', compact('escolas', 'produtos'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->cargo != 1) {
            return redirect()->route('estoques.index')
                ->with('error', 'Acesso permitido somente para administradores municipais.');
        }

        $dados = $request->validate([
            'produto_id' => 'required|integer',
            'quantidade_entrada' => 'required|integer|min:1',
            'validade' => 'required|date',
            'escola_id' => 'required|integer',
        ]);

        $dados['quantidade_saldo'] = $dados['quantidade_entrada'];
        $dados['quantidade_saida'] = 0;

        Estoque::create($dados);

        return redirect()->route('estoques.index')->with('sucesso', 'Cadastro realizado com sucesso!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $estoque = Estoque::with(['produto', 'escola', 'pedido'])->findOrFail($id);

        return view('estoques.show', compact('estoque'));
    }

    public function edit(string $id)
    {
        return view('estoques.edit', [
            'estoque' => Estoque::findOrFail($id),
            'produtos' => Produto::all(),
            'escolas' => Escola::all()
        ]);
    }

    public function update(Request $request, string $id)
    {
        $estoque = Estoque::findOrFail($id);

        $dados = $request->validate([
            'produto_id' => 'required|integer|exists:produtos,id',
            'quantidade_entrada' => 'required|integer|min:1',
            'validade' => 'required|date',
            'escola_id' => 'required|integer|exists:escolas,id',
        ]);

        // Recalcular saldo (entrada - saídas já registradas)
        $dados['quantidade_saldo'] = $dados['quantidade_entrada'] - $estoque->quantidade_saida;

        if ($dados['quantidade_saldo'] < 0) {
            return back()->with('erro', 'Não é possível atualizar: saldo ficaria negativo!');
        }

        $estoque->update($dados);

        return redirect()
            ->route('estoques.index')
            ->with('sucesso', 'Entrada de estoque atualizada com sucesso!');
    }

    public function destroy(string $id)
    {
        try {
            $estoque = Estoque::findOrFail($id);
            $estoque->delete();

            return redirect()
                ->route('estoques.index')
                ->with('sucesso', 'Item excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()
                ->route('estoques.index')
                ->with('erro', 'Erro ao excluir o item.');
        }
    }
}
