<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CidadeResouce;
use App\Http\Controllers\Controller;
use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    // Listar todas as cidades
    public function index()
    {
        $cidades = Cidade::all();
        return CidadeResouce::collection($cidades);
    }

    // Criar uma nova cidade
    public function store(Request $request)
    {

        $cidade = Cidade::create($request->all());

        return response()->json([
            'message' => 'Cidade criada com sucesso',
            'cidade' => $cidade
        ], 201);
    }

    // Mostrar cidade específica
    public function show($id)
    {
        $cidade = Cidade::find($id);

        if (!$cidade) {
            return response()->json(['error' => 'Cidade não encontrada'], 404);
        }

        return response()->json($cidade, 200);
    }

    // Atualizar cidade
    public function update(Request $request, $id)
    {
        $cidade = Cidade::find($id);

        if (!$cidade) {
            return response()->json(['error' => 'Cidade não encontrada'], 404);
        }

        $request->validate([
            'codIbge' => "required|integer|unique:cidades,codIbge,$id",
            'nome' => 'required|string|max:150',
            'uf' => 'required|string|size:2',
        ]);

        $cidade->update($request->all());

        return response()->json([
            'message' => 'Cidade atualizada com sucesso',
            'cidade' => $cidade
        ], 200);
    }

    // Deletar cidade
    public function destroy($id)
    {
        $cidade = Cidade::find($id);

        if (!$cidade) {
            return response()->json(['error' => 'Cidade não encontrada'], 404);
        }

        $cidade->delete();

        return response()->json([
            'message' => 'Cidade deletada com sucesso'
        ], 200);
    }
}
