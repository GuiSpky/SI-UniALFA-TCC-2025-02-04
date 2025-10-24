@extends('layouts.app')
@section("title", "Detalhe da Escola")
@section("content")
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="mb-4 fade-in-up">
        <div class="d-flex align-items-center mb-3">
            <a href="{{route("escolas.index")}}" class="btn btn-outline-secondary btn-sm me-3" style="border-color: #2a2a3e; color: #b0b0b0; transition: all 0.3s ease;">
                <i class="bi bi-arrow-left me-2"></i>Voltar
            </a>
            <div>
                <h1 class="h2 fw-bold mb-1" style="color: #ffffff;">
                    <i class="bi bi-house-door-fill me-2"></i>{{ $escola->nome }}
                </h1>
                <p class="text-muted mb-0">Informações detalhadas da escola</p>
            </div>
        </div>
    </div>

    <!-- Details Card -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card fade-in-up" style="background-color: #252535; border: 1px solid #2a2a3e; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); overflow: hidden;">
                <div class="card-body p-4 p-md-5">
                    <!-- ID e Nome -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <p style="color: #b0b0b0; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">
                                <i class="bi bi-hash me-2" style="color: #0dcaf0;"></i>ID
                            </p>
                            <p class="fw-bold fs-5" style="color: #ffffff;">
                                <span class="badge" style="background-color: #0d6efd; color: white; padding: 0.5rem 0.75rem; border-radius: 6px;">
                                    {{ $escola->id }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-9">
                            <p style="color: #b0b0b0; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">
                                <i class="bi bi-building me-2" style="color: #0dcaf0;"></i>Nome
                            </p>
                            <p class="fw-bold fs-5" style="color: #ffffff;">{{ $escola->nome }}</p>
                        </div>
                    </div>

                    <!-- Cidade e Bairro -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p style="color: #b0b0b0; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">
                                <i class="bi bi-geo-alt me-2" style="color: #0dcaf0;"></i>Cidade
                            </p>
                            <p class="fw-bold fs-5" style="color: #ffffff;">
                                {{ $cidades->where("id", $escola->id_cidade)->pluck("nome")->first() ?? "Não definida" }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p style="color: #b0b0b0; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">
                                <i class="bi bi-map me-2" style="color: #0dcaf0;"></i>Bairro
                            </p>
                            <p class="fw-bold fs-5" style="color: #ffffff;">
                                {{ $bairro->where("id", $escola->id_bairro)->pluck("nome")->first() ?? "Não definido" }}
                            </p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end gap-3 mt-5 pt-4" style="border-top: 1px solid #2a2a3e;">
                        <a class="btn btn-lg" href="{{route("escolas.index")}}" style="background-color: #1a1a2e; color: #b0b0b0; border: 1px solid #2a2a3e; border-radius: 8px; transition: all 0.3s ease;">
                            <i class="bi bi-arrow-left me-2"></i>Voltar
                        </a>
                        <a class="btn btn-lg" href="{{route("escolas.edit", $escola)}}" style="background-color: #1a5f7a; color: #0dcaf0; border: 1px solid #0dcaf0; border-radius: 8px; transition: all 0.3s ease;">
                            <i class="bi bi-pencil-square me-2"></i>Editar
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Card -->
        <div class="col-lg-4">
            <div class="card fade-in-up" style="background-color: #252535; border: 1px solid #2a2a3e; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); overflow: hidden;">
                <div class="card-body p-4">
                    <h5 style="color: #ffffff; margin-bottom: 1.5rem;">
                        <i class="bi bi-info-circle me-2" style="color: #0dcaf0;"></i>Informações
                    </h5>
                    <div class="mb-3">
                        <p style="color: #b0b0b0; font-size: 0.85rem; margin-bottom: 0.5rem;">Status</p>
                        <span class="badge" style="background-color: #51cf66; color: white; padding: 0.5rem 0.75rem; border-radius: 6px;">
                            <i class="bi bi-check-circle me-1"></i>Ativo
                        </span>
                    </div>
                    <div class="mb-3" style="border-top: 1px solid #2a2a3e; padding-top: 1rem;">
                        <p style="color: #b0b0b0; font-size: 0.85rem; margin-bottom: 0.5rem;">Última atualização</p>
                        <p style="color: #ffffff; font-size: 0.9rem;">
                            <i class="bi bi-calendar me-2" style="color: #0dcaf0;"></i>{{ $escola->updated_at->format("d/m/Y H:i") ?? "N/A" }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    a:hover {
        text-decoration: underline;
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
</style>
@endsection

