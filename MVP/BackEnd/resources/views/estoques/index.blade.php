@extends('layouts.app')
@section('title', 'Lista de Estoque')

@section('content')
    <div class="container-fluid">
        <div class="mb-4 fade-in-up">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <h1 class="h2 fw-bold mb-1"><i class="bi bi-archive me-2"></i>Estoque</h1>
                    <p class="text-muted mb-0">Gerencie o estoque no sistema</p>
                </div>
                @if (Auth::user()->cargo == 1)
                    <a href="{{ route('estoques.create') }}" class="btn btn-primary btn-sm ms-auto shadow-sm">
                        <i class="bi bi-plus-circle me-1"></i> Nova Entrada
                    </a>
                @endif

            </div>
        </div>
        @if (Auth::user()->cargo == 1)
            <div class="estoque-filter-wrapper">
                <form method="GET" class="estoque-filter-container">

                    <label for="escola_id" class="fw-semibold">Filtrar por escola:</label>

                    <select name="escola_id" id="escola_id" class="form-select" onchange="this.form.submit()">
                        @foreach ($escolas as $escola)
                            <option value="{{ $escola->id }}" {{ $escolaSelecionada == $escola->id ? 'selected' : '' }}>
                                {{ $escola->nome }}
                            </option>
                        @endforeach
                    </select>

                </form>
            </div>
        @endif

        <div class="card shadow-sm border-2 shadow-sm rounded-3">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 table-bordered custom-table">
                    <thead>
                        <tr class="text-uppercase small fw-bold">
                            <th class="col-estoque-id">ID</th>
                            <th>Produto</th>
                            <th>Saldo</th>
                            <th class="col-estoque-data">Data Entrada</th>
                            <th class="col-estoque-pedido">Pedido</th>
                            <th class="col-estoque-validade">Validade</th>
                            <th class="col-estoque-deposito">Depósito</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($estoque as $item)
                            <tr>
                                <td class="col-estoque-id">
                                    <span class="badge bg-primary">
                                        #{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('estoques.show', $item) }}">
                                        {{ $produtos->where('id', $item->produto_id)->pluck('nome')->first() ?? 'N/A' }}
                                    </a>
                                </td>

                                <td>
                                    {{ $item->quantidade_saldo }}
                                    {{ $produtos->where('id', $item->produto_id)->pluck('medida')->first() ?? 'N/A' }}
                                </td>

                                <td class="col-estoque-data">{{ \Carbon\Carbon::parse($item->data)->format('d/m/Y') }}</td>

                                <td class="col-estoque-pedido">
                                    @if ($item->pedido_id)
                                        <a href="{{ route('pedidos.show', $item->pedido_id) }}">
                                            {{ $item->pedido_id }}
                                        </a>
                                    @else
                                        N/A
                                    @endif
                                </td>

                                <td class="col-estoque-validade">
                                    {{ \Carbon\Carbon::parse($item->validade)->format('d/m/Y') }}</td>

                                <td class="col-estoque-deposito">
                                    {{ $escolas->where('id', $item->escola_id)->first()->nome ?? 'Sem escola' }}</td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                                    <p class="text-muted">Nenhum estoque encontrado</p>
                                </td>
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
                @if ($estoque->hasPages())
                    <div class="card-footer d-flex justify-content-center py-3">
                        {{ $estoque->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
