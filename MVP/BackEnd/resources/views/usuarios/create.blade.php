@extends('layouts.app')

@section('title', 'Novo Usuário')

@section('content')
<div class="container-fluid py-4">
    <div class="mb-4 fade-in-up">
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary btn-sm me-3">
                <i class="bi bi-arrow-left me-2"></i>Voltar
            </a>
            <div>
                <h1 class="h2 fw-bold mb-1"><i class="bi bi-person-plus-fill me-2"></i>Novo Usuário</h1>
                <p class="text-muted mb-0">Preencha os dados para cadastrar um novo usuário</p>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card fade-in-up shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('usuarios.store') }}" method="POST" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="cargo" class="form-label">Cargo</label>
                            <select class="form-select" id="cargo" name="cargo_id" required>
                                <option value="" selected disabled>Selecione o cargo</option>
                                <option value="1">Gerente</option>
                                <option value="2">Cozinheiro Cheff</option>
                                <option value="3">Cozinheiro</option>
                                <option value="4">Nutricionista</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="permissao" class="form-label">Permissão</label>
                            <select class="form-select" id="permissao" name="permissao" required>
                                <option value="Usuário">Usuário</option>
                                <option value="Administrador">Administrador</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" required>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Salvar Usuário
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
