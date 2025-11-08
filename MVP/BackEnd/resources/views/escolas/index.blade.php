@extends('layouts.app')
@section('title', 'Lista de Escolas')

@section('content')
    <div class="container-fluid">
        <div class="mb-4 fade-in-up">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <h1 class="h2 fw-bold mb-1"><i class="bi bi-building me-2"></i>Escolas</h1>
                    <p class="text-muted mb-0">Gerencie as escolas cadastradas no sistema</p>
                </div>
                @if (in_array(Auth::user()->cargo, [1]))
                    <a href="{{ route('escolas.create') }}" class="btn btn-primary btn-sm ms-auto shadow-sm">
                        <i class="bi bi-plus-circle me-1"></i> Nova Escola
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
        <div class="card border-2 shadow-sm rounded-3">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 table-bordered custom-table">
                    <thead>
                        <tr class="text-uppercase small fw-bold">
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Bairro</th>
                            <th>Cidade</th>
                            @if (in_array(Auth::user()->cargo, [1]))
                                <th class="text-end">Ações</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($escolas as $escola)
                            <tr>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $escola->id }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('escola.show', $escola) }}">
                                        {{ $escola->nome }}
                                    </a>
                                </td>
                                <td>
                                    {{ $bairros->where('id', $escola->id_bairro)->pluck('nome')->first() ?? 'N/A' }}
                                </td>
                                <td>
                                    {{ $cidades->where('id', $escola->id_cidade)->pluck('nome')->first() ?? 'N/A' }}
                                </td>
                                @if (in_array(Auth::user()->cargo, [1]))
                                    <td class="text-end">
                                        <a href="{{ route('escolas.edit', $escola->id) }}"
                                            class="btn btn-outline-primary btn-sm" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('escolas.destroy', $escola) }}" method="POST"
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
                                    <p class="text-muted">Nenhuma escola encontrada</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($escolas->hasPages())
            <div class="card-footer d-flex justify-content-center py-3">
                {{ $escolas->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
@endsection
