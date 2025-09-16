<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CidadeResource;
use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    public function index()
    {
        $dados = Cidade::all();
        return CidadeResource::collection($dados);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
        'nome' => 'required|string|max:255',
        'id_cidade' => 'required|integer',
        'id_bairro' => 'required|integer',
    ]);

        Cidade::create($dados);
        return ($dados);
    }

    public function show(string $id)
    {
        $cidade = Cidade::findOrFail($id); // Encontra o recurso ou lança um erro 404

        return ($cidade);
    }

    public function update(Request $request, string $id)
    {
        $cidade = Cidade::findOrFail($id);

        $cidade->update([
            "codIbge"=>$request->codIbge,
	        "nome"=>$request->nome,
	        "uf"=>$request->uf,
        ]);

        $cidade = Cidade::findOrFail($id);

        return ($cidade);
    }

    public function destroy(string $id)
    {
        $cidade = Cidade::findOrFail($id); // Encontra o recurso ou lança um erro 404

        // Exclui o ambiente
        $cidade->delete();

        // Retorna apenas uma mensagem de sucesso
        return response()->json([
            'message' => 'Ambiente deletado com sucesso.',
        ], 200);
    }
}
