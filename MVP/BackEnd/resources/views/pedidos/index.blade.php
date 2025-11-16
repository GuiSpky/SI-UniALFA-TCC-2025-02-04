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
                @if (in_array(Auth::user()->cargo, [2]))
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
                        @if ($pedido->status == 'Editando') bg-primary
                        @elseif($pedido->status == 'Enviado') bg-info text-dark
                        @elseif($pedido->status == 'Confirmado') bg-success
                        @elseif($pedido->status == 'Recebido') bg-dark @endif">
                                        {{ $pedido->status }}
                                    </span>
                                </td>
                                <td>
                                    @foreach ($pedido->itens as $item)
                                        {{ $item->produto->nome }} ({{ $item->quantidade }}
                                        {{ $produtos->where('id', $item->produto->id)->pluck('medida')->first() ?? 'N/A' }})<br>
                                    @endforeach
                                </td>
                                <td class="text-end">
                                    @if ($pedido->status == 'Editando')
                                        @can('update', $pedido)
                                            <a href="{{ route('pedidos.edit', $pedido) }}"
                                                class="btn btn-outline-primary btn-sm" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        @endcan
                                        @can('enviar', $pedido)
                                            <form method="POST" action="{{ route('pedidos.enviar', $pedido) }}"
                                                class="d-inline">
                                                @csrf @method('PUT')
                                                <button class="btn btn-outline-info btn-sm" title="Enviar">
                                                    <i class="bi bi-send"></i>
                                                    </a>
                                            </form>
                                        @endcan
                                    @elseif ($pedido->status == 'Enviado')
                                        @can('confirmar', $pedido)
                                            <form method="POST" action="{{ route('pedidos.confirmado', $pedido) }}"
                                                class="d-inline">
                                                @csrf @method('PUT')
                                                <button class="btn btn-outline-success btn-sm" title="Confirmar">
                                                    <i class="bi bi-check-lg"></i>
                                                    </a>
                                            </form>
                                        @endcan
                                    @elseif ($pedido->status == 'Confirmado')
                                        @can('recebido', $pedido)
                                            <form method="POST" action="{{ route('pedidos.recebido', $pedido) }}"
                                                class="d-inline">
                                                @csrf @method('PUT')
                                                <button class="btn btn-outline-dark btn-sm" title="Recebido">
                                                    <i class="bi bi-arrow-down"></i>
                                                    </a>
                                            </form>
                                        @endcan
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
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
            <!-- Itens por página (à esquerda) -->
            <form method="GET" class="d-flex align-items-center mb-2 mb-md-0">
                <label for="per_page" class="me-2 mb-0 fw-semibold">Itens por página:</label>
                <select name="per_page" id="per_page" class="form-select form-select-sm w-auto"
                    onchange="this.form.submit()">
                    @foreach ([10, 20, 50, 100] as $size)
                        <option value="{{ $size }}" {{ $perPage == $size ? 'selected' : '' }}>
                            {{ $size }}
                        </option>
                    @endforeach
                </select>
            </form>

            <!-- Pesquisa (centralizada) -->
            <div class="flex-grow-1 text-center">
                <!-- Paginação -->
                @if ($pedidos->hasPages())
                    <div class="card-footer d-flex justify-content-center py-3">
                        {{ $pedidos->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
