@extends('layouts.app')
@section('title', 'Editar Usuário')

@section('content')
    <div class="container-fluid py-4">
        <div class="mb-4 fade-in-up">
            <div class="d-flex align-items-center mb-3">
                <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary btn-sm me-3">
                    <i class="bi bi-arrow-left me-2"></i>Voltar
                </a>
                <div>
                    <h1 class="h2 fw-bold mb-1"><i class="bi bi-pencil-square me-2"></i>Editar Usuário</h1>
                    <p class="text-muted mb-0">Atualize os dados do usuário</p>
                </div>
            </div>
        </div>

    <!-- Form Card -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card fade-in-up" style="background-color: #252535; border: 1px solid #2a2a3e; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); overflow: hidden;">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('usuarios.update', $usuario) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <!-- Nome -->
                        <div class="mb-4">
                            <label for="nome" class="form-label fw-bold" style="color: #ffffff;">
                                <i class="bi bi-person me-2" style="color: #0dcaf0;"></i>Nome Completo
                            </label>
                            <input type="text" name="nome" id="nome" class="form-control form-control-lg" placeholder="Digite o nome" value="{{$usuario->nome}}" required style="background-color: #1a1a2e; border: 1px solid #2a2a3e; color: #ffffff; border-radius: 8px; transition: all 0.3s ease;">
                            <div class="invalid-feedback" style="color: #ff6b6b;">Por favor, insira o nome.</div>
                        </div>

                        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Mensagens de erro --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- Nome --}}
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome"
                                    value="{{ old('nome', $usuario->nome) }}" required>
                            </div>

                            {{-- Email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $usuario->email) }}" required>
                            </div>

                            {{-- Telefone --}}
                            <div class="mb-3">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="tel" class="form-control" id="telefone" name="telefone"
                                    value="{{ old('telefone', $usuario->telefone) }}" required>
                            </div>

                            {{-- Cargo --}}
                            <div class="mb-3">
                                <label for="cargo" class="form-label">Cargo</label>
                                <select class="form-select" id="cargo" name="cargo" required>
                                    <option value="" disabled>Selecione o cargo</option>
                                    <option value="Gerente"
                                        {{ old('cargo', $usuario->cargo) == 'Gerente' ? 'selected' : '' }}>Gerente</option>
                                    <option value="Cozinheiro Cheff"
                                        {{ old('cargo', $usuario->cargo) == 'Cozinheiro Cheff' ? 'selected' : '' }}>
                                        Cozinheiro Cheff</option>
                                    <option value="Cozinheiro"
                                        {{ old('cargo', $usuario->cargo) == 'Cozinheiro' ? 'selected' : '' }}>Cozinheiro
                                    </option>
                                    <option value="Nutricionista"
                                        {{ old('cargo', $usuario->cargo) == 'Nutricionista' ? 'selected' : '' }}>
                                        Nutricionista</option>
                                </select>
                            </div>

                            {{-- Escola --}}
                            <div class="mb-3">
                                <label for="id_escola" class="form-label">Escola</label>
                                <select name="id_escola" id="id_escola" class="form-select" required>
                                    <option value="">Selecione uma Escola</option>
                                    @foreach ($escolas as $escola)
                                        <option value="{{ $escola->id }}"
                                            {{ old('id_escola', $usuario->id_escola) == $escola->id ? 'selected' : '' }}>
                                            {{ $escola->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Botões --}}
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-2"></i>Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-2"></i>Atualizar Usuário
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus,
    .form-select:focus {
        background-color: #1a1a2e !important;
        border-color: #0dcaf0 !important;
        color: #ffffff !important;
        box-shadow: 0 0 0 0.2rem rgba(13, 202, 240, 0.25);
    }

    .form-control::placeholder {
        color: #b0b0b0;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }

    .was-validated .form-control:invalid {
        border-color: #ff6b6b;
        background-image: none;
    }

    .was-validated .form-control:valid {
        border-color: #51cf66;
        background-image: none;
    }
</style>

<script>
    // Validação de formulário Bootstrap 5
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()

    // Efeitos de foco nos inputs
    document.querySelectorAll('.form-control, .form-select').forEach(input => {
        input.addEventListener('focus', function() {
            this.style.boxShadow = '0 0 0 0.2rem rgba(13, 202, 240, 0.25)';
        });

        input.addEventListener('blur', function() {
            this.style.boxShadow = 'none';
        });
    });
</script>
@endsection
