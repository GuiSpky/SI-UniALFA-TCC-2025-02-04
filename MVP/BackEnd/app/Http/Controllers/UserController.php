<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Escola;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    private $cargos = [
        1 => 'Gerente',
        2 => 'Cozinheiro Chefe',
        3 => 'Cozinheiro',
        4 => 'Nutricionista',
    ];

    public function index(Request $request)
    {
        // Usa o Model User
        $perPage = $request->input('per_page', 10);
        $users = Usuario::paginate($perPage);
        $escolas = Escola::all();

        // Renomeia a variável para o plural correto ('users')
        return view('usuarios.index', compact('perPage','users', 'escolas'));

    }

    public function create()
    {
        $escolas = Escola::all();

        return view('usuarios.create', compact('escolas'), [
            'cargos' => $this->cargos
        ]);
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        $escolas = Escola::all();

        return view('usuarios.edit', compact('user', 'escolas'), [
            'cargos' => $this->cargos
        ]);
    }


    public function store(Request $request)
    {
        // Validação (sem alterações)
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users,email',
            'telefone' => 'required|string|max:20|unique:users,telefone',
            'password' => 'required|string|min:8',
            'cargo' => 'required|integer|in:1,2,3,4',
            'id_escola' => 'required|integer|exists:escolas,id',
        ], [
            'email.unique' => 'Este e-mail já está cadastrado.',
            'telefone.unique' => 'Este telefone já está cadastrado.',
            'id_escola.exists' => 'A escola selecionada não existe.',
            'cargo.in' => 'Cargo inválido.',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        try {
            Usuario::create($validated);
            return redirect('/usuarios')->with('sucesso', 'Usuário cadastrado com sucesso!');
        } catch (\Exception $e) {
            // Chamada ao Log corrigida (sem a barra invertida)
            Log::error('Falha ao cadastrar usuário: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('erro', 'Falha ao cadastrar o usuário. Tente novamente.');
        }
    }

    // ... (os métodos show e edit não precisam de mudança)

    public function show(string $id)
    {
        $user = Usuario::findOrFail($id);
        $escolas = Escola::all();

        return view('usuarios.show', compact('user', 'escolas'));
    }

    public function update(Request $request, string $id)
    {
        $user = Usuario::findOrFail($id);

        // Validação (sem alterações)
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => ['required', 'string', 'email', 'max:100', Rule::unique('users')->ignore($user->id)],
            'telefone' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
            'cargo' => 'required|integer|in:1,2,3,4',
            'id_escola' => 'required|integer|exists:escolas,id',
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8']);
            $validated['password'] = Hash::make($request->password);
        }

        try {
            $user->update($validated);
            return redirect('/usuarios')->with('sucesso', 'Usuário atualizado com sucesso!');
        } catch (\Exception $e) {
            // Chamada ao Log corrigida (sem a barra invertida)
            Log::error('Falha ao atualizar usuário: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('erro', 'Falha ao atualizar usuário. Tente novamente.');
        }
    }

    public function destroy(string $id)
    {
        try {
            // Usa o Model User
            $user = Usuario::findOrFail($id);
            $user->delete();
            return redirect('/usuarios')->with('sucesso', 'Usuário excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect('/usuarios')->with('erro', 'Erro ao excluir o usuário.');
        }
    }
}
