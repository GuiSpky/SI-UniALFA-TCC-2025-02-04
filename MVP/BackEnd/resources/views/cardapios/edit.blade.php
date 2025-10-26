@extends("app")
@section("title", "Editar Cardápio")
@section("content")
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="mb-4 fade-in-up">
        <div class="d-flex align-items-center mb-3">
            <a href="{{route("cardapios.index")}}" class="btn btn-outline-secondary btn-sm me-3" style="border-color: #2a2a3e; color: #b0b0b0; transition: all 0.3s ease;">
                <i class="bi bi-arrow-left me-2"></i>Voltar
            </a>
            <div>
                <h1 class="h2 fw-bold mb-1" style="color: #ffffff;">
                    <i class="bi bi-journal-text me-2"></i>Editar Cardápio
                </h1>
                <p class="text-muted mb-0">Atualize os dados do cardápio</p>
            </div>
        </div>
    </div>

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> parent of 7206cff5 (Configurados alguns cruds no front)
    <!-- Form Card -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card fade-in-up" style="background-color: #252535; border: 1px solid #2a2a3e; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); overflow: hidden;">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route("cardapios.update", $cardapio) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method("PUT")
<<<<<<< HEAD

=======

>>>>>>> parent of 7206cff5 (Configurados alguns cruds no front)
                        <!-- Nome -->
                        <div class="mb-4">
                            <label for="nome" class="form-label fw-bold" style="color: #ffffff;">
                                <i class="bi bi-tag me-2" style="color: #0dcaf0;"></i>Nome do Cardápio
                            </label>
                            <input type="text" name="nome" id="nome" class="form-control form-control-lg" placeholder="Digite o nome do cardápio" value="{{$cardapio->nome}}" required style="background-color: #1a1a2e; border: 1px solid #2a2a3e; color: #ffffff; border-radius: 8px; transition: all 0.3s ease;">
                            <div class="invalid-feedback" style="color: #ff6b6b;">Por favor, insira o nome do cardápio.</div>
                        </div>
<<<<<<< HEAD
=======
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card fade-in-up shadow-sm border-0">
                    <div class="card-body p-4 p-md-5">
>>>>>>> 7206cff5ffaa47eca6315801c6b5ab824288de90
=======
>>>>>>> parent of 7206cff5 (Configurados alguns cruds no front)

                        <!-- Item -->
                        <div class="mb-4">
                            <label for="item" class="form-label fw-bold" style="color: #ffffff;">
                                <i class="bi bi-list-check me-2" style="color: #0dcaf0;"></i>Itens do Cardápio
                            </label>
                            <input type="text" name="item" id="item" class="form-control form-control-lg" placeholder="Descreva os itens do cardápio" value="{{$cardapio->item}}" required style="background-color: #1a1a2e; border: 1px solid #2a2a3e; color: #ffffff; border-radius: 8px; transition: all 0.3s ease;">
                            <div class="invalid-feedback" style="color: #ff6b6b;">Por favor, insira os itens do cardápio.</div>
                        </div>

                        <!-- Data -->
                        <div class="mb-4">
                            <label for="data" class="form-label fw-bold" style="color: #ffffff;">
                                <i class="bi bi-calendar-date me-2" style="color: #0dcaf0;"></i>Data
                            </label>
                            <input type="date" name="data" id="data" class="form-control form-control-lg" value="{{$cardapio->data}}" required style="background-color: #1a1a2e; border: 1px solid #2a2a3e; color: #ffffff; border-radius: 8px; transition: all 0.3s ease;">
                            <div class="invalid-feedback" style="color: #ff6b6b;">Por favor, selecione a data.</div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-end gap-3 mt-5 pt-4" style="border-top: 1px solid #2a2a3e;">
                            <a class="btn btn-lg" href="{{route("cardapios.index")}}" style="background-color: #1a1a2e; color: #b0b0b0; border: 1px solid #2a2a3e; border-radius: 8px; transition: all 0.3s ease;">
                                <i class="bi bi-x-circle me-2"></i>Cancelar
                            </a>
                            <button class="btn btn-lg" type="submit" style="background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%); color: white; border: none; border-radius: 8px; transition: all 0.3s ease;">
                                <i class="bi bi-check-circle me-2"></i>Atualizar Cardápio
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> parent of 7206cff5 (Configurados alguns cruds no front)
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
<<<<<<< HEAD

=======

>>>>>>> parent of 7206cff5 (Configurados alguns cruds no front)
        input.addEventListener('blur', function() {
            this.style.boxShadow = 'none';
        });
    });
</script>
<<<<<<< HEAD
=======
>>>>>>> 7206cff5ffaa47eca6315801c6b5ab824288de90
=======
>>>>>>> parent of 7206cff5 (Configurados alguns cruds no front)
@endsection

