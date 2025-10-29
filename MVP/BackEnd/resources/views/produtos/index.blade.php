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
                <a href="{{ route('produtos.create') }}" class="btn btn-primary btn-sm ms-auto shadow-sm">Novo Produto</a>
            </div>
        </div>

        <div class="card shadow-sm border-2">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead>
                        <tr class="table-light text-uppercase small fw-bold">
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Grupo</th>
                            <th class="text-end">Ações</th>
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
                                <td>{{ $produto->grupo }}</td>
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
    </div>
@endsection
