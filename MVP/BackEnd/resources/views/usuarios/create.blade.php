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
                <div class="card fade-in-up border-2 shadow-sm rounded-3">
                    <div class="card-body p-4 p-md-5">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $erro)
                                        <li>{{ $erro }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('usuarios.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="tel" class="form-control" id="telefone" name="telefone" maxlength="15" required>
                            </div>

                            <div class="mb-3">
                                <label for="cargo" class="form-label">Cargo</label>
                                <select class="form-select" id="cargo" name="cargo" required>
                                    <option value="" selected disabled>Selecione o cargo</option>
                                    @foreach ($cargos as $id => $nome)
                                        <option value="{{ $id }}" {{ old('cargo') == $id ? 'selected' : '' }}>
                                            {{ $nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="escola_id" class="form-label">Escola</label>
                                <select class="form-select" id="escola_id" name="escola_id" required>
                                    <option value="">Selecione uma Escola</option>
                                    @foreach ($escolas as $escola)
                                        <option value="{{ $escola->id }}">{{ $escola->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Salvar Usuário
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const tel = document.getElementById('telefone');

            tel.addEventListener('input', function() {
                let v = this.value.replace(/\D/g, ""); // Remove tudo que não é número

                // Aplica a máscara (99) 99999-9999
                if (v.length > 0) v = "(" + v;
                if (v.length > 3) v = v.slice(0, 3) + ") " + v.slice(3);
                if (v.length > 10) v = v.slice(0, 10) + "-" + v.slice(10, 14);

                this.value = v.slice(0, 15); // limita no máximo
            });
        </script>
    </div>
@endsection
