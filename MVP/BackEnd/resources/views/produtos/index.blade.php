@extends('layouts.app')

@section('title', 'Lista de Produtos')

@section('content')
    <div class="container-fluid">
        <div class="mb-4 fade-in-up">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <h1 class="h2 fw-bold mb-1"><i class="bi bi-person-workspace me-2"></i>Produtos</h1>
                    <p class="text-muted mb-0">Gerencie as produtos cadastrados</p>
                </div>
                @if (in_array(Auth::user()->cargo, [1, 4]))
                    <a href="{{ route('produtos.create') }}" class="btn btn-primary btn-sm ms-auto shadow-sm">
                        <i class="bi bi-plus-circle me-1"></i> Novo Produto</a>
                @endif
            </div>
        </div>
        <div class="card shadow-sm border-2 shadow-sm rounded-3">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 table-bordered custom-table">
                    <thead>
                        <tr class="text-uppercase small fw-bold">
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Grupo</th>
                            <th>Medida</th>
                            @if (in_array(Auth::user()->cargo, [1, 4]))
                                <th class="text-end">Ações</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produtos as $produto)
                            <tr>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $produto->id }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('produto.show', $produto) }}">
                                        {{ $produto->nome }}
                                    </a>
                                </td>
                                <td>
                                    <x-grupo-label :value="$produto->grupo" />
                                </td>
                                <td>
                                    {{ $produto->medida }}
                                </td>
                                @if (in_array(Auth::user()->cargo, [1, 4]))
                                    <td class="text-end">
                                        <a href="{{ route('produtos.edit', $produto->id) }}"
                                            class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Tem certeza?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                                    <p class="text-muted">Nenhuma produto encontrada</p>
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
                @if ($produtos->hasPages())
                    <div class="card-footer d-flex justify-content-center py-3">
                        {{ $produtos->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
