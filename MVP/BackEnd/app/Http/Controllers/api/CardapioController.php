<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CardapioResource;
use App\Models\Cardapio;
use Illuminate\Http\Request;

class CardapioController extends Controller
{
    public function index()
    {
        $dados = Cardapio::all();
        return view('cardapios.index', [
            'cardapios' => $dados
        ]);
    }

    public function create()
    {
        return view('cardapios.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
        'codIbge' => 'required|Integer',
        'nome' => 'required|string|max:255',
        'uf' => 'required|string|max:255',
    ]);

        Cardapio::create($dados);
        return ($dados);
    }

    public function show(string $id)
    {
        $cardapio = Cardapio::findOrFail($id); // Encontra o recurso ou lança um erro 404

        return view('cardapios.show', ['cardapio'=> $cardapio]);

    }

    public function edit(string $id)
    {
        $cardapio = Cardapio::find($id);
        return view('cardapios.edit',[
            'cardapio' => $cardapio
        ]);
    }

    public function update(Request $request, string $id)
    {
        $cardapio = Cardapio::findOrFail($id);

        $cardapio->update([
            "codIbge"=>$request->codIbge,
	        "nome"=>$request->nome,
	        "uf"=>$request->uf,
        ]);

        $cardapio = Cardapio::findOrFail($id);

        return redirect('/cardapios');
    }

    public function destroy(string $id)
    {
        $cardapio = Cardapio::findOrFail($id); // Encontra o recurso ou lança um erro 404

        // Exclui o ambiente
        $cardapio->delete();

        // Retorna apenas uma mensagem de sucesso
        return redirect('/cardapios');

    }

    public function count()
    {
        return response()->json(['total' => Cardapio::count()]);
    }
}
