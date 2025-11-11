@extends('layouts.app')
@section('title', 'Lista de Estoque')

@section('content')
    <div class="container-fluid">
        <div class="mb-4 fade-in-up">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <h1 class="h2 fw-bold mb-1"><i class="bi bi-map me-2"></i>Estoque</h1>
                    <p class="text-muted mb-0">Gerencie o estoque no sistema</p>
                </div>
                @if (in_array(Auth::user()->cargo, [1, 2]))
                    <a href="{{ route('itemProdutos.create') }}" class="btn btn-primary btn-sm ms-auto shadow-sm">
                        <i class="bi bi-plus-circle me-1"></i> Nova Entrada
                    </a>
                @endif
            </div>
        </div>
        <form method="GET" class="d-flex align-items-center">
            <label for="per_page" class="me-2 mb-0">Itens por página:</label>
            <select name="per_page" id="per_page" class="form-select form-select-sm" onchange="this.form.submit()">
                @foreach ([10, 20, 50, 100] as $size)
                    <option value="{{ $size }}" {{ $perPage == $size ? 'selected' : '' }}>
                        {{ $size }}
                    </option>
                @endforeach
            </select>
        </form>
        <div class="card shadow-sm border-2 shadow-sm rounded-3">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 table-bordered custom-table">
                    <thead>
                        <tr class="text-uppercase small fw-bold">
                            <th>ID</th>
                            <th>Produto</th>
                            <th>Qtd. Entrada</th>
                            <th>Qtd. Saída</th>
                            <th>Qtd. Saldo</th>
                            <th>Data Entrada</th>
                            <th>Nr Pedido</th>
                            <th>Validade</th>
                            <th>Depósito</th>
                            @if (in_array(Auth::user()->cargo, [1, 2]))
                                <th class="text-end">Ações</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($itemProdutos as $itemProduto)
                            <tr>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $itemProduto->id }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('itemProdutos.show', $itemProduto) }}">
                                        {{ $produtos->where('id', $itemProduto->id_produto)->pluck('nome')->first() ?? 'N/A' }}
                                    </a>
                                </td>
                                <td>
                                    {{ $itemProduto->quantidade_entrada }}
                                    {{ $produtos->where('id', $itemProduto->id_produto)->pluck('medida')->first() ?? 'N/A' }}

                                </td>
                                <td>
                                    {{ $itemProduto->quantidade_saida }}
                                    {{ $produtos->where('id', $itemProduto->id_produto)->pluck('medida')->first() ?? 'N/A' }}

                                </td>
                                <td>
                                    {{ $itemProduto->quantidade_entrada - $itemProduto->quantidade_saida }}
                                    {{ $produtos->where('id', $itemProduto->id_produto)->pluck('medida')->first() ?? 'N/A' }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($itemProduto->data)->format('d/m/Y') }}
                                </td>
                                <td>------</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($itemProduto->validade)->format('d/m/Y') }}
                                </td>
                                <td>
                                    {{ $escolas->where('id', $itemProduto->id_escola)->pluck('nome')->first() ?? 'N/A' }}
                                </td>
                                @if (in_array(Auth::user()->cargo, [1, 2]))
                                    <td class="text-end">
                                        <a href="{{ route('itemProdutos.edit', $itemProduto->id) }}"
                                            class="btn btn-outline-primary btn-sm" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('itemProdutos.destroy', $itemProduto) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm" type="submit"
                                                onclick="return confirm('Deseja realmente apagar este itemProduto?')"
                                                title="Apagar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                                    <p class="text-muted">Nenhum estoque encontrado</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($itemProdutos->hasPages())
            <div class="card-footer d-flex justify-content-center py-3">
                {{ $itemProdutos->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
@endsection
