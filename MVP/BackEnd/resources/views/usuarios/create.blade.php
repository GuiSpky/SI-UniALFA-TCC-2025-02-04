@extends('layouts.app')

@section('title', 'Novo Usuário')

@section('content')
    <h1>Novo Usuário</h1>
    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" placeholder="Digite o nome">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Digite os itens">
        </div>
        <div class="mb-3">
            <label for="data" class="form-label">Telefone</label>
            <input type="number" name="telefone" id="telefone" class="form-control" placeholder="Digite a Data">
        </div>
        <div class="form-group mb-3">
            <label>Selecione o Cargo</label>
            <select name="cargo" class="form-control" required>
                <option value="">-- Escolha um cargo --</option>
                    <option value="1">Gerente</option>
                    <option value="2">Cozinheiro Cheff</option>
                    <option value="3">Cozinheiro</option>
                    <option value="4">Nutricionista</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label>Selecione a Escola</label>
            <select name="id_escola" class="form-control" required>
                <option value="">-- Escolha uma Escola --</option>
                @foreach ($escolas as $escola)
                    <option value="{{ $escola->id }}">{{ $escola->nome }}</option>
                @endforeach
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
