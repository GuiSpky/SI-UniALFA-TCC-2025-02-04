<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CardapioResource;
use App\Models\Cardapio;
use Illuminate\Http\Request;

class CardapioController extends Controller
{
    public function index()
    {
        $cardapios = Cardapio::all();
        return view('cardapios.index', compact('cardapios'));
    }

    public function create()
    {
        return view('cardapios.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|String|max:255',
            'item' => 'required|string|max:255',
            'data' => 'required|date|max:255|after_or_equal:today',
        ], [
            'nome.required' => 'Nome deve ser informado',
            'item.required' => 'Item deve ser informado',
            'data.required' => 'Data deve ser informado',
            'data.after_or_equal' => 'Data informada menor do que data atual',

        ]);

        try {
            Cardapio::create($dados);
            return redirect('/cardapios')->with('sucesso', 'Cardápio cadastrado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('erro', 'Falha ao cadastrar o cardápio. Tente novamente.');
        }
    }

    public function show(string $id)
    {
        $cardapio = Cardapio::findOrFail($id);

        return view('cardapios.show', compact('cardapio'));
    }

    public function edit(string $id)
    {
        $cardapio = Cardapio::findOrFail($id);
        return view('cardapios.edit', compact('cardapio'));
    }

    public function update(Request $request, string $id)
    {
        $cardapio = Cardapio::findOrFail($id);

        $dados = $request->validate([
            'nome' => 'required|String|max:255',
            'item' => 'required|string|max:255',
            'data' => 'required|date|max:255|after_or_equal:today',
        ]);

        try {
            $cardapio->update($dados);
            return redirect('/cardapios')->with('sucesso', 'Cardápio atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('erro', 'Falha ao atualizar cardápio. Tente novamente.');
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
