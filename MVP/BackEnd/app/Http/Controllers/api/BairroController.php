<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BairroResource;
use App\Models\Bairro;
use Illuminate\Http\Request;

class BairroController extends Controller
{

    public function index()
    {
        $dados = Bairro::all();
        return BairroResource::collection($dados);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
        'nome' => 'required|string|max:100',
        'id_cidade' => 'required|integer',
    ]);

        Bairro::create($dados);
        return ($dados);
    }

    public function show(string $id)
    {
        $bairro = Bairro::findOrFail($id); // Encontra o recurso ou lança um erro 404

        return ($bairro);
    }

    public function update(Request $request, string $id)
    {
        $bairro = Bairro::findOrFail($id);

        $bairro->update([
            "id_cidade"=>$request->id_cidade,
	        "nome"=>$request->nome,
        ]);

        $bairro = Bairro::findOrFail($id);

        return ($bairro);
    }

    public function destroy(string $id)
    {
        $bairro = Bairro::findOrFail($id); // Encontra o recurso ou lança um erro 404

        // Exclui o ambiente
        $bairro->delete();

        // Retorna apenas uma mensagem de sucesso
        return response()->json([
            'message' => 'Ambiente deletado com sucesso.',
        ], 200);
    }
}
