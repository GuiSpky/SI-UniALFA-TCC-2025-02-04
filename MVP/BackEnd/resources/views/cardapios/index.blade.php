@extends('layouts.app')
@section('title', 'Lista de Cardápios')

@section('content')
    <div class="container-fluid">
        <div class="mb-4 fade-in-up">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <h1 class="h2 fw-bold mb-1"><i class="bi bi-journal-check me-2"></i>Cardápios</h1>
                    <p class="text-muted mb-0">Gerencie os cardápios cadastrados no sistema</p>
                </div>
                @if (in_array(Auth::user()->cargo, [1, 4]))
                    <a href="{{ route('cardapios.create') }}" class="btn btn-primary btn-sm ms-auto shadow-sm">
                        <i class="bi bi-plus-circle me-1"></i> Novo Cardápio
                    </a>
                @endif
            </div>
        </div>

        <div class="card shadow-sm border-2">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead>
                        <tr class="table-light text-uppercase small fw-bold">
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Item</th>
                            <th>Data</th>
                            @if (in_array(Auth::user()->cargo, [1, 4]))
                                <th class="text-end">Ações</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cardapios as $cardapio)
                            <tr>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $cardapio->id }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('cardapio.show', $cardapio) }}">
                                        {{ $cardapio->nome }}
                                    </a>
                                </td>
                                <td>{{ $cardapio->item }}</td>
                                <td>
                                    <i
                                        class="bi bi-calendar me-2"></i>{{ \Carbon\Carbon::parse($cardapio->data)->format('d/m/Y') }}
                                </td>
                                @if (in_array(Auth::user()->cargo, [1, 4]))
                                    <td class="text-end">
                                        <a href="{{ route('cardapios.edit', $cardapio->id) }}"
                                            class="btn btn-outline-primary btn-sm" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('cardapios.destroy', $cardapio) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm" type="submit"
                                                onclick="return confirm('Deseja realmente apagar este cardapio?')"
                                                title="Apagar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                @endif
                                </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                                    <p class="text-muted">Nenhum cardápio encontrado</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
