@extends('app')
@section('title', 'Detalhe do Usuário')
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
                    <i class="bi bi-person-circle me-2"></i>{{ $usuario->nome }}
                </h1>
                <p class="text-muted mb-0">Informações detalhadas do usuário</p>
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
                                    {{ $usuario->id }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-9">
                            <p style="color: #b0b0b0; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">
                                <i class="bi bi-person me-2" style="color: #0dcaf0;"></i>Nome
                            </p>
                            <p class="fw-bold fs-5" style="color: #ffffff;">{{ $usuario->nome }}</p>
                        </div>
                    </div>

                    <!-- Email e Telefone -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p style="color: #b0b0b0; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">
                                <i class="bi bi-envelope me-2" style="color: #0dcaf0;"></i>Email
                            </p>
                            <p class="fw-bold fs-5" style="color: #ffffff;">
                                <a href="mailto:{{ $usuario->email }}" style="color: #0dcaf0; text-decoration: none; transition: all 0.3s ease;">
                                    {{ $usuario->email }}
                                </a>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p style="color: #b0b0b0; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">
                                <i class="bi bi-telephone me-2" style="color: #0dcaf0;"></i>Telefone
                            </p>
                            <p class="fw-bold fs-5" style="color: #ffffff;">
                                <a href="tel:{{ $usuario->telefone }}" style="color: #0dcaf0; text-decoration: none; transition: all 0.3s ease;">
                                    {{ $usuario->telefone }}
                                </a>
                            </p>
                        </div>
                    </div>

                    <!-- Cargo e Escola -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p style="color: #b0b0b0; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">
                                <i class="bi bi-briefcase me-2" style="color: #0dcaf0;"></i>Cargo
                            </p>
                            <p class="fw-bold fs-5">
                                <span class="badge" style="background-color: rgba(13, 110, 253, 0.2); color: #0dcaf0; padding: 0.4rem 0.8rem; border-radius: 6px; border: 1px solid #0dcaf0;">
                                    @php
                                        $cargos = [
                                            1 => 'Gerente',
                                            2 => 'Cozinheiro Cheff',
                                            3 => 'Cozinheiro',
                                            4 => 'Nutricionista'
                                        ];
                                    @endphp
                                    {{ $cargos[$usuario->cargo] ?? 'Não definido' }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p style="color: #b0b0b0; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">
                                <i class="bi bi-building me-2" style="color: #0dcaf0;"></i>Escola
                            </p>
                            <p class="fw-bold fs-5" style="color: #ffffff;">
                                {{ $escolas->where('id', $usuario->id_escola)->pluck('nome')->first() ?? 'Não atribuída' }}
                            </p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end gap-3 mt-5 pt-4" style="border-top: 1px solid #2a2a3e;">
                        <a class="btn btn-lg" href="{{route('usuarios.index')}}" style="background-color: #1a1a2e; color: #b0b0b0; border: 1px solid #2a2a3e; border-radius: 8px; transition: all 0.3s ease;">
                            <i class="bi bi-arrow-left me-2"></i>Voltar
                        </a>
                        <a class="btn btn-lg" href="{{route('usuarios.edit', $usuario)}}" style="background-color: #1a5f7a; color: #0dcaf0; border: 1px solid #0dcaf0; border-radius: 8px; transition: all 0.3s ease;">
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
                            <i class="bi bi-calendar me-2" style="color: #0dcaf0;"></i>{{ $usuario->updated_at->format('d/m/Y H:i') ?? 'N/A' }}
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

