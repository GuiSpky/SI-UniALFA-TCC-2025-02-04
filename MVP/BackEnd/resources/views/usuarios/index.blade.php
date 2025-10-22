@extends('layouts.app')

@section('title', 'Lista de Usuários')

@section('content')
<?php
    $cargos = [
        1 => 'Gerente',
        2 => 'Cozinheiro Cheff',
        3 => 'Cozinheiro',
        4 => 'Nutricionista'
    ];
?>
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

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr class="table-light">
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Cargo</th>
                        <th>Telefone</th>
                        <th>Permissão</th>
                        <th>Último Acesso</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($usuarios as $usuario)
                        <tr>
                            <td>{{ ucfirst($usuario->nome) }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $cargos[$usuario->cargo] ?? 'Não informado' }}</td>
                            <td>{{ $usuario->telefone}}</td>
                            <td>
                                <span class="badge {{ $usuario->permissao == 'Administrador' ? 'bg-danger' : 'bg-secondary' }}">
                                    {{ $usuario->permissao }}
                                </span>
                            </td>
                            <td>{{ $usuario->ultimo_acesso ? $usuario->ultimo_acesso->format('d/m/Y H:i') : 'Nunca' }}</td>
                            <td class="text-end">
                                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Tem certeza?')">
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
