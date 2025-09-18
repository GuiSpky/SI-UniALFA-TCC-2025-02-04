<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsuarioResources;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $dados = Usuario::all();
        return UsuarioResources::collection($dados);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
        'nome' => 'required|string|max:100',
        'email' => 'required|string|max:100',
        'telefone' => 'required|string|max:13',
        'cargo' => 'required|string|max:100',
        'id_escola' => 'required|integer',
    ]);

        Usuario::create($dados);
        return ($dados);
    }

    public function show(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        return ($usuario);
    }

    public function update(Request $request, string $id)
    {
        $dados = Usuario::findOrFail($id);

        $dados->update([
            "nome"=>$request->nome,
	        "email"=>$request->email,
	        "telefone"=>$request->telefone,
	        "cargo"=>$request->cargo,
	        "id_escola"=>$request->id_escola,
        ]);

        $dados = Usuario::findOrFail($id);

        return ($dados);
    }

    public function destroy(string $id)
    {
        $usuario = Usuario::findOrFail($id); // Encontra o recurso ou lança um erro 404

        // Exclui o ambiente
        $usuario->delete();

        // Retorna apenas uma mensagem de sucesso
        return response()->json([
            'message' => 'Usuário deletado com sucesso.',
        ], 200);
    }
}
