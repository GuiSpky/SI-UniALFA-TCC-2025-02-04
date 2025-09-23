<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EscolaResource;
use App\Models\Bairro;
use App\Models\Cidade;
use App\Models\Escola;
use Illuminate\Http\Request;

class EscolaController extends Controller
{
    public function index()
    {
        $dados = Escola::all();
        return EscolaResource::collection($dados);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
        'nome' => 'required|string|max:255',
        'id_cidade' => 'required|integer',
        'id_bairro' => 'required|integer',
    ]);

        Escola::create($dados);
        return ($dados);
    }

    public function show(string $id)
    {
        $escola = Escola::findOrFail($id);

        return ($escola);
    }

    public function update(Request $request, string $id)
    {
        $escola = Escola::findOrFail($id);

        $escola->update([
            "nome"=>$request->nome,
	        "id_cidade"=>$request->id_cidade,
	        "id_bairro"=>$request->id_bairro,
        ]);

        $escola = Escola::findOrFail($id);

        return ($escola);
    }

    public function destroy(string $id)
    {
        $escola = Escola::findOrFail($id); // Encontra o recurso ou lança um erro 404

        // Exclui o ambiente
        $escola->delete();

        // Retorna apenas uma mensagem de sucesso
        return response()->json([
            'message' => 'Escola deletado com sucesso.',
        ], 200);
    }


}
