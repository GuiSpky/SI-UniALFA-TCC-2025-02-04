<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{

    private $cargos = [
        1 => 'Gerente',
        2 => 'Cozinheiro Chefe',
        3 => 'Cozinheiro',
        4 => 'Nutricionista',
    ];

    public function index()
    {
        $usuarios = Usuario::all();
        $escolas = Escola::all();

        return view('usuarios.index', compact('usuarios', 'escolas'));
    }

    public function create()
    {
        $escolas = Escola::all();

        return view('usuarios.create', compact('escolas'), [
            'cargos' => $this->cargos
        ]);
    }

    public function store(Request $request)
    {
        // Validação de entrada
        $validated = $request->validate([
            'nome' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:usuarios,email',
            'telefone' => 'required|string|max:13|unique:usuarios,telefone',
            'senha' => 'required|string|min:8',
            'cargo' => 'required|integer|in:1,2,3,4',
            'id_escola' => 'required|integer|exists:escolas,id',
        ], [
            'email.unique' => 'Este e-mail já está cadastrado.',
            'telefone.unique' => 'Este telefone já está cadastrado.',
            'id_escola.exists' => 'A escola selecionada não existe.',
            'cargo.in' => 'Cargo inválido.',
        ]);

        // Tratamento seguro dos dados
        $validated['senha'] = Hash::make($validated['senha']);

        try {
            Usuario::create($validated);
            return redirect('/usuarios')->with('sucesso', 'Usuário cadastrado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('erro', 'Falha ao cadastrar o usuário. Tente novamente.');
        }
    }

    public function show(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        $escolas = Escola::all();

        return view('usuarios.show', compact('usuario', 'escolas'));
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', [
            'usuario' => $usuario,
            'escolas' => Escola::all(),
            'cargos' => $this->cargos,
        ]);
    }


    public function update(Request $request, string $id)
    {
        $usuario = Usuario::findOrFail($id);

        // Validação no update
        $validated = $request->validate([
            'nome' => 'required|string|max:100',
            'email' => [
                'required',
                'string',
                'email',
                'max:100',
                Rule::unique('usuarios')->ignore($usuario->id),
            ],
            'telefone' => [
                'required',
                'string',
                'max:13',
                Rule::unique('usuarios')->ignore($usuario->id),
            ],
            'cargo' => 'required|integer|in:1,2,3,4',
            'id_escola' => 'required|integer|exists:escolas,id',
        ]);

        $validated['cargo'] = (int) $validated['cargo'];
        $validated['id_escola'] = (int) $validated['id_escola'];

        try {
            $usuario->update($validated);
            return redirect('/usuarios')->with('sucesso', 'Usuário atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('erro', 'Falha ao atualizar usuário. Tente novamente.');
        }
    }

    public function destroy(string $id)
    {
        try {
            $usuario = Usuario::findOrFail($id);
            $usuario->delete();
            return redirect('/usuarios')->with('sucesso', 'Usuário excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect('/usuarios')->with('erro', 'Erro ao excluir o usuário.');
        }
    }
}
