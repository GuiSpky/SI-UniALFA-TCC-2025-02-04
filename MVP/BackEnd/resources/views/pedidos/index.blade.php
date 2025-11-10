@extends('layouts.app')
@section('title', 'Lista de Pedidos')

@section('content')
    <div class="container-fluid">
        <div class="mb-4 fade-in-up">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <h1 class="h2 fw-bold mb-1"><i class="bi bi-journal-check me-2"></i>Pedidos</h1>
                    <p class="text-muted mb-0">Gerencie os pedidos cadastrados no sistema</p>
                </div>
                @if (in_array(Auth::user()->cargo, [1, 4]))
                    <a href="{{ route('pedidos.create') }}" class="btn btn-primary btn-sm ms-auto shadow-sm">
                        <i class="bi bi-plus-circle me-1"></i> Novo Pedido
                    </a>
                @endif
            </div>
        </div>

        <div class="card border-2 shadow-sm rounded-3">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 table-bordered">
                    <thead>
                        <tr class="text-uppercase small fw-bold">
                            <th>Número do Pedido</th>
                            <th>Escola</th>
                            <th>Data do Pedido</th>
                            <th>Status</th>
                            <th>Produtos</th>
                            <th class="align-ite-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pedidos as $pedido)
                            <tr>
                                <td>
                                    <a class="badge bg-primary" href="{{ route('pedidos.show', $pedido) }}">
                                        {{ $pedido->id }}
                                    </a>
                                </td>
                                <td>{{ $pedido->escola->nome ?? '—' }}</td>
                                <td>{{ $pedido->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <span
                                        class="badge 
                        @if ($pedido->status == 'Editando') bg-warning
                        @elseif($pedido->status == 'Enviado') bg-info
                        @elseif($pedido->status == 'Recebido') bg-secondary
                        @elseif($pedido->status == 'Confirmado') bg-success @endif">
                                        {{ $pedido->status }}
                                    </span>
                                </td>
                                <td>
                                    @foreach ($pedido->itens as $item)
                                        {{ $item->produto->nome }} ({{ $item->quantidade }})<br>
                                    @endforeach
                                </td>
                                <td class="text-end">
                                    @if ($pedido->status == 'Editando')
                                        <a href="{{ route('pedidos.edit', $pedido) }}"
                                            class="btn btn-sm btn-warning">Editar</a>
                                        <form action="{{ route('pedidos.enviar', $pedido) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-sm btn-primary">Enviar</button>
                                        </form>
                                    @elseif ($pedido->status == 'Enviado')
                                        <form action="{{ route('pedidos.confirmado', $pedido) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-sm btn-success">Confirmar</button>
                                        </form>
                                    @elseif ($pedido->status == 'Confirmado')
                                        <form action="{{ route('pedidos.recebido', $pedido) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-sm btn-secondary">Recebido</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Nenhum pedido encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
