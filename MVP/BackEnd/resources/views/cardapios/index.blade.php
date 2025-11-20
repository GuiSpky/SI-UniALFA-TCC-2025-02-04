@extends('layouts.app')
@section('title', 'Lista de Cardápios')

@section('content')
    <div class="container-fluid">
        <div class="mb-4 fade-in-up">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <h1 class="h2 fw-bold mb-1"><i class="bi bi-list-ul me-2"></i>Cardápios</h1>
                    <p class="text-muted mb-0">Gerencie os cardápios cadastrados no sistema</p>
                </div>
                @if (in_array(Auth::user()->cargo, [1, 4]))
                    <a href="{{ route('cardapios.create') }}" class="btn btn-primary btn-sm ms-auto shadow-sm">
                        <i class="bi bi-plus-circle me-1"></i> Novo Cardápio
                    </a>
                @endif
            </div>
        </div>
        <div class="card border-2 shadow-sm rounded-3">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 table-bordered custom-table">
                    <thead>
                        <tr class="text-uppercase small fw-bold">
                            <th class="col-cardapio-id">ID</th>
                            <th>Receita</th>
                            <th>Itens</th>
                            <th>Data</th>
                            @if (in_array(Auth::user()->cargo, [1, 4]))
                                <th class="col-cardapio-acoes text-end">Ações</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cardapios as $cardapio)
                            <tr>
                                <td class="col-cardapio-id">
                                    <span class="badge bg-primary">
                                        #{{ str_pad($cardapio->id, 5, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('cardapios.show', $cardapio) }}">
                                        {{ $cardapio->receita }}
                                    </a>
                                </td>
                                <td>
                                    @foreach ($cardapio->itens as $item)
                                        {{ $item->produto->nome ?? 'N/A' }}<br>
                                    @endforeach
                                </td>
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
                                                onclick="return confirm('Deseja realmente apagar esta escola?')"
                                                title="Apagar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                @endif

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
                @if ($cardapios->hasPages())
                    <div class="card-footer d-flex justify-content-center py-3">
                        {{ $cardapios->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
