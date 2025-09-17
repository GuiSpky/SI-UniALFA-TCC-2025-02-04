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
        return CardapioResource::collection($dados);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
        'codIbge' => 'required|bigInteger',
        'nome' => 'required|string|max:255',
        'uf' => 'required|string|max:255',
    ]);

        Cardapio::create($dados);
        return ($dados);
    }

    public function show(string $id)
    {
        $cardapio = Cardapio::findOrFail($id); // Encontra o recurso ou lança um erro 404

        return ($cardapio);
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

        return ($cardapio);
    }

    public function destroy(string $id)
    {
        $cardapio = Cardapio::findOrFail($id); // Encontra o recurso ou lança um erro 404

        // Exclui o ambiente
        $cardapio->delete();

        // Retorna apenas uma mensagem de sucesso
        return response()->json([
            'message' => 'Ambiente deletado com sucesso.',
        ], 200);
    }
}
