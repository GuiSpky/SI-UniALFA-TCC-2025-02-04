@extends('layouts.app')
@section('title', 'Editar Usuário')
@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="mb-4 fade-in-up">
        <div class="d-flex align-items-center mb-3">
            <a href="{{route('usuarios.index')}}" class="btn btn-outline-secondary btn-sm me-3" style="border-color: #2a2a3e; color: #b0b0b0; transition: all 0.3s ease;">
                <i class="bi bi-arrow-left me-2"></i>Voltar
            </a>
            <div>
                <h1 class="h2 fw-bold mb-1" style="color: #ffffff;">
                    <i class="bi bi-pencil-square me-2"></i>Editar Usuário
                </h1>
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

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold" style="color: #ffffff;">
                                <i class="bi bi-envelope me-2" style="color: #0dcaf0;"></i>Email
                            </label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="Digite o email" value="{{$usuario->email}}" required style="background-color: #1a1a2e; border: 1px solid #2a2a3e; color: #ffffff; border-radius: 8px; transition: all 0.3s ease;">
                            <div class="invalid-feedback" style="color: #ff6b6b;">Por favor, insira um email válido.</div>
                        </div>

                        <!-- Telefone -->
                        <div class="mb-4">
                            <label for="telefone" class="form-label fw-bold" style="color: #ffffff;">
                                <i class="bi bi-telephone me-2" style="color: #0dcaf0;"></i>Telefone
                            </label>
                            <input type="text" name="telefone" id="telefone" class="form-control form-control-lg" placeholder="Digite o telefone" value="{{$usuario->telefone}}" required style="background-color: #1a1a2e; border: 1px solid #2a2a3e; color: #ffffff; border-radius: 8px; transition: all 0.3s ease;">
                            <div class="invalid-feedback" style="color: #ff6b6b;">Por favor, insira o telefone.</div>
                        </div>

                        <!-- Cargo -->
                        <div class="mb-4">
                            <label for="cargo" class="form-label fw-bold" style="color: #ffffff;">
                                <i class="bi bi-briefcase me-2" style="color: #0dcaf0;"></i>Cargo
                            </label>
                            <select name="cargo" id="cargo" class="form-select form-select-lg" required style="background-color: #1a1a2e; border: 1px solid #2a2a3e; color: #ffffff; border-radius: 8px; transition: all 0.3s ease;">
                                <option value="" disabled style="color: #b0b0b0;">-- Escolha um cargo --</option>
                                <option value="1" style="background-color: #1a1a2e; color: #ffffff;" @if($usuario->cargo == 1) selected @endif>Gerente</option>
                                <option value="2" style="background-color: #1a1a2e; color: #ffffff;" @if($usuario->cargo == 2) selected @endif>Cozinheiro Cheff</option>
                                <option value="3" style="background-color: #1a1a2e; color: #ffffff;" @if($usuario->cargo == 3) selected @endif>Cozinheiro</option>
                                <option value="4" style="background-color: #1a1a2e; color: #ffffff;" @if($usuario->cargo == 4) selected @endif>Nutricionista</option>
                            </select>
                            <div class="invalid-feedback" style="color: #ff6b6b;">Por favor, selecione um cargo.</div>
                        </div>

                        <!-- Escola -->
                        <div class="mb-4">
                            <label for="id_escola" class="form-label fw-bold" style="color: #ffffff;">
                                <i class="bi bi-building me-2" style="color: #0dcaf0;"></i>Escola
                            </label>
                            <select name="id_escola" id="id_escola" class="form-select form-select-lg" required style="background-color: #1a1a2e; border: 1px solid #2a2a3e; color: #ffffff; border-radius: 8px; transition: all 0.3s ease;">
                                <option value="" disabled style="color: #b0b0b0;">-- Escolha uma escola --</option>
                                @foreach ($escolas as $escola)
                                    <option value="{{ $escola->id }}" style="background-color: #1a1a2e; color: #ffffff;" @if($usuario->id_escola == $escola->id) selected @endif>{{ $escola->nome }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" style="color: #ff6b6b;">Por favor, selecione uma escola.</div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-end gap-3 mt-5 pt-4" style="border-top: 1px solid #2a2a3e;">
                            <a class="btn btn-lg" href="{{route('usuarios.index')}}" style="background-color: #1a1a2e; color: #b0b0b0; border: 1px solid #2a2a3e; border-radius: 8px; transition: all 0.3s ease;">
                                <i class="bi bi-x-circle me-2"></i>Cancelar
                            </a>
                            <button class="btn btn-lg" type="submit" style="background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%); color: white; border: none; border-radius: 8px; transition: all 0.3s ease;">
                                <i class="bi bi-check-circle me-2"></i>Atualizar Usuário
                            </button>
                        </div>
                    </form>
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

