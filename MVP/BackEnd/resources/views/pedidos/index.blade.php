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
                            <th>Data do Pedido</th>
                            <th>Produtos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedidos as $pedido)
                            <tr>
                                <td>
                                    <a class="badge bg-primary" href="{{ route('pedidos.show', $pedido) }}">
                                        {{ $pedido->id }}
                                    </a>
                                </td>
                                <td>{{ $pedido->created_at->format('d/m/Y') }}</td>
                                <td>
                                    @foreach ($pedido->itens as $item)
                                        {{ $item->produto->nome }} ({{ $item->quantidade }})<br>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
