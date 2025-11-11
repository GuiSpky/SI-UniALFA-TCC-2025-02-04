<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $escolas = Escola::all();
        $pedidos = Pedido::with('itens.produto')->get();
        $produtos = Produto::all();
        return view('pedidos.index', compact('pedidos', 'escolas', 'produtos'));
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

        $user = auth()->user();

        if (!$user || !$user->id_escola) {
            return redirect()->back()->with('error', 'Usuário sem escola vinculada.');
        }

        // Cria o pedido com status inicial e escola do usuário logado
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
        return view('pedidos.show', compact('pedido'));
    }

    public function edit($id)
    {
        $pedido = Pedido::with('itens.produto')->findOrFail($id);

        if ($pedido->status !== 'Editando') {
            return redirect()->route('pedidos.index')->with('error', 'Apenas pedidos com status "Editando" podem ser alterados.');
        }

        $produtos = Produto::all();
        return view('pedidos.edit', compact('pedido', 'produtos'));
    }

    public function update(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);

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
        $pedido->update(['status' => 'Enviado']);
        return redirect()->route('pedidos.index')->with('success', 'Pedido enviado com sucesso!');
    }

    public function recebido($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->update(['status' => 'Recebido']);
        return redirect()->route('pedidos.index')->with('success', 'Pedido marcado como recebido!');
    }

    public function confirmado($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->update(['status' => 'Confirmado']);
        return redirect()->route('pedidos.index')->with('success', 'Pedido confirmado com sucesso!');
    }
}
