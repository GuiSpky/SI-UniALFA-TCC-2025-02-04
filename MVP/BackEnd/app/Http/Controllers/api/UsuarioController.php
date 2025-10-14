<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsuarioResources;
use App\Models\Cidade;
use App\Models\Escola;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuario = Usuario::all();
        $escola = Escola::all();

        return view('usuarios.index',[
            'usuarios' => $usuario,
            'escola' => $escola
        ]);
    }

    public function create()
    {
        $usuario = Usuario::all();
        $escolas = Escola::all();

        return view('usuarios.create', [
            'usuario' => $usuario,
            'escolas' => $escolas
        ]);
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
        return redirect('/usuarios');
    }

        public function edit(string $id)
    {
        $usuario = Usuario::find($id);
        $escolas = Escola::all();

        return view('usuarios.edit',[
            'usuario' => $usuario,
            'escolas' => $escolas
        ]);
    }

    public function show(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        $escola = Escola::all();
        return view('usuarios.show', [
            'usuario' => $usuario,
            'escolas' => $escola
        ]);
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

        return redirect('/usuarios');

    }

    public function destroy(string $id)
    {
        $usuario = Usuario::findOrFail($id); // Encontra o recurso ou lança um erro 404

        // Exclui o ambiente
        $usuario->delete();

        // Retorna apenas uma mensagem de sucesso
        return redirect('/usuarios');
    }
}
