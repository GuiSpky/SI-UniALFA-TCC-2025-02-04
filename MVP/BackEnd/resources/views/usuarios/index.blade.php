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
                <table class="table table-hover table-striped mb-0">
                    <thead>
                        <tr class="text-uppercase small fw-bold">
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Cargo</th>
                            <th>Local de trabalho</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $user->id }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('usuario.show', $user) }}">
                                        {{ $user->name }}
                                    </a>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->telefone }}</td>
                                <td><x-cargo-label :value="$user->cargo" /></td>
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
    </div>
@endsection
