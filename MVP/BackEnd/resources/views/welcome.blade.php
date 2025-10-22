@extends('app')
@section('title', 'Bem-vindo ao GEMA')

@section('content')
<div class="container-fluid py-5 text-center fade-in-up">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="display-4 fw-bold mb-4" style="color: #ffffff;">
                <i class="bi bi-lightning-fill me-3" style="font-size: 0.9em; color: #0dcaf0;"></i>Bem-vindo ao <span style="background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">GEMA</span>
            </h1>
            <p class="lead mb-5" style="color: #b0b0b0;">
                Seu sistema de gestão eficiente para a prefeitura. Organize, planeje e execute com facilidade.
            </p>
            <div class="d-grid gap-3 col-md-8 mx-auto">
                <a href="#" class="btn btn-primary btn-lg py-3 px-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%); border: none; border-radius: 8px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                    <i class="bi bi-speedometer2 me-2"></i>Ir para o Dashboard
                </a>
                <a href="#" class="btn btn-outline-secondary btn-lg py-3 px-5" style="border-color: #2a2a3e; color: #b0b0b0; border-radius: 8px; font-weight: 600; transition: all 0.3s ease;">
                    <i class="bi bi-info-circle me-2"></i>Saiba Mais
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3) !important;
    }
    .btn-outline-secondary:hover {
        background-color: #1a1a2e;
        color: #ffffff !important;
        transform: translateY(-3px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3) !important;
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
        animation: fadeInUp 0.8s ease-out;
    }
</style>
@endsection

