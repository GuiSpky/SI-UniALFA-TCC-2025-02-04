@extends('layouts.app')

@section('title', 'Lista de Usuários')

@section('content')
    <div class="container-fluid">
        <div class="mb-4 fade-in-up">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <h1 class="h2 fw-bold mb-1"><i class="bi bi-people-fill me-2"></i>Usuários</h1>
                    <p class="text-muted mb-0">Gerencie os usuários cadastrados no sistema</p>
                </div>
                <a href="{{ route('usuarios.create') }}" class="btn btn-primary btn-sm ms-auto shadow-sm">
                    <i class="bi bi-person-plus me-1"></i> Novo Usuário
                </a>
            </div>
        </div>

        <div class="card shadow-sm border-2 shadow-sm rounded-3">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 table-bordered custom-table">
                    <thead>
                        <tr class="text-uppercase small fw-bold">
                            <th class="col-id">Id</th>
                            <th>Nome</th>
                            <th class="col-email">Email</th>
                            <th class="col-telefone">Telefone</th>
                            <th class="col-cargo">Cargo</th>
                            <th>Local de trabalho</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td class="col-id">
                                    <span class="badge bg-primary">
                                        #{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('usuarios.show', $user) }}">
                                        {{ $user->name }}
                                    </a>
                                </td>
                                <td class="col-email">{{ $user->email }}</td>
                                <td class="col-telefone">{{ $user->telefone }}</td>
                                <td class="col-cargo"><x-cargo-label :value="$user->cargo" /></td>
                                <td>{{ $user->escola->nome ?? 'Não vinculado' }}</td>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('usuarios.edit', $user->id) }}"
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST"
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
                                    <p class="text-muted">Nenhum usuário encontrado</p>
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
                @if ($users->hasPages())
                    <div class="card-footer d-flex justify-content-center py-3">
                        {{ $users->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
