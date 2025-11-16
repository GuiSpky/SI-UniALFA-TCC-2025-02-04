<?php

namespace App\Http\Controllers;

use App\Models\Consumo;
use App\Models\Estoque;
use App\Models\ItemConsumo;
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
                ->where('escola_id', $user->escola_id)
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
        if (
            !in_array($user->cargo, [1, 2]) &&
            $pedido->escola_id !== $user->escola_id
        ) {
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

        if (!$user || !$user->escola_id) {
            return redirect()->back()->with('error', 'Usuário sem escola vinculada.');
        }

        $pedido = Pedido::create([
            'status' => 'Editando',
            'escola_id' => $user->escola_id,
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
        $pedido = Pedido::with('itens.produto')->findOrFail($id);

        $this->authorize('recebido', $pedido);

        // Usuário deve ser cargo 2
        if (auth()->user()->cargo != 2) {
            return redirect()->back()->with('error', 'Ação permitida somente para diretoria.');
        }

        foreach ($pedido->itens as $item) {

            Estoque::create([
                'produto_id' => $item->produto_id,
                'quantidade_entrada' => $item->quantidade,
                'quantidade_saldo' => $item->quantidade,
                'quantidade_saida' => 0,
                'validade' => now()->addMonths(6), // ajustar se houver campo de validade no pedido
                'escola_id' => $pedido->escola_id,
                'pedido_id' => $pedido->id,
            ]);
        }

        $pedido->update(['status' => 'Recebido']);

        return redirect()->route('pedidos.index')->with('success', 'Pedido recebido e estoque atualizado!');
    }


    public function confirmado($id)
{
    $pedido = Pedido::with('itens.produto')->findOrFail($id);

    $this->authorize('confirmar', $pedido);

    if (auth()->user()->cargo != 1) {
        return redirect()->back()->with('error', 'Ação permitida somente para administradores municipais.');
    }

    // =============================
    // 📌 CRIA O REGISTRO DE CONSUMO
    // =============================
    $consumo = Consumo::create([
        'escola_id' => $pedido->escola_id,
    ]);

    // ========================================
    // 📌 LOOP PARA BAIXAR ESTOQUE (FIFO)
    // ========================================
    foreach ($pedido->itens as $item) {

        $quantidadeNecessaria = $item->quantidade;

        // Estoques FIFO por validade crescente
        $estoques = Estoque::where('produto_id', $item->produto_id)
            ->where('quantidade_saldo', '>', 0)
            ->orderBy('validade')
            ->get();

        foreach ($estoques as $estoque) {

            if ($quantidadeNecessaria <= 0) break;

            $disponivel = $estoque->quantidade_saldo;

            // Quantidade que realmente será consumida deste estoque
            $qtdConsumida = min($disponivel, $quantidadeNecessaria);

            // ================================
            // 📌 1. Atualiza o estoque (baixa)
            // ================================
            $estoque->quantidade_saldo -= $qtdConsumida;
            $estoque->quantidade_saida += $qtdConsumida;
            $estoque->save();

            // =======================================
            // 📌 2. Registra item do consumo
            // =======================================
            ItemConsumo::create([
                'consumo_id' => $consumo->id,    // 🔥 agora está correto
                'estoque_id' => $estoque->id,
                'quantidade' => $qtdConsumida,
            ]);

            // diminui o necessário
            $quantidadeNecessaria -= $qtdConsumida;
        }

        // =======================================
        // 📌 Valida estoque insuficiente
        // =======================================
        if ($quantidadeNecessaria > 0) {
            return redirect()->back()
                ->with('error', "Estoque insuficiente para o produto {$item->produto->nome}.");
        }
    }

    // =======================================
    // 📌 Atualiza o status final do pedido
    // =======================================
    $pedido->update(['status' => 'Confirmado']);

    return redirect()->route('pedidos.index')
        ->with('success', 'Pedido confirmado, consumo registrado e estoque baixado com sucesso!');
}

}
