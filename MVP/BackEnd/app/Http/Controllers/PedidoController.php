<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with('itens.produto')->get();

        return view('pedidos.index', compact('pedidos'));
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

        // Cria o pedido (data = created_at automaticamente)
        $pedido = Pedido::create();

        // Associa os produtos
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
}
