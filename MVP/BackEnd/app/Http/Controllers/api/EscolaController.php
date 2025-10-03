<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EscolaResource;
use App\Models\Bairro;
use App\Models\Cidade;
use App\Models\Escola;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EscolaController extends Controller
{
    public function index()
    {
        $escolas = DB::table('escolas')
            ->join('bairros', 'escolas.id_bairro', '=', 'bairros.id')
            ->join('cidades', 'escolas.id_cidade', '=', 'cidades.id')
            ->select(
                'escolas.id',
                'escolas.nome as nome',
                'bairros.nome as bairro',
                'cidades.nome as cidade'
            )
            ->get();

        return response()->json([
            'data' => $escolas
        ]);
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
            "nome" => $request->nome,
            "id_cidade" => $request->id_cidade,
            "id_bairro" => $request->id_bairro,
        ]);

        $escola = Escola::findOrFail($id);

        return ($escola);
    }

    public function destroy(string $id)
    {
        $escola = Escola::findOrFail($id);

        $escola->delete();

        // Retorna apenas uma mensagem de sucesso
        return response()->json([
            'message' => 'Escola deletado com sucesso.',
        ], 200);
    }

    public function getEscolaBairro()
    {
        $escolas = DB::table('escolas')
            ->join('bairros', 'escolas.id_bairro', '=', 'bairros.id')
            ->join('cidades', 'escolas.id_cidade', '=', 'cidades.id')
            ->select(
                'escolas.id',
                'escolas.nome as nome',
                'bairros.nome as bairro',
                'cidades.nome as cidade'
            )
            ->get();

        return response()->json([
            'data' => $escolas
        ]);
    }
}
