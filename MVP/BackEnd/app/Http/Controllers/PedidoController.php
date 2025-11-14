<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PedidoController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $user = Auth::user();
        $perPage = $request->input('per_page', 10);

        // Cargo 1: NÃO pode ver pedidos "Editando"
        if ($user->cargo == 1) {
            $pedidos = Pedido::with(['escola', 'itens.produto'])
                ->where('status', '!=', 'Editando')
                ->paginate($perPage);

        // Usuários normais: apenas pedidos da própria escola
        } else {
            $pedidos = Pedido::with(['escola', 'itens.produto'])
                ->where('id_escola', $user->id_escola)
                ->paginate($perPage);
        }

        $produtos = Produto::all();

        return view('pedidos.index', compact('perPage', 'pedidos', 'produtos'));
    }

    /** ----------------------------------------------
     *  🔒 Função auxiliar para bloquear acessos ilegais
     *  ---------------------------------------------- */
    private function bloquearAcesso($pedido, $user)
    {
        // Cargo 1 NÃO pode ver pedidos com status Editando
        if ($user->cargo == 1 && $pedido->status == 'Editando') {
            return redirect()->route('pedidos.index')
                ->with('error', 'Administradores municipais não têm acesso a pedidos em edição.');
        }

        // Usuário normal só pode acessar pedidos de sua escola
        if (!in_array($user->cargo, [1, 2]) &&
            $pedido->id_escola !== $user->id_escola) {
            return redirect()->route('pedidos.index')
                ->with('error', 'Você não tem permissão para acessar este pedido.');
        }

        return null;
    }

    public function create()
    {
        $produtos = Produto::all();
        return view('pedidos.create', compact('produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produtos' => 'required|array',
            'quantidades' => 'required|array',
        ]);

        $this->authorize('create', Pedido::class);

        $user = auth()->user();

        if (!$user || !$user->id_escola) {
            return redirect()->back()->with('error', 'Usuário sem escola vinculada.');
        }

        $pedido = Pedido::create([
            'status' => 'Editando',
            'id_escola' => $user->id_escola,
        ]);

        foreach ($request->produtos as $index => $produto_id) {
            $quantidade = $request->quantidades[$index] ?? 1;

            $pedido->itens()->create([
                'produto_id' => $produto_id,
                'quantidade' => $quantidade,
            ]);
        }

        return redirect()->route('pedidos.index')->with('success', 'Pedido criado com sucesso!');
    }

    public function show($id)
    {
        $pedido = Pedido::with('itens.produto')->findOrFail($id);

        $this->authorize('view', $pedido);

        return view('pedidos.show', compact('pedido'));
    }

    public function edit($id)
    {
        $pedido = Pedido::with('itens.produto')->findOrFail($id);
        $user = Auth::user();

        if ($res = $this->bloquearAcesso($pedido, $user)) return $res;

        if ($pedido->status !== 'Editando') {
            return redirect()->route('pedidos.index')
                ->with('error', 'Apenas pedidos com status "Editando" podem ser alterados.');
        }

        $produtos = Produto::all();
        return view('pedidos.edit', compact('pedido', 'produtos'));
    }

    public function update(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);
        
        $this->authorize('update', $pedido);

        if ($pedido->status !== 'Editando') {
            return redirect()->route('pedidos.index')->with('error', 'Não é possível editar este pedido.');
        }

        $pedido->itens()->delete();

        foreach ($request->produtos as $index => $produto_id) {
            $pedido->itens()->create([
                'produto_id' => $produto_id,
                'quantidade' => $request->quantidades[$index],
            ]);
        }

        return redirect()->route('pedidos.index')->with('success', 'Pedido atualizado com sucesso!');
    }

    public function enviar($id)
    {
        $pedido = Pedido::findOrFail($id);
        
        $this->authorize('enviar', $pedido);

        $pedido->update(['status' => 'Enviado']);

        return redirect()->route('pedidos.index')->with('success', 'Pedido enviado!');
    }

    public function recebido($id)
    {
        $pedido = Pedido::findOrFail($id);
        
        $this->authorize('recebido', $pedido);

        $pedido->update(['status' => 'Recebido']);

        return redirect()->route('pedidos.index')->with('success', 'Pedido marcado como recebido!');
    }

    public function confirmado($id)
    {
        $pedido = Pedido::findOrFail($id);

        $this->authorize('confirmar', $pedido);

        $pedido->update(['status' => 'Confirmado']);

        return redirect()->route('pedidos.index')->with('success', 'Pedido confirmado com sucesso!');
    }
}

