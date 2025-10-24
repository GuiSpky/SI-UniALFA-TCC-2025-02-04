@extends('layouts.app')
@section('title', 'Novo Cardápio')

@section('content')
    <div class="container-fluid py-4">
        <div class="mb-4 fade-in-up">
            <div class="d-flex align-items-center mb-3">
                <a href="{{ route('cardapios.index') }}" class="btn btn-outline-secondary btn-sm me-3">
                    <i class="bi bi-arrow-left me-2"></i>Voltar
                </a>
                <div>
                    <h1 class="h2 fw-bold mb-1"><i class="bi bi-person-plus-fill me-2"></i>Novo Cardápio</h1>
                    <p class="text-muted mb-0">Preencha os dados para cadastrar um novo cardápio</p>
                </div>
            </div>
        </div>

<<<<<<< HEAD
    <!-- Form Card -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card fade-in-up" style="background-color: #252535; border: 1px solid #2a2a3e; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); overflow: hidden;">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('cardapios.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <!-- Nome -->
                        <div class="mb-4">
                            <label for="nome" class="form-label fw-bold" style="color: #ffffff;">
                                <i class="bi bi-tag me-2" style="color: #0dcaf0;"></i>Nome do Cardápio
                            </label>
                            <input type="text" name="nome" id="nome" class="form-control form-control-lg" placeholder="Digite o nome do cardápio" required style="background-color: #1a1a2e; border: 1px solid #2a2a3e; color: #ffffff; border-radius: 8px; transition: all 0.3s ease;">
                            <div class="invalid-feedback" style="color: #ff6b6b;">Por favor, insira o nome do cardápio.</div>
                        </div>
=======
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card fade-in-up shadow-sm border-0">
                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('cardapios.store') }}" method="POST">
                            @csrf
>>>>>>> 7206cff5ffaa47eca6315801c6b5ab824288de90

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>

                            <div class="mb-3">
                                <label for="item" class="form-label">Item</label>
                                <input type="text" class="form-control" id="item" name="item" required>
                            </div>

                            <div class="mb-3">
                                <label for="data" class="form-label">Data</label>
                                <input type="date" class="form-control" id="data" name="data" required>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Salvar Cardápio
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
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
=======
>>>>>>> 7206cff5ffaa47eca6315801c6b5ab824288de90
@endsection
