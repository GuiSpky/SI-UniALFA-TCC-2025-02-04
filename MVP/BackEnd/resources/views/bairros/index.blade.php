@extends('layouts.app')
@section('title', 'Lista de Bairros')

@section('content')
    <div class="container-fluid">
        <div class="mb-4 fade-in-up">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <h1 class="h2 fw-bold mb-1"><i class="bi bi-geo-alt-fill me-2"></i>Bairros</h1>
                    <p class="text-muted mb-0">Gerencie os bairros cadastrados no sistema</p>
                </div>
                <a href="{{ route('bairros.create') }}" class="btn btn-primary btn-sm ms-auto shadow-sm">
                    <i class="bi bi-plus-circle me-1"></i> Novo Bairro
                </a>
            </div>
        </div>
        <div class="card shadow-sm border-2 rounded-3">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 table-bordered custom-table">
                    <thead>
                        <tr class="text-uppercase small fw-bold">
                            <th class="col-bairro-id">ID</th>
                            <th>Nome</th>
                            <th>Cidade</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bairros as $bairro)
                            <tr>
                                <td class="col-bairro-id">
                                    <span class="badge bg-primary">
                                        #{{ str_pad($bairro->id, 5, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('bairros.show', $bairro) }}">
                                        {{ $bairro->nome }}
                                    </a>
                                </td>
                                <td>
                                    {{ $cidades->where('id', $bairro->cidade_id)->pluck('nome')->first() ?? 'N/A' }}
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('bairros.edit', $bairro->id) }}"
                                        class="btn btn-outline-primary btn-sm" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('bairros.destroy', $bairro) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm" type="submit"
                                            onclick="return confirm('Deseja realmente apagar este bairro?')" title="Apagar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                                    <p class="text-muted">Nenhum bairro encontrado</p>
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
                @if ($bairros->hasPages())
                    <div class="card-footer d-flex justify-content-center py-3">
                        {{ $bairros->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
