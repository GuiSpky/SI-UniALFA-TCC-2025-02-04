<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CardapioResource;
use App\Models\Cardapio;
use App\Models\ItemReceita;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CardapioController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $cardapios = Cardapio::with(['itens.produto'])->paginate($perPage);
        return view('cardapios.index', compact('perPage','cardapios'));
    }

    public function create()
    {
        $produtos = Produto::all();
        return view('cardapios.create', compact('produtos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'receita' => 'required|String|max:255',
            'data' => 'required|date|max:255|after_or_equal:today',
            'produtos' => 'required|array',
            'produtos.*' => 'exists:produtos,id'
        ], [
            'receita.required' => 'Receita deve ser informado',
            'data.required' => 'Data deve ser informado',
            'data.after_or_equal' => 'Data informada menor do que data atual',

        ]);

        try {
            $cardapio = Cardapio::create([
                'receita' => $validated['receita'],
                'data' => $validated['data'],
            ]);

            // Salva os produtos na tabela item_receita
            foreach ($validated['produtos'] as $produtoId) {
                ItemReceita::create([
                    'cardapio_id' => $cardapio->id,
                    'produto_id' => $produtoId,
                ]);
            }

            return redirect('/cardapios')->with('sucesso', 'Cardápio cadastrado com sucesso!');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function show(string $id)
    {
        $cardapio = Cardapio::with(['itens.produto'])->get()->findOrFail($id);
        return view('cardapios.show', compact('cardapio'));
    }

    public function edit(string $id)
    {
        $cardapio = Cardapio::findOrFail($id);
        $produtos = Produto::all();
        return view('cardapios.edit', compact('cardapio','produtos'));
    }

    public function update(Request $request, string $id)
{
    $cardapio = Cardapio::with('itens')->findOrFail($id);

    $dados = $request->validate([
        'receita' => 'required|string|max:255',
        'data' => 'required|date|after_or_equal:today',
        'produtos' => 'required|array', // produtos devem vir em array
    ]);

    try {
        // Atualiza os dados básicos do cardápio
        $cardapio->update([
            'receita' => $dados['receita'],
            'data' => $dados['data'],
        ]);

        // Remove os itens antigos
        $cardapio->itens()->delete();

        // Recria os novos itens vinculados
        foreach ($dados['produtos'] as $produto_id) {
            $cardapio->itens()->create([
                'produto_id' => $produto_id,
            ]);
        }

        return redirect()
            ->route('cardapios.index')
            ->with('sucesso', 'Cardápio atualizado com sucesso!');
    } catch (\Exception $e) {
        return redirect()
            ->back()
            ->withInput()
            ->with('erro', 'Falha ao atualizar cardápio. Tente novamente.');
    }
}

    public function destroy(string $id)
    {
        try {
            $cardapio = Cardapio::findOrFail($id);
            $cardapio->delete();
            return redirect('/cardapios')->with('sucesso', 'Cardápio excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect('/cardapios')->with('erro', 'Erro ao excluir o cardápio.');
        }
    }

    public function count()
    {
        return response()->json(['total' => Cardapio::count()]);
    }
}
